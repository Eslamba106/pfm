<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\FreezingRepo;
use App\Services\property_master\PropertyMasterServices;


class FreezingServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(FreezingRepo $repo){
        $this->repo = $repo;
    }


}
