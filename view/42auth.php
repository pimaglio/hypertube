<?php
session_start();
if (isset($_SESSION['loggued_on_user']))
    header("Location: index.php");
require('../controllers/OAuth2/src/OAuth2/Client.php');
require('../controllers/OAuth2/src/OAuth2/GrantType/IGrantType.php');
require('../controllers/OAuth2/src/OAuth2/GrantType/AuthorizationCode.php');
include('header_alt.php');
require('../controllers/ProfilsController.php');

const CLIENT_ID = '18b0ad5f0844e0696964e07844f47c01f570a8803c0664b25bcc6348fecb9cbb';
const CLIENT_SECRET = 'e24ca4403739db8cc3d4c2add966b6d14bf4173b29c9c48819c605745f2722e3';

const REDIRECT_URI = 'http://localhost:8008/view/42auth.php';
const AUTHORIZATION_ENDPOINT = 'https://api.intra.42.fr/oauth/authorize';
const TOKEN_ENDPOINT = 'https://api.intra.42.fr/oauth/token';

$client = new OAuth2\Client(CLIENT_ID, CLIENT_SECRET);
if (!isset($_GET['code'])) {
    $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI);
    header('Location: ' . $auth_url);
    die('Redirect');
} else {
    $params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);
    $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);
    if (isset($response['result']['access_token'])) {
        $client->setAccessToken($response['result']['access_token']);
        $response = $client->fetch('https://api.intra.42.fr/v2/me');
        $user = $response['result'];

        if (get_42_id($user['id']) == 1) {
            signin_42($user['id']);
            exit;
        } else {
            $nom = $user['displayname'];
            $login = $user['login'];
            $email = $user['email'];
            $pic = $user['image_url'];
            $id = $user['id'];

            echo "
            <div class=\"form_create_profil fade-in two\">
                <div class=\"row\">
                   <div class=\"title_account2\">
                        <img class=\"image_title_account\" src=\"assets/images/createprofil.svg\">
                        <h2 style=\"margin-left: 100px;\" class=\"title-form-alt\">Inscription<br><span
                        class=\"title-form\">Sign in</span></h2>
                   </div>
                </div>
                <form id=\"register-form\" method=\"POST\" action=\"../controllers/ProfilsController.php\" enctype=\"multipart/form-data\">
                    <div class=\"row\">
                        <div class=\"input-field col s6 fade-in three\">
                            <i class=\"material-icons prefix\">account_circle</i>
                            <input id=\"nom\" type=\"text\" class=\"validate\" pattern=\"[A-Za-z\séèâêëçû -]+\" name=\"nom\" maxlength=\"50\" value='$nom' required>
                            <span class=\"helper-text\" data-error=\"Format invalide: (A-z) et (-)\" data-success=\"Format valide\"></span>
                            <label for=\"nom\">Nom et Prénom</label>
                        </div>
                        <div class=\"input-field col s6 fade-in four\">
                            <i class=\"material-icons prefix\">account_circle</i>
                            <input id=\"login\" type=\"text\" class=\"validate\" pattern=\"[A-Za-z-0-9\s -]+\" name=\"login\" maxlength=\"25\" value='$login' required>
                            <span class=\"helper-text\" data-error=\"Format invalide: (A-z), (0-9), (-)\" data-success=\"Format valide\"></span>
                            <label for=\"login\">Nom d'utilisateur</label>
                        </div>
                        <div class=\"input-field col s12 fade-in five\">
                            <i class=\"material-icons prefix\">email</i>
                            <input id=\"email\" type=\"email\" class=\"validate\" name=\"email\" value='$email' required>
                            <label for=\"email\">Adresse email</label>
                        </div>
                        <div class=\"input-field col s6 fade-in six\">
                            <i class=\"material-icons prefix\">vpn_key</i>
                            <input id=\"password\" type=\"password\" class=\"validate\" pattern=\"(?=.*[!@#$%^&*(),.?:{}|<>]).{6,}\" name=\"password\" maxlength=\"25\" required>
                            <span class=\"helper-text\" data-error=\"Format invalide: Doit contenir 6 caractères minimum dont 1 caractère special (!@#$%^&*(),.?:{}|<>)\" data-success=\"Format valide\"></span>
                            <label for=\"password\">Mot de passe</label>
                        </div>
                        <div class=\"input-field col s6 fade-in seven\">
                            <i class=\"material-icons prefix\">vpn_key</i>
                            <input id=\"password2\" type=\"password\" class=\"validate\" pattern=\"(?=.*[!@#$%^&*(),.?:{}|<>]).{6,}\" name=\"password2\" maxlength=\"25\" required>
                            <span class=\"helper-text\" data-error=\"Les mots de passe ne correspondent pas\" data-success=\"Format valide\"></span>
                            <label for=\"password2\">Mot de passe (confirmation)</label>
                        </div>
                    </div>
                    <div style=\"text-align: center\" class=\"input-field col s12\">
                        <img src=\"$pic\" class=\"preview img_up\"/>
                        <div class=\"file-field input-field\">
                            <div class=\"btn\">
                                <span>Choisir</span>
                                <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" data-preview=\".preview\"/>
                                <input type='hidden' name='42pic' value='$pic'/>
                            </div>
                            <div class=\"file-path-wrapper\">
                                <input class=\"file-path validate\" type=\"text\">
                            </div>
                        </div>
                    </div>
                    <input type=\"hidden\" name=\"register_42\" value=\"ok\">
                    <input type='hidden' name='42_id' value='$id'>
                    <div style=\"text-align: center\">
                        <button class=\"btn-large waves-effect waves-light accent-3 fade-in eight\" type=\"submit\" name=\"submit\" value=\"Créer mon profil\">S'inscrire
                            <i class=\"material-icons right\">send</i>
                        </button>
                    </div>
                </form>
            </div>
            ";
        }

    } else {
        $_SESSION['error'] = 10;
        header('Location: ../index.php');
        exit();
    }
}