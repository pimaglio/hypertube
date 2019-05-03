<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-04-30
 * Time: 00:19
 */
$i = $idf + 5;
for ($idf; $idf < $i; $idf++) {
    if (!isset($data[$idf]))
        break ;
    if ($_SESSION['lang'] === 'en')
        $title = $data[$idf]['title'];
    else
        $title = $data[$idf]['title_fr'];
    if ($_SESSION['lang'] === 'en')
        $des = $data[$idf]['description'];
    else
        $des = $data[$idf]['description_fr'];
    $date = substr($data[$idf]['creation_date'], 0, 4);
    $note = $data[$idf]['note'];
    $id = $idf + 1;
    $img = $data[$idf]['image'];
    $title_alt = $title;
    $count = strlen($title);
    if ($count > 28)
        $title = substr($title, 0, 28) . '...';
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
                <p data-position=\"top\" data-tooltip=\"$title_alt\" class=\"card_movie_title tooltipped\">$title</p>
                <div>
                    <p class=\"card_movie_year\"><i style=\"color: #b71c1c\" class=\"material-icons left\">movie</i>$date</p>
                    <p class=\"rate\"><i style=\"color: #ffab00\" class=\"material-icons left\">stars</i>$note / 10</p>
                </div>
            </div>
        </div>
        ";
}
?>
<script>
    $(document).ready(function(){
        $('.tooltipped').tooltip();
    });
</script>
