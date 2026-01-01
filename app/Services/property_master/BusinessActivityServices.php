<?php 

namespace App\Services\property_master;

use App\Repo\property_master\BusinessActivityRepo;


class BusinessActivityServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(BusinessActivityRepo $repo){
        $this->repo = $repo;
    }
 
    
}