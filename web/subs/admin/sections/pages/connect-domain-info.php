<?php
session_start();
include "../../conf/db.php";

?>
<div class="container-fluid">
<div class="card" id="add-new">
                            <div class="card-content">
                                <h4 class="card-title">Linkinize bir bilgi bağlayın</h4>
                                <h6 class="card-subtitle">IsimLink'teki linkinize ekstra bir bilgi bağlayın.</h6>
<? if($_GET["ret"] == "err"){?>
 <h6 class="card-subtitle danger" style="color:red;">Eklemede bir hata oluştu, tekrar deneyiniz.</h6>
<?}
else if($_GET["ret"] == "ok"){
?>
 <h6 class="card-subtitle success" style="color:green;">Başarıyla eklendi.</h6>
<?}?>

<div class="row">	
									<form method="get" action="actions/addLink.php">
                                         <div class="row">
                                            <div class="col m12">
                                                <div class="input-field col s12">
                                                    <select class="custom-select form-control required" id="did" name="did">
														<?php
														$q = $db->prepare("CALL getDomainsOfUser(:uid)");
														$q->execute(array("uid" => $_SESSION['uid']));
														$f = $q->fetchAll(PDO::FETCH_ASSOC);
														foreach($f as $info){
														?>
                                                        <option value="<?=$info["DID"]?>"><?=$info["Domain"]?>.isim.link</option>
													<? } ?>	
                                                    </select>
                                                    <label for="newinfotype"> Domain : <span class="danger">*</span> </label>
                                                </div>
                                            </div>
                                        </div>
											<div class="row">
                                            <div class="col m12">
                                                <div class="input-field col s12">
                                                    <select class="custom-select form-control required" id="iid" name="iid">
                                                        <?php
														$q = $db->prepare("CALL getInfos(:uid)");
														$q->execute(array("uid" => $_SESSION['uid']));
														$f = $q->fetchAll(PDO::FETCH_ASSOC);
														foreach($f as $info){
														?>
                                                        <option value="<?=$info["IID"]?>"><?=$info["Info"]?></option>
													<? } ?>	
                                                    </select>
                                                    <label for="newinfotype"> Bilgi : <span class="danger">*</span> </label>
                                                </div>
                                            </div>
                                        </div>
											<div class="row">
                                            <div class="col m12">
                                                <div class="input-field col s12">
                                                    <select class="custom-select form-control required" id="pid" name="pid">
                                                        <?php
														$q = $db->prepare("CALL getPrivacies()");
														$q->execute();
														$f = $q->fetchAll(PDO::FETCH_ASSOC);
														foreach($f as $info){
														?>
                                                        <option value="<?=$info["PID"]?>"><?=$info["Privacy"]?></option>
													<? } ?>	
                                                    </select>
                                                    <label for="newinfotype"> Gizlilik Türü : <span class="danger">*</span> </label>
                                                </div>
                                            </div>
                                        </div>
									<input style="margin-top:15px;" type="submit" class="btn btn-primary" value="Ekle"/>
									</form>
                                    </div>
<p><br>Son eklediğiniz bilgi gizlilik türü etkin olacaktır!</p>
</div>
</div>
<div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Bilgilerim</h4>
                                <h6 class="card-subtitle">IsimLink'te mevcut olan bilgileriniz</h6>
                                <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                    <thead>
                                        <tr>
                                            <th> Bilgi Türü </th>
                                            <th> Link </th>
                                            <th> Bilgi </th>
                                            <th> Gizlilik </th>
                                            <th> Eklenme Tarihi </th>
                                        </tr>
                                    </thead>
									<div class="m-t-40">
                                        <div class="d-flex">
                                            <div class="mr-auto">
                                                <div class="form-group">
                                                    <a href="#add-new" class="btn btn-primary btn-small"><i class="icon wb-plus" aria-hidden="true"></i>Yeni Bağlantı Ekle
                                                    </a></div>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="form-group">
                                                    <input id="demo-input-search2" type="text" placeholder="Filtrele" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tbody>
									<?
$q = $db->prepare("CALL getDomainLinksOfUser(:uid)");
$q->execute(array("uid" => $_SESSION['uid']));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
									
									function getTypeName($t){
										switch($t){
											case 1:	return 'Email';
											case 2: return 'Telefon';
										}
									}
									foreach($f as $info){
										?>
                                        <tr diid="<?=$info["DIID"]?>">
											<td><?=getTypeName($info["TypeID"])?></td>
                                            <td><a href="https://<?=$info['Domain']?>.isim.link/" target="_blank"><?=$info['Domain']?>.isim.link</a></td>
											<td><?=$info['Info']?></td>
											<td><?=$info['Privacy']?></td>
                                            <td><?=$info['connection_date']?></td>
                                        </tr>
									<? } ?>
                                    </tbody>
									<tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-right">
                                                    <ul class="pagination">
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
						</div>