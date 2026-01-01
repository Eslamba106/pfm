<?php 

namespace App\Services\property_master;

use App\Repo\property_master\EnquiryStatusRepo;


class EnquiryStatusServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(EnquiryStatusRepo $repo){
        $this->repo = $repo;
    }
 
    
}