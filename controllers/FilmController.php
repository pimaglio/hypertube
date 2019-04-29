<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-25
 * Time: 15:34
 */

require_once '../vendor/autoload.php';
include_once '../models/FilmModel.php';
include '../view/header_alt.php';

function recup_film_arr(){
    $film = new Film([]);
    $arr = $film->recup_film();
    return $arr;
}

if (isset($_POST['research']) && $_POST['research'] == 'ok' && isset($_POST['film'])) {
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
                            break ;
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
                    $seed = new Film($infos);
                    $seed->insert_film();
                }
            }
        }
    }
}