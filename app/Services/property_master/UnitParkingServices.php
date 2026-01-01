<?php 

namespace App\Services\property_master;

use App\Repo\property_master\UnitParkingRepo;


class UnitParkingServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(UnitParkingRepo $repo){
        $this->repo = $repo;
    }
 
    
}