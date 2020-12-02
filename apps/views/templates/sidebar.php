<?php if(!empty($_SESSION['userdata'])) : ?>
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">MAIN MENU</div>
                            <a class="nav-link" href="<?= BASE_URL; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?= BASE_URL; ?>penerimabantuan">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-hands-helping"></i></div>
                                Penerima bantuan
                            </a>
                            <a class="nav-link" href="<?= BASE_URL; ?>catatanbantuan">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-clipboard-list"></i></div>
                                Catatan bantuan
                            </a>
                            <a class="nav-link collapsed" href="<?= BASE_URL; ?>dist/#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Master data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= BASE_URL; ?>Kategoribantuan">Kategori bantuan</a>
                                    <a class="nav-link" href="<?= BASE_URL; ?>Datapenduduk">Data penduduk</a>
                                    <a class="nav-link" href="<?= BASE_URL; ?>Pekerjaan">Data pekerjaan</a>
                                    <a class="nav-link" href="<?= BASE_URL; ?>Rules">Pengurus</a>
                                </nav>
                            </div>
                           
                        </div>
                    </div>
                </nav>
            </div>
<?php else : ?>

    <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">MAIN MENU</div>
                            <a class="nav-link" href="<?= BASE_URL; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?= BASE_URL; ?>penerimabantuan">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-hands-helping"></i></div>
                                Penerima bantuan
                            </a>
                            <a class="nav-link" href="<?= BASE_URL; ?>catatanbantuan">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-clipboard-list"></i></div>
                                Catatan bantuan
                            </a>
                            <a class="nav-link" href="<?= BASE_URL; ?>Datapenduduk">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-clipboard-list"></i></div>
                                Data penduduk
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= BASE_URL; ?>Kategoribantuan">Kategori bantuan</a>
                                    <a class="nav-link" href="<?= BASE_URL; ?>Datapenduduk">Data penduduk</a>
                                    <a class="nav-link" href="<?= BASE_URL; ?>Pekerjaan">Data pekerjaan</a>
                                    <a class="nav-link" href="<?= BASE_URL; ?>Rules">Pengurus</a>
                                </nav>
                            </div>
                           
                        </div>
                    </div>
                </nav>
            </div>
<?php endif; ?>