<?php

namespace App\Repo\facility_master;

use App\Models\WorkStatus;
use App\Repo\property_master\PropertyMasterRepo;


class WorkStatusRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(WorkStatus::class);
    }

}
