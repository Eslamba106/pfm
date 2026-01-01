<?php

namespace App\Repo\property_master;

use App\Models\EnquiryStatus;
use App\Repo\property_master\PropertyMasterRepo;


class EnquiryStatusRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(EnquiryStatus::class);
    }

}