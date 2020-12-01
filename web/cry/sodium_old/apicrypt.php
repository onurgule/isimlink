<?php
function safeEncrypt(string $message): array
{
	$public = hex2bin("777cf8dcfeeb155b52e7eed8ee47e48be50cacdc55078f9ab1d169322c7c8159");
    // if (mb_strlen($key, '8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
        // throw new RangeException('Key is not the correct size (must be 32 bytes).');
    // }
    //$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
	$nonce = hex2bin("59d1b03b86f8e1982215d99a3b8f378493e5a2196f4d6611");

    $cipher = (
        $nonce.
        sodium_crypto_secretbox(
            $message,
            $nonce,
            $public
        )
    );
    sodium_memzero($message);
    sodium_memzero($public);
    return array(($cipher));
}
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
function safeEncryptK(string $rawdata,string $key, string $pub): array
{
$nonce = random_bytes(SODIUM_CRYPTO_BOX_NONCEBYTES);
$encryption_key = sodium_crypto_box_keypair_from_secretkey_and_publickey(hex2bin($key), hex2bin($pub));
$encrypted = sodium_crypto_box($rawdata, $nonce, $encryption_key);
return array(bin2hex($encrypted),bin2hex($nonce));
}
function safeDecryptK(string $crypted, string $key, string $pub, string $nonce): string
{   
//every crypto has different nonce but it is not secret...

$decryption_key = sodium_crypto_box_keypair_from_secretkey_and_publickey(hex2bin($key), hex2bin($pub));

$decrypted = sodium_crypto_box_open(hex2bin($crypted), hex2bin($nonce), $decryption_key);
    sodium_memzero($crypted);
    sodium_memzero($key);
    return $decrypted;
}
$gonderilecekveri = array ();
$uk = $_GET["uk"];
$up = $_GET["up"];
$ak = $_GET["ak"];
$ap = $_GET["ap"];
foreach($_POST as $key => $veri){
	$kirilan = safeDecrypt($veri);
	$sifrelenen = safeEncryptK($kirilan, $uk, $ap);
	$gonderilecekveri[$key] = safeDecryptK(trim($sifrelenen[0]),trim($ak),trim($up),trim($sifrelenen[1]));
}
echo json_encode($gonderilecekveri,JSON_UNESCAPED_UNICODE);