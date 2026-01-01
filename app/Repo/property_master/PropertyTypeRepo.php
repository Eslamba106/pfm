<?php

namespace App\Repo\property_master;

use App\Models\PropertyType;
use App\Repo\property_master\PropertyMasterRepo;


class PropertyTypeRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(PropertyType::class);
    }

}