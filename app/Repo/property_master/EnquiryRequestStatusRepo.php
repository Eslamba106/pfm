<?php

namespace App\Repo\property_master;

use App\Models\EnquiryRequestStatus;
use App\Repo\property_master\PropertyMasterRepo;


class EnquiryRequestStatusRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(EnquiryRequestStatus::class);
    }

}