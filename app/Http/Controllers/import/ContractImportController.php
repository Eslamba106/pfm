<?php
namespace App\Http\Controllers\import;

use App\Http\Controllers\Controller;
use App\Imports\ContractTemplate;
use App\Models\Agreement;
use App\Models\AgreementDetails;
use App\Models\AgreementUnits;
use App\Models\AgreementUnitsService;
use App\Models\Block;
use App\Models\BlockManagement;
use App\Models\CountryMaster;
use App\Models\Floor;
use App\Models\FloorManagement;
use App\Models\PropertyManagement;
use App\Models\ServiceMaster;
use App\Models\Tenant;
use App\Models\Unit;
use App\Models\UnitManagement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ContractImportController extends Controller
{
    public function import_page(Request $request)
    {
        $instructions = '
        <p>1. ' . ui_change('download_the_format_file_and_fill_it_with_proper_data.') . '</p>
        <p>2. ' . ui_change('you_can_download_the_example_file_to_understand_how_the_data_must_be_filled.') . '</p>
        <p>3. ' . ui_change('once_you_have_downloaded_and_filled_the_format_file') . ', ' . ui_change('upload_it_in_the_form_below_and_submit.') . '</p>
        <p>4. ' . ui_change('after_uploading_products_you_need_to_edit_them_and_set_product_images_and_choices.') . '</p>
        <p>5. ' . ui_change('you_can_get_brand_and_category_id_from_their_list_please_input_the_right_ids.') . '</p>
        <p>6. ' . ui_change('you_can_upload_your_product_images_in_product_folder_from_gallery_and_copy_image_path.') . '</p>
    ';
        $data = [
            'instructions' => $instructions,
            'file'         => 'agreement',
        ];

        return view('import_excel.upload_page', $data);
    }
    public function preview(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);
        $path = $request->file('file')->getRealPath();

        $data = Excel::toCollection(null, $request->file('file'))->first();

        return view('import_excel.agreement_preview', compact('data'));
    }
    public function confirm_agreement(Request $request)
    {
        $rows = $request->input('rows', []);
        foreach ($rows as $row) {
            $normalizedRow = $this->normalizeRow($row);

            $validator = Validator::make($normalizedRow, [
                'lease_agreement_no' => 'required',
                'tenant_name'        => 'required',
                'property_name'      => 'required',
                'block_name'         => 'required',
                'floor_name'         => 'required',
                'unit'               => 'required',
                'lease_start_date'   => 'required',
                'lease_end_date'     => 'required',
                'invoicing_frequncy' => 'required',
                'rent_start_date'    => 'required',
                'rent_end_date'      => 'required',
                'currency'           => 'required',
                'rent_per_month'     => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('import_contract')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                $normalizedRow = $this->normalizeRow($row);

                $country = CountryMaster::select('id', 'country_id', 'country_code')->first();

                $tenant = Tenant::firstOrCreate(
                    ['name' => trim($normalizedRow['tenant_name'])],
                    ['type' => 'individual', 'country_id' => $country->id]
                );

                $property = PropertyManagement::firstOrCreate(
                    ['name' => $normalizedRow['property_name']],
                    ['code' => $normalizedRow['prop_code'] ?? null]
                );

                $blockName = Block::firstOrCreate(
                    ['name' => $normalizedRow['block_name'], 'code' => $normalizedRow['block_code'] ?? null]
                );
                $block = BlockManagement::firstOrCreate([
                    'block_id'               => $blockName->id,
                    'property_management_id' => $property->id,
                ]);
                $floorName = Floor::firstOrCreate(
                    ['name' => $normalizedRow['floor_name'], 'code' => $normalizedRow['floor_code'] ?? null]
                );
                $floor = FloorManagement::firstOrCreate([
                    'floor_id'               => $floorName->id,
                    'block_management_id'    => $block->id,
                    'property_management_id' => $property->id,
                ]);
                $unit = Unit::firstOrCreate(
                    ['unit_no' => $normalizedRow['unit']],
                    ['name' => $normalizedRow['unit'], 'code' => $normalizedRow['unit']]
                );

                $unit_management = UnitManagement::firstOrCreate([
                    'unit_id'                => $unit->id,
                    'property_management_id' => $property->id,
                    'block_management_id'    => $block->id,
                    'floor_management_id'    => $floor->id,
                ]);

                $agreement = Agreement::updateOrCreate(
                    ['agreement_no' => $normalizedRow['lease_agreement_no']],
                    [
                        'agreement_no'   => $normalizedRow['lease_agreement_no'],
                        'agreement_date' => $normalizedRow['date'] ?? Carbon::now(),
                        'tenant_id'      => $tenant->id,
                        'status'         => 'pending',
                        'country_id'     => $country->id,
                        'booking_status' => 'agreement',
                    ]
                );
                AgreementDetails::updateOrCreate(
                    ['agreement_id' => $agreement->id],
                    [
                        'period_from' => $normalizedRow['lease_start_date'],
                        'period_to'   => $normalizedRow['lease_end_date'],
                    ]
                );
                $rentModes = [
                    0 => ['select', 'select_rent_mode'],
                    1 => ['daily', 'per day'],
                    2 => ['monthly', 'per month'],
                    3 => ['bi_monthly', 'every two months', 'bimonthly'],
                    4 => ['quarterly', 'every 3 months'],
                    5 => ['half_yearly', 'semi annual', 'semi-annual'],
                    6 => ['yearly', 'annually', 'per year'],
                ];
                $excelValue     = strtolower(trim($normalizedRow['invoicing_frequncy']));
                $paymentModeKey = collect($rentModes)->search(fn($synonyms) =>
                    in_array($excelValue, array_map('strtolower', $synonyms))
                ) ?: 0;

                $agreementUnit = AgreementUnits::updateOrCreate(
                    [
                        'agreement_id' => $agreement->id,
                        'unit_id'      => $unit->id, 
                    ],
                    [
                        'property_id'           => $property->id,
                        'commencement_date'     => $normalizedRow['rent_start_date'],
                        'expiry_date'           => $normalizedRow['rent_end_date'],
                        'payment_mode'          => $paymentModeKey,
                        'rent_amount'           => $normalizedRow['rent_per_month'],
                        'rent_mode'             => $paymentModeKey,
                        'total_net_rent_amount' => $normalizedRow['rent_per_month'],
                    ]
                );
                if (! empty($normalizedRow['service_start_date'])) {
                    $chargeMode = ServiceMaster::first();
                    AgreementUnitsService::updateOrCreate(
                        [
                            'agreement_unit_id' => $agreementUnit->id,
                        ],
                        [
                            // 'service_frequency' => $normalizedRow['service_frequency'] ?? null,
                            // 'start_date'        => $normalizedRow['service_start_date'] ?? null,
                            // 'end_date'          => $normalizedRow['service_end_date'] ?? null,
                            'amount'            => $normalizedRow['service_amount_in_bd_exlusive_vat'],
                            'vat'               => 0,
                            'total'             => $normalizedRow['service_amount_in_bd_exlusive_vat'],
                            'other_charge_type' => $chargeMode->id,
                        ]
                    );
                }
                signed($agreement->id);
            }

            DB::commit();
            return redirect()->route('agreement.index')->with('success', ui_change('imported_successfully'));

        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->route('import_contract')
                ->with('error',$th->getMessage())
                ->withInput();
        }
    }

    // public function confirm_agreement(Request $request)
    // {
    //     $rows = $request->input('rows', []);
    //     foreach ($rows as $row) {
    //         $normalizedRow = $this->normalizeRow($row);
    //         Log::info($normalizedRow);
    //     }
    // foreach ($rows as $row) {
    //     $normalizedRow = $this->normalizeRow($row);
    //     $validator     = Validator::make($normalizedRow, [
    //         'lease_agreement_no' => 'required',
    //         'tenant_name'        => 'required',
    //         'property_name'      => 'required',
    //         'block_name'         => 'required',
    //         'floor_name'         => 'required',
    //         'unit'               => 'required',
    //         'lease_start_date'   => 'required',
    //         'lease_end_date'     => 'required',
    //         'invoicing_frequncy' => 'required',
    //         'rent_start_date'    => 'required',
    //         'rent_end_date'      => 'required',
    //         'currency'           => 'required',
    //         'rent_per_month'     => 'required',

    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('import_contract')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }
    // }
    // DB::beginTransaction();
    // try {
    //     foreach ($rows as $row) {
    //         $normalizedRow = $this->normalizeRow($row);

    //         $country = CountryMaster::select('id', 'country_id', 'country_code')->first();
    //         $tenant  = Tenant::firstOrCreate(
    //             ['name' => trim($normalizedRow['tenant_name'])],
    //             ['type' => 'individual', 'country_id' => $country->id]
    //         );

    //         // 4. Property
    //         $property = PropertyManagement::firstOrCreate(
    //             ['name' => $normalizedRow['property_name']],
    //             ['code' => $normalizedRow['propcode'] ?? null]
    //         );

    //         // 5. Block
    //         $blockName = Block::firstOrCreate(
    //             ['name' => $normalizedRow['block_name'], 'code' => $normalizedRow['blockcode'] ?? null]
    //         );
    //         $block = BlockManagement::firstOrCreate([
    //             'block_id'               => $blockName->id,
    //             'property_management_id' => $property->id,
    //         ]);

    //         // 6. Floor
    //         $floorName = Floor::firstOrCreate(
    //             ['name' => $normalizedRow['floor_name'], 'code' => $normalizedRow['floorcode'] ?? null]
    //         );
    //         $floor = FloorManagement::firstOrCreate([
    //             'floor_id'               => $floorName->id,
    //             'block_management_id'    => $block->id,
    //             'property_management_id' => $property->id,
    //         ]);

    //         // 7. Unit
    //         $unit = Unit::firstOrCreate(
    //             ['unit_no' => $normalizedRow['unit']],
    //             ['name' => $normalizedRow['unit'], 'code' => $normalizedRow['unit']]
    //         );

    //         $unit_management = UnitManagement::firstOrCreate([
    //             'unit_id'                => $unit->id,
    //             'property_management_id' => $property->id,
    //             'block_management_id'    => $block->id,
    //             'floor_management_id'    => $floor->id,
    //         ]);

    //         // 8. Agreement
    //         $agreement = Agreement::updateOrCreate(
    //             ['agreement_no' => $normalizedRow['lease_agreement_no']],
    //             [
    //                 'agreement_no'   => $normalizedRow['lease_agreement_no'],
    //                 'agreement_date' => $normalizedRow['date'] ?? Carbon::now(),
    //                 'tenant_id'      => $tenant->id,
    //                 'status'         => 'pending',
    //                 'country_id'     => $country->id,
    //                 'booking_status' => 'agreement',
    //             ]
    //         );

    //         // 9. Agreement Details
    //         AgreementDetails::updateOrCreate(
    //             ['agreement_id' => $agreement->id],
    //             [
    //                 'period_from' => $normalizedRow['lease_start_date'],
    //                 'period_to'   => $normalizedRow['lease_end_date'],
    //             ]
    //         );

    //         // 10. Rent mode mapping
    //         $rentModes = [
    //             0 => ['select', 'select_rent_mode'],
    //             1 => ['daily', 'per day'],
    //             2 => ['monthly', 'per month'],
    //             3 => ['bi_monthly', 'every two months', 'bimonthly'],
    //             4 => ['quarterly', 'every 3 months'],
    //             5 => ['half_yearly', 'semi annual', 'semi-annual'],
    //             6 => ['yearly', 'annually', 'per year'],
    //         ];
    //         $excelValue     = strtolower(trim($normalizedRow['invoicing_frequncy']));
    //         $paymentModeKey = collect($rentModes)->search(fn($synonyms) =>
    //             in_array($excelValue, array_map('strtolower', $synonyms))
    //         ) ?: 0;

    //         // 11. Agreement Units
    //         AgreementUnits::updateOrCreate(
    //             [
    //                 'agreement_id' => $agreement->id,
    //                 'unit_id'      => $unit_management->id,
    //             ],
    //             [
    //                 'property_id'           => $property->id,
    //                 'commencement_date'     => $normalizedRow['rent_start_date'],
    //                 'expiry_date'           => $normalizedRow['rent_end_date'],
    //                 'payment_mode'          => $paymentModeKey,
    //                 'rent_amount'           => $normalizedRow['rent_per_month'],
    //                 'rent_mode'             => $paymentModeKey,
    //                 'total_net_rent_amount' => $normalizedRow['rent_per_month'],
    //             ]
    //         );
    //         AgreementUnitsService::updateOrCreate([]);
    //     }
    //     DB::commit();
    //     return redirect()->route('agreement.index')->with('success', ui_change('imported_successfully'));
    // } catch (Throwable $th) {
    //     DB::rollBack();
    //     return redirect()->route('import_contract')
    //         ->withErrors($th->getMessage())
    //         ->withInput();
    // }

    // }
    // private function normalizeRow(array $row): array
    // {
    //     $normalized = [];

    //     $map = [
    //         'leaseagreementno'  => 'lease_agreement_no',
    //         'tenantname'        => 'tenant_name',
    //         'propertyname'      => 'property_name',
    //         'blockname'         => 'block_name',
    //         'floorname'         => 'floor_name',
    //         'unit'              => 'unit',
    //         'leasestartdate'    => 'lease_start_date',
    //         'leaseenddate'      => 'lease_end_date',
    //         'invoicingfrequncy' => 'invoicing_frequncy',
    //         'rentstartdate'     => 'rent_start_date',
    //         'rentenddate'       => 'rent_end_date',
    //         'currency'          => 'currency',
    //         'rentpermonth'      => 'rent_per_month',
    //     ];

    //     foreach ($row as $key => $value) {
    //         $normalizedKey = strtolower(trim($key));
    //         $normalizedKey = str_replace([' ', '-', '/'], '', $normalizedKey); // بدون underscore
    //         $normalizedKey = preg_replace('/[^a-z0-9]/', '', $normalizedKey);

    //         if (isset($map[$normalizedKey])) {
    //             $normalized[$map[$normalizedKey]] = is_string($value) ? trim($value) : $value;
    //         } else {
    //             $normalized[$normalizedKey] = is_string($value) ? trim($value) : $value;
    //         }
    //     }

    //     return $normalized;
    // }

    private function normalizeRow(array $row): array
    {
        $normalized = [];

        foreach ($row as $key => $value) {
            $normalizedKey = strtolower(trim($key));
            $normalizedKey = str_replace([' ', '-'], '_', $normalizedKey);
            $normalizedKey = preg_replace('/[^a-z0-9_]/', '', $normalizedKey);

            $normalized[$normalizedKey] = $value;
        }

        return $normalized;
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new ContractTemplate, $request->file('file'));

        return back()->with('success', ui_change('imported_successfully'));
    }

}
