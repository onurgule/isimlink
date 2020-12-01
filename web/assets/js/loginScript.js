var allPasswordInp = [];

$(document).ready(function() {
  
  $("input[type=password]").each(function(idx, ele) {
    allPasswordInp.push(ele)
  })

  routie({
    '': function() {
      showProgress()
      $("#passwordDiv").addClass("scale-out")
      $(".formTitle").html("Giriş Yapın")
      /* Show Login Form */
      $("#formContainer").removeClass("goLeft").addClass("goRight")

    },

    'hasPassword': function() {
      showProgress()
      $("#passwordDiv").addClass("pulse").removeClass("scale-out")
      $("#enterOTPDiv").addClass("scale-out")
      $(".passwordOrOTP").html("Giriş").attr("data-PassOTP","OTP").attr("href", "#enterOTP")
      $(".loginNextBtn").addClass("hide")
      $(".loginBtn").removeClass("hide")
    },

    'password': function() {
      showProgress()
	  console.log("geldim")
     /* setTimeout(function() {
        M.toast({html: 'Şifrenizi Giriniz', classes: 'rounded'})
      }, 600)*/
	  checkDomain().then((gelen) => {
		 if(gelen == 1){
			 //devam var
			 console.log("ok");
			  $("#passwordDiv").addClass("pulse").removeClass("scale-out")
			  $(".loginNextBtn").addClass("hide")
			  $(".loginBtn").removeClass("hide")
			 $('#user_name').removeClass("invalid");
			 $('#user_name').addClass("valid");
		 }
		 else{
			 console.log("notok");
			 $('#user_name').addClass("invalid");
			 routie('')
			 //if 1 if 2 yapılabilir ileride
			 
			 //genel hata (yok)
		 }
	  });

    },

    'register': function() {
      $(".formTitle").html("Kaydol")
      showProgress()
      /* Show Signup Form */
      $("#formContainer").removeClass("goRight").addClass("goLeft")
    }
  });
$('#reg_user_name').keyup(un => {
	checkDomainUsable().then((gelen) => {
		 if(gelen == 1){
			 //devam var
			 console.log("ok");
			 $('#reg_user_name').removeClass("invalid");
			 $('#reg_user_name').addClass("valid");
		 }
		 else{
			 $('#reg_user_name').addClass("invalid");
			 //if 1 if 2 yapılabilir ileride
			 
			 //genel hata (yok)
		 }
	  });
	});
	
	
});

async function login(){
	if($('#pass_word').val().length == 0)
	{
		routie('password')
		$('#pass_word').focus();
	}
	else{
		var data = { d: $('#user_name').val(), p:$('#pass_word').val() };
		await fetch('https://isim.link/api/login.php', {
		  method: 'POST',
		  headers: {
			'Content-Type': 'application/json',
		  },
		  body: JSON.stringify(data),
		})
		.then(response => response.text())
		.then(data => {
		  let res = (JSON.parse(data));
		  if(res.result == 1){
			  //buraya r gelirse, r'ye gidecek... r.isim.link
			    var queryDict = {}
				location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] =item.split("=")[1]})
				if(queryDict.redir != undefined) document.location.href="https://"+queryDict.redir+".isim.link/";
			    else document.location.href=res.panel;
		  }
		  else{
			 $('#user_name').removeClass("valid");
			  
			 $('#pass_word').addClass("invalid");
		  }
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	}
		
}
async function register(){
	if($('.signUpForm .invalid').length > 0){
		console.log("error");
	}
	else{
		//kaydedelim...
		console.log("okkey");
		
		var data = { n:$('#first_name').val(),s:$('#last_name').val(),d: $('#reg_user_name').val(), p:$('#reg_pass_word').val() };
		await fetch('https://isim.link/api/register.php', {
		  method: 'POST',
		  headers: {
			'Content-Type': 'application/json',
		  },
		  body: JSON.stringify(data),
		})
		.then(response => response.text())
		.then(data => {
			console.log(data);
		  let res = (JSON.parse(data));
		  if(res.result == 1){
			  //buraya r gelirse, r'ye gidecek... r.isim.link
			  document.location.href=res.panel;
		  }
		  else{
			 $('#reg_user_name').removeClass("valid");
			  
			 $('#reg_user_name').addClass("invalid");
		  }
		})
		.catch((error) => {
		  console.error('Error:', error);
		});
	
	
	}
		
}
function checkPasswordMatch() {
        var password = $("#reg_pass_word").val();
        var confirmPassword = $("#re_pass_word").val();
        if (password != confirmPassword){
			 $('#reg_pass_word').addClass("invalid");
			 $('#re_pass_word').addClass("invalid");
		}
        else
            $('#reg_pass_word').removeClass("invalid");
			 $('#re_pass_word').removeClass("invalid");
			 $('#reg_pass_word').addClass("valid");
			 $('#re_pass_word').addClass("valid");
    }
    $(document).ready(function () {
       $("#reg_pass_word").keyup(checkPasswordMatch);
       $("#re_pass_word").keyup(checkPasswordMatch);
    });
	
function showProgress() {
  $("#progress-bar").removeClass("hidden")
  setTimeout(function() {
    $("#progress-bar").addClass("hidden")
  }, 500)
}

async function checkDomain(){
	return await fetch("https://isim.link/api/isDomainExist.php?d="+$('#user_name').val()).then(getters => getters.text()).then( getter => {
	return getter;	
	})
}
async function checkDomainUsable(){
	return await fetch("https://isim.link/api/isDomainUsable.php?d="+$('#reg_user_name').val()).then(getters => getters.text()).then( getter => {
	return getter;	
	})
}


function showPassword() {
  var iconText = $(".showPassword:eq(0) i").text();
  var input_type = (iconText == "visibility") ? "text" : "password";
  if(input_type == "text") {
    $(".showPassword i").text("visibility_off");
  }else{
    $(".showPassword i").text("visibility");
  }

  $.each(allPasswordInp, function(idx, ele) {

    $(ele).attr("type", input_type);
  })
}

$("form#submit input").on('keypress',function(event) {
  event.preventDefault();
  if (event.which === 13) {
    routie('password');
  }
});