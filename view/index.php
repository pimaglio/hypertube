<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 11:59
 */
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION['loggued_but_not_complet']))
    header("Location: createprofile.php");

if (!isset($_SESSION['loggued_on_user']))
    header("Location: ../index.php");

include('header_connect.php');
include('../controllers/SuggestController.php');
?>

<body>

<div class="container_s">
    <div class="row result">
            <div class="homesuggest">
                Notre sélection du moment
            </div>
    </div>
</div>

<script>

</script>

<script src="assets/js/materialize.js"></script>
</body>