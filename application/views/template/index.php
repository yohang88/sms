<div id="header">
    <div class="container">
        <div class="page-header">
            <h1><i class="icon-wrench icon-large"></i> Pengaturan Template</h1>
        </div>
    </div>
</div>
<?php $this->load->view('common/subheader'); ?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="span3">
                <?php $this->load->view('common/sidebar'); ?>
            </div>
            <div class="span9">

                <div class="toolbar">
                    <div class="input-append">
                        <?php echo form_open(site_url('template/search')) ?>
                        <input class="span3" name="search" placeholder="Cari template..." type="text" value="<?php echo @field($search,''); ?>" />
                        <button class="btn" type="submit"><i class="icon-search"></i> Cari</button>
                        <a href="<?php echo site_url('template') ?>" class="btn"><i class="icon-asterisk"></i> Tampil Semua</a>
                        <?php echo form_close() ?>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="<?php echo site_url('template/add') ?>" class="btn btn-success"><i class="icon-plus icon-white"></i> Tambah</a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <?php $this->load->view('common/notif_area'); ?>

                <div class="contactlist-holder">
                    <table class="table table-striped table-hover table-condensed">
                        <tbody>
                            <?php foreach($templates as $template): ?>
                            <tr>
                                <td width="150px"><?php echo $template->title ?></td>
                                <td><?php echo nl2br($template->content) ?></td>
                                <td width="100px">
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('template/edit/'.$template->id) ?>" class="btn"><i class="icon-wrench"></i> Ubah</a>
                                        <a href="<?php echo site_url('template/delete/'.$template->id) ?>" class="btn btn-danger"><i class="icon-trash icon-white"></i> Hapus</a>
                                    </div>
                                </td>
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