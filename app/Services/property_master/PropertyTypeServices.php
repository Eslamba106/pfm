<?php 

namespace App\Services\property_master;

use App\Repo\property_master\PropertyTypeRepo;


class PropertyTypeServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(PropertyTypeRepo $repo){
        $this->repo = $repo;
    }

    
}