<?php
/**
 * Created by PhpStorm.
 * User: hankunwang
 * Date: 15/04/18
 * Time: 2:48 AM
 */

namespace Hugostech\Data_interaction;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Log;

class DataInteractionService
{
    use Signature;

    private $client;
    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('DataInteraction.API_URL')]);
        if (strtolower(config('DataInteraction.MODE')) == 'strict'){
            $this->checkConnection();
        }

    }

    private function checkConnection(){
        $response = $this->client->request('GET', 'health');
        if ($response->getReasonPhrase() != 'OK'){
            throw new \Exception('API server error', 500);
        }
    }

    public function get($url,$query=''){
        try{
            return $this->client->request('GET',$url,compact('query'));
        }catch (RequestException $e){
            if ($e->hasResponse()){
                Log::error(Psr7\str($e->getResponse()));
            }
        }
        
    }

    public function post($url,$json=''){
        try{
            $json = $this->sign($json);
            return $this->client->request('POST',$url,compact('json'));
        }catch (RequestException $e){
            if ($e->hasResponse()){
                Log::error(Psr7\str($e->getResponse()));
            }
        }
    }
}