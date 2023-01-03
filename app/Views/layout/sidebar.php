<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">SIBKK</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="<?= base_url('admin') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Data Alumni">Data Alumni</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= base_url('admin/alumni') ?>" class="menu-link">
                        <div data-i18n="Kelola">Kelola Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/alumni/create') ?>" class="menu-link">
                        <div data-i18n="Notifications">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/alumni/store') ?>" class="menu-link">
                        <div data-i18n="Connections">Import/Export Data</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Data Jurusan">Data Jurusan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= base_url('admin/jurusan') ?>" class="menu-link">
                        <div data-i18n="Basic">Kelola Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Import/Export Data</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Landing Page</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="<?= base_url('admin/school') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Informasi Sekolah</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?= base_url('admin/loker') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Informasi Lowongan</div>
            </a>
        </li>

        <!-- Misc -->
        <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
        <li class="menu-item">
            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li> -->
    </ul>
</aside>
<!-- / Menu -->