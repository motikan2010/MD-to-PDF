<?php


namespace App\Http\Controllers;


use App\Services\RepositoryService;
use Illuminate\Http\Request;

class RepositoryController
{

    private $repositoryService;

    public function __construct(RepositoryService $repositoryService)
    {
        $this->repositoryService = $repositoryService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $repositoryInfoList = $this->repositoryService->getRepositoryList($request->session()->get('token'));

        return view('repository.index')->with('result', [
            'repository_list' => $repositoryInfoList,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request) {
        $repoFullName = $request->get('r');
        $fileInfo = $this->repositoryService->getFileList($repoFullName, $request->session()->get('token'));
        return view('repository.detail')->with('result', [
            'repository_name' => $repoFullName,
            'repository_info' => $fileInfo,
        ]);
    }

    /**
     * @param Request $request
     */
    public function convert(Request $request) {
        $repoFullName = $request->get('r');
        $fileName = $request->get('f');
        $downloadUrl = "https://raw.githubusercontent.com/{$repoFullName}/master/{$fileName}";
        $this->repositoryService->convert($downloadUrl, $request->session()->get('token'));
    }

}
