<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminRepository
{
   public function getUsers()
   {
       return User::orderBy('created_at', 'desc')->get();
   }

   public function createUser($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_token = Str::random(30);
        $user->save();
    }
}
