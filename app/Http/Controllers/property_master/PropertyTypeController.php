<?php
namespace App\Http\Controllers\property_master;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use App\Services\property_master\PropertyTypeServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PropertyTypeController extends Controller
{
    public $property_type_services;
    public $model;
    public function __construct(PropertyTypeServices $property_type_services)
    {
        $this->property_type_services = $property_type_services;
    }
    public function index(Request $request)
    {
        // $this->authorize('complaints');
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status' && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new PropertyType())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search        = $request['search'];
        $query_param   = $search ? ['search' => $request['search']] : '';
        $property_type = (new PropertyType())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'           => $property_type,
            'search'         => $search,
            'route'          => 'property_type',
            'description'    => 'no',
            'code_status'    => 'yes',
            'department'     => 'no',
            'complaint_type' => 'no',

        ];
        return view("admin-views.property_master.index", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('tenant.property_types', 'name'),
            ],
            'code' => [
                'required',
            ],
        ]);
        try {
            $property_type_services = $this->property_type_services->storePropertyMasterModal($request);
            return redirect()->route('property_type.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id)
    {
        $property_type_services = $this->property_type_services->findOrFail($id);
        $data                   = [
            "main"           => $property_type_services,
            'route'          => 'property_type',
            'description'    => 'no',
            'code_status'    => 'yes',
            'department'     => 'no',
            'complaint_type' => 'no',

        ];
        return view("admin-views.property_master.edit", $data);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|unique:property_types,name,' . $id,
            'code' => 'required',
        ]);
        try {
            $property_type_services = $this->property_type_services->updatePropertyMasterModal($request);
            return redirect()->route('property_type.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $property_type_services        = $this->property_type_services->findOrFail($request->id);
        $property_type_services_delete = $this->property_type_services->deletePropertyMasterModal($request->id);
        ($property_type_services_delete == true) ? redirect()->route("property_type.index")->with("success", __('property_master.deleted_successfully'))
        : redirect()->back()->with('error', __('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        $main = (new PropertyType())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', __('property_master.updated_successfully'));
    }

}
