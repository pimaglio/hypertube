<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 11:59
 */

session_start();

if (isset($_SESSION['loggued_on_user']))
    header("Location: index.php");

include('header_alt.php');
if (isset($_SESSION['lang'])){
    if ($_SESSION['lang'] === 'en')
        include_once '../controllers/en.php';
    if ($_SESSION['lang'] === 'fr')
        include_once '../controllers/fr.php';
}
?>

<body>

<div id="background">
</div>

<div class="form_create_profil fade-in two">
    <div class="row">
        <div class="title_account2">
            <img class="image_title_account" src="assets/images/createprofil.svg">
            <h2 style="margin-left: 100px;" class="title-form-alt">Inscription<br><span
                        class="title-form">Sign up</span></h2>
        </div>
    </div>
    <?php
    $nom = '';
    $login = '';
    $email = '';
    $pic = '';
    $id = '';
    if (isset($_GET['name']))
        $nom = $_GET['name'];
    if (isset($_GET['login']))
        $login = $_GET['login'];
    if (isset($_GET['email']))
        $email = $_GET['email'];
    if (isset($_GET['pic'])) {
        $pic = $_GET['pic'];
        $require = '';
    } else
        $require = 'required';
    if (isset($_SESSION['id_42']))
        $id_42 = $_SESSION['id_42'];
    else
        $id_42 = 0;
    if (isset($_SESSION['id_google']))
        $id_google = $_SESSION['id_google'];
    else
        $id_google = 0;
    echo ";
    ?>
</div>

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

    $(function () {
        $("input[data-preview]").change(function () {
            var input = $(this);
            var oFReader = new FileReader();
            oFReader.readAsDataURL(this.files[0]);
            oFReader.onload = function (oFREvent) {
                $(input.data('preview')).attr('src', oFREvent.target.result);
            };
        });
    })
</script>
</body>
