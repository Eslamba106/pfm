<?php
namespace App\Http\Controllers\property_transactions;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\AgreementDetails;
use App\Models\AgreementUnits;
use App\Models\CountryMaster;
use App\Models\property_transactions\Termination;
use App\Models\ServiceMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TerminationController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('agreement');
        $ids = $request->bulk_ids;

        if ($request->bulk_action_btn === 'update_status' && is_array($ids) && count($ids)) {
            $data = ['status' => 1];
            (new Termination())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search       = $request['search'];
        $query_param  = $search ? ['search' => $request['search']] : '';
        $terminations = (new Termination())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('agreement_no', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        }) //->where('status' , 'pending')
            ->with(['tenant', 'agreement'])
            ->latest()->orderBy('created_at', 'asc')->paginate()->appends($query_param);
        // if ($request->bulk_action_btn === 'filter') {
        //     $data         = ['status' => 1];
        //     $report_query = (new Termination())->setConnection('tenant')->query();
        //     if ($request->booking_status && $request->booking_status != -1 &&  ($request->booking_status == 'signed')) {
        //         $report_query->where('booking_status', $request->booking_status);
        //     }
        //     if ($request->status && $request->status != -1) {
        //         $report_query->where('status', $request->status);
        //     }
        //     if ($request->booking_status && $request->booking_status != -1 &&  ($request->booking_status == 'unsigned')) {
        //         $report_query->where('booking_status','!=' , 'signed');
        //     }
        //     if ($request->from && $request->to) {
        //         $startDate = Carbon::createFromFormat('d/m/Y', $request->from)->startOfDay();
        //         $endDate   = Carbon::createFromFormat('d/m/Y', $request->to)->endOfDay();
        //         $report_query->whereBetween('created_at', [$startDate, $endDate]);
        //     }
        //     $terminations = $report_query->orderBy('created_at', 'desc')->paginate();
        // }
        $data = [
            'terminations' => $terminations,
            'search'       => $search,

        ];
        return view("admin-views.property_transactions.termination.terminations_list", $data);
    }

    public function create($id)
    {
        $agreement         = (new Agreement())->setConnection('tenant')->where('id', $id)->first();
        $agreement_details = (new AgreementDetails())->setConnection('tenant')->where('agreement_id', $id)->first();
        $agreement_units   = (new AgreementUnits())->setConnection('tenant')->with('agreement_units:id,unit_id,property_management_id,block_management_id,floor_management_id', 'agreement_units.unit_management_main:id,name', 'agreement_units.property_unit_management:id,code', 'agreement_units.block_unit_management:id,block_id', 'agreement_units.floor_unit_management:id,floor_id')->where('agreement_id', $id)->select('id', 'unit_id')->get();

        $data = [
            'agreement'         => $agreement,
            'agreement_details' => $agreement_details,
            'agreement_units'   => $agreement_units,
        ];

        return view("admin-views.property_transactions.termination.create", $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'agreement_id'     => 'required',
            'termination_date' => 'required',
            'applicant'        => 'nullable|string|max:255',
            'units'            => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $unit_ids   = json_encode($request->units);
            $is_created = DB::connection('tenant')->table('terminations')->insert([
                'agreement_id' => $request->input('agreement_id'),
                'tenant_id'    => $request->input('tenant_id'),
                'comment'      => $request->input('comment'),
                'applicant'    => $request->input('applicant'),
                'status'       => 'pending',
                'unit_ids'     => $unit_ids,
                'created_at'   => now(),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
        return to_route('termination.index')->with('success', __('property_master.added_successfully'));
    }

    public function edit($id)
    {
        $termination       = (new Termination())->setConnection('tenant')->findOrFail($id);
        $agreement         = (new Agreement())->setConnection('tenant')->select('id', 'agreement_no', 'tenant_id')->where('id', $termination->agreement_id)->first();
        $agreement_details = (new AgreementDetails())->setConnection('tenant')->where('agreement_id', $termination->agreement_id)->first();
        $agreement_units   = (new AgreementUnits())->setConnection('tenant')->with('agreement_units:id,unit_id,property_management_id,block_management_id,floor_management_id', 'agreement_units.unit_management_main:id,name', 'agreement_units.property_unit_management:id,code', 'agreement_units.block_unit_management:id,block_id', 'agreement_units.floor_unit_management:id,floor_id')->where('agreement_id', $termination->agreement_id)->select('id', 'unit_id')->get();
        $units             = json_decode($termination->unit_ids);
        // dd($units);
        $data = [
            'agreement'         => $agreement,
            'agreement_details' => $agreement_details,
            'agreement_units'   => $agreement_units,
            'units'             => $units,
            'termination'       => $termination,
        ];

        return view("admin-views.property_transactions.termination.edit", $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'agreement_id'     => 'required',
            'termination_date' => 'required',
            'applicant'        => 'nullable|string|max:255',
            'units'            => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $termination = DB::connection('tenant')->table('terminations')->where('id', $id)->first();
            if (! $termination) {
                return redirect()->back()->with('error', __('property_master.not_found'));
            }
            $unit_ids = json_encode($request->units);
            DB::connection('tenant')->table('terminations')->where('id', $id)->update([
                'agreement_id' => $request->input('agreement_id'),
                'tenant_id'    => $request->input('tenant_id'),
                'comment'      => $request->input('comment'),
                'applicant'    => $request->input('applicant'),
                'unit_ids'     => $unit_ids,
                'updated_at'   => now(),
            ]);

            DB::commit();
            return to_route('termination.index')->with('success', __('property_master.added_successfully'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return to_route('termination.index')->with('success', __('property_master.updated_successfully'));
    }

    public function approved($id)
    {
        $termination       = (new Termination())->setConnection('tenant')->findOrFail($id);
        $agreement         = (new Agreement())->setConnection('tenant')->select('id', 'agreement_no', 'tenant_id')->where('id', $termination->agreement_id)->first();
        $agreement_details = (new AgreementDetails())->setConnection('tenant')->where('agreement_id', $termination->agreement_id)->first();
        $units_ids         = json_decode($termination->unit_ids, true);
        $units_ids         = is_array($units_ids) ? $units_ids : [];

        if (in_array(-1, $units_ids)) {
            $agreement_units = (new AgreementUnits())->setConnection('tenant')->where('agreement_id', $termination->agreement_id)->pluck('id');
            (new AgreementUnits())->setConnection('tenant')->where('agreement_id', $termination->agreement_id)->delete();
        } else {
            $agreement_units = (new AgreementUnits())->setConnection('tenant')->where('agreement_id', $termination->agreement_id)
                ->whereIn('id', $units_ids)
                ->pluck('id');
            (new AgreementUnits())->setConnection('tenant')->where('agreement_id', $termination->agreement_id)
                ->whereIn('id', $units_ids)
                ->delete();
        }
        $termination->update([
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', __('general.updated_successfully'));

    }
    public function rejected($id)
    {
        $termination = (new Termination())->setConnection('tenant')->findOrFail($id);

        $termination->update([
            'status' => 'rejected',
        ]);
        return redirect()->back()->with('success', __('general.updated_successfully'));
    }
    public function delete(Request $request)
    {
        $termination = (new Termination())->setConnection('tenant')->findOrFail($request->id);
        $termination->delete();
        return redirect()->back()->with('success', __('general.deleted_successfully'));
    }

    public function renewal($id)
    {
        $agreement         = (new Agreement())->setConnection('tenant')->findOrFail($id);
        $agreement_details = (new AgreementDetails())->setConnection('tenant')->where('agreement_id', $id)->first();
        $agreement_units   = (new AgreementUnits())->setConnection('tenant')->where('agreement_id', $id)->get();
        $services_master   = (new ServiceMaster())->setConnection('tenant')->get();

        $tenants                  = DB::connection('tenant')->table('tenants')->get();
        $agents                   = DB::connection('tenant')->table('agents')->get();
        $enquiry_statuses         = DB::connection('tenant')->table('enquiry_statuses')->get();
        $enquiry_request_statuses = DB::connection('tenant')->table('enquiry_request_statuses')->get();
        $employees                = DB::connection('tenant')->table('employees')->get();
        $country_master           = (new CountryMaster())->setConnection('tenant')->get();
        $live_withs               = DB::connection('tenant')->table('live_withs')->get();
        $business_activities      = DB::connection('tenant')->table('business_activities')->get();
        $buildings                = DB::connection('tenant')->table('property_management')->get();
        $unit_descriptions        = DB::connection('tenant')->table('unit_descriptions')->get();
        $unit_conditions          = DB::connection('tenant')->table('unit_conditions')->get();
        $unit_types               = DB::connection('tenant')->table('unit_types')->get();
        $views                    = DB::connection('tenant')->table('views')->get();
        $property_types           = DB::connection('tenant')->table('property_types')->get();
        $data                     = [
            'services_master'          => $services_master,
            'unit_types'               => $unit_types,
            'property_types'           => $property_types,
            'views'                    => $views,
            'unit_conditions'          => $unit_conditions,
            'unit_descriptions'        => $unit_descriptions,
            'buildings'                => $buildings,
            'enquiry_request_statuses' => $enquiry_request_statuses,
            'enquiry_statuses'         => $enquiry_statuses,
            'employees'                => $employees,
            'agents'                   => $agents,
            'country_master'           => $country_master,
            'live_withs'               => $live_withs,
            'business_activities'      => $business_activities,
            'tenants'                  => $tenants,
            'agreement'                => $agreement,
            'agreement_details'        => $agreement_details,
            'agreement_units'          => $agreement_units,
        ];
        return view('admin-views.property_transactions.termination.renewal', $data);
    }

    public function renewal_update(Request $request, $id)
    {

        $agreement         = (new Agreement())->setConnection('tenant')->findOrFail($id);
        $agreement_details = (new AgreementDetails())->setConnection('tenant')->where('agreement_id', $id)->first();
        $agreement_units   = (new AgreementUnits())->setConnection('tenant')->where('agreement_id', $id)->get();

        $agreement_details->update([
            'period_to' => $period_to ?? null,
        ]);
        if (in_array('-1', $request->units)) {
            foreach ($agreement_units as $key => $agreement_units_value) {
                ($request->period_from != null) ? $period_from = Carbon::createFromFormat('d/m/Y', $request->period_from)->format('Y-m-d') : $period_from = null;
                ($request->period_to != null) ? $period_to     = Carbon::createFromFormat('d/m/Y', $request->period_to)->format('Y-m-d') : $period_to     = null;
                $agreement_units_value->update([
                    'lease_break_comment'   => $request->comment,
                    'rent_amount'           => $request->rent_amount,
                    'total_net_rent_amount' => (($agreement_units_value->vat_percentage * $request->rent_amount) + $request->rent_amount),
                    'commencement_date'     => $period_from,
                    'expiry_date'           => $period_to,
                ]);
            }
        } else {
            foreach ($agreement_units as $key => $agreement_units_value) {
                if (! in_array($agreement_units_value->id, $request->units)) {
                    continue;
                }
                ($request->period_from != null) ? $period_from = Carbon::createFromFormat('d/m/Y', $request->period_from)->format('Y-m-d') : $period_from = null;
                ($request->period_to != null) ? $period_to     = Carbon::createFromFormat('d/m/Y', $request->period_to)->format('Y-m-d') : $period_to     = null;
                $agreement_units_value->update([
                    'lease_break_comment'   => $request->comment,
                    'rent_amount'           => $request->rent_amount,
                    'total_net_rent_amount' => (($agreement_units_value->vat_percentage * $request->rent_amount) + $request->rent_amount),
                    'commencement_date'     => $period_from,
                    'expiry_date'           => $period_to,
                ]);
            }
        }
        return to_route('agreement.index')->with('success', __('general.updated_successfully'));
        // } catch (Throwable $e) {
        //     DB::rollBack();
        //     return redirect()->back()->with("error", $e->getMessage());
        // }
    }
}
