<head>
    <meta charset="utf-8">
    <title>Hypertube Torrent Streaming APP</title>
    <link rel="icon" type="image/png" href="../view/assets/images/favico.png"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../view/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../view/assets/css/materialize.css">
    <script src="../view/assets/js/materialize.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<style>
    h1 {
        color: #333;
        font-size: 40px;
    }

    body {
        display: block;
        width: 100%;
        height: 100%;
        font-family: 'Nunito', sans-serif;
        font-size: 16px;
        line-height: 32px;
        color: #7d93b2;
        background-color: #fafcff;
        font-weight: 200;
        margin: 0;
    }

    .lg-title, .lg {
        float: left;
        padding: 10px;
        font-size: 60px;
        padding-bottom: 15px;
    }

    .lg-title {
        background-color: #ff5c72;
        color: white;
    }

    .error-sql{
        position: absolute;
        right: 0;
        left: 0;
        top: 500px;
        color: #820000;
    }

    .success-sql{
        position: absolute;
        right: 0;
        left: 0;
        top: 500px;
        color: #2da977;
    }

</style>

<div class="home_page row">
    <h1 class="logo_home fade-in one">
        Hypertube
    </h1>
</div>

<div style="text-align: center !important;">
<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-06
 * Time: 14:28
 */

require_once("database.php");
try {
    $db = database_connect();

    $sql_create_user_db_tbl = <<<EOSQL
CREATE TABLE if not exists user_db (
  id int(11) NOT NULL AUTO_INCREMENT,
  login varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  nom varchar(50) NOT NULL,
  password binary(64) NOT NULL COMMENT 'sha-256',
  email varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  creation_date date DEFAULT NULL,
  cle varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  pic VARCHAR(255) NOT NULL default '../upload/no-image.png',
  notif tinyint(1) DEFAULT NULL,
  id_42 int(11) DEFAULT NULL,
  id_google varchar(25) DEFAULT NULL,
  valid tinyint(1) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_user = <<<EOSQL
INSERT INTO user_db (login, nom, password, email, valid)
VALUES 
  ('root', 'root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'root@root.com', '1');
EOSQL;

    $msg = '';
    $msg_err = '';

    if ($r !== false) {

        $r = $db->exec($sql_create_user_db_tbl);
        $r = $db->exec($sql_create_user);

        if ($r !== false) {
            $msg = "Tables are created successfully!." . "<br>";
        } else {
            $msg_err = "Error creating table." . "<br>";
        }

    } else {
        $msg_err = "Error creating table." . "<br>";
    }

    // display the message
    if ($msg != '') {
        echo "<h2 class='success-sql'>$msg<br><i class=\"far fa-smile-beam fa-9x\"></i></h2>" . "\n";
        $delai=2;
        $url='../index.php';
        header("Refresh: $delai;url=$url");
    }
    else if ($msg_err != '')
        echo "<h2 class='error-sql'>$msg_err<br><i class=\"far fa-sad-cry fa-9x\"></i></h2>" . "\n";

} catch (PDOException $e) {
    $msg2 = $e->getMessage();
    echo "<br>" . "<h2 class='error-sql' >$msg2<br><i class=\"far fa-sad-cry fa-7x\"></i></h2>";
}
?>
</div>
