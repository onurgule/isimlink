<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="js/phonur.js"></script>
<title>İsimLink - Telefonu Linke Dönüştür</title>
<br>
<h2 style="text-align:center;">İsimLink - Telefon numaranızı linke dönüştürün!</h2>
<script>
function checkUsername(){
	let uname = document.getElementById('username');
	var english = /^[A-Za-z0-9]*$/;
	if (english.test(uname.value)){
		document.getElementById('tr').style.color = "black";
		document.getElementById('submit').removeAttribute("disabled");
	}	
	else{
		
		document.getElementById('tr').style.color = "red";
		document.getElementById('submit').setAttribute("disabled","disabled");
	}
}
function checkNumber(){
	let numb = document.getElementById('phone').value;
	var numbers = /^[0-9]+$/;
	if (numbers.test(numb)){
		if(phone(document.getElementById('phone').value,"90").length != 0){
		document.getElementById('phone').value = phone(document.getElementById('phone').value,"90")[0];
		document.getElementById('submit').removeAttribute("disabled");
		}
		else document.getElementById('submit').setAttribute("disabled","disabled");
	}	
	else{
		
		document.getElementById('submit').setAttribute("disabled","disabled");
	}
}
</script>
<?php
$exist = 0;
include "conf/db.php";
$ad = $_POST["name"];
$soyad = $_POST["surname"];
$username = $_POST["username"];
$phone = $_POST["phone"];

if(isset($username)){
	//kaydet
	$q = $db->prepare("SELECT COUNT(*) AS kackisi FROM Users WHERE username = :username");
	$q->execute(array("username" => $username));
	$f = $q->fetchAll(PDO::FETCH_ASSOC);
	if($f[0]["kackisi"] > 0){
		$exist = 1;
	}
	else{
		$q1 = $db->prepare("INSERT INTO Users(name,surname,username,phone) VALUES(:name,:surname,:username,:phone)");
		$q1->execute(array("name" => $ad, "surname" => $soyad, "username" => $username, "phone" => $phone));
		$link = $username.".isim.link";
	}
}


?><h3 style="display:none;">2021'DE YER YERİNDEN OYNAYACAK</h3>
<?php if(isset($link)){ ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<a class="btn btn-primary center" style="margin:25%;"  href="https://<?=$link?>"><?=$link?></a>
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">			
				<h4 class="modal-title w-100">Linkiniz oluştu!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center">Telefon numaranız yerine artık <?=$link?> linkini verebilirsiniz!</p>
			</div>
		</div>
	</div>
</div>     
<? }
else{?>
<div style="padding:30px;">
<?if($exist){?>
<label style="color:red;">Username kullanımda!</label>
<?}?>
<form method="POST" action="index.php">
<div style="display:flex">
 <div class="form-group">
    <label for="name">Ad:</label>
    <input required type="text" class="form-control" name="name" id="name">
  </div>
   <div class="form-group">
    <label for="surname">Soyad:</label>
    <input required type="text" class="form-control" name="surname" id="surname">
  </div>
  </div>
   <div class="form-group">
    <label for="username">Username:</label>
    <input required type="text" onchange="checkUsername()" class="form-control" name="username" id="username">
	<h6><b>username</b>.isim.link şeklinde tahsis edilecektir.</h6>
	<h6 id="tr">Türkçe karakter kullanmayınız.</h6>
  </div>
   <div class="form-group">
    <label for="phone">Telefon:</label>
    <input required type="tel" class="form-control" id="phone" name="phone" onchange="checkNumber()">
  </div>
     <div class="form-check">
    <input type="checkbox" class="form-check-input" id="gizlilik">
	 <label class="form-check-label" for="exampleCheck1">Linkimin gizliliği benim sorumluluğumda ve paylaştıklarım ile telefonumu paylaşmayı kabul ediyorum.</label>
  </div><br>
  <button id="submit" type="submit" class="btn btn-primary">Linki Al</button>
</form>
</div>
<?}?>