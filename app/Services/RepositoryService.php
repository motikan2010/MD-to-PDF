<?php


namespace App\Services;


class RepositoryService
{

    private $httpService;

    static $githubApiUrl = 'https://api.github.com';

    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
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
     * @param $repoFullName
     * @param string $token
     * @return array
     */
    public function getFileList($repoFullName, string $token) {
        $headers = $this->httpService->getAuthHeader($token);
        $repositoryFileList = json_decode($this->httpService->get(self::$githubApiUrl . "/repos/{$repoFullName}/contents/", $headers)->getContents(), true);

        $fileList = [];
        foreach ( $repositoryFileList as $repositoryFile ) {
            // var_dump($repositoryFile); // TODO
            $fileList[] = [
                'name' => $repositoryFile['name'],
                'type' => $repositoryFile['type'],
            ];
        }

        return $fileList;
    }

    /**
     * Convert MD to PDF
     *
     * @param $downloadUrl
     * @param string $token
     */
    public function convert($downloadUrl, string $token) {
        $headers = $this->httpService->getAuthHeader($token);
        $contentBody = $this->getContentsBody($downloadUrl, $headers);
        // TODO

    }

    /**
     * @param $downloadUrl
     * @param $authHeader
     * @return string
     */
    private function getContentsBody($downloadUrl, $authHeader) : string {
        return $this->httpService->get($downloadUrl, $authHeader)->getContents();
    }

}
