<?php

namespace App\Http\Controllers\property_master;

use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\property_master\FloorServices;

class FloorController extends Controller
{
    public $floor_services;
    public function __construct(FloorServices $floor_services)
    {
        $this->floor_services = $floor_services;
    }
    public function index(Request $request)
    {
          // $this->authorize('complaints');
          $ids = $request->bulk_ids;
          if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
              $data = ['status' => 1, 'worker' => $request->worker];
              (new Floor())->setConnection('tenant')->whereIn('id', $ids)->update($data);
              return back()->with('success', __('general.updated_successfully'));
          }
          $search      = $request['search'];
          $query_param = $search ? ['search' => $request['search']] : '';
          $main = (new Floor())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
              $key = explode(' ', $request['search']);
              foreach ($key as $value) {
                  $q->Where('name', 'like', "%{$value}%")
                      ->orWhere('id', $value);
              }
          })
              ->latest()->orderBy('name' , 'desc')->paginate()->appends($query_param);        $search = null;
        $data = [
            "main" => $main,
            "search" => $search,
        ];
        return view('admin-views.property_master_part_two.index', $data);
    }
    public function create()
    {
        return view('admin-views.property_master_part_two.create');
    }
    public function edit($id){
        $main = (new Floor())->setConnection('tenant')->findOrFail($id);
        $data = [
            'main'=> $main
        ] ;
        if($main->mode == 'single'){
            return view('admin-views.property_master_part_two.single_edit', $data);

        }elseif($main->mode == 'multiple'){

            return view('admin-views.property_master_part_two.multiple_edit', $data);

        }
    }
  
    public function floor_single(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = DB::connection('tenant')  
                        ->table('floors')
                        ->whereRaw('LOWER(name) = ?', [strtolower($value)])
                        ->exists();
    
                    if ($exists) {
                        $fail(__('validation.unique', ['attribute' => $attribute]));
                    }
                }
            ],
            'code' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } 
        try { 
            $request->merge(['company_id' => auth()->id() ?? 1]);
            $floor_services = $this->floor_services->storePropertyMasterModal($request);
            return redirect()->route('floor.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function floor_single_edit(Request $request , $id)
    {
        $request->validate([
            'name' => 'required|unique:floors,name,' . $id . ',id',
            'code'      => 'required',

        ]);
        try {
            $request->merge(['company_id' => auth()->id()?? 1]);
            $floor_services = $this->floor_services->updatePropertyMasterModal($request);
            return redirect()->route('floor.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function floor_multiple(Request $request)
    { 
        $data = [
            "fill_zero"                     => $request->fill_zero,
            "start_floor_no"                => $request->start_floor_no,
            "width"                         => $request->width ?? 0,
            "floor_code_prefix_status"      => $request->floor_code_prefix_status,
            "floor_code_prefix"             => $request->floor_code_prefix ?? null, 
            'floor_name_prefix'             => $request->floor_name_prefix ?? null,
            'no_of_floors'                  => $request->no_of_floors,
            "status"                        => $request->status
        ];
        return view('admin-views.property_master_part_two.floor_form', $data);
    }
    public function floor_multiple_store(Request $request)
    { 
        app()->make('db')->setDefaultConnection('tenant');
        $rules = [
            'floor_name' => 'required|array',
            'floor_code' => 'nullable|array',
        ];
        if(isset($request->floor_name)){
        foreach ($request->floor_name as $index => $name) {
            $rules["floor_name.$index"] = [
                'required',
                'string',
                'distinct',
                Rule::unique('floors', 'name'), 
            ];
        }}
        if(isset($request->floor_code)){
            foreach ($request->floor_code as $index => $code) {
                $rules["floor_code.$index"] = [
                     
                    'string',
                    'distinct',
                    Rule::unique('floors', 'code'),
                ];
            }
        }
        
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // $request->validate([
        //     'floor_name.*' => 'required|string|distinct|unique:floors,name' ,
        //     'floor_code.*' => 'required|string|distinct|unique:floors,code' ,
        // ]);

        try {
            for ($i = 0, $ii = count($request->floors); $i < $ii; $i++) {
                (new Floor())->setConnection('tenant')->create([
                    // 'name'              => $request->floors[$i],
                    // 'code'              => $request->floor_code_prefix,
                    'floor_no'          => isset($request->width)  ? str_pad(($i + $request->start_floor_no), $request->width, '0', STR_PAD_LEFT)  : ($i + $request->start_floor_no) ,
                    'code'          => (isset($request->width)  && isset($request->floor_code[$i]) ) ? str_pad(( $request->floor_code[$i]), $request->width, '0', STR_PAD_LEFT)  : ( $request->floors[$i]) ,
                    'name'          => (isset($request->width)  && isset($request->floor_name[$i]) ) ? str_pad(( $request->floor_name[$i]), $request->width, '0', STR_PAD_LEFT)   : ( $request->floors[$i]) ,
                    // 'code'              => (isset($request->floor_code) ? $request->floor_code : '') . (isset($width) ? str_pad($i + $request->start_floor_no, $width, '0', STR_PAD_LEFT) : $i + $request->start_floor_no) ,
                    'status'            => $request->status,
                    'mode'              => 'multiple',
                    'prefix'            => $request->floor_code_prefix ,
                    'width'             => $request->width  ?? 0 ,
                    'company_id'        => auth()->id() ?? 1,
                ]);
            }
            return redirect()->route('floor.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function floor_multiple_edit(Request $request , $id)
    {
        $request->validate([
            'name' => 'required|unique:floors,name' ,
            'code' => 'required|unique:floors,code' ,
        ]);
        $floor = (new Floor())->setConnection('tenant')->findOrFail($id);
        try {
            // for ($i = 0, $ii = count($request->floors); $i < $ii; $i++) {
                $floor->update([
                    'name'              => $request->floor_name_prefix . ((isset($request->width) && $request->fill_zero == 'yes') ? str_pad('', $request->width - 1, '0'). (int)$request->start_floor_no : ''),
                    // 'name'              => $request->floor_name_prefix .str_pad('', $request->width - 1, '0'). (int)$request->start_floor_no,
                    'code'              => $request->floor_code_prefix. ((isset($request->width) && $request->fill_zero == 'yes') ? str_pad('', $request->width - 1, '0'). (int)$request->start_floor_no : ''),
                    'floor_no'          => (str_pad('', $request->width - 1, '0') . ( (int)$request->start_floor_no)) ,
                    'status'            => $request->status,
                    'mode'              => 'multiple',
                    'prefix'            => $request->floor_code_prefix ,
                    'width'             => $request->width ,
                    'company_id'        => auth()->id() ?? 1,
                ]);
            // }
            return redirect()->route('floor.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $floor = (new Floor())->setConnection('tenant')->findOrFail($request->id);
        $floor->delete();
        return redirect()->route('floor.index')->with('success', __('property_master.deleted_successfully'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Floor())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
