<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-25
 * Time: 15:34
 */

require_once '../vendor/autoload.php';
include_once '../models/FilmModel.php';
require_once '../controllers/ProfilsController.php';

function recup_film_arr($idf)
{
    $film = new Film([]);
    $arr = $film->recup_film($idf);
    return $arr;
}

if (isset($_POST['research']) && $_POST['research'] == 'nop' && isset($_POST['film'])) {
    if (htmlspecialchars($_POST['film']) != $_POST['film']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/search.php');
        exit ();
    }
    $token = new \Tmdb\ApiToken('eec9199c7c3efc546a7b7ea6d86ffcee');
    $client = new \Tmdb\Client($token);
    for ($i = 1; $i <= 10; $i++) {
        $movie = $client->getMoviesApi()->getTopRated(array(
            'page' => $i
        ));
        $movie_fr = $client->getMoviesApi()->getTopRated(array(
            'page' => $i,
            'language' => 'fr'
        ));
        foreach ($movie as $k => $v) {
            if ($k == 'results') {
                foreach ($v as $k1 => $v1) {
                    $id = $v1['id'];
                    $detail = $client->getMoviesApi()->getMovie($id);
                    $credits = $client->getMoviesApi()->getCredits($id);
                    $infos = [];
                    $infos['title'] = $detail['title'];
                    $infos['title_fr'] = $movie_fr[$k][$k1]['title'];
                    $infos['overview'] = $detail['overview'];
                    $infos['overview_fr'] = $movie_fr[$k][$k1]['overview'];
                    $infos['date'] = $detail['release_date'];
                    $infos['note'] = $detail['vote_average'];
                    $infos['time'] = $detail['runtime'] . 'min';
                    $infos['cast'] = NULL;
                    for ($j = 0; $j <= 4; $j++) {
                        if (!isset($credits['cast'][$j]))
                            break;
                        if ($j != 4)
                            $infos['cast'] .= $credits['cast'][$j]['name'] . ' / ';
                        else
                            $infos['cast'] .= $credits['cast'][$j]['name'];
                    }
                    $configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
                    $config = $configRepository->load();
                    $imageHelper = new \Tmdb\Helper\ImageHelper($config);
                    $infos['img'] = 'http:' . $imageHelper->getUrl($detail['poster_path'], 'w500', 500, 80);
                    $genre = new \Tmdb\Repository\GenreRepository($client);
                    $gender_id = [];
                    $gender = [];
                    foreach ($movie[$k][$k1]['genre_ids'] as $kk => $vv)
                        $gender_id[] .= $vv;
                    $infos['genres'] = NULL;
                    foreach ($gender_id as $kk => $vv) {
                        $gender = $genre->load(intval($vv));
                        $infos['genres'] .= $gender->getName() . ' ';
                    }
                    trim($infos['genres']);
//                    $seed = new Film($infos);
//                    $seed->insert_film();
                }
            }
        }
    }
    htmldump(recup_film_arr());
}

if (isset($_POST['research']) && $_POST['research'] == 'ok' && isset($_POST['film'])) {
    if (htmlspecialchars($_POST['film']) != $_POST['film']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/search.php');
        exit ();
    }

    if (!$search = )
    $title = $_POST['film'];
    $title = str_replace(' ', '+', $title);
    $json = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=eec9199c7c3efc546a7b7ea6d86ffcee&query=' . $title);
    $arr = json_decode($json, true);
    htmldump($arr);
    foreach ($arr['results'] as $k => $v) {
        $id = $v['id'];
        $token = new \Tmdb\ApiToken('eec9199c7c3efc546a7b7ea6d86ffcee');
        $client = new \Tmdb\Client($token);
        $detail = $client->getMoviesApi()->getMovie($id);
        htmldump($detail);
        $detail_fr = $client->getMoviesApi()->getMovie($id, ['language' => 'fr']);
        $credits = $client->getMoviesApi()->getCredits($id);
        $infos = [];
        $infos['title'] = $detail['title'];
        $infos['title_fr'] = $detail_fr['title'];
        $infos['overview'] = $detail['overview'];
        $infos['overview_fr'] = $detail_fr['overview'];
        $infos['date'] = $detail['release_date'];
        $infos['note'] = $detail['vote_average'];
        $infos['time'] = $detail['runtime'] . 'min';
        $infos['cast'] = NULL;
        for ($j = 0; $j <= 4; $j++) {
            if (!isset($credits['cast'][$j]))
                break;
            if ($j != 4)
                $infos['cast'] .= $credits['cast'][$j]['name'] . ' / ';
            else
                $infos['cast'] .= $credits['cast'][$j]['name'];
        }
        $configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
        $config = $configRepository->load();
        $imageHelper = new \Tmdb\Helper\ImageHelper($config);
        $infos['img'] = 'http:' . $imageHelper->getUrl($detail['poster_path'], 'w500', 500, 80);
        $infos['genres'] = NULL;
        foreach ($detail['genres'] as $k => $v)
            $infos['genres'] .= $v['name'] . ' ';
        trim($infos['genres']);
        htmldump($infos);
    }
}