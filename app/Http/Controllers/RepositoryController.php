<?php


namespace App\Http\Controllers;


use App\Services\RepositoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail() {
        return view('repository.detail');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function convert(Request $request) {
        $repoFullName = $request->get('r');
        $fileName = $request->get('f');
        $downloadUrl = "https://raw.githubusercontent.com/{$repoFullName}/master/{$fileName}";
        $pdfData = $this->repositoryService->multiConvert($downloadUrl, $request->session()->get('token'));

        $filename = 'out.pdf'; // TODO
        return Response::make($pdfData, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }

}
