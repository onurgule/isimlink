<?php
$mailadd = $_GET["email"];
require '../../../../api/sendEmail.php';
require '../../../../conf/db.php';
require '../../../../conf/cry.php';
//echo $randomKey."--".$_SESSION['uid']."-";
if($mailadd != "" && $mailadd != " " && $mailadd != null){
$q = $db->prepare("CALL addEmail(:uid,:email,:code)");
$q->execute(array("uid" => $_SESSION['uid'], "email" => $mailadd, "code" => $randomKey)); //cry ile eklenecek...
$f = $q->fetchAll();
//print_r($f);
print_r(array("uid" => $_SESSION['uid'], "email" => $mailadd, "code" => $randomKey));
if($f[0]['return'] == 'ok'){
?>

<div class="email-code">
<form>
    <div class="input-field">
        <input id="step3" type="text" value="" >
        <label for="step3">Email ile Gelen Kod</label>
    </div>
</form>
</div>

<? } 
else{
	?>
	<h3 style="text-align:center;">Bir Hata Oluştu!</h3>
	<p style="text-align:center;">Bu email kayıtlı olabilir... Tekrar deneyin.</p>
	<?
} }
else{
	?>
	<h3 style="text-align:center;">Bir Hata Oluştu!</h3>
	<p style="text-align:center;">Yanlış email girildi. Tekrar deneyin.</p>
<? } ?>