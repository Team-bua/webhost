<?php

namespace App\Repositories;

use App\Models\DataUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminRepository
{
   public function getUsers()
   {
       return User::orderBy('created_at', 'desc')->get();
   }

   public function getProfile($id)
   {
       return User::find($id);
   }

   public function countData($users)
   {
        $count_data = [];
        foreach($users as $user){
            $count = DataUser::where('user_token', $user->user_token)->count();
            $count_data[$user->id] = $count;
        }
        return $count_data;
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

    public function delete($request)
    {
        $delete = User::find($request->id);
        if($delete->role == 1){
            return response()->json([
                'success' => false,
            ]);
        }else{          
            $data = DataUser::where('user_token', $request->user_token)->get();
            foreach($data as $da){
                $da->delete();
            }
            $delete->delete();
            // $i = 1;
            // $output = null;
            // $user = User::orderBy('created_at', 'desc')->get();
            // $count_data = self::countData($user);
            // if(count($user) > 0){
            //     foreach($user as $us){
            //         $output .= '<tr>
            //                     <td class="align-middle text-center text-sm">
            //                         <p class="text-xs font-weight-bold mb-0">' .$i++. '</p>
            //                     </td>
            //                     <td class="align-middle text-center text-sm">
            //                         <p class="text-xs font-weight-bold mb-0">'.$us->name.'</p>
            //                     </td>
            //                     <td class="align-middle text-center text-sm">
            //                         <p class="text-xs font-weight-bold mb-0">'.$us->email.'</p>
            //                     </td>
            //                     <td class="align-middle text-center">
            //                     <span class="badge badge-sm bg-gradient-info">'.number_format($count_data[$us->id]).'</span>
            //                     </td>
            //                     <td class="align-middle text-center text-sm">
            //                         <p class="text-xs font-weight-bold mb-0">'.$us->user_token.'</p>
            //                     </td>
            //                     <td class="align-middle text-center text-sm">
            //                         <a href="'.route('data', $us->user_token).'"><span class="badge badge-sm bg-gradient-success">Data</span></a>
            //                     </td>
            //                     <td class="align-middle">
            //                         <a href="javascript:;" delete_id="'.$us->id.'" class="text-secondary font-weight-bold text-xs simpleConfirm">
            //                             <span class="badge bg-gradient-danger">Xóa</span>
            //                         </a>
            //                         <div class="form-check form-switch" style="margin-top: 10px">
            //                             <input class="form-check-input" onchange="updateStatus(this)" value="{{ $user->id }}" type="checkbox" name="check_all" id="check_all" @if($user->get_delete == 1) checked @endif>
            //                             <label class="form-check-label" for="rememberMe" style="font-size: 15px; color: red" >Lấy xong xóa</label>
            //                         </div>
            //                     </td>
            //                     </tr>';
            //     }
            // }
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function updateInfo($request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->save();
    }

    public function updatePass($request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->new_password);
        $user->save();
    }
}
