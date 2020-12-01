<?php
session_set_cookie_params ( 
    time() + 3600,      // $lifetime
    '/',                // $path 
    '.isim.link'
);
ini_set('session.cookie_domain', '.isim.link');
session_start();
if(explode(".",$_SERVER['SERVER_NAME'])[0] != $_SESSION["domain"]){
	header("Location: https://isim.link/login.php");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	  window.location.href='https://isim.link/login.php?d=".explode(".",$_SERVER['SERVER_NAME'])[0]."';
	 </SCRIPT>");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "sections/head.php"; ?>
</head>
<body>
    <div class="main-wrapper" id="main-wrapper">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">IsimLink</p>
            </div>
        </div>
        <?php include "sections/header.php"; ?>
        <?php include "sections/sidebar.php"; ?>
        <div class="page-wrapper">
		<?php include "sections/pages/index.php"; ?>
            <footer class="center-align m-b-30"><a href="https://isim.link">IsimLink</a> tarafından oluşturulmuştur.</footer>
        </div>
        <?php include "sections/settingsbar.php"; ?>
        <div class="chat-windows"></div>
    </div>
    <?php include "sections/foot.php"; ?>
</body>

</html>