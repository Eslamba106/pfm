<?php

namespace App\Services\facility_master;

use App\Repo\facility_master\AssetGroupRepo;
use App\Services\property_master\PropertyMasterServices;


class AssetGroupServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(AssetGroupRepo $repo){
        $this->repo = $repo;
    }


}
