<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\UnitManagement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
      public function admin_dashboard()
    {
        
    
        $companies = Company::orderBy('id', 'desc')
            ->limit(100)
            ->get();  
        $data              = [ 
            'companies'            => $companies,
            
        ];
        return view("super_admin.admin_dashboard", $data);
    }
    
}
