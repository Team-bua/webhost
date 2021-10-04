<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\DataUser;
use App\Models\User;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    protected $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function documentApi()
    {
        return view('admin.document');
    }

    public function viewAdmin($token)
    {
        $datas = DataUser::where('user_token', $token)->orderBy('created_at', 'desc')->paginate(20);
        $user = User::where('user_token', $token)->first();
        return view('admin.dashboard', compact('token', 'datas', 'user'));
    }

    public function getProfile($id)
    {
        $user = $this->repository->getProfile($id);
        return view('admin.profile', compact('user'));
    }

    public function viewUsers()
    {
        if(Auth::user()->role == 0){
            return redirect()->route('data');
        }else{
            $users = $this->repository->getUsers();
            $count_data = $this->repository->countData($users);
            return view('admin.users', compact('users', 'count_data'));
        }      
    }

    public function createUser(RegisterUserRequest $request)
    {
        $this->repository->createUser($request);
        return response()->json([
            'success' => true
        ],200);
    }

    public function updateInfo(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' =>'required|max:30|regex:/(^[\pL0-9 ]+$)/u',
            ],
            [
                'name.required' => 'Vui lòng nhập tên',
                'name.max' => 'Giới hạn 30 ký tự',
                'name.regex' => 'Tên không có ký tự đặc biệt',
            ]
        );
        $this->repository->updateInfo($request, $id);
        return redirect()->back()->with('information', 'Cập nhật thành công');
    }

    public function updatePass(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'new_password' => 'required|min:5|max:25',
                'confirm_password' => 'required|same:new_password',
            ],
            [
                'new_password.required' => 'Vui lòng nhập mật khẩu',              
                'new_password.min' => 'Thấp nhất 5 ký tự',
                'new_password.max' => 'Giới hạn 25 ký tự',
                'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
                'confirm_password.same' => 'Xác nhận mật khẩu không chính xác',
            ]
        );
        $this->repository->updatePass($request, $id);
        return redirect()->back()->with('changepass', 'Cập nhật thành công');
    }

    public function getDelete(Request $request)
    {
        $user = User::find($request->id);
        if($user){
            $user->get_delete = $request->get_delete;
            $user->save();
            return 1;
        }
        else
        {
            return 0;
        }
        
    }

    public function delete(Request $request)
    {
        return $this->repository->delete($request);
    }

}
