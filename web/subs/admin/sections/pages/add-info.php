<div class="container-fluid">
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content wizard-content">
                                <h5 class="card-title">Bilginizi Ekleyin</h5>
                                <h6 class="card-subtitle">Linkinizde gösterilmesini istediğiniz bilgiyi ekleyin!</h6>
                                <form action="#" class="validation-wizard wizard-circle m-t-40">
                                    <!-- Step 1 -->
                                    <h6>Bilgi Türü</h6>
                                    <section style="height:150px;">
                                        <div class="row">
                                            <div class="col m12">
                                                <div class="input-field col s12">
                                                    <select class="custom-select form-control required" id="newinfotype" name="newinfotype">
                                                        <option value="2">Telefon Numarası</option>
                                                        <option  value="1">Email Adresi</option>
                                                        <option disabled value="3">Adres</option>
                                                    </select>
                                                    <label for="newinfotype"> Bilgi Türü : <span class="danger">*</span> </label>
                                                </div>
                                            </div>
                                        </div>
											<span>Ekleyeceğiniz bilgi türünü seçiniz...</span>
                                    </section>
                                    <!-- Step 2 -->
                                    <h6>Bilgi Girişi</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col m12">
                                                <div class="input-field col s12">
													<div id="form-step2"></div>
												</div>
											</div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6>Doğrulama</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col m12">
                                                <div class="input-field col s12">
													<div id="form-step3"></div>
												</div>
											</div>
                                        </div>
                                    </section>
                                    </section>
                                    <!-- Step 4 -->
                                    <h6>Link</h6>
                                    <section>
                                         <div class="row">
                                            <div class="col m12">
                                                <div class="input-field col s12">
													<div id="form-step4"></div>
												</div>
											</div>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
			<link href="../../assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
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
 
			   <script src="../../assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="../../assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="../../assets/libs/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="https://isim.link/assets/js/phonur.js"></script>
<script src="https://cdn.firebase.com/js/client/2.4.0/firebase.js"></script>
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-analytics.js"></script>


  <!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-firestore.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyDH6pWsHZTGntZFUYIAQ7SeCQyF3Dfo9Zs",
    authDomain: "isimlink-firebase.firebaseapp.com",
    databaseURL: "https://isimlink-firebase.firebaseio.com",
    projectId: "isimlink-firebase",
    storageBucket: "isimlink-firebase.appspot.com",
    messagingSenderId: "632015320451",
    appId: "1:632015320451:web:4b2ae82fa12a0d6ab032b6",
    measurementId: "G-3HH607XQCG"
  };
  // Initialize Firebase
  if (!firebase.apps.length) {
    firebase.initializeApp(firebaseConfig);
}
  firebase.analytics();
  firebase.auth().languageCode = 'tr';
</script>

    <script>
    


    var form = $(".validation-wizard").show();
	var infos = {};
    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
			console.log(currentIndex,newIndex,"indexx");
			if(newIndex == 1){
				var newinfotype = $('#newinfotype').val();
				console.log(newinfotype);
				 $.get('sections/infos/step2.php?it='+newinfotype, function(data) {
					$('#form-step2').html(data);
				  });
			}
			else if(newIndex == 2){
					var newinfotype = $('#newinfotype').val();
					var step2val = $('#step2').val();
					if(newinfotype == 2){
				console.log(newinfotype);
				 $.get('sections/infos/telverif.php?p='+step2val, function(data) {
					 if(data.indexOf("illegaldataexc")>-1){
						 form.steps("previous");
						 console.log("sa");

					 }
					 else $('#form-step3').html(data);
				  });
					}
					else if(newinfotype == 1){
				console.log(newinfotype);
				 $.get('sections/infos/emailverif.php?email='+step2val, function(data) {
					 if(data.indexOf("illegaldataexc")>-1){
						 form.steps("previous");
						 console.log("sa");

					 }
					 else $('#form-step3').html(data);
				  });
					}
			}
			else if(newIndex == 3){
				var newinfotype = $('#newinfotype').val();
				var step3val = $('#step3').val();
				if(newinfotype == 2){
					var code = step3val;
					confirmationResult.confirm(code).then(function (result) {
					  // User signed in successfully.
					  var user = result.user;
					  infos.user = user;
					  infos.it = newinfotype;
					  $('#step3').removeClass("invalid");
						$.post( "sections/infos/step4.php", JSON.stringify(infos))
						  .done(function( data ) {
							$('#form-step4').html(data);
						  });
					  // ...
					}).catch(function (error) {
						 $('#step3').addClass("validate invalid");
						 form.steps("previous");
					  // User couldn't sign in (bad verification code?)
					  // ...
					});
				}
				else if(newinfotype == 1){
					var code = step3val;
					var step2val = $('#step2').val();
					 $.get('sections/infos/emailverifcode.php?email='+step2val+'&code='+code, function(data) {
					 if(data == '1'){
					  var user = {email:step2val, code:code};
					  infos.user = user;
					  infos.it = newinfotype;
						$.post( "sections/infos/step4.php", JSON.stringify(infos))
						  .done(function( data ) {
							$('#form-step4').html(data);
						  });
					 }
					 else {
						 form.steps("previous");
						 console.log("sa");
					 }
				  });
					
					
					
					
				}
				
			}
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")))
        },
        onFinishing: function(event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function(event, currentIndex) {
            swal("Bilgi Eklendi!", "Bilginiz eklenmiştir, bilgilerim sayfasından güncelleyebilirsiniz.").then(()=>{
			document.location.href='infos.php';
				
			});
        }
    }), $(".validation-wizard").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element)
        },
        rules: {
            email: {
                email: !0
            }
        }
    })
    </script>

	<link href="../../dist/css/style.css" rel="stylesheet">
    <!-- This page CSS -->
    <link href="../../assets/libs/jquery-steps/jquery.steps.css" rel="stylesheet">
    <link href="../../assets/libs/jquery-steps/steps.css" rel="stylesheet">