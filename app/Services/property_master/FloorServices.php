<?php 

namespace App\Services\property_master;

use App\Repo\property_master\FloorRepo;


class FloorServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(FloorRepo $repo){
        $this->repo = $repo;
    }
 
    
}