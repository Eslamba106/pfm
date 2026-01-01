<?php

namespace App\Repo\property_master;

use App\Models\Floor;
use App\Repo\property_master\PropertyMasterRepo;


class FloorRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Floor::class);
    }

}