<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-25
 * Time: 15:34
 */

/*require_once '../vendor/autoload.php';*/
include_once '../models/FilmModel.php';
require_once '../models/UsersModel.php';

function recup_film_arr($idf)
{
    $film = new Film([]);
    $arr = $film->recup_film($idf);
    return $arr;
}

//var_dump($_POST);

//if (isset($_POST['search']) && $_POST['search'] == 'ok' && isset($_POST['film']) && !empty($_POST['film'])) {
//    if (htmlspecialchars($_POST['film']) != $_POST['film']) {
//        $_SESSION['error'] = 5;
//        header('Location: ../view/search.php');
//        exit ();
//    }
//    echo 'ok';
function recup_search($title, $datemin, $datemax, $notemin, $notemax, $sort)
{
//    $datemax = intval($datemax);
//    $datemin = intval($datemin);
    $film = new Film([]);
    $res = $film->return_result($title, $datemin, $datemax, $notemin, $notemax, $sort);
    return $res;
//    $title = str_replace(' ', '+', $title);
//    $json = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=eec9199c7c3efc546a7b7ea6d86ffcee&query=' . $title);
//    $arr = json_decode($json, true);
//    foreach ($arr['results'] as $k => $v) {
//        $id = $v['id'];
//        $token = new \Tmdb\ApiToken('eec9199c7c3efc546a7b7ea6d86ffcee');
//        $client = new \Tmdb\Client($token);
//        $detail = $client->getMoviesApi()->getMovie($id);
//        $detail_fr = $client->getMoviesApi()->getMovie($id, ['language' => 'fr']);
//        $credits = $client->getMoviesApi()->getCredits($id);
//        $infos = [];
//        $infos['title'] = $detail['title'];
//        $infos['title_fr'] = $detail_fr['title'];
//        $infos['overview'] = $detail['overview'];
//        $infos['overview_fr'] = $detail_fr['overview'];
////        $infos['date'] = $detail['release_date'];
//        if (!empty($detail['release_date']))
//            $infos['date'] = explode('-', $infos['date'])[0];
//        $infos['note'] = $detail['vote_average'];
//        $infos['time'] = $detail['runtime'] . 'min';
//        $infos['cast'] = NULL;
//        for ($j = 0; $j <= 4; $j++) {
//            if (!isset($credits['cast'][$j]))
//                break;
//            if ($j != 4)
//                $infos['cast'] .= $credits['cast'][$j]['name'] . ' / ';
//            else
//                $infos['cast'] .= $credits['cast'][$j]['name'];
//        }
//        $configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
//        $config = $configRepository->load();
//        $imageHelper = new \Tmdb\Helper\ImageHelper($config);
//        $infos['img'] = 'http:' . $imageHelper->getUrl($detail['poster_path'], 'w500', 500, 80);
//        $infos['genres'] = NULL;
//        foreach ($detail['genres'] as $k => $v)
//            $infos['genres'] .= $v['name'] . ' ';
//        trim($infos['genres']);
//        if (!$search = $film->find_film($infos['title'], $infos['title_fr'])) {
//            $new = new Film($infos);
//            $new->insert_film();
//        }
//    }
}

//}

function recup_genre($genre, $datemin, $datemax, $notemin, $notemax, $sort)
{
    $film = new Film([]);
    $res = $film->recup_genre($genre,$datemin, $datemax, $notemin, $notemax, $sort);
    return $res;
}

if (isset($_POST['research']) && $_POST['research'] == 'genre' && isset($_POST['genre'])) {
    echo $_POST['genre'];
    if ($_POST['genre'] != htmlspecialchars($_POST['genre'])) {
        $_SESSION['error'] = 5;
        header('Location: ../view/search.php');
        exit;
    }
    $genre = $_POST['genre'];
    $film = new Film([]);
    $res = $film->recup_gender($genre);
    var_dump($res);
}