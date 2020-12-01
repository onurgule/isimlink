<?php
session_start();
include "../../conf/db.php";

$q = $db->prepare("CALL getDomainsOfUser(:uid)");
$q->execute(array("uid" => $_SESSION['uid']));
$f = $q->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container-fluid">
<div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Bilgilerim</h4>
                                <h6 class="card-subtitle">IsimLink'te mevcut olan bilgileriniz</h6>
                                <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                    <thead>
                                        <tr>
                                            <th> Domain </th>
                                            <th> Eklenme Tarihi </th>
                                        </tr>
                                    </thead>
									<div class="m-t-40">
                                        <div class="d-flex">
                                            <div class="mr-auto">
                                                <div class="form-group">
                                                    <a href="add-domain.php" class="btn btn-primary btn-small"><i class="icon wb-plus" aria-hidden="true"></i>Yeni Domain Ekle
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
									function getTypeName($t){
										switch($t){
											case 1:	return 'Email';
											case 2: return 'Telefon';
										}
									}
									foreach($f as $info){
										?>
                                        <tr>
                                            <td><a href="https://<?=$info['Domain']?>.isim.link/" target="_blank"><?=$info['Domain']?>.isim.link</a></td>
                                            <td><?=$info['created_date']?></td>
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