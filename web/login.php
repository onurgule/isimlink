<?php
session_start();
?>
<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>IsimLink - Login</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="assets/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/loginStyle.css">
	<!-- Hotjar Tracking Code for isim.link -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2108147,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</head>
<body>
	<div class="row gmailStyle">
		<div class="container-fluid">
			<div class="valign-wrapper screenHeight">
					<div class="col card s12 m8 l6 xl4 autoMargin setMaxWidth overflowHidden">
						<div class="row hidden" id="progress-bar">
					    <div class="progress mar-no">
					      <div class="indeterminate"></div>
					    </div>
						</div>
						<div class="clearfix mar-all pad-all"></div>

						<img src="assets/images/logos/logo_transparent.png" class="logoImage" />
						<h5 class="center-align mar-top mar-bottom formTitle">Giriş Yapın</h5>
						<p class="center-align pad-no mar-no">İsimLink panelinize erişmek için</p>

						<div class="clearfix mar-all pad-all"></div>

						<div id="formContainer" class="goRight">

							<form class="loginForm" id="loginForm" onsubmit="return false;">
								<div class="input-fields-div autoMargin">
									<div class="input-field">
					          <input id="user_name" style="width:60%;" type="text" class="validate">
					          <label for="user_name">Kullanıcı Adınız</label>
							  <span style="font-size:x-large;">.isim.link</span>
							  <span class="helper-text" data-error="Link bulunamadı!"></span>
					        </div>
									
									<div id="passwordDiv" class="input-field scale-transition scale-out">
					          <input id="pass_word" type="password" class="validate">
					          <label for="pass_word">Şifreniz</label>
										<a href="javascript:void(0)" class="showPassword" onclick="showPassword()"><i class="material-icons md-18">visibility</i></a>
					        </div>
									<p><a href="#register" class="register">Üye Ol</a></p>
								</div>
								<div class="input-fields-div autoMargin right-align">
									<a style="background-color:royalblue;" href="#password" class="loginNextBtn waves-effect waves-light btn">Giriş</a>
									<button style="background-color:royalblue;" type="submit" onclick="login()" class="loginBtn waves-effect waves-light btn hide">Giriş</button>
								</div>
							</form>

							<form class="signUpForm">
								<div class="input-fields-div autoMargin">
									<div class="row input-inline-field">
										<div class="input-field col s6">
						          <input id="first_name" type="text" class="validate">
						          <label for="first_name">Adınız</label>
						        </div>
										<div class="input-field col s6">
						          <input id="last_name" type="text" class="validate">
						          <label for="last_name">Soyadınız</label>
						        </div>
									</div>
									<div class="input-field">
					          <input style="width:60%;" id="reg_user_name" type="text" class="">
					          <label for="reg_user_name">Kullanıcı Adınız</label>
							  <span style="font-size:x-large;">.isim.link</span>
										<span class="helper-text" data-error="Bu link kullanılamaz!" data-success="Bu link kullanılabilir.">Kendinize özel <strong>benzersiz</strong> bir <strong>link</strong> seçiniz.</span>
					        </div>
									<div class="row input-inline-field">
										<div id="reg_passwordDiv" class="input-field col s6">
						          <input pattern=".{6,}"   required title="6 characters minimum" minlength="6" id="reg_pass_word" type="password" class="">
						          <label for="reg_pass_word">Şifreniz</label>
											
											<a href="javascript:void(0)" class="showPassword" onclick="showPassword()"><i class="material-icons md-18">visibility</i></a>
											<!--<span class="helper-text" data-error="Min. 6 karakter!" data-success="right">Min. 6 karakter</span>-->
						        </div>
								
										<div id="rePasswordDiv" class="input-field col s6">
						          <input minlength="6" pattern=".{6,}" required title="6 characters minimum" id="re_pass_word" type="password" class="">
						          <label for="re_pass_word">Şifreniz</label>
						        </div>
										<div class="input-field col s12 mar-no">
											<span class="helper-text" data-error="İki şifreyi de aynı giriniz.">Yalnızca IsimLink'te kullanacağınız bir parola seçmenizi öneririz.</span>
										</div>
									</div>
									<p>Zaten hesabım var, <a href="#" class="backToLogin">Giriş Yap</a></p>
								</div>
								<div class="input-fields-div autoMargin right-align">
									<button style="background-color:royalblue;" type="submit" onclick="register()" class="registerBtn waves-effect waves-light btn">Kaydol</button>
								</div>
							</form>
							<div class="clearfix"></div>
						</div>


						<div class="clearfix mar-all pad-all"></div>
					</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/js/materialize.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/js/routie.min.js"></script>
	<script type="text/javascript" src="assets/js/loginScript.js"></script>
</body>
</html>
