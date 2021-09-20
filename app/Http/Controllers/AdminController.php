<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    protected $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewAdmin()
    {
        return view('admin.dashboard');
    }

    public function viewUsers()
    {
        if(Auth::user()->role == 0){
            return redirect()->route('data');
        }else{
            $users = $this->repository->getUsers();
            return view('admin.users', compact('users'));
        }      
    }

    public function createUser(RegisterUserRequest $request)
    {
        $this->repository->createUser($request);
        return response()->json([
            'success' => true
        ],200);
    }
}
