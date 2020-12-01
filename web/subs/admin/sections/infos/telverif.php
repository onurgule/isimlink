
<?php
$phone = $_GET["p"];
?>
<div id="recaptcha-container"></div>
<script>

$(document).ready( async function(){
	var myphone = phone("<?=$phone?>","90");
	console.log(myphone[0]);
	
      var sw1 = await swal({   
            title: "Telefon Numara Kontrolü",   
            text: myphone[0]+ " numarasına doğrulama kodu göndereceğiz, doğru girmediyseniz düzenleyebilirsiniz.",   
            type: "warning",   
            showCancelButton: true,   
			showLoaderOnConfirm: true,
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Onayla",   
            cancelButtonText: "Yanlış Girdim",
			preConfirm: function() {
			Swal.showLoading();
			swal.showLoading();

			var phoneNumber = myphone[0];
				var appVerifier = window.recaptchaVerifier;
				Swal.showLoading()
				firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
					.then(function (confirmationResult) {
						Swal.close();
						console.log("sends");
						$('.sms-code').show();
					  // SMS sent. Prompt user to type the code from the message, then sign the
					  // user in with confirmationResult.confirm(code).
					  
					  window.confirmationResult = confirmationResult;
					}).catch(function (error) {
						console.log("yoo",error);
					  // Error; SMS not sent
					  // ...
					});
			
			return false;
		  // proceed otherwise
		},

			  onOpen: function() { $('.swal2-confirm').attr('id','btnConfirm');$('.swal2-cancel').attr('id','btnCancel');
			  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier($('.swal2-confirm')[0], {
			  'size': 'invisible',
			  'callback': function(response) {
				// reCAPTCHA solved, allow signInWithPhoneNumber.
				console.log("ok captch");
				Swal.showLoading();
			  }
			});
			}
        }).then((asd) => {
			
			if(asd.value == true){
				
				//let there be firebase
			
			}
			else{
				console.log("niye yaw");
				form.steps("previous");
				return false;
			}
		});
});

</script>
<div class="sms-code" style="display:none;">
<form>
    <div class="input-field">
        <input id="step3" type="text" value="" >
        <label for="step3">SMS ile Gelen Kod</label>
    </div>
</form>
</div>