<?php

namespace App\Http\Controllers\property_master;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\property_master\UnitServices;

class UnitController extends Controller
{
    public $unit_services;
    public function __construct(UnitServices $unit_services)
    {
        $this->unit_services = $unit_services;
    }
    public function index(Request $request)
    {
          // $this->authorize('complaints');
          $ids = $request->bulk_ids;
          if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
              $data = ['status' => 1, 'worker' => $request->worker];
              (new Unit())->setConnection('tenant')->whereIn('id', $ids)->update($data);
              return back()->with('success', __('general.updated_successfully'));
          }
          $search      = $request['search'];
          $query_param = $search ? ['search' => $request['search']] : '';
          $main = (new Unit())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
              $key = explode(' ', $request['search']);
              foreach ($key as $value) {
                  $q->Where('name', 'like', "%{$value}%")
                      ->orWhere('id', $value);
              }
          })
              ->latest()->paginate()->appends($query_param);

        $search = null;
        $data = [
            "main" => $main,
            "search" => $search,
        ];
        return view('admin-views.property_master_part_two.index_unit', $data);
    }
    public function create()
    {
        return view('admin-views.property_master_part_two.create_unit');
    }
    public function edit($id)
    {
        $main = (new Unit())->setConnection('tenant')->findOrFail($id);
        $data = [
            'main' => $main
        ];
        if ($main->mode == 'single') {
            return view('admin-views.property_master_part_two.single_edit_unit', $data);
        } elseif ($main->mode == 'multiple') {

            return view('admin-views.property_master_part_two.multiple_edit_unit', $data);
        }
    }

    public function unit_single(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = DB::connection('tenant')  
                        ->table('units')
                        ->whereRaw('LOWER(name) = ?', [strtolower($value)])
                        ->exists();
    
                    if ($exists) {
                        $fail(__('validation.unique', ['attribute' => $attribute]));
                    }
                }
            ],
            'code' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = DB::connection('tenant')
                        ->table('units')
                        ->whereRaw('LOWER(code) = ?', [strtolower($value)])
                        ->exists();
    
                    if ($exists) {
                        $fail(__('validation.unique', ['attribute' => $attribute]));
                    }
                }
            ],
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            // $data = $request->only(['unit_name' , 'unit_code']);
            $request->merge(['company_id' => auth()->id() ?? 1]);
            $unit_services = $this->unit_services->storePropertyMasterModal($request);
            return redirect()->route('unit.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function unit_single_edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:units,name,' .$id.'id' ,
            'code' => 'required|unique:units,code,' .$id.'id' ,
        ]);
        try {
            $request->merge(['company_id' => auth()->id()] ?? 1);
            $unit_services = $this->unit_services->updatePropertyMasterModal($request);
            return redirect()->route('unit.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function unit_multiple(Request $request)
    {
        $data = [
            "fill_zero"                     => $request->fill_zero,
            "start_unit_no"                => $request->start_unit_no,
            "width"                         => $request->width  ?? 0,
            "unit_code_prefix_status"      => $request->unit_code_prefix_status,
            "unit_code_prefix"             => $request->unit_code_prefix ?? null, 
            'unit_name_prefix'             => $request->unit_name_prefix ?? null,
            'no_of_units'                  => $request->no_of_units,
            "status"                        => $request->status
        ];
        return view('admin-views.property_master_part_two.unit_form', $data);
    }
    public function unit_multiple_store(Request $request)
    { 
        app()->make('db')->setDefaultConnection('tenant');
        $rules = [
            'unit_name' => 'required|array',
            'unit_code' => 'nullable|array',
        ];
        if(isset($request->unit_name)){
        foreach ($request->unit_name as $index => $name) {
            $rules["unit_name.$index"] = [
                'required',
                'string',
                'distinct',
                Rule::unique('units', 'name'), 
            ];
        }}
        if(isset($request->unit_code)){
            foreach ($request->unit_code as $index => $code) {
                $rules["unit_code.$index"] = [
                     
                    'string',
                    'distinct',
                    Rule::unique('units', 'code'),
                ];
            }
        }
        
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            for ($i = 0, $ii = count($request->units); $i < $ii; $i++) {
                (new Unit())->setConnection('tenant')->create([
                    // 'name'              => $request->units[$i],
                    'code'              => $request->unit_code_prefix,
                    // 'unit_no'          => (isset($request->width)) ? (str_pad('', $request->width - 1, '0') . ($i + $request->start_unit_no)) : ($i + $request->start_unit_no),
                    // 'unit_no'          =>  isset($request->width)  ? str_pad(($i + $request->start_unit_no), $request->width, '0', STR_PAD_LEFT)  : ($i + $request->start_unit_no) ,
                    'unit_no'          => isset($request->width)  ? str_pad(($i + $request->start_unit_no), $request->width, '0', STR_PAD_LEFT)  : ($i + $request->start_unit_no) ,
                    'code'          => (isset($request->width)  && isset($request->unit_code[$i]) ) ? str_pad(( $request->unit_code[$i]), $request->width, '0', STR_PAD_LEFT)  : ( $request->units[$i]) ,
                    'name'          => (isset($request->width)  && isset($request->unit_name[$i]) ) ? str_pad(( $request->unit_name[$i]), $request->width, '0', STR_PAD_LEFT)   : ( $request->units[$i]) ,
                    'status'            => $request->status,
                    'mode'              => 'multiple',
                    'prefix'            => $request->unit_code_prefix,
                    'width'             => $request->width ?? 0,
                    'company_id'        => auth()->id() ?? 1,
                ]);
            }
            return redirect()->route('unit.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function unit_multiple_edit(Request $request, $id)
    {
        $unit = (new Unit())->setConnection('tenant')->findOrFail($id);
        $request->validate([
            'unit_name.*' => 'required|unique:units,name,'.$id.'id' ,
            'unit_code.*' => 'required|unique:units,code,'.$id.'id' ,
        ]);
        try {
            $unit->update([
                // 'name'              => $request->unit_code_prefix . str_pad('', $request->width - 1, '0') . (int)$request->start_unit_no,
                // 'code'              => $request->unit_code_prefix,
                'name'              => $request->unit_name_prefix . ((isset($request->width) && $request->fill_zero == 'yes') ? str_pad('', $request->width - 1, '0'). (int)$request->start_unit_no : ''), 
                'code'              => $request->unit_code_prefix. ((isset($request->width) && $request->fill_zero == 'yes') ? str_pad('', $request->width - 1, '0'). (int)$request->start_unit_no : ''),
                'unit_no'           => (str_pad('', $request->width - 1, '0') . ((int)$request->start_unit_no)),
                'status'            => $request->status,
                'mode'              => 'multiple',
                'prefix'            => $request->unit_code_prefix,
                'width'             => $request->width,
                'company_id'        => auth()->id() ?? 1,
            ]);
            return redirect()->route('unit.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $unit = (new Unit())->setConnection('tenant')->findOrFail($request->id);
        $unit->delete();
        return redirect()->route('unit.index')->with('success', __('property_master.deleted_successfully'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Unit())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
