<?php

namespace App\Repo\facility_master;

use App\Models\facility\Priority;
use App\Repo\property_master\PropertyMasterRepo;


class PriorityRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Priority::class);
    }

}

