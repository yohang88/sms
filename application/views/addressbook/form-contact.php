<div id="header">
    <div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Ubah Data<small>buku telepon</small></h1>
                <i class="page-icon icon-enter"></i>
            </div>
        </div>
    </div>
</div>

<div class="page secondary with-sidebar">
    <?php $this->load->view('common/sidebar'); ?>
    <div class="page-region">
        <div class="page-region-content">
            <div class="grid">
            <div class="row">
                <div class="span4">
                    <?php echo validation_errors(); ?>
                    
                    <?php $id = @field($this->uri->segment(3, NULL), $this->form_validation->set_value('id'), 'X'); ?>
                    <?php echo form_open('addressbook/save', '', array('id' => $id)); ?>
                    <div class="input-control text">
                        <input name="name" type="text" placeholder="Nama Lengkap" value="<?php echo @field(set_value('name'), $detail->name) ?>" />
                        <button class="btn-clear"></button>
                    </div>                
                    <div class="input-control text">
                        <input name="primary" type="text" placeholder="Nomor Telepon" value="<?php echo @field(set_value('primary'), $detail->primary); ?>" />
                        <button class="btn-clear"></button>
                    </div>
                    <div class="input-control text">
                        <input name="alternate" type="text" placeholder="Nomor Alternatif" value="<?php echo @field(set_value('alternate'), $detail->alternate) ?>" />
                        <button class="btn-clear"></button>
                    </div>                
                    <div class="input-control textarea">
                        <textarea name="address" placeholder="Alamat"><?php echo @field(set_value('address'), $detail->address) ?></textarea>
                    </div>
                    <div class="input-control text">
                        <input name="email" type="text" placeholder="Alamat Email" value="<?php echo @field(set_value('email'), $detail->email) ?>" />
                        <button class="btn-clear"></button>
                    </div>
                    <div class="input-control text">
                        <input name="group" type="text" placeholder="Group" />
                        <button class="btn-clear"></button>
                    </div>                      
                    <div class="input-control">
                    <input type="submit" value="Simpan"/>
                    <a href="<?php echo site_url('addressbook') ?>" class="button">Kembali</a>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <div class="span5">
                    <?php if($id != 'X'): ?>
                    <a href="<?php echo site_url('conversation/view/'.$detail->primary) ?>" class="button command-button">
                        Lihat Percakapan
                        <small>Lihat catatan percakapan dengan nomor ini</small>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>