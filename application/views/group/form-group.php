<div id="header">
    <div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Ubah Data Group<small>buku telepon</small></h1>
                <i class="page-icon icon-enter"></i>
            </div>
        </div>
    </div>
</div>

<div class="page secondary with-sidebar">
    <?php $this->load->view('common/sidebar'); ?>
    <div class="page-region">
        <div class="page-region-content">
            <div class="span9">
                <?php echo validation_errors(); ?>
                
                <?php $id = @field($this->uri->segment(3, NULL), $this->form_validation->set_value('id'), 'X'); ?>
                <?php echo form_open('group/save', '', array('id' => $id)); ?>
                <div class="input-control text">
                    <input name="name" type="text" placeholder="Nama Lengkap" value="<?php echo @field(set_value('name'), $detail->name) ?>" />
                    <button class="btn-clear"></button>
                </div>                                              
                <div class="input-control">
                <input type="submit" value="Simpan"/>
                <a href="<?php echo site_url('group') ?>" class="button">Kembali</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>