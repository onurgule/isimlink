<?php
$tcno1 = $_GET["tcno1"];
$tcno2 = $_GET["tcno2"];
$filter = $_GET["filter"];
$command = escapeshellcmd('python /var/www/html/tc/tc.py '.$tcno1.' '.$tcno2.' '.$filter);
$output = shell_exec($command);
echo ($output);
?>