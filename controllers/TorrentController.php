<?php
if (isset($_POST['film']) && !empty($_POST['film'])) {
    try {
        $film = strtolower($_POST['film']);
        $lien = 'https://wvw.torrent9.uno/search_torrent/films/' . $film . '.html,trie-seeds-d';
        $e = 'OK';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $lien);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $return = curl_exec($curl);
        if (!$i = stristr($return, 'title="Télécharger'))
            throw $e;
        $j = stristr($i, 'href="http');
        $link = explode('"', $j)[1];
        curl_close($curl);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $return = curl_exec($curl);
        $s = NULL;
        $i = stristr($return, 'class="download-btn"');
        $j = stristr($i, 'href="/');
        $s = 'https://wvw.torrent9.uno';
        $s .= explode('"', $j)[1];
//        echo $s;
    }catch (ERROR $e)
    {
        echo 'Aucun torrent disponible pour ce film';
    }
}