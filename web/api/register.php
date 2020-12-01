<?php
ini_set('session.cookie_domain', substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100));
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);
include "../conf/db.php";
include "../conf/key.php";
$domain = $data->d;
$password = $data->p;
$name = $data->n;
$surname= $data->s;

$hash = sifrele($password);

//$q = $db->prepare("CALL DoLogin2(:domain,:password)");
//$q->execute(array("domain" => $data->d,"password" => $data->p));
$q = $db->prepare("CALL Register(:name,:surname,:domain,:hash)");
$q->execute(array("name" => $name, "surname" => $surname, "domain" => $domain, "hash" => $hash));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
$return = $f[0]["return"];
if($return == "ok"){
$verif = dogrula($password,$hash);
$q = $db->prepare("CALL DoLogin(:domain,:success)");
$q->execute(array("domain" => $data->d,"success" => $verif));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
if($f[0]["return"] == "Başarılı") {
	$res = array("result" => 1, "message" => "Hoşgeldiniz ".$f[0]["Name"]. " ".$f[0]["Surname"].".\nUID:".$f[0]["UID"], "panel" => "https://".$domain.".isim.link/admin");
	echo json_encode($res);
	$_SESSION['uid'] = $f[0]["UID"];
	$_SESSION['name'] = $f[0]["Name"];
	$_SESSION['surname'] = $f[0]["Surname"];
	$_SESSION['domain'] = $domain;
	
    exit();
}
else {
	$res = array("result" => 0, "message" => "Bir hata oluştu!");
	echo json_encode($res);
}
}