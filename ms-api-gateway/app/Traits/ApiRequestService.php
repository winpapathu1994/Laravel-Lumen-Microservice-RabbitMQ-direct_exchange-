<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
trait ApiRequestService
{
    /**
     * @param       $method
     * @param       $requestUrl
     * @param array $formParams
     * @param array $headers
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $requestUrl, $formParams = [], $headers = []) : string
    {

        $client = new Client([
            'base_uri' => $this->baseUri
        ]);
        $headers['Accept'] = 'application/json';
        if (isset($this->secret)) {
            $headers['accessKey'] = $this->secret;
        }
        // Check access key exist or not
        if (empty(request()->header('Authorization'))) {
            throw new UnauthorizedHttpException('Basic', 'MISSING_AUTH_FIELD');
        }

        $headers['Authorization'] = request()->header('Authorization');
       
        $response = $client->request($method, $requestUrl,
            [
                'form_params' => $formParams,
                'headers' => $headers,
                'http_errors' => false,
            ]
        );

        //$data = json_decode($response->getbody(), true);
        return $response->getbody()->getContents();
    }
}
