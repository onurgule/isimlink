<?php
session_start();
include "../../conf/db.php";
$iletisim_bilgisi = 0;
$top_giris_say = 0;
$rehber = 0;
$istek_sayisi = 0;
$q = $db->prepare('CALL getIndexStats(:fuid)');
$q->execute(array("fuid" => $_SESSION['uid']));
$f = $q->fetch(PDO::FETCH_ASSOC);
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col l3 m6 s12">
                        <div class="card danger-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2 class="white-text m-b-5"><?=$f['iletisim']?></h2>
                                        <h6 class="white-text op-5 light-blue-text">İletişim Bilgisi</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col l3 m6 s12">
                        <div class="card success-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2 class="white-text m-b-5"><?=$f['topgiris']?></h2>
                                        <h6 class="white-text op-5 text-darken-2">Toplam Giriş Sayısı</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card info-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2 class="white-text m-b-5">-</h2>
                                        <h6 class="white-text op-5">Rehberdeki Kişi Sayısı</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">contacts</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                    
                    
                   
                    <div class="col l3 m6 s12">
                        <div class="card warning-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2 class="white-text m-b-5">-</h2>
                                        <h6 class="white-text op-5">İstek Sayısı</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">call_missed_outgoing</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>