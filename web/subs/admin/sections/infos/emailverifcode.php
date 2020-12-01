<?php
session_start();
require '../../../../conf/db.php';
$mailadd = $_GET["email"];
$code = $_GET["code"];
$q = $db->prepare("CALL emailVerif(:uid,:email,:code)");
$q->execute(array("uid" => $_SESSION['uid'], "email" => $mailadd, "code" => $code)); //cry ile eklenecek...
$f = $q->fetchAll();
//print_r($f);
//print_r(array("uid" => $_SESSION['uid'], "email" => $mailadd, "code" => $randomKey));
if($f[0]['return'] == 'ok'){
	echo 1;
}
else{
	echo 0;
}
	


?>