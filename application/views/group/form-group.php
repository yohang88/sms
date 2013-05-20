<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Ubah Data Group <small>buku telepon</small></h1>
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