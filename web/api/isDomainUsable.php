<?php

include "../conf/db.php";
$q = $db->prepare("SELECT COUNT(*) AS mevcut FROM Domains WHERE domain = :domain");
$q->execute(array("domain" => $_GET["d"]));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
if($f[0]["mevcut"] > 1) echo "0";
else if($f[0]["mevcut"] == 0) echo "1";
else if($_GET["d"] == "admin") echo "0"; //bunlar dbden gelsin