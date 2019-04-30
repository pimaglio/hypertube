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

<div class="container">
    <div class="moviecontent row">
        <div class="col s12">

        </div>
        <div class="col s6">

        </div>

    </div>
</div>

<script>

</script>

<script src="assets/js/materialize.js"></script>
</body>