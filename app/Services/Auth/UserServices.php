<?php 

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServices 
{

    public function login($data)
    {

        if(isset($data['user_name']) && Auth::attempt(['user_name' => $data['user_name'], 'password' => $data['password']])){
            $user = User::active()->where('user_name' , $data['user_name'])->first();
            return $user;
        }elseif(isset($data['email']) && Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            $user = User::active()->where('email' , $data['email'])->first();
            return $user;
        }
        else
        {
            return false;
        }
    }

}