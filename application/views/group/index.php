<div id="header">
    <div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Kelola Group<small>daftar kontak</small></h1>
                <i class="page-icon icon-enter"></i>
            </div>
        </div>
    </div>
</div>

<div class="page secondary with-sidebar">
    <?php $this->load->view('common/sidebar'); ?>
    <div class="page-region">
        <div class="page-region-content">
            <div class="span10">
                <a href="<?php echo site_url('group/add') ?>" class="button"><i class="icon-plus-2"></i>Tambah Baru</a>
                <div class="contactlist-holder">
                <table class="striped hovered">
                    <thead>
                    <tr>
                       <th>Nama</th>
                       <th class="right">Jumlah Anggota</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($groups as $group): ?>
                    <tr>
                        <td width="250px"><span style="cursor: pointer;" onclick="document.location.href='<?php echo site_url('group/edit/'.$group->id) ?>'"><?php echo $group->name ?></span></td>
                        <td width="110px"><span style="cursor: pointer;" onclick="document.location.href='<?php echo site_url('group/memberlist/'.$group->id) ?>'"><?php echo $group->membercount ?></span></td>
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