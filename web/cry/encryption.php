<?php
$encmethod = "AES-256-CBC";
$isimlinktopsecret = "2NFpN3OLmaLhwTYBF6oiDvab5zXJJ+7Rb2bTUNJUW2Q=";

function encry($text){
$encryptedMessage = openssl_encrypt($text, $encmethod, $isimlinktopsecret);
return $encryptedMessage;
}

//To Decrypt
function decry($hash){
$decryptedMessage = openssl_decrypt($hash, $encmethod, $isimlinktopsecret);
return $decryptedMessage;
}
