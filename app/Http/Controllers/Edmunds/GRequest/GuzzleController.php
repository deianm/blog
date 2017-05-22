<?php

namespace App\Http\Controllers\Edmunds\GRequest;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class GuzzleController extends Controller
{

    public function __construct()
    {

    }

    public static function request_edmunds($url)
    {

        $client = new Client([
            'base_uri' => 'https://api.edmunds.com/',
            'timeout'  => 2.0,
        ]);

        try {

            $response = $client->request('GET', $url)->getBody();

            return $response;

        } catch (RequestException $e) {

            if ($e->getResponse()->getStatusCode() == '400') {
                //Exception stuff, exit for now
                exit('Exception one.');

            }

        } catch (\Exception $e) {

            if ($e->getResponse()->getStatusCode() == '403') {
                //Exception stuff, exit for now
                exit('Error: 403 Quota Exceeded | Forbidden ');

            }

            //Other exception stuff, exit for now
            exit('Unknown Error');

        }

        exit('Exit');

    }

}
