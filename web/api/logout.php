<?php
ini_set('session.cookie_domain', substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100));
session_start();
if (session_status() == PHP_SESSION_ACTIVE) { session_destroy(); }
echo "<script>document.location.href='https://isim.link/login.php';</script>";