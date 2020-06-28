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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request) {
        $token = $request->session()->get('token');
        if ( empty($token) ) {
            return redirect(route('index'));
        }
        $repositoryInfoList = $this->repositoryService->getRepositoryList($token);

        return view('repository.index')->with('result', [
            'repository_list' => $repositoryInfoList,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail() {
        return view('repository.detail');
    }

}
