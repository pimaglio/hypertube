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
        <form method="get" action="search.php">

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-numeric-down icon_spacing2"></i>Âge minimum</p>
                <p class="range-field">
                    <input name="agemin" type="range" id="test5" value="30" min="18" max="116"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-numeric-up icon_spacing2"></i>Âge maximum</p>
                <p class="range-field">
                    <input name="agemax" type="range" id="test5" value="77" min="18" max="116"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-amount-up icon_spacing2"></i>Popularité minimum</p>
                <p class="range-field">
                    <input name="popmin" type="range" id="test5" min="0" max="10000"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-street-view icon_spacing2"></i>Distance maximum (km)</p>
                <p class="range-field">
                    <input name="distmax" type="range" id="test5" min="0" max="1000"/>
                </p>
            </div>

            <div style="position: relative" class="col s12">
                <p class="fw100"><i class="fas fa-sort-amount-up icon_spacing2"></i>Centre(s) d'intérêt(s)</p>
                <div class="row">
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="sport" value="101"/>
                            <span>Sport</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="voyage" value="101"/>
                            <span>Voyage</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="vegan" value="101"/>
                            <span>Vegan</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="geek" value="101"/>
                            <span>Geek</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="soiree" value="101"/>
                            <span>Soiree</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="tattoo" value="101"/>
                            <span>Tattoo</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="musique" value="101"/>
                            <span>Musique</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="lecture" value="101"/>
                            <span>Lecture</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="theatre" value="101"/>
                            <span>Théâtre</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="religion" value="101"/>
                            <span>Religion</span>
                        </label>
                    </p>
                </div>
                <div class="row">
                    <div class="col s3">
                        <p>
                            <label>
                                <input name="sort" value="0" class="with-gap pulse" name="group1" type="radio" checked/>
                                <span>Ne pas trier</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s3">
                        <p>
                            <label>
                                <input name="sort" value="1" class="with-gap pulse" name="group1" type="radio"/>
                                <span>Trier par âge croissant</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s3">
                        <p>
                            <label>
                                <input name="sort" value="2" class="with-gap pulse" name="group1" type="radio"/>
                                <span>Trier par âge décroissant</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s3">
                        <p>
                            <label>
                                <input name="sort" value="3" class="with-gap pulse" name="group1" type="radio"/>
                                <span>Trier par popularité croissante</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s3">
                        <p>
                            <label>
                                <input name="sort" value="4" class="with-gap pulse" name="group1" type="radio"/>
                                <span>Trier par popularité décroissante</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div >
                    <button class=" btn_search btn-large waves-effect waves-light pink accent-3 fade-in two">Rechercher
                        <i style="position: absolute" class="fab fa-searchengin icon_spacing3"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="homesuggest">
        <?php echo $titleresult?>
    </div>

</div>

<script>

</script>

<script src="assets/js/materialize.js"></script>
</body>