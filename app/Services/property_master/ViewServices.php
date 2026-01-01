<?php 

namespace App\Services\property_master;

use App\Repo\property_master\ViewRepo;


class ViewServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(ViewRepo $repo){
        $this->repo = $repo;
    }
 
    
}