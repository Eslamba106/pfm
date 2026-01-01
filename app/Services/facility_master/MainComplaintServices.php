<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\MainComplaintRepo;
use App\Services\property_master\PropertyMasterServices;


class MainComplaintServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(MainComplaintRepo $repo){
        $this->repo = $repo;
    }


}
