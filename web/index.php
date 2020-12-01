<!doctype html>
<html class="no-js" lang="tr">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>İsimLink - İletişim Bilgileriniz Tek Linkte</title>
    
    <meta name="description" content="İsimLink ile telefon, email gibi iletişim bilgilerinizi kısa link olarak istediğiniz kişiyle kolaylıkla paylaşabilirsiniz.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="assets/css/slick.css">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/css/default.css">
     <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/style.css">
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
    <!--[if IE]>
    <p class="browserupgrade">Eski bir browser kullanıyorsunuz, tam verim alamayabilirsiniz.</p>
  <![endif]-->
   
    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/images/logos/logo_transparent.png" alt="">
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->
    
    <!--====== NAVBAR TWO PART START ======-->

    <section class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                       
                        <a class="navbar-brand" href="#">
                            <img style="width:250px;" src="assets/images/logos/logo_only_name_transparent.png" alt="Logo">
                        </a>
                        
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item active"><a class="page-scroll" href="#home">Anasayfa</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#services">Servisler</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#pricing">Fiyatlandırma</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#about">S.S.S</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#team">Takım</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#contact">İletişim</a></li>
                            </ul>
                        </div>
                        
                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                <li><a class="solid" href="login.php">Giriş</a></li>
                            </ul>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== NAVBAR TWO PART ENDS ======-->
    
    <!--====== SLIDER PART START ======-->


    <section id="home" class="slider_area">
        <div id="carouselThree" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselThree" data-slide-to="0" class="active"></li>
                <li data-target="#carouselThree" data-slide-to="1"></li>
                <li data-target="#carouselThree" data-slide-to="2"></li>
                <li data-target="#carouselThree" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner">
			<div class="carousel-item active">
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-8 center">
                                <div class="slider-content" style="text-align:center;">
									<img style="width:250px; height:115px; margin-bottom:25px;" src="assets/images/logos/logo_name_transparent.png" alt="">
                                    <div>
									<form action="api/search.php">
									<div class="input-group">
									<input style="text-align:center;" id="search_query" class="form-control" type="text" name="query" />
									<div class="input-group-append">
									  <span class="input-group-text">.isim.link</span>
									</div>
									</div>
									</div>
                                    <ul class="slider-btn rounded-buttons" style="text-align:center;">
                                        <li><input type="submit" name="action" value="Git" class="main-btn rounded-one" /></li>
										<li><a href="#" class="main-btn rounded-one waves-effect waves-light btn modal-trigger" onclick="doSearch()">Ara</a></li>
                                    </ul>
									</form>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    
                </div> <!-- carousel-item -->
				<!--<div class="carousel-item active">
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-10 center">
                                <div class="slider-content" style="text-align:center;">
									<img style="width:150px; height:80px; margin-bottom:25px;" src="assets/images/logos/logo_name_transparent.png" alt="">
									<p style="text-align:center; margin-bottom:15px; color:white;">İsimLink'te arayın...</p>
                                    <div>
									<form action="api/search.php">
									<input style="text-align:center;" class="form-control" type="text" name="query" />
									</div>
                                    <ul class="slider-btn rounded-buttons" style="text-align:center;">
                                        <li><input type="submit" value="Ara" class="main-btn rounded-one" /></li>
                                    </ul>
									</form>
                                </div>
                            </div>
                        </div> 
                    </div> 
                    
                </div> <!-- carousel-item -->
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">990 Rakam Ezberlenmez</h1>
                                    <p class="text">Araştırmalara göre kişilerin rehberlerinde ortalama 90 kişi kayıtlı. Her birinin desensiz 11 haneli telefonunu ezberlemeniz veya ezberletmeniz çok zor.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="login.php#register">Numaranı Kısalt</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="assets/images/slider/1.png" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->

                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">Şarjınız Bitebilir</h1>
                                    <p class="text">Şarjınız bittiğinde buluşacağınız kişiyi ezberden arayabilir misiniz?</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="login.php#register">Kısalt</a></li>
                                    </ul>
                                </div> <!-- slider-content -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="assets/images/slider/2.png" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->

                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">İşletmeler için Nimet</h1>
                                    <p class="text">Kaç kişi işletmenizin adını biliyor, kaç kişi telefonunu biliyor? Artık müşterilerinizin işletmenizin adını bilmesi yeterli.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="login.php#register">Hemen Başlayın</a></li>
                                    </ul>
                                </div> <!-- slider-content -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="assets/images/slider/3.png" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->
            </div>

            <a class="carousel-control-prev" href="#carouselThree" role="button" data-slide="prev">
                <i class="lni lni-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselThree" role="button" data-slide="next">
                <i class="lni lni-arrow-right"></i>
            </a>
        </div>
    </section>

    <!--====== SLIDER PART ENDS ======-->
    
    <!--====== FEATRES TWO PART START ======-->

    <section id="services" class="features-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Servislerimiz</h3>
                        <p class="text">İsimLink'in özellikleri saymakla bitmez! Ancak biz yine en önemli özelliklerini sıralayalım.</p>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title"><a href="#">Kolay ve Düzenli</a></h4>
                            <div class="features-icon">
                                <i class="lni lni-brush"></i>
                                <img class="shape" src="assets/images/f-shape-1.svg" alt="Shape">
                            </div>
                        </div>
                        <div class="features-content">
                            <p class="text">İsminizi bilmek mi, telefonunuzu bilmek mi daha kolay? Düzensiz rakamları ezberlemek kesinlikle daha zor. Hemen kendinize özel ücretsiz bir link oluşturun ve sevdiklerinizle paylaşın!</p>
                            <a class="features-btn" href="login.php#register">Daha Fazla</a>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title"><a href="#">Kişiye Özel Bilgiler</a></h4>
                            <div class="features-icon">
                                <i class="lni lni-layout"></i>
                                <img class="shape" src="assets/images/f-shape-1.svg" alt="Shape">
                            </div>
                        </div>
                        <div class="features-content">
                            <p class="text">Kişisel telefon numaranızı herkese vermek istemezsiniz. Bunu da düşündük! Kişisel iletişim bilgilerinizi yalnızca yakınlarınızla paylaşabilirsiniz.</p>
                            <a class="features-btn" href="login.php#register">Daha Fazla</a>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title"><a href="#">Tamamen Güvenli</a></h4>
                            <div class="features-icon">
                                <i class="lni lni-bolt"></i>
                                <img class="shape" src="assets/images/f-shape-1.svg" alt="Shape">
                            </div>
                        </div>
                        <div class="features-content">
                            <p class="text">Tüm bilgileriniz şifreli olarak saklandığından dolayı izin vermediğiniz bir kişi, kişisel verilerinize erişemez!</p>
                            <a class="features-btn" href="login.php#register">Daha Fazla</a>
                        </div>
                    </div> <!-- single features -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FEATRES TWO PART ENDS ======-->
    
    
    <!--====== PRINICNG START ======-->

    <section id="pricing" class="pricing-area ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-25">
                        <h3 class="title">Fiyatlandırma</h3>
                        <p class="text">Kişisel kullanım tamamen ücretsiz, ancak iş için de kullanmak isteyebilirsiniz diye düşündük.</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="pricing-style mt-30">
                        <div class="pricing-icon text-center">
                            <img src="assets/images/basic.svg" alt="">
                        </div>
                        <div class="pricing-header text-center">
                            <h5 class="sub-title">Kişisel Kullanım</h5>
                            <p class="month"><span class="price">Ücretsiz</span></p>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li><i class="lni lni-check-mark-circle"></i>Kısa Link Servisi</li>
                                <li><i class="lni lni-check-mark-circle"></i>Kişisel iletişim bilgileri</li>
								<li><i class="lni lni-check-mark-circle"></i>Özel paylaşım hizmeti</li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="main-btn rounded-one" href="login.php#register">Hemen Başlayın</a>
                        </div>    
                    </div> <!-- pricing style one -->
                </div>
                
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="pricing-style mt-30">
                        <div class="pricing-icon text-center">
                            <img src="assets/images/pro.svg" alt="">
                        </div>
                        <div class="pricing-header text-center">
                            <h5 class="sub-title">İş İçin</h5>
                            <p class="month"><span class="price">9 ₺</span>/ay</p>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li><i class="lni lni-check-mark-circle"></i>Kısa Link Servisi</li>
                                <li><i class="lni lni-check-mark-circle"></i>Kişisel iletişim bilgileri</li>
								<li><i class="lni lni-check-mark-circle"></i>Özel paylaşım hizmeti</li>
								<li><i class="lni lni-check-mark-circle"></i>İş telefonları</li>
								<li><i class="lni lni-check-mark-circle"></i>Kartvizit hizmeti</li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="main-btn rounded-one" href="login.php#register">Hemen Başlayın</a>
                        </div>
                    </div> <!-- pricing style one -->
                </div>
                
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="pricing-style mt-30">
                        <div class="pricing-icon text-center">
                            <img src="assets/images/enterprise.svg" alt="">
                        </div>
                        <div class="pricing-header text-center">
                            <h5 class="sub-title">Kurumsal</h5>
                            <p class="month"><span class="price">İletişime Geçin</span></p>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li><i class="lni lni-check-mark-circle"></i>Kısa Link Servisi</li>
                                <li><i class="lni lni-check-mark-circle"></i>Çalışanlara Özel Link</li>
								<li><i class="lni lni-check-mark-circle"></i>Özel paylaşım hizmeti</li>
								<li><i class="lni lni-check-mark-circle"></i>Santral Hizmeti</li>
								<li><i class="lni lni-check-mark-circle"></i>Kartvizit hizmeti</li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="main-btn rounded-one" href="mailto:iletisim@isim.link">İletişime Geçin</a>
                        </div>
                    </div> <!-- pricing style one -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PRINICNG ENDS ======-->
    
    <!--====== ABOUT PART START ======-->

    <section id="about" class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="faq-content mt-45">
                        <div class="about-title">
                            <h6 class="sub-title">Biraz Bizle Alakalı</h6>
                            <h4 class="title">Sıkça Sorulan Sorular</h4>
                        </div> <!-- faq title -->
                        <div class="about-accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Servisiniz Ücretli mi?</a>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text">Servisimiz kişisel kullanım için tamamen ücretsizdir. Herhangi bir ödeme bilgisi talep etmiyoruz. Hemen kullanmaya başlayabilirsiniz.</p>
                                        </div>
                                    </div> 
                                </div> <!-- card -->
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Bana nasıl ulaşacaklar?</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text">IsimLink ile telefonunuzu kısalttıysanız dileyen kişi ornek.isim.link adresine giderek size anında ulaşabilir. Ayrıca mobil uygulamamızı da indirebilir ve kolaylıkla erişebilir.</p>
                                        </div>
                                    </div>
                                </div> <!-- card -->
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Ya linkimi başkası yazarsa?</a>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text">Bunu da düşündük, eğer telefon numaranızı herkese açık olarak paylaşmak istemiyorsanız ücretsiz olarak özel paylaşım hizmetimizden yararlanabilir ve telefonunuzu kimin görebileceğini yönetebilirsiniz.</p>
                                        </div>
                                    </div>
                                </div> <!-- card -->
                                <div class="card">
                                    <div class="card-header" id="headingFore">
                                        <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFore" aria-expanded="false" aria-controls="collapseFore">İşletmem için almak istiyorum.</a>
                                    </div>
                                    <div id="collapseFore" class="collapse" aria-labelledby="headingFore" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text">İşletmeniz için özel bir panel veriyoruz, bu panel ile çalışanlarınızın iş telefonlarını kısaltıp kolaylıkla iletişime geçebileceksiniz.</p>
                                        </div>
                                    </div>
                                </div> <!-- card -->
                                <div class="card">
                                    <div class="card-header" id="headingFive">
                                        <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Bilgilerim Çalınırsa?</a>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text">Bilgileriniz tamamen şifreli olarak saklanmakta. Linkinizi vermediğiniz biri sizin özel bilgilerinizi göremez.</p>
                                        </div>
                                    </div>
                                </div> <!-- card -->
                            </div>
                        </div> <!-- faq accordion -->
                    </div> <!-- faq content -->
                </div>
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img style="width:auto; margin-top: auto;" src="assets/images/logos/logo_name_transparent.png" alt="about">
                    </div> <!-- faq image -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->
    
    <!--====== TESTIMONIAL PART START ======-->

    <section id="testimonial" class="testimonial-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-5 col-lg-6">
                    <div class="testimonial-left-content mt-45">
                        <h6 class="sub-title">Yorumlar</h6>
                        <h4 class="title">Kullanıcılarımızın hakkımızdaki <br> yorumları</h4>
                        <ul class="testimonial-line">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <p class="text">Tüm kullanıcılarımızın bizim önceliğimizdir. Bir problem yaşadıklarında hemen irtibata geçer ve problemi gideririz. </p>
                    </div> <!-- testimonial left content -->
                </div>
                <div class="col-lg-6">
                    <div class="testimonial-right-content mt-50">
                        <div class="quota">
                            <i class="lni lni-quotation"></i>
                        </div>
                        <div class="testimonial-content-wrapper testimonial-active">
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">“Telefonumu söylerken zorlanıyorum, ancak artık İsimLink ile çok rahat olarak telefonumu paylaşabiliyorum.”</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
                                    <div class="author-info d-flex align-items-center">
                                        <div class="author-image">
                                            <img src="assets/images/author-1.jpg" alt="author">
                                        </div>
                                        <div class="author-name media-body">
                                            <h5 class="name">Orhun Özdemir</h5>
                                            <span class="sub-title">SAU Öğrencisi</span>
                                        </div>
                                    </div>
                                    <div class="author-review">
                                        <ul class="star">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                        </ul>
                                        <span class="review"></span>
                                    </div>
                                </div>
                            </div> <!-- single testimonial -->
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">“Telefonumu herkesin içinde vermekten hoşlanmıyorum, İsimLink sayesinde sadece tanıdıklarımla paylaşabiliyorum.”</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
                                    <div class="author-info d-flex align-items-center">
                                        <div class="author-image">
                                                <img src="assets/images/author-2.jpg" alt="author">
                                        </div>
                                        <div class="author-name media-body">
                                            <h5 class="name">Özlem Yıldız</h5>
                                            <span class="sub-title">İş Kadını</span>
                                        </div>
                                    </div>
                                    <div class="author-review">
                                        <ul class="star">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                        </ul>
                                        <span class="review"></span>
                                    </div>
                                </div>
                            </div> <!-- single testimonial -->
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">“İşletmeleri aramak için önce Google'dan telefon numaralarını bulmak zorunda kalıyordum. Artık İsimLink ile tek tıkla arayabiliyorum.”</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
                                    <div class="author-info d-flex align-items-center">
                                        <div class="author-image">
                                                <img src="assets/images/author-3.jpg" alt="author">
                                        </div>
                                        <div class="author-name media-body">
                                            <h5 class="name">Taha Furkan Cansizoğlu</h5>
                                            <span class="sub-title">SAU Öğrencisi</span>
                                        </div>
                                    </div>
                                    <div class="author-review">
                                        <ul class="star">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                        </ul>
                                        <span class="review"></span>
                                    </div>
                                </div>
                            </div> <!-- single testimonial -->
                        </div> <!-- testimonial content wrapper -->
                    </div> <!-- testimonial right content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== TESTIMONIAL PART ENDS ======-->
    
    <!--====== TEAM START ======-->

    <section id="team" class="team-area pt-120 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-30">
                        <h3 class="title">Takımımız</h3>
                        <p class="text">Bu harika hizmeti sizinle buluşturan takım üyelerimizle tanışın!</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="team-style-eleven text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                        <div class="team-image">
                            <img src="assets/images/onurgule.jpg" alt="Onur Osman Güle">
                        </div>
                        <div class="team-content">
                            <div class="team-social">
                                <ul class="social">
                                    <li><a href="https://www.linkedin.com/in/onurgule/"><i class="lni lni-linkedin-original"></i></a></li>
                                </ul>
                            </div>
                            <h4 class="team-name"><a href="#">Onur Osman GÜLE</a></h4>
                            <span class="sub-title">Co-Founder</span>
                        </div>
                    </div> <!-- single team -->
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="team-style-eleven text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                        <div class="team-image">
                            <img src="assets/images/fatiheniskaya.jpg" alt="Fatih Enis Kaya">
                        </div>
                        <div class="team-content">
                            <div class="team-social">
                                <ul class="social">
                                    <li><a href="https://www.linkedin.com/in/fatiheniskaya/"><i class="lni lni-linkedin-original"></i></a></li>
                                </ul>
                            </div>
                            <h4 class="team-name"><a href="#">Fatih Enis KAYA</a></h4>
                            <span class="sub-title">Co-Founder</span>
                        </div>
                    </div> <!-- single team -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== TEAM  ENDS ======-->
    
    <!--====== CONTACT PART START ======-->

    <section id="contact" class="contact-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-30">
                        <h3 class="title">İletişim</h3>
                        <p class="text">Herhangi bir sorunuz olursa çekinmeden iletişime geçin!</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="contact-info pt-30">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text"> Sakarya Üniversitesi - Bilgisayar ve Bilişim Bilimleri Fakültesi </p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">iletisim@isim.link</p>
                                <p class="text">isimlink@gmail.com</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
							<p class="text"><a href="https://iletisim.isim.link/">iletisim.isim.link</a></p>
                                <p class="text"><a href="tel:+902129099149">+90 212 909 9149</a></p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row -->
            </div> <!-- contact info -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->
    
    <!--====== FOOTER PART START ======-->

    <section class="footer-area footer-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="footer-logo text-center">
                        <a class="mt-30" href="index.html"><img style="width:150px;" src="assets/images/logos/logo_name_transparent.png" alt="Logo"></a>
                    </div> <!-- footer logo -->
                    <ul class="social text-center mt-60">
                        <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                        <li><a href="#"><i class="lni lni-twitter-original"></i></a></li>
                        <li><a href="#"><i class="lni lni-instagram-original"></i></a></li>
                        <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                    </ul> <!-- social -->
                    <div class="footer-support text-center">
                        <span class="mail">iletisim@isim.link</span>
                    </div>
                    <div class="copyright text-center mt-35">
                        <p class="text">© Copyright IsimLink 2020 </a> </p>
                    </div> <!--  copyright -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->    

    <!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-">
                    
                </div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->
 <div id="modal1" class="modal bottom-sheet">
                                    <div class="modal-content">
                                        <h5 class="header">Arama Sonuçları</h5>
                                        <ul class="collection">
                                           
                                        </ul>
                                    </div>
                                </div>



    <!--====== Jquery js ======-->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!--====== Slick js ======-->
    <script src="assets/js/slick.min.js"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="assets/js/ajax-contact.js"></script>
    
    <!--====== Isotope js ======-->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    
    <!--====== Scrolling Nav js ======-->
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/scrolling-nav.js"></script>
    
    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>
	
    <script src="subs/dist/js/materialize.min.js"></script>
    <script>
async function doSearch(){
var query = $('#search_query').val();
 await fetch("https://isim.link/api/search.php?a=s&query="+query).then(getters => getters.text()).then( getter => {
	$('.collection').html(getter);
	var elem = document.querySelector('.modal');
	var instance = M.Modal.init(elem,);
	instance.open();
	})
}
$(document).ready(function(){
var elem = document.querySelector('.modal');
var instance = M.Modal.init(elem,);
});
</script>
</body>

</html>
