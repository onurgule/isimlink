
<?php
//function safeEncrypt(string $message, string $key): string
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
function safeEncryptN(string $message,string $nonce): array
{
	$public = hex2bin("777cf8dcfeeb155b52e7eed8ee47e48be50cacdc55078f9ab1d169322c7c8159");
    // if (mb_strlen($key, '8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
        // throw new RangeException('Key is not the correct size (must be 32 bytes).');
    // }
	$nonce = hex2bin($nonce);
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
    return array(strrev($cipher),$nonce);
}
function safeEncryptK(string $message,string $key): array
{
	$public = hex2bin($key);
    // if (mb_strlen($key, '8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
        // throw new RangeException('Key is not the correct size (must be 32 bytes).');
    // }
	$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
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
    return array(strrev($cipher),$nonce);
}
$rawdata = $_POST["data"]; //POST  olacak
if(isset($_POST["nonce"])){
	$nonce = $_POST["nonce"];
	//nonce mevcut.
	$ciphertext = safeEncryptN($rawdata,$nonce);
$hexcrypted = bin2hex($ciphertext[0]);
$hexnonce = bin2hex($ciphertext[1]);
echo json_encode(array($hexcrypted,$hexnonce));
}
else if(isset($_POST["pub"])){
	//pair crypto 1ddd299fc4dff166a4cde26a64418677 -- cc2dd097178d4ae4cb8a2159158818e0
$key = $_POST["key"];	
$pub = $_POST["pub"];
$nonce = random_bytes(SODIUM_CRYPTO_BOX_NONCEBYTES);
//$nonce = hex2bin("935743bfd1eebe2dfa1d9a62e412d4a06383fefe9a9bec09");
$encryption_key = sodium_crypto_box_keypair_from_secretkey_and_publickey(hex2bin($key), hex2bin($pub));
$encrypted = sodium_crypto_box($rawdata, $nonce, $encryption_key);
echo bin2hex($encrypted)."---".bin2hex($nonce);

}
else if(isset($_POST["key"])){
		$key = $_POST["key"];
		if(isset($_POST["reverse"])) $key=strrev($key);
	//nonce mevcut.
	$ciphertext = safeEncryptK($rawdata,$key);
$hexcrypted = bin2hex($ciphertext[0]);
$hexnonce = bin2hex($ciphertext[1]);
echo json_encode(array($hexcrypted,$hexnonce));
}
else{
//$key = $_POST["key"]; // 256 bit - private //$_POST["key"]; //POST  olacak
//$ciphertext = safeEncrypt($rawdata, hex2bin($key));
$ciphertext = safeEncrypt($rawdata);
$hexcrypted = strrev(bin2hex($ciphertext[0]));
$hexnonce = bin2hex($ciphertext[1]);
echo json_encode(array($hexcrypted,$hexnonce));
}
// Decrypt


