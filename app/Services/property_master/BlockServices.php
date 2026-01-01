<?php 

namespace App\Services\property_master;

use App\Repo\property_master\BlockRepo;


class BlockServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(BlockRepo $repo){
        $this->repo = $repo;
    }
 
    
}