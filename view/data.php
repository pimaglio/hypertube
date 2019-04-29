<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-04-30
 * Time: 00:19
 */

foreach ($data as $k => $v){
    if ($_SESSION['lang'] === 'en')
        $title = $v['title'];
    else
        $title = $v['title_fr'];
    $date = substr($v['creation_date'], 0, 4);
    $note = $v['note'];
    $id = $v['id'];
    echo "
        <div class=\"post-id card_movie fade-in two\" id='$id'>
            <div style=\"background-image: url('http://image.tmdb.org/t/p/w500/or06FN3Dka5tukK1e9sl16pB3iy.jpg')\" class=\"image_movie\">
                <div class=\"dejavu\">
                    <span class=\"new badge red\" data-badge-caption=\"Déja visionné\"></span>
                </div>
                <div class=\"rate center\">

                </div>
            </div>
            <div class=\"card_movie_hover\">

            </div>
            <div class=\"card_movie_info\">
                <p class=\"card_movie_title\">$title</p>
                <div>
                    <p class=\"card_movie_year\"><i style=\"color: #b71c1c\" class=\"material-icons left\">movie</i>$date</p>
                    <p class=\"rate\"><i style=\"color: #ffab00\" class=\"material-icons left\">stars</i>$note / 10</p>
                </div>
            </div>
        </div>
        ";
}
?>