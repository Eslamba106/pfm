<?php

namespace App\Repo\facility_master;

use App\Models\ComplaintCategory;
use App\Repo\property_master\PropertyMasterRepo;


class ComplaintCategoryRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(ComplaintCategory::class);
    }

}
