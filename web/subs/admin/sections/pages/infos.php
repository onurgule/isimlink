<?php
session_start();
include "../../conf/db.php";

$q = $db->prepare("CALL getInfos(:uid)");
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
                                            <th data-toggle="true"> Bilgi Türü </th>
                                            <th> Bilgi </th>
                                            <th data-hide="phone"> Eklenme Tarihi </th>
                                            <th data-hide="all"> Durum </th>
											<th data-hide="all"> Doğrulanmış </th>
											<th data-hide="all"> Gizlilik </th>
											<th> Düzenle </th>
                                        </tr>
                                    </thead>
									<div class="m-t-40">
                                        <div class="d-flex">
                                            <div class="mr-auto">
                                                <div class="form-group">
                                                    <a href="add-info.php" class="btn btn-primary btn-small"><i class="icon wb-plus" aria-hidden="true"></i>Yeni Bilgi Ekle
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
                                            <td><?=getTypeName($info['TypeID'])?></td>
                                            <td><?=$info['Info']?></td>
                                            <td><?=$info['inserted_date']?></td>
                                            <td><span class="label label-table label-success"><?=$info['active']?></span></td>
											<td><span class="label label-table label-success"><?=$info['verified']?></span></td>
											<td><span class="label label-table label-success"><?=$info['private']?></span></td>
											<td><span class="btn-floating btn-small blue"><i class="material-icons">edit</i></span></td>
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