<?php 

namespace App\Services\property_master;

use App\Repo\property_master\OwnershipRepo;


class OwnershipServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(OwnershipRepo $repo){
        $this->repo = $repo;
    }
 
    
}