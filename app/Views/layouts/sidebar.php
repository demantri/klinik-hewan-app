<ul class="sidebar-menu">
    <li><a class="nav-link" href="<?= base_url('dashboard')?>"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a></li>
    <li class="dropdown">
        <a class="nav-link has-dropdown" href="#">
            <i class="fa-solid fa-house"></i> <span>Masterdata</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="<?= base_url('masterdata/dokter')?>">Dokter</a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url('masterdata/pemilik') ?>">Pemilik</a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url('masterdata/kategori') ?>">Kategori</a>
            </li>
        </ul>
    </li>
    <li>
        <a class="nav-link" href="<?= base_url('pendaftaran') ?>"><i class="fa-solid fa-book"></i> <span>Pendaftaran Baru</span></a>
    </li>
    <li class="dropdown">
        <a class="nav-link has-dropdown" href="#">
            <i class="fa-solid fa-book"></i> <span>Rekam Medis</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="<?= base_url('rekam-medis/input') ?>">Input Rekam Medis</a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url('rekam-medis/view') ?>">List Rekam Medis</a>
            </li>
        </ul>
    </li>
</ul>