<?php 

namespace App\Services\property_master;

use App\Repo\property_master\UnitConditionRepo;


class UnitConditionServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(UnitConditionRepo $repo){
        $this->repo = $repo;
    }
 
    
}