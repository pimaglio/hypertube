<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-04-30
 * Time: 00:19
 */

foreach ($data as $k => $v) {
    if ($_SESSION['lang'] === 'en')
        $title = $v['title'];
    else
        $title = $v['title_fr'];
    if ($_SESSION['lang'] === 'en')
        $des = $v['description'];
    else
        $des = $v['description_fr'];
    $date = substr($v['creation_date'], 0, 4);
    $note = $v['note'];
    $id = $v['id'];
    $img = $v['image'];
    $title_alt = $title;
    $title = substr($title, 0, 30) . '...';
    echo "
        <div class=\"post-id card_movie fade-in two\" id='$id'>
            <div style=\"background-image: url('$img')\" class=\"image_movie\">
                <div class=\"dejavu\">
                    <span class=\"new badge red\" data-badge-caption=\"Déja visionné\"></span>
                </div>
                <div class=\"rate center\">

                </div>
            </div>
            <div id='scroll-over'>
            <div class=\"card_movie_hover\">
                <div id='scroll-over'>
                    <p class='synops synops-title'>Synopsis:</p>
                    <p class='synops synopsdes'>$des</p>
                </div>
            </div>
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
