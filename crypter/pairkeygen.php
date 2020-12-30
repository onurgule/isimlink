<?php
$keypair = sodium_crypto_box_keypair(); //user
$keypair_public = sodium_crypto_box_publickey($keypair); //upk
$keypair_secret = sodium_crypto_box_secretkey($keypair); //usk
echo json_encode(array(bin2hex($keypair_secret),bin2hex($keypair_public)));