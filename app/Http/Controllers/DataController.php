<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportDataRequest;
use App\Repositories\DataRepository;
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
        $this->repository->importData($request, $token);
        return response()->json([
            'success' => true
        ],200);
    }

    public function exportData($token)
    {
        $data_user = $this->repository->getDataFromTokenUser($token);
        return $this->repository->exportData($data_user);
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
        $this->repository->deleteAll($request);
        return response()->json([
            'success' => true
        ],200);
    }
}
