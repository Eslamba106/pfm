<?php

namespace App\Services\property_master;

class PropertyMasterServices
{
    protected $repo;

    public function __construct($repo)
    {
        $this->repo = $repo;
    }
    public function storePropertyMasterModal($request){
        return $this->repo->storePropertyMasterModal($request);
    }
    public function updatePropertyMasterModal($request){
        return $this->repo->updatePropertyMasterModal($request);
    }
    public function findOrFail($request){
        return $this->repo->findOrFail($request);
    }
    public function deletePropertyMasterModal($id){
        return $this->repo->deletePropertyMasterModal($id);
    }
}