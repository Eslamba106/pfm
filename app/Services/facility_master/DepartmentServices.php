<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\DepartmentRepo;
use App\Services\property_master\PropertyMasterServices;


class DepartmentServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(DepartmentRepo $repo){
        $this->repo = $repo;
    }


}
