<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\RepositoryDetailRequest;
use App\Services\RepositoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RepositoryController
{

    private $repositoryService;

    /**
     * RepositoryController constructor.
     * @param RepositoryService $repositoryService
     */
    public function __construct(RepositoryService $repositoryService)
    {
        $this->repositoryService = $repositoryService;
    }

    /**
     * Show file list.
     *
     * @param RepositoryDetailRequest $request
     * @return array
     */
    public function detail(RepositoryDetailRequest $request) {
        $repoFullName = $request->get('r');
        $fileName = $request->get('f');
        $token = $request->session()->get('user')['token'];
        return $this->repositoryService->getFileList($repoFullName, ($fileName === null ? '' : $fileName), $token);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function convert(Request $request) {
        $repoFullName = $request->post('r');
        $convertFileNameList = $request->post('f');

        $pdfData = $this->repositoryService->multiConvert($repoFullName, $convertFileNameList, $request->session()->get('user')['token']);
        $filename = 'out.pdf'; // TODO
        return Response::make($pdfData, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"{$filename}\""
        ]);
    }

}
