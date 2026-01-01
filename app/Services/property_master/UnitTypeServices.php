<?php 

namespace App\Services\property_master;

use App\Repo\property_master\UnitTypeRepo;


class UnitTypeServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(UnitTypeRepo $repo){
        $this->repo = $repo;
    }
 
    
}