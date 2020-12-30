<?php
$ilpublic = "2fccaf5f51f5a62929fafa9412f38934b25f8b8b30e65314e9c1a84cb0f68268";
$ilsecret = "2033cae0f95ab19910ed0cf37498ccd64a5e71db1bc4326331cc227e3b5e4218";

$type=$_POST["type"];
$publicc = $_POST["pub"];
$value = $_POST["val"];
if($type == 'isimlink') $publicc = $ilpublic;
$encrypted = sodium_crypto_box_seal(
    $value,
    hex2bin($publicc)
);
echo bin2hex($encrypted);
