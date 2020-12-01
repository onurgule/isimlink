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
	    <link href="../../assets/libs/footable/css/footable.core.css" rel="stylesheet">
    <link href="../../dist/css/pages/footable-page.css" rel="stylesheet">
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
		<?php include "sections/pages/domains.php"; ?>
        <?php include "sections/footer.php"; ?>
        </div>
        <?php include "sections/settingsbar.php"; ?>
        <div class="chat-windows"></div>
    </div>
    <?php include "sections/foot.php"; ?>
	    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../dist/js/materialize.min.js"></script>
    <script src="../../assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!-- ============================================================== -->
    <!-- Apps -->
    <!-- ============================================================== -->
    <script src="../../dist/js/app.js"></script>
     <script src="../../dist/js/app.init.mini-sidebar.js"></script>
    <script src="../../dist/js/app-style-switcher.js"></script>
    <!-- ============================================================== -->
    <!-- Custom js -->
    <!-- ============================================================== -->
    <script src="../../dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <!-- Footable -->
    <script src="../../assets/libs/footable/dist/footable.all.min.js"></script>
    <script src="../../dist/js/pages/footable/footable-init.js"></script>
</body>

</html>