<?php

namespace App\Repositories;

use App\Models\DataUser;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataRepository
{
    public function importData($request, $token)
    {
        $data_arr = explode(' ',explode('  ', preg_replace("/\r|\n/", " ", $request->data_text))[0]);
        $error = 1;

        for ($i=0; $i < count($data_arr); $i++) {
            $data_array_2 = explode('|',$data_arr[$i]);
            for ($j=0; $j < count($data_array_2); $j++) {
                $data_all = DataUser::where('user_token', $token)
                                    ->where('data', $data_array_2[$j])
                                    ->get();
                if(count($data_all) == 0){
                    $data = new DataUser();
                    $data->user_token = $token;
                    $data->data = $data_array_2[$j];
                    $data->save(); 
                }
                else{
                    $error++;
                }
            }           
        }
    }

    public function getDataFromTokenUser($token)
    {
        return DataUser::where('user_token', $token)->get();
    }

    public function exportData($data_user)
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
        foreach ($data_user as $du) {
            $du->delete();
        }
        return response()->download(storage_path('app/'.$date.'.txt'));
    }

    public function importFile($request)
    {
        $data = file_get_contents($request->text_file->getRealPath());
        $token = $request->token_user;
        $error = 0;
        $data_arr = explode('  ', preg_replace("/\r|\n/", " ", $data));
        
        for ($i=0; $i < count($data_arr); $i++) {
            $data_array_2 = explode('|',$data_arr[$i]);
            for ($j=0; $j < count($data_array_2); $j++) {
                $data_all = DataUser::where('user_token', $token)
                                    ->where('data', $data_array_2[$j])
                                    ->get();
               
                if(count($data_all) == 0){
                    $data = new DataUser();
                    $data->user_token = $token;
                    $data->data = $data_array_2[$j];
                    $data->save(); 
                }
                else{
                    $error++;
                }
            }           
        }
    }
}
