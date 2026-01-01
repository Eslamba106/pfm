<?php

namespace App\Repo\facility_master;

use App\Models\Complaint;
use App\Repo\property_master\PropertyMasterRepo;


class MainComplaintRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Complaint::class);
    }

}
