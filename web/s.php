<?php
session_set_cookie_params ( 
    time() + 3600,      // $lifetime
    '/',                // $path 
    '.isim.link'
);
ini_set('session.cookie_domain', '.isim.link');
session_start();
ini_set('session.cookie_domain', '.isim.link');
$_SESSION["o"] = "onur";
print_r($_SESSION);

print ini_get("session.cookie_domain");