<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportDataRequest;
use App\Models\User;
use App\Repositories\DataRepository;
use Exception;
use Illuminate\Http\Request;

class DataController extends Controller
{

    protected $repository;

    public function __construct(DataRepository $repository)
    {
        $this->repository = $repository;
    }

    public function importData(ImportDataRequest $request, $token)
    {
        return $this->repository->importData($request, $token);
    }

    public function editData($id)
    {
        $data = $this->repository->editData($id);
        return view('admin.edit', compact('data'));
    }

    public function updateData(ImportDataRequest $request, $id)
    {
        $this->repository->updateData($request, $id);
        return redirect()->back()->with('message', '1');
    }

    public function exportData($token)
    {
        $data_user = $this->repository->getDataFromTokenUser($token);
        return $this->repository->exportData($data_user, $token);
    }

    public function importFile(Request $request)
    {
        return $this->repository->importFile($request);
    }

    public function delete(Request $request)
    {
        return $this->repository->delete($request);
    }

    public function deleteAll(Request $request)
    {
        return $this->repository->deleteAll($request);
    }

    public function getDelete(Request $request)
    {
        $user = User::where('user_token', $request->user_token)->first();
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

    public function deleteFlies()
    {
        return $this->repository->deleteFiles();
    }
}
