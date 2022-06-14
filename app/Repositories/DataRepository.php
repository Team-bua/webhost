<?php

namespace App\Repositories;

use App\Models\DataUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DataRepository
{
    public function importData($request, $token)
    {
        $data_arr = explode('  ', explode('   ', preg_replace("/\r|\n/", "  ", $request->data_text))[0]);
        $error = 0;

        for ($i=0; $i < count($data_arr); $i++) {
            $data_all = DataUser::where('user_token', $token)
                                ->where('data', $data_arr[$i])
                                ->get();
            if(count($data_all) == 0){
                $data = new DataUser();
                $data->user_token = $token;
                $data->limit = $request->limit;
                $data->data = $data_arr[$i];
                $data->save();
            }
            else{
                $error++;
            }
        }
        if($error == 0){
            return response()->json([
                'success' => true
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'duplicate' => 0,
                'error' => $error
            ],500);
        }
    }

    public function editData($id)
    {
        return DataUser::find($id);
    }

    public function updateData($request, $id)
    {
        $data = DataUser::find($id);
        $data->data = $request->data_text;
        $data->save();
    }

    public function getDataFromTokenUser($token)
    {
        return DataUser::where('user_token', $token)->get();
    }

    public function exportData($data_user, $token)
    {
        $data = '';
        $c = 0;
        $date = date('Y-m-d His');
        foreach ($data_user as $value) {
            $data .= $value->data . PHP_EOL;
            $c++;
        }
        $data = "Tổng dữ liệu: " . $c . " - Ngày xuất: " . date('Y-m-d H:i:s') . "\n" . $data;
        Storage::put($date.'.txt', $data);
        $user = User::where('user_token', $token)->first();
        if($user->get_delete == 1){
            foreach ($data_user as $du) {
                $du->delete();
            }
        }
        return response()->download(storage_path('app/'.$date.'.txt'));
    }

    public function importFile($request)
    {

        if(isset($request)){
            $data = file_get_contents($request->text_file->getRealPath());
            $token = $request->token_user;
            $limit = $request->limit_import;
            $error = 0;

            $data_arr = explode('  ', preg_replace("/\r|\n/", " ", $data));

            $data_records = [];

            $data_user = [];
            $unique = array_unique($data_arr);
            $data_all = DataUser::where('user_token', $token)->get();
            foreach($data_all as $dt){
                    $data_user[] = $dt->data;
            }
            $arr_diff = array_diff($unique, $data_user);
            foreach($arr_diff as $arr){
                if($arr != ''){
                    $sup_arr = [];
                    $sup_arr = ['user_token'=>$token,
                                'data' => $arr,
                                'limit' => $limit,
                                'created_at' => Carbon::now(),
                                ];
                    $data_records[] = $sup_arr;
                }
            }
            foreach(array_chunk($data_records,1000) as $d) {

                DataUser::insert($d);

             }
             return redirect()->back()->with(['information' => 'success', 'messege' => 'Thêm dữ liệu thành công']);
         }
    }

    public function delete($request)
    {
        $delete = DataUser::find($request->id);
        $delete->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteFiles()
    {
        $storage = Storage::disk('local');
        if($storage)
        {
            foreach($storage->files() as $file) {
                $storage->delete($file);
            }
        }

    }

    public function deleteAll($request)
    {
        $error = 0;
        $delete = DataUser::where('user_token', $request->user_token)->get();
        if(count($delete) != 0){
            DB::table('data_user')
                ->where('user_token', $request->user_token)
                ->delete();
        }else{
            $error = 1;
        }
        return response()->json([
            'success' => true,
            'error' => $error
        ],200);
    }
}
