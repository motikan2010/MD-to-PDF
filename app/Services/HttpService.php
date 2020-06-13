<?php


namespace App\Services;


use GuzzleHttp\Client;

class HttpService
{

    /**
     * Send GET HTTP request
     *
     * @param string $url
     * @param array $headers
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $url, array $headers) {
        $urlInfo = parse_url($url);
        $client = new Client(['base_uri' => "{$urlInfo['scheme']}://{$urlInfo['host']}"]);
        $options = [
            'headers' => $headers
        ];
        $query = (array_key_exists('query', $urlInfo)) ? "?{$urlInfo['query']}" : '';
        $response = $client->request('GET', $urlInfo['path'] . $query , $options);
        return $response->getBody();
    }

    /**
     * Get Authentication header
     *
     * @param string $token
     * @return array
     */
    public function getAuthHeader(string $token) {
        return [
            'Accept' => 'application/vnd.github.v3+json',
            'Authorization' => 'token ' . $token,
        ];
    }

}
