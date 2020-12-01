<?php
$key = "31415OnosFekSau";
function encry($str){
	$olay = openssl_encrypt($str, "AES-128-CBC", $key);
    return $olay;
	}
function decry($str){
	$dec = openssl_decrypt($str, "AES-128-CBC", $key);
	return $dec;
	}