<?php

namespace App\Repo\facility_master;

use App\Models\facility\Freezing;
use App\Repo\property_master\PropertyMasterRepo;


class FreezingRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Freezing::class);
    }

}

