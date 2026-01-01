<?php

namespace App\Repo\property_master;

use App\Models\UnitType;
use App\Repo\property_master\PropertyMasterRepo;


class UnitTypeRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(UnitType::class);
    }

}