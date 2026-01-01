<?php 

namespace App\Services\property_master;

use App\Repo\property_master\LiveWithRepo;


class LiveWithServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(LiveWithRepo $repo){
        $this->repo = $repo;
    }
 
    
}