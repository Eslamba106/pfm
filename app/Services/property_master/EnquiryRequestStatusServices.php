<?php 

namespace App\Services\property_master;

use App\Repo\property_master\EnquiryRequestStatusRepo;


class EnquiryRequestStatusServices extends PropertyMasterServices
{
    protected $repo;
    public function __construct(EnquiryRequestStatusRepo $repo){
        $this->repo = $repo;
    }
 
    
}