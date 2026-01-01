<?php

namespace App\Repo\property_master;

use App\Models\View;
use App\Repo\property_master\PropertyMasterRepo;


class ViewRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(View::class);
    }

}