<?php

namespace App\Repo\property_master;

use App\Models\Block;
use App\Repo\property_master\PropertyMasterRepo;


class BlockRepo  extends PropertyMasterRepo{

    public function __construct(){
        parent::__construct(Block::class);
    }

}