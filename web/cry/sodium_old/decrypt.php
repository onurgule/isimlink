
<?php
function safeDecrypt(string $encrypted, string $key="777cf8dcfeeb155b52e7eed8ee47e48be50cacdc55078f9ab1d169322c7c8159"): string
{   
    $decoded = hex2bin(strrev($encrypted));
    $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
    $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

    $plain = sodium_crypto_secretbox_open(
        $ciphertext,
        $nonce,
        hex2bin("777cf8dcfeeb155b52e7eed8ee47e48be50cacdc55078f9ab1d169322c7c8159")
    );
    sodium_memzero($ciphertext);
    sodium_memzero($key);
    return $plain;
}
$crypted = $_POST["crypted"]; //POST  olacak
// $key = $_POST["key"]; //POST  olacak
//$plaintext = safeDecrypt(($crypted), ($key));
if(isset($_POST["pub"])){
	$pub = $_POST["pub"];
	$key = $_POST["key"];
//$nonce = mb_substr(hex2bin($crypted), 0, SODIUM_CRYPTO_BOX_NONCEBYTES, '8bit');
$nonce = $_POST["nonce"]; //every crypto has different but it is not secret...
$decryption_key = sodium_crypto_box_keypair_from_secretkey_and_publickey(hex2bin($key), hex2bin($pub));
$decrypted = sodium_crypto_box_open(hex2bin($crypted), $nonce, $decryption_key);
echo $decrypted;
}
else{
$plaintext = safeDecrypt($crypted);
echo $plaintext;
}
//kişinin kendi görmek istediği veriler


