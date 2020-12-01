<?php
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);
include "../../../../conf/db.php";
include "../../../../conf/key.php";
$infotype = $data->it;
$iid= null;
//print_r($data);
//Burada infoyu ekleyelim, adama sorduktan sonra aktif yapalım.
if($infotype == 2){
//print_r($data->user->uid);
//print_r($db);
if($data->user->uid != null){
$q = $db->prepare("CALL addInfo(:uid,:info,:type)");
$q->execute(array("uid" => $_SESSION['uid'],"info" => $data->user->phoneNumber,"type" => $infotype));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
//burdan idyi getir.
$iid = $f[0]['IID'];
}
}
if($infotype == 1){
//print_r($data->user->uid);
//print_r($db);
if($data->user->email != null){
$q = $db->prepare("SELECT i.IID AS IID FROM Infos i WHERE i.UID = :uid AND i.Info = :info AND i.TypeID = :type AND i.verified = 1");
$q->execute(array("uid" => $_SESSION['uid'],"info" => $data->user->email,"type" => $infotype));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
//burdan idyi getir.
print_r($f);
$iid = $f[0]['IID'];
}
}
?>
<h3 style="text-align:center;">Bilgi Eklendi!</h3>
<p style="text-align:center;">Bu bilgiyi bir domaine bağlayabilirsiniz.</p>
<div>
<form action="domlink.php" method="post">
	<input type="hidden" name="iid" value="<?=$iid?>">
	<input type="hidden" name="uid" value="<?=$_SESSION['uid']?>">
    <div class="row">
    <div class="col s12">
		<select class="form-control required" style="display:block !important;" id="domain" name="domain">
		<?
		$q = $db->prepare("CALL getDomainsOfUser(:uid)");
		$q->execute(array("uid" => $_SESSION['uid']));
		$f = $q->fetchAll(PDO::FETCH_ASSOC);
		foreach($f as $dom){
			?>
			<option value="<?=$dom["DID"]?>"><?=$dom["Domain"]?>.isim.link</option>
		<?}?>
		</select>
		<label for="newinfotype"> Domain: <span class="danger">*</span> </label>
	</div>
	</div>
    <div class="row">
	<div class="col s12">
		<select class="form-control required" style="display:block !important;" id="privacy" name="privacy">
		<?
		$q = $db->prepare("CALL getPrivacies()");
		$q->execute();
		$f = $q->fetchAll(PDO::FETCH_ASSOC);
		foreach($f as $dom){
			?>
			<option value="<?=$dom["PID"]?>"><?=$dom["Privacy"]?></option>
		<?}?>
		</select>
		<label for="newinfotype"> Gizlilik Türü: <span class="danger">*</span> </label>
	</div>
	</div>
	</form>
	</div>
<?



if($infotype == 1 && false){
	?>
	<form>
    <div class="input-field">
        <input id="step2" type="email" value="" >
        <label for="step2">Email Adresiniz</label>
    </div>
</form>
	<?
}
else if($infotype == 2&& false){
	
	?>
	<form>
    <div class="input-field">
        <input disabled id="step2" type="tel" value="<?=$data->user->phoneNumber?>" >
        <label for="step2">Telefon Numaranız</label>
    </div>
</form>
	<?
}
else if($infotype == 3&& false){
	
}