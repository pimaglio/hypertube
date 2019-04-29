<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-25
 * Time: 15:34
 */

require_once '../vendor/autoload.php';
include_once '../models/ResearchModel.php';
include '../view/header_alt.php';
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
        htmldump($movie);
        foreach ($movie as $k => $v) {
            if ($k == 'results') {
                foreach ($v as $k1 => $v1) {
                    $id = $v1['id'];
                    $detail = $client->getMoviesApi()->getMovie($id);
                    $credits = $client->getMoviesApi()->getCredits($id);
                    $infos = [];
                    $title = $detail['title'];
                    $title_fr = $movie_fr[$k][$k1]['title'];
                    $overview_fr = $movie_fr[$k][$k1]['overview'];
                    $overview = $detail['overview'];
                    $date = $detail['release_date'];
                    $note = $detail['vote_average'];
                    $time = $detail['runtime'] . 'min';
                    $infos['title'] = $title;
                    $infos['title_fr'] = $title_fr;
                    $infos['overview'] = $overview;
                    $infos['overview_fr'] = $overview_fr;
                    $infos['date'] = $date;
                    $infos['note'] = $note;
                    $infos['time'] = $time;
                    $infos['cast'] = NULL;
                    for ($j = 0; $j <= 4; $j++) {
                        if ($j != 4)
                            $infos['cast'] .= $credits['cast'][$j]['name'] . ' / ';
                        else
                            $infos['cast'] .= $credits['cast'][$j]['name'];
                    }
                    $configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
                    $config = $configRepository->load();
                    $imageHelper = new \Tmdb\Helper\ImageHelper($config);
                    $infos['img'] = 'http:' . $imageHelper->getUrl($detail['poster_path'], 'w500', 500, 80);
                    echo $infos['img'];
                    $seed = new Seed($infos);
                    $seed->insert_film();
                }
            }
        }
    }
}