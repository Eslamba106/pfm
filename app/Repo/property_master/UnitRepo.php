<?php

namespace App\Repo\property_master;

use App\Models\Unit;
use App\Repo\property_master\PropertyMasterRepo;


class UnitRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Unit::class);
    }

}