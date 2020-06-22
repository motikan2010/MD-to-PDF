<?php


namespace App\Http\Controllers\Api;


use App\Services\RepositoryService;
use Illuminate\Http\Request;

class RepositoryController
{

    private $repositoryService;

    public function __construct(RepositoryService $repositoryService)
    {
        $this->repositoryService = $repositoryService;
    }

    public function detail(Request $request) {
        $repoFullName = $request->get('r');
        $token = $request->session()->get('token');
        return $this->repositoryService->getFileList($repoFullName, $token);
    }

}
