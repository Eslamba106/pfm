<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\WorkStatusRepo;
use App\Services\property_master\PropertyMasterServices;


class WorkStatusServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(WorkStatusRepo $repo){
        $this->repo = $repo;
    }


}
