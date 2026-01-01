<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\ComplaintCategoryRepo;
use App\Services\property_master\PropertyMasterServices;


class ComplaintCategoryServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(ComplaintCategoryRepo $repo){
        $this->repo = $repo;
    }


}
