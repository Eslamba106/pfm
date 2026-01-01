<?php

namespace App\Repo\property_master;

use App\Models\BusinessActivity;
use App\Repo\property_master\PropertyMasterRepo;


class BusinessActivityRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(BusinessActivity::class);
    }

}