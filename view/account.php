<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 11:59
 */

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['loggued_on_user']))
    header("Location: ../index.php");

include('header_connect.php');
?>

<body>

<main class="my_profil row">

    <div class="col s12 panel_info">
        <div class="title_account">
            <img class="image_title_account" src="assets/images/user_info.svg">
            <h2 style="margin-left: 100px;" class="title-form-alt">Mes données<br><span
                        class="title-form">personelles</span></h2>
        </div>
    </div>
    <?php
    echo "
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
                                <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" data-preview=\".preview\" $require/>
                                <input type='hidden' name='42pic' value='$pic'/>
                            </div>
                            <div class=\"file-path-wrapper\">
                                <input class=\"file-path validate\" type=\"text\">
                            </div>
                        </div>
                    </div>
                    <input type=\"hidden\" name=\"register_42\" value=\"ok\">
                    <input type='hidden' name='42_id' value='$id_42'>
                    <input type='hidden' name='google_id' value='$id_google'>
                    <div style=\"text-align: center\">
                        <button class=\"btn-large waves-effect waves-light accent-3 fade-in eight\" type=\"submit\" name=\"submit\" value=\"Créer mon profil\">S'inscrire
                            <i class=\"material-icons right\">send</i>
                        </button>
                    </div>
                </form>
            ";
    ?>
</main>

<script src="assets/js/materialize.js"></script>

<script>
    $(document).ready(function () {
        $('select').formSelect();
    });


    var password = document.getElementById("password")
        , confirm_password = document.getElementById("password2");

    function validatePassword() {
        if (password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

</body>