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
    <div class="search_container row">
        <form method="POST" action="../controllers/FilmController.php">
            <div class="input-field col s12">
                <p class="fw100"><i class="fas fa-film icon_spacing2"></i><?php echo $titlemovie ?></p>
                <input id="film" type="text" class="validate" pattern="[A-Za-z\séèâêëçû -]+" name="nom">
                <span class=\"helper-text\" data-error=\"fewfefewf\" data-success=\"$formnameSuccess\"></span>
            </div>
            <div class="col s3">
                <p class="fw100"><i class="fas fa-calendar-minus icon_spacing2"></i><?php echo $rangedatemin ?></p>
                <p class="range-field">
                    <input name="datemin" type="range" id="datemin" value="2000" min="1940" max="2019"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-calendar-plus icon_spacing2"></i><?php echo $rangedatemax ?></p>
                <p class="range-field">
                    <input name="datemax" type="range" id="datemax" value="2019" min="1940" max="2019"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-amount-down icon_spacing2"></i><?php echo $scoremin ?></p>
                <p class="range-field">
                    <input name="notemin" type="range" id="test5" value="2" min="0" max="10"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-amount-up icon_spacing2"></i><?php echo $scoremax ?></p>
                <p class="range-field">
                    <input name="notemax" type="range" id="test5" value="8" min="0" max="10"/>
                </p>
            </div>

            <?php
            echo "
            <div class=\"input-field col s12\">
            <p class=\"fw100\"><i class=\"fas fa-tape icon_spacing2\"></i>Genre(s)</p>
                <select>
                    <option value=\"\" disabled selected>$titleselect</option>
                    <option value='3' name='action'>$genreAction</option>
                    <option value='3' name='adventure'>$genreAdventure</option>
                    <option value='3' name='animation'>$genreAnimation</option>
                    <option value='3' name='comedy'>$genreComedy</option>
                    <option value='3' name='crime'>$genreCrime</option>
                    <option value='3' name='documentary'>$genreDocumentary</option>
                    <option value='3' name='drama'>$genreDrama</option>
                    <option value='3' name='family'>$genreFamily</option>
                    <option value='3' name='fantasy'>$genreFantasy</option>
                    <option value='3' name='history'>$genreHistory</option>
                    <option value='3' name='horror'>$genreHorror</option>
                    <option value='3' name='music'>$genreMusic</option>
                    <option value='3' name='mystery'>$genreMystery</option>
                    <option value='3' name='romance'>$genreRomance</option>
                    <option value='3' name='science fiction'>$genreSciencefi</option>
                    <option value='3' name='tv movie'>$genreTvMovie</option>
                    <option value='3' name='thriller'>$genreThriller</option>
                    <option value='3' name='war'>$genreWar</option>
                    <option value='3' name='western'>$genreWestern</option>
                </select>
            </div>
                <div class=\"row\">
                    <div class=\"col s3\">
                        <p>
                            <label>
                                <input value=\"nosort\" class=\"with-gap pulse\" name=\"sort\" type=\"radio\" checked/>
                                <span>$trino</span>
                            </label>
                        </p>
                    </div>
                    <div class=\"col s3\">
                        <p>
                            <label>
                                <input value=\"sortnote\" class=\"with-gap pulse\" name=\"sort\" type=\"radio\"/>
                                <span>$trinote</span>
                            </label>
                        </p>
                    </div>
                    <div class=\"col s3\">
                        <p>
                            <label>
                                <input value=\"sortrecent\" class=\"with-gap pulse\" name=\"sort\" type=\"radio\"/>
                                <span>$trirecent</span>
                            </label>
                        </p>
                    </div>
                </div>
                <input type='hidden' name='search' value='ok'>
                <div >
                    <button class=\" btn_search btn-large waves-effect waves-light pink accent-3 fade-in two\">$srcbtn
                        <i style=\"position: absolute\" class=\"fab fa-searchengin icon_spacing3\"></i>
                    </button>
                </div>
            </div>
            ";
            ?>

        </form>
    </div>

    <div class="homesuggest center">
        <h6><?php echo $titleresult?></h6>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('select').formSelect();
    });

</script>

<script src="assets/js/materialize.js"></script>
</body>