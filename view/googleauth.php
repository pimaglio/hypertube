<?php
//Include GP config file && User class
include_once '../controllers/Google_auth/gpConfig.php';
include_once '../controllers/ProfilsController.php';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['loggued_on_user']))
    header("Location: index.php");

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}
if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}
if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();
    htmldump($gpUserProfile);


    //Insert or update user data to the database
/*    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );*/

} else {
/*    $_SESSION['error'] = 10;
    header('Location: ../index.php');
    exit();*/
}

