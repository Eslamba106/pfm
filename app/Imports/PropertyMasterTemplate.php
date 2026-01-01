<?php
namespace App\Imports;

use App\Models\Block;
use App\Models\BlockManagement;
use App\Models\Floor;
use App\Models\FloorManagement;
use App\Models\PropertyManagement;
use App\Models\PropertyType;
use App\Models\Unit;
use App\Models\UnitCondition;
use App\Models\UnitDescription;
use App\Models\UnitManagement;
use App\Models\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PropertyMasterTemplate implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    { 
        foreach ($rows as $row) { 
            $propertyType = PropertyType::firstOrCreate(['name' => $row['property_type'], 'code' => $row['block_code']]);

            $property = PropertyManagement::firstOrCreate(
                ['name' => $row['property_name']],
                [
                    'code' => $row['property_code'] ?? null,
                ]
            );
            if ($property) {
                $property->property_types()->sync($propertyType);
            }
            // ---------------------
            // Block
            // ---------------------
            $blockName = Block::firstOrCreate(['name' => $row['block_name'], 'code' => $row['block_code']]);

            $block = BlockManagement::firstOrCreate(
                [
                    'block_id'               => $blockName->id,
                    'property_management_id' => $property->id,
                ],
                [

                ]
            );

            // ---------------------
            // Floor
            // ---------------------
            $floorName = Floor::firstOrCreate(['name' => $row['floor_name'], 'code' => $row['floor_code']]);

            $floor = FloorManagement::firstOrCreate(
                [
                    'floor_id'               => $floorName->id,
                    'block_management_id'    => $block->id,
                    'property_management_id' => $property->id,
                ],
                [

                ]
            );

            // ---------------------
            // Unit
            // ---------------------
            // Unit
            $unitName = ! empty($row['unit_no'])
            ? Unit::firstOrCreate(['name' => $row['unit_no'], 'code' => $row['unit_no']])
            : null;
            if(!$unitName){

                $unitName = ! empty($row['unit_name'])
                ? Unit::firstOrCreate(['name' => $row['unit_name'], 'code' => $row['unit_name']])
                : null;
            }

// Unit Description
            $unit_description = ! empty($row['unit_type'])
            ? UnitDescription::firstOrCreate(['name' => $row['unit_type'], 'code' => $row['unit_type']])
            : null;

// Unit Condition
            $unit_condition = ! empty($row['unit_condition'])
            ? UnitCondition::firstOrCreate(['name' => $row['unit_condition'], 'code' => $row['unit_condition']])
            : null;

// View
            $view = ! empty($row['view'])
            ? View::firstOrCreate(['name' => $row['view'], 'code' => $row['view']])
            : null;
 
            if ($unitName ) {
                Log::info("Unit " . $unitName);
                $unit = UnitManagement::firstOrCreate(
                    [
                        'unit_id'                => $unitName->id,
                        'property_management_id' => $property->id,
                        'block_management_id'    => $block->id,
                        'floor_management_id'    => $floor->id,
                    ],
                    [
                        'unit_description_id'    => $unit_description->id ?? null,
                        'unit_condition_id'      => $unit_condition->id ?? null,
                        'view_id'                => $view->id ?? null,
                        'property_management_id' => $property->id,
                        'block_management_id'    => $block->id,
                        'floor_management_id'    => $floor->id,
                        'unit_id'                => $unitName->id,
                    ]
                );
            } 
            // Log::info('Imported Unit', [
            //     'property' => $property,
            //     'block'    => $block,
            //     'floor'    => $floor,
            //     'unit'     => $unit,
            // ]);
        }
        //    foreach ($rows as $row) {
        //     Log::info($row);

        // }
    }
}
 