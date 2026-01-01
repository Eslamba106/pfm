<?php

namespace App\Repo\property_master;

use App\Models\UnitParking;
use App\Repo\property_master\PropertyMasterRepo;


class UnitParkingRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(UnitParking::class);
    }

}