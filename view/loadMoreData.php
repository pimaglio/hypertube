<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-04-30
 * Time: 00:44
 */
/*require ('../controllers/FilmController.php');*/
include ('../controllers/FilmController.php');

$data = recup_film_arr($_GET['last_id']);

$json = include('data.php');

echo json_encode($json);
?>