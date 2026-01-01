<?php
namespace App\Jobs;

use App\Models\Block;
use App\Models\BlockManagement;
use App\Models\Floor;
use App\Models\FloorManagement;
use App\Models\PropertyManagement;
use App\Models\PropertyType;
use App\Models\Unit;
use App\Models\UnitCondition;
use App\Models\UnitDescription;
use App\Models\UnitManagement;;
use App\Models\View;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class ImportPropertyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $rows;

    /**
     *
     * Create a new job instance.
     */
    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * Execute the job.
     */

    public function handle(): void
    {
        foreach ($this->rows as $row) {
            //   $normalizedRow = $this->normalizeRow($row);
            $normalizedRow = $this->normalizeRow($row);
            // ---------------------
            // Property Type
            // ---------------------
            $propertyType = PropertyType::firstOrCreate([
                'name' => $normalizedRow['property_type'] ?? null,
                'code' => $normalizedRow['property_type'] ?? null,
            ]);

            // ---------------------
            // Property
            // ---------------------
            $property = PropertyManagement::firstOrCreate(
                ['name' => $normalizedRow['property_name'] ?? null],
                ['code' => $normalizedRow['property_code'] ?? null]
            );

            if ($property && $propertyType) {
                $property->property_types()->syncWithoutDetaching([$propertyType->id]);
            }

            // ---------------------
            // Block
            // ---------------------
            $blockName = Block::firstOrCreate([
                'name' => $normalizedRow['block_name'] ?? null,
                'code' => $normalizedRow['block_code'] ?? null,
            ]);

            $block = BlockManagement::firstOrCreate([
                'block_id'               => $blockName->id,
                'property_management_id' => $property->id,
            ]);

            // ---------------------
            // Floor
            // ---------------------
            $floorName = Floor::firstOrCreate([
                'name' => $normalizedRow['floor_name'] ?? null,
                'code' => $normalizedRow['floor_code'] ?? null,
            ]);

            $floor = FloorManagement::firstOrCreate([
                'floor_id'               => $floorName->id,
                'block_management_id'    => $block->id,
                'property_management_id' => $property->id,
            ]);

            // ---------------------
            // Units
            // ---------------------
            $totalUnits = ! empty($normalizedRow['total_no_of_units'])
                ? (int) $normalizedRow['total_no_of_units']
                : 1;
// ---------------------
// Units
// ---------------------
            $unitBaseName = $normalizedRow['unit_name'] ?? 'Unit';
            $unitFullName = $unitBaseName;

            $unitNo = $normalizedRow['unit_no'] ?? null;

            $unitName = Unit::firstOrCreate([
                'name' => $unitFullName,
                'code' => $unitNo ?? $unitFullName,
            ]);

// Unit Description
            $unit_description = ! empty($normalizedRow['unit_type'])
                ? UnitDescription::firstOrCreate([
                'name' => $normalizedRow['unit_type'],
                'code' => $normalizedRow['unit_type'],
            ])
                : null;

// Unit Condition
            $unit_condition = ! empty($normalizedRow['unit_condition'])
                ? UnitCondition::firstOrCreate([
                'name' => $normalizedRow['unit_condition'],
                'code' => $normalizedRow['unit_condition'],
            ])
                : null;

// View
            $view = ! empty($normalizedRow['view'])
                ? View::firstOrCreate([
                'name' => $normalizedRow['view'],
                'code' => $normalizedRow['view'],
            ])
                : null;

            UnitManagement::firstOrCreate(
                [
                    'unit_id'                => $unitName->id,
                    'property_management_id' => $property->id,
                    'block_management_id'    => $block->id,
                    'floor_management_id'    => $floor->id,
                ],
                [
                    'unit_description_id' => $unit_description->id ?? null,
                    'unit_condition_id'   => $unit_condition->id ?? null,
                    'view_id'             => $view->id ?? null,
                ]
            );
        
            // for ($i = 1; $i <= $totalUnits; $i++) {
            //     $unitBaseName = $normalizedRow['unit_name'] ?? 'Unit';
            //     $unitFullName = $totalUnits > 1 ? $unitBaseName . ' - ' . $i : $unitBaseName;

            //     $unitNo = $totalUnits > 1 ? $i : ($normalizedRow['unit_no'] ?? null);

            //     $unitName = Unit::firstOrCreate([
            //         'name' => $unitFullName,
            //         'code' => $unitNo ?? $unitFullName,
            //     ]);

            //     // Unit Description
            //     $unit_description = !empty($normalizedRow['unit_type'])
            //         ? UnitDescription::firstOrCreate([
            //             'name' => $normalizedRow['unit_type'],
            //             'code' => $normalizedRow['unit_type']
            //         ])
            //         : null;

            //     // Unit Condition
            //     $unit_condition = !empty($normalizedRow['unit_condition'])
            //         ? UnitCondition::firstOrCreate([
            //             'name' => $normalizedRow['unit_condition'],
            //             'code' => $normalizedRow['unit_condition']
            //         ])
            //         : null;

            //     // View
            //     $view = !empty($normalizedRow['view'])
            //         ? View::firstOrCreate([
            //             'name' => $normalizedRow['view'],
            //             'code' => $normalizedRow['view']
            //         ])
            //         : null;

            //     UnitManagement::firstOrCreate(
            //         [
            //             'unit_id'                => $unitName->id,
            //             'property_management_id' => $property->id,
            //             'block_management_id'    => $block->id,
            //             'floor_management_id'    => $floor->id,
            //         ],
            //         [
            //             'unit_description_id' => $unit_description->id ?? null,
            //             'unit_condition_id'   => $unit_condition->id ?? null,
            //             'view_id'             => $view->id ?? null,
            //         ]
            //     );
            // }

        }
    }
    private function normalizeRow(array $row): array
    {
        $normalized = [];

        foreach ($row as $key => $value) {
            if (is_int($key)) {
                continue;
            }

            $normalizedKey = strtolower(trim($key));
            $normalizedKey = str_replace([' ', '-'], '_', $normalizedKey);
            $normalizedKey = preg_replace('/[^a-z0-9_]/', '', $normalizedKey);

            $normalized[$normalizedKey] = $value;
        }
        return $normalized;
    }
    // private function normalizeRow($row)
    // {
    //     return is_array($row) ? $row : (array) $row;
    // }
}
