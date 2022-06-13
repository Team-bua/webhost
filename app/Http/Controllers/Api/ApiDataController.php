<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApiDataController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|unique:data_user,data',
            'user_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $user_token = User::where('user_token', $request->user_token)->first();
        if(!isset($user_token)){
            return response()->json([
                'status' => 'error',
                'message' => 'Unknown user token'
            ],500);
        }else{
            DataUser::create($request->all());
            return response()->json([
                'status' => 'success',
            ],200);
        }
    }

    public function getData($token)
    {
        $user_token = DataUser::where('user_token', $token)->inRandomOrder()->first();
        $user = User::where('user_token', $token)->first();

        if(isset($user_token->data)){
            $lock = Cache::lock($user_token->data, 5);
            if($user->get_delete == 1){
                if ($lock->get()) {
                    if($user_token){
                        $data = $user_token->data;
                        if ($user_token->limit != 0) {
                            $user_token->limit = $user_token->limit - 1;
                            $user_token->save();
                        }
                        if ($user_token->limit == 0) {
                            $user_token->delete();
                        }
                        return '{"status":"success","data":"'.$data.'"}';
                    }else{
                        return response()->json([
                            'status' => 'error',
                        ],500);
                    }
                    $lock->release();
                }else{
                    return Http::get(url("/api/get-data/{$token}"));
                }
            }else{
                $data = $user_token->data;
                return '{"status":"success","data":"'.$data.'"}';
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Out of data'
            ],500);
        }
    }

}
