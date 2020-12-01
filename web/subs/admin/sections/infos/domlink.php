<?php
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);
print_r($data);
include "../../../../conf/db.php";
$q = $db->prepare("CALL connectDomainInfo(:uid,:did,:iid,pri)");
$q->execute(array("uid" => $_SESSION['uid'], "did" => $data->domain, "iid" => $data->iid,"pri" => $data->privacy)); 
$f = $q->fetchAll();
//TEST EDİLMEDİ:!!!!
?>