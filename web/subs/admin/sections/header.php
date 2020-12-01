        <header class="topbar">
            <nav>
                <div class="nav-wrapper">
                    <a href="javascript:void(0)" class="brand-logo">
                        <span class="icon">
                            <img class="light-logo" src="../../assets/images/logo-light-icon.png">
                            <img class="dark-logo" src="../../assets/images/logo-icon.png">
                        </span>
                        <span class="text">
                            <img class="light-logo" src="../../assets/images/logo-light-text.png">
                            <img class="dark-logo" src="../../assets/images/logo-text.png">
                        </span>
                    </a>
                    <ul class="left">
                        <li class="hide-on-med-and-down">
                            <a href="javascript: void(0);" class="nav-toggle">
                                <span class="bars bar1"></span>
                                <span class="bars bar2"></span>
                                <span class="bars bar3"></span>
                            </a>
                        </li>
                        <li class="hide-on-large-only">
                            <a href="javascript: void(0);" class="sidebar-toggle">
                                <span class="bars bar1"></span>
                                <span class="bars bar2"></span>
                                <span class="bars bar3"></span>
                            </a>
                        </li>
                        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="noti_dropdown"><i class="material-icons">notifications</i></a>
                            <ul id="noti_dropdown" class="mailbox dropdown-content">
                                <li>
                                    <div class="drop-title">Bildirimler</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <a href="#">
                                                <span class="btn-floating btn-large red"><i class="material-icons">link</i></span>
                                                <span class="mail-contnet">
                                                    <h5>İsimLink</h5>
                                                    <span class="mail-desc">Önemli bildirimleriniz burada gözükür.</span>
                                                </span>
                                            </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="center-align" href="javascript:void(0);"> <strong>Tümünü görüldü işaretle</strong> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="search-box">
                            <a href="javascript: void(0);"><i class="material-icons">search</i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Ara..."> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="right">
                        <li class="lang-dropdown"><a class="dropdown-trigger" href="javascript: void(0);" data-target="lang_dropdown"><i class="flag-icon flag-icon-tr"></i></a>
                            <ul id="lang_dropdown" class="dropdown-content">
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-us"></i> English</a>
                                </li>
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-de"></i> Deutsch</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown"><img src="../../assets/images/users/2.jpg" alt="user" class="circle profile-pic"></a>
                            <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="../../assets/images/users/2.jpg" alt="user"></div>
                                        <div class="u-text">
                                            <h4><?=$_SESSION["name"]." ".$_SESSION["surname"]?></h4>
                                            <p><?=$_SESSION["domain"].".isim.link"?></p>
                                            <a class="waves-effect waves-light btn-small red white-text">Profili Görüntüle</a>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="material-icons">account_circle</i> Profilim</a></li>
                                <li><a href="#"><i class="material-icons">call_missed_outgoing</i> İsteklerim</a></li>
                                <li><a href="#"><i class="material-icons">perm_contact_calendar</i> Bilgilerim</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="material-icons">settings</i> Hesap Ayarlarım</a></li>
                                <li><a href="#"><i class="material-icons">power_settings_new</i> Çıkış</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>