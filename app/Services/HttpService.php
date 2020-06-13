<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpService
{

    /**
     * Send GET HTTP request
     *
     * @param string $url
     * @param array $headers
     * @return \Psr\Http\Message\StreamInterface
     */
    public function get(string $url, array $headers) {
        $urlInfo = parse_url($url);
        $client = new Client(['base_uri' => "{$urlInfo['scheme']}://{$urlInfo['host']}"]);
        $options = [
            'headers' => $headers
        ];
        $query = (array_key_exists('query', $urlInfo)) ? "?{$urlInfo['query']}" : '';
        try {
            $response = $client->request('GET', $urlInfo['path'] . $query , $options);
        } catch (GuzzleException $e) {
            // TODO
        }
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
