<?php

namespace App\Repo\property_master;

use App\Models\UnitCondition;
use App\Repo\property_master\PropertyMasterRepo;


class UnitConditionRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(UnitCondition::class);
    }

}