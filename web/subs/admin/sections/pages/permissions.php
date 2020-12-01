<?php
session_start();
include "../../conf/db.php";

$q = $db->prepare("CALL getContacts(:uid)");
$q->execute(array("uid" => $_SESSION['uid']));
$f = $q->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container-fluid">
<div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Rehbere Birini Ekleyin</h4>
                                <h6 class="card-subtitle">IsimLink'teki rehberinize birilerini ekleyerek bilgilerinize erişim hakkı tanıyabilirsiniz.</h6>
<? if($_GET["ret"] == "err"){?>
 <h6 class="card-subtitle danger" style="color:red;">Eklemede bir hata oluştu, tekrar deneyiniz.</h6>
<?}
else if($_GET["ret"] == "ok"){
?>
 <h6 class="card-subtitle success" style="color:green;">Başarıyla eklendi.</h6>
<?}?>

<div class="row">	
									<form method="get" action="actions/addContact.php">
                                        <div style="text-align:center;" class="input-field col s9">
                                            <input name="contact" id="contact" type="text">
                                            <label for="contact">Link, Email, Telefon vs.</label>
                                        </div>
									<input style="margin-top:15px;" type="submit" class="btn btn-primary" value="Ekle"/>
									</form>
                                    </div>
<p><br>Eklemek istediğiniz kişinin linkini, emailini veya telefonunu girmeniz yeterli.<br>Ekleyeceğiniz kişinin IsimLink hesabı olması gerekmektedir.</p>
</div>
</div>
<div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Rehber</h4>
                                <h6 class="card-subtitle">IsimLink'te bağlantılı olduğunuz kişiler</h6>

								<div class="container-fluid">
                <div class="row">
                    <!-- .col -->
<?
									function getTypeName($t){
										switch($t){
											case 1:	return 'Email';
											case 2: return 'Telefon';
										}
									}
									foreach($f as $info){
										?>
                                             <div class="col m6">
												<div class="card">
													<div class="card-content">
														<div class="row d-flex align-items-center">
															<div class="col m4 l3 center-align">
																<a href="app-contact-detail.html"><img src="../../assets/images/users/1.jpg" alt="user" class="circle responsive-img"></a>
															</div>
															<div class="col m8 l9">
																<h3 class="m-b-0"><?=$info["Name"]." ".$info["Surname"]?></h3> <small><a href="https://<?=$info["Domain"]?>.isim.link/"><?=$info["Domain"]?>.isim.link</a></small>
																<address>
																	
																	<abbr title="Eklenme Tarihi">T:</abbr> <?=$info["Date"]?>
																</address>
															</div>
														</div>
													</div>
												</div>
											</div>
									<? } ?>
                   
                    <!-- /.col -->
                </div>
<p>Not: Bu kişiler <b>Sadece Rehber</b> olarak seçtiğiniz bilgilerinize erişebilir.</p>
            </div>

									
                                  
                            </div>
                        </div>
						</div>