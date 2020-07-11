<?php


namespace App\Services;

class RepositoryService
{

    private $httpService;
    private $convertService;

    static $githubApiUrl = 'https://api.github.com';

    public function __construct(HttpService $httpService, ConvertService $convertService)
    {
        $this->httpService = $httpService;
        $this->convertService = $convertService;
    }

    /**
     * Get repository list
     *
     * @param string $token
     * @return array
     */
    public function getRepositoryList(string $token) {
        $headers = $this->httpService->getAuthHeader($token);
        $repositoryInfoList = [];
        for ( $page = 1; true; $page++ ) {
            $responseList = json_decode($this->httpService->get(self::$githubApiUrl . "/user/repos?page={$page}", $headers)->getContents(), true);
            foreach ( $responseList as $response ) {
                $repositoryInfoList[] = [
                    'full_name' => $response['full_name'],
                ];
            }
            if ( count($responseList) < 30 ) {
                break;
            }
        }

        return $repositoryInfoList;
    }

    /**
     * Get file list
     *
     * @param string $repoFullName
     * @param string $fileName
     * @param string $token
     * @return array
     */
    public function getFileList(string $repoFullName, string $fileName, string $token = null) {
        $headers = $token !== null ? $this->httpService->getAuthHeader($token) : [];
        $repositoryFileList = json_decode($this->httpService->get(self::$githubApiUrl . "/repos/{$repoFullName}/contents/{$fileName}", $headers)->getContents(), true);

        return array_map(function ($repositoryFile) {
            return [
                'name' => $repositoryFile['name'],
                'type' => $repositoryFile['type'],
            ];
        }, $repositoryFileList);
    }

    /**
     * @param string $repoFullName
     * @param array $fileNameList
     * @param string $token
     * @return string|null
     */
    public function multiConvert(string $repoFullName, array $fileNameList, string $token = null) {
        $headers = $token !== null ? $this->httpService->getAuthHeader($token) : [];
        $mdBodyList = array_map(function ($fileName) use ($repoFullName, $headers) {
            return $this->getContentsBody("https://raw.githubusercontent.com/{$repoFullName}/master{$fileName}", $headers);
        }, $fileNameList);

        return $this->convertService->convertMdToPdf($mdBodyList);
    }

    /**
     * Get file body from GitHub
     *
     * @param $downloadUrl
     * @param $authHeader
     * @return string
     */
    private function getContentsBody($downloadUrl, $authHeader) : string {
        return $this->httpService->get($downloadUrl, $authHeader)->getContents();
    }

}
