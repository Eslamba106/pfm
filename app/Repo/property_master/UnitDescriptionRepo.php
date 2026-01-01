<?php

namespace App\Repo\property_master;

use App\Models\UnitDescription;
use App\Repo\property_master\PropertyMasterRepo;


class UnitDescriptionRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(UnitDescription::class);
    }

}