<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'C:\Users\aimlyaa\Desktop\test\back\dev\vendor\autoload.php';
$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'POST');
});

$app->post('/v1/create', function (Request $request, Response $response, array $args) {
    $clientId = '29982469';

    $body  = $request->getParsedBody();
    $entId = $body["id"];

    // получаем токен и поддомен
    $ch_auth = curl_init();
    curl_setopt($ch_auth, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($ch_auth, CURLOPT_URL, "https://test.gnzs.ru/oauth/get-token.php");
    curl_setopt($ch_auth, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
       "Accept: application/json",
       "Content: application/json",
       "X-Client-Id:".$clientId,
    );
    curl_setopt($ch_auth, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch_auth, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch_auth, CURLOPT_SSL_VERIFYPEER, false);
    $auth_resp = curl_exec($ch_auth);
    $auth_array = json_decode($auth_resp);
    curl_close($ch_auth);

    // amoAPI
    $access_token = $auth_array->access_token;
    $subdomain    = 'https://'. $auth_array->base_domain;
    $link = '';
    switch ($entId) {
        case 1:
            $link = $subdomain . '/api/v4/leads';
            break;
        case 2:
            $link  = $subdomain . '/api/v4/contacts';
            break;
        case 3:
            $link  = $subdomain . '/api/v4/companies';
            break;
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_VERBOSE, 1);
    curl_setopt($curl, CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
    $amo_headers = [
        'Accept: application/json',
        'Content: application/json',
        'Authorization: Bearer ' . $access_token
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $amo_headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $post_data = array (
      array (
        'name' => 'Hello World' ,
      )
    ) ;
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));
    $out = curl_exec($curl); 
    $out_array = json_decode($out);
    curl_close($curl);

    $result_id = 0;
    switch ($entId) {
    case 1:
        $result_id = $result_id = $out_array->_embedded->leads[0]->id;
        break;
    case 2:
        $result_id = $result_id = $out_array->_embedded->contacts[0]->id;
        break;
    case 3:
        $result_id = $result_id = $out_array->_embedded->companies[0]->id;
        break;
    }

    return $response->withJson($result_id, 200);
});
$app->run();