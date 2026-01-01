<?php

namespace App\Repo\property_master;

use App\Models\Ownership;
use App\Repo\property_master\PropertyMasterRepo;


class OwnershipRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Ownership::class);
    }

}