<div class="page-sidebar">
    <ul>
        <li>
            <a href="<?php echo site_url('home'); ?>"><i class="icon-home"></i> Beranda</a>
        </li>
        <li>
            <a id="draggableDialog"><i class="icon-mail"></i> Kirim Baru</a>
        </li>
        <li>
            <a href="<?php echo site_url('inbox'); ?>"><i class="icon-enter"></i> Kotak Masuk</a>
        </li>
        <li>
            <a href="<?php echo site_url('outbox'); ?>"><i class="icon-exit"></i> Kotak Antrian Kirim</a>
        </li>
        <li>
            <a href="<?php echo site_url('sent'); ?>"><i class="icon-checkmark"></i> Kotak Terkirim</a>
        </li>
        <li>
            <a href="<?php echo site_url('sent'); ?>"><i class="icon-cancel"></i> Kotak Gagal Terkirim</a>
        </li>        
        <li data-role="dropdown">
            <a href="<?php echo site_url('addressbook'); ?>"><i class="icon-user"></i> Buku Telepon</a>
            <ul class="sub-menu sidebar-dropdown-menu">
                <li><a href="<?php echo site_url('addressbook/group'); ?>"><i class="icon-wrench"></i> Group</a></li>
            </ul>                
        </li>
        <li><a href="<?php echo site_url('sent'); ?>"><i class="icon-wrench"></i> Konfigurasi</a></li>
    </ul>
</div>