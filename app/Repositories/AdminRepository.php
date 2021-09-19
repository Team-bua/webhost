<?php

namespace App\Repositories;

use App\Models\User;

class AdminRepository
{
   public function getUsers()
   {
       return User::orderBy('created_at', 'desc')->get();
   }
}
