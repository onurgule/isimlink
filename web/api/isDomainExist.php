<?php

include "../conf/db.php";
$q = $db->prepare("SELECT COUNT(*) AS mevcut FROM Domains WHERE domain = :domain");
$q->execute(array("domain" => $_GET["d"]));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
echo $f[0]["mevcut"];