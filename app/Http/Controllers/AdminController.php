<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

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
        $users = $this->repository->getUsers();
        return view('admin.users', compact('users'));
    }
}
