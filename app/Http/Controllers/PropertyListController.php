<?php

namespace App\Http\Controllers;

use App\Models\UnitManagement;
use Illuminate\Http\Request;
use App\Models\PropertyManagement;

class PropertyListController extends Controller
{
     public function index( )
    {
       
        
         
        $property     = (new PropertyManagement())->setConnection('tenant')->forUser()->get();
        // if ($property->isEmpty()) {
        //     $property = (new PropertyManagement())->setConnection('tenant')->get();
        // }
        $data = [
            'properties' => $property,
        ];
        return view('admin-views.property_list.check_property', $data);
    }

     public function image_view($id  )
    {
        $property_unit = (new UnitManagement())->setConnection('tenant')->where('property_management_id' , $id)->get();
        $property = (new PropertyManagement())->setConnection('tenant')->forUser()->with('blocks_management_child', 'blocks_management_child.block'
            , 'blocks_management_child.floors_management_child', 'blocks_management_child.floors_management_child.floor_management_main',
            'blocks_management_child.floors_management_child.unit_management_child', 'blocks_management_child.floors_management_child.unit_management_child.unit_management_main'
        )->findOrFail($id);
        // $property = PropertyManagement::findOrFail($id);
        $data = [
            'property_item' => $property,
            'property_unit' => $property_unit,
        ];
        return view('admin-views.property_list.view_image', $data);
    }
    public function list_view($id )
    {
              
        $property_unit = (new UnitManagement())->setConnection('tenant')->where('property_management_id' , $id)->get();
        $property = (new PropertyManagement())->setConnection('tenant')->forUser()->with('blocks_management_child', 'blocks_management_child.block'
            , 'blocks_management_child.floors_management_child', 'blocks_management_child.floors_management_child.floor_management_main',
            'blocks_management_child.floors_management_child.unit_management_child', 'blocks_management_child.floors_management_child.unit_management_child.unit_management_main'
        )->findOrFail($id);
        // $property = PropertyManagement::findOrFail($id);
        $data = [
            'property_item' => $property,
            'property_unit' => $property_unit,
        ];
        return view('admin-views.property_list.list_view', $data);
    }
}
