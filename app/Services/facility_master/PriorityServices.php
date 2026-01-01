<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\PriorityRepo;
use App\Services\property_master\PropertyMasterServices;


class PriorityServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(PriorityRepo $repo){
        $this->repo = $repo;
    }


}
