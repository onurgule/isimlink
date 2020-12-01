<?php 
$key = "ohahahaha";
$str = "onosssss";
$olay = openssl_encrypt($str, "AES-128-CBC", $key);
echo $olay;
$dec = openssl_decrypt($olay, "AES-128-CBC", $key);
echo "<br>-> ".$dec;