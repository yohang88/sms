<div class="page-sidebar">
    <ul class="nav nav-tabs nav-stacked">
        <li class="<?php echo active_link('home'); ?>"><a href="<?php echo site_url('home'); ?>"><i class="icon-home"></i> Beranda</a></li>
        <li class="<?php echo active_link('messages'); ?>"><a href="<?php echo site_url('messages/compose'); ?>"><i class="icon-pencil"></i> Kirim Baru</a></li>
        <li class="<?php echo active_link('inbox'); ?>"><a href="<?php echo site_url('inbox'); ?>"><i class="icon-envelope"></i> Kotak Masuk <span id="counter_unresponded" class="badge badge-success pull-right"></span></a></li>
        <li class="<?php echo active_link('outbox'); ?>"><a href="<?php echo site_url('outbox'); ?>"><i class="icon-share-alt"></i> Antrian Kirim <span id="counter_outbox" class="badge badge-warning pull-right"></span></a></li>
        <li class="<?php echo active_link('sent'); ?>"><a href="<?php echo site_url('sent'); ?>"><i class="icon-ok"></i> Terkirim</a></li>
        <li class="<?php echo active_link('failed'); ?>"><a href="<?php echo site_url('failed'); ?>"><i class="icon-warning-sign"></i> Gagal Terkirim <span id="counter_failed" class="badge badge-important pull-right"></span></a></li>
        <li class="<?php echo active_link('scheduled'); ?>"><a href="<?php echo site_url('scheduled'); ?>"><i class="icon-time"></i> Pengiriman Terjadwal <span id="counter_scheduled" class="badge badge-warning pull-right"></span></a></a></li>
        <li class="<?php echo active_link('addressbook'); ?>"><a href="<?php echo site_url('addressbook'); ?>"><i class="icon-user"></i> Buku Telepon</a></li>
        <li class="<?php echo active_link('group'); ?>"><a href="<?php echo site_url('group'); ?>"><i class="icon-group"></i> Group</a></li>
        <li class="<?php echo active_link('template'); ?>"><a href="<?php echo site_url('template'); ?>"><i class="icon-star"></i> Pengaturan Template</a></li>
        <li class="<?php echo active_link('configuration'); ?>"><a href="<?php echo site_url('configuration'); ?>"><i class="icon-wrench"></i> Pengaturan Umum</a></li>
        <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="icon-signout"></i> Log out Pengguna</a></li -->
    </ul>
</div>
