<?php

namespace App\Repositories;

use App\Models\DataUser;
use Illuminate\Support\Facades\Storage;

class DataRepository
{
    public function importData($request, $token)
    {
        $data_arr = explode(' ',explode('  ', preg_replace("/\r|\n/", " ", $request->data_text))[0]);
        $error = 1;

        for ($i=0; $i < count($data_arr); $i++) {        
            $data_all = DataUser::where('user_token', $token)
                                ->where('data', $data_arr[$i])
                                ->get();
            if(count($data_all) == 0){
                $data = new DataUser();
                $data->user_token = $token;
                $data->data = $data_arr[$i];
                $data->save(); 
            }
            else{
                $error++;
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
            $data_all = DataUser::where('user_token', $token)
                                ->where('data', $data_arr[$i])
                                ->get();
            
            if(count($data_all) == 0){
                $data = new DataUser();
                $data->user_token = $token;
                $data->data = $data_arr[$i];
                $data->save();                 
            }
            else{
                $error++;
                
            }         
        }
        if($error == 0){
            return redirect()->back()->with(['information' => 'success', 'messege' => 'Thêm dữ liệu thành công']);
        }else{
            return redirect()->back()->with(['information' => 'warning', 'messege' => 'Có '.$error.' dữ liệu trùng']);
        }
    }

    public function delete($request)
    {
        $delete = DataUser::find($request->id);
        $delete->delete();
        $i = 1;
        $output = null;
        $data = DataUser::where('user_token', $request->user_token)->get();
        if(count($data) > 0){
            foreach($data as $da){
                $output .= '<tr>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0">' .$i++. '</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0">'.$da->data.'</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0">'.$da->created_at.'</p>
                            </td>
                            <td class="align-middle">
                            <a href="javascript:;" delete_id="'.$da->id.'" class="text-secondary font-weight-bold text-xs">
                                <span class="badge bg-gradient-danger">Xoá</span>
                            </a>
                            </td>
                            </tr>';
            }
        }
        return response()->json([
            'success' => true,
            'data_del' => $output
        ]);
    }

    public function deleteAll($request)
    {
        $error = 0;
        $delete = DataUser::where('user_token', $request->user_token)->get();
        if(count($delete) != 0){
            foreach($delete as $del){
                $del->delete();
            }
        }else{
            $error = 1;
        }
        return response()->json([
            'success' => true,
            'error' => $error
        ],200);
    }
}
