<?php

require('OAuth2/src/OAuth2/Client.php');
require('OAuth2/src/OAuth2/GrantType/IGrantType.php');
require('OAuth2/src/OAuth2/GrantType/AuthorizationCode.php');

const CLIENT_ID     = '18b0ad5f0844e0696964e07844f47c01f570a8803c0664b25bcc6348fecb9cbb';
const CLIENT_SECRET = 'e24ca4403739db8cc3d4c2add966b6d14bf4173b29c9c48819c605745f2722e3';

const REDIRECT_URI           = 'http://localhost:8008/';
const AUTHORIZATION_ENDPOINT = 'https://api.intra.42.fr/oauth/authorize';
const TOKEN_ENDPOINT         = 'https://api.intra.42.fr/oauth/token';

$client = new OAuth2\Client(CLIENT_ID, CLIENT_SECRET);
if (!isset($_GET['code']))
{
    $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI);
    header('Location: ' . $auth_url);
    die('Redirect');
}
else
{
    $params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);
    $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);
    if (isset($response['result']['access_token']))
    {
        $client->setAccessToken($response['result']['access_token']);
        $response = $client->fetch('https://api.intra.42.fr/v2/me');
        $user = $response['result'];
        htmldump($user);
    }
}