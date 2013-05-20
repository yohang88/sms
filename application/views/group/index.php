<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Kelola Group <small>daftar kontak</small></h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="span3">
                <?php $this->load->view('common/sidebar'); ?>
            </div>
            <div class="span9">
                <?php $this->load->view('common/notif_area'); ?>
                
                <a href="<?php echo site_url('group/add') ?>" class="button"><i class="icon-plus-2"></i>Tambah Baru</a>
                <div class="contactlist-holder">
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                       <th>Nama</th>
                       <th class="right">Jumlah Anggota</th>
                       <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($groups as $group): ?>
                    <tr>
                        <td width="250px"><span style="cursor: pointer;" onclick="document.location.href='<?php echo site_url('group/edit/'.$group->id) ?>'"><?php echo $group->name ?></span></td>
                        <td width="110px"><span style="cursor: pointer;" onclick="document.location.href='<?php echo site_url('group/memberlist/'.$group->id) ?>'"><?php echo $group->membercount ?></span></td>
                        <td><a href="<?php echo site_url('group/delete/'.$group->id) ?>">Hapus</a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>

                <?php echo $this->pagination->create_links(); ?>

            </div>
        </div>
    </div>
</div>