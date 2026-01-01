<?php

namespace App\Repo\property_master;

use App\Models\LiveWith;
use App\Repo\property_master\PropertyMasterRepo;


class LiveWithRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(LiveWith::class);
    }

}