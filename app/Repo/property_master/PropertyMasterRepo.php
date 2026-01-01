<?php

namespace App\Repo\property_master;

use Illuminate\Http\Request;


    class PropertyMasterRepo
    {
        protected $model;
        public function __construct($model)
        {
            $this->model = $model;
        }

        public function storePropertyMasterModal(Request $request){
            $request->validate([
                "name"=> "required|max:150",
                // "code"=> "required|max:20",
            ],[
                "name.required"                 => __('property_master.name_required'),
                "code.required"                 => __('property_master.code_required'),
                "name.max"                      => __('property_master.name_max'),
                // "code.max"                      => __('property_master.code_max'),
            ]);
            $property_master = $this->model::create($request->except('_token' , 'q'));
            return $property_master;

        }
    public function updatePropertyMasterModal(Request $request){
        $property_master = $this->model::find($request->id);
        $property_master->update($request->except('_token' , 'q'));
        return $property_master;
    }
    public function deletePropertyMasterModal($id){
        $property_master = $this->model::find($id);
        if($property_master->delete()){
            return true;
        }else{
            return false;
        }
    }
    public function findOrFail($id)
    {
        return $this->model::findOrfail($id);
    }

}
