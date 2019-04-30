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

<div class="">



    <div class="flexgallery" id="post-data">
        <h1 class="homesuggest"><?php echo $titlesugggestion?></h1>
        <?php
        if (!isset($_GET['last_id']))
            $idf = 0;
        else
            $idf = $_GET['last_id'];
        $data = recup_film_arr($idf);

        include('data.php');

        ?>
    </div>
    <div class="ajax-load text-center" style="display:none">
        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
    </div>
</div>

<script>
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            var last_id = $(".post-id:last").attr("id");
            loadMoreData(last_id);
        }
    });


    function loadMoreData(last_id){
        $.ajax(
            {
                url: '/view/loadMoreData.php?last_id=' + last_id,
                type: "GET",
            })
            .done(function(data)
            {
                
                $("#post-data").append(data);
            })

            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('server not responding...');
            });
    }

</script>

<script src="assets/js/materialize.js"></script>
</body>