<?php 

namespace App\Services\property_master;

use App\Repo\property_master\UnitRepo;


class UnitServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(UnitRepo $repo){
        $this->repo = $repo;
    }
 
    
}