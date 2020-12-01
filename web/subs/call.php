<?php
$link = "tel:".$_GET["no"];
$numara = $_GET["num"];
header("Location: tel:`$numara`");