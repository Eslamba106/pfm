<?php

namespace App\Repo\facility_master;

use App\Models\facility\AssetGroup;
use App\Repo\property_master\PropertyMasterRepo;


class AssetGroupRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(AssetGroup::class);
    }

}
