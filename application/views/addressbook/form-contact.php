<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Ubah Data <small>buku telepon</small></h1>
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
                <?php echo form_open('addressbook/save', array('class' => 'form-horizontal'), array('id' => $id)); ?>
                <div class="control-group">
                <label class="control-label">Nama Lengkap</label>
                <div class="controls">
                    <input name="name" type="text" placeholder="Nama Lengkap" value="<?php echo @field(set_value('name'), $detail->name) ?>" />
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Nomor Telepon</label>
                <div class="controls">
                    <input name="primary" type="text" placeholder="Nomor Telepon" value="<?php echo @field(set_value('primary'), $detail->primary); ?>" />
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Nomor Alternatif</label>
                <div class="controls">
                    <input name="alternate" type="text" placeholder="Nomor Alternatif" value="<?php echo @field(set_value('alternate'), $detail->alternate) ?>" />
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Alamat</label>
                <div class="controls">
                    <textarea name="address" placeholder="Alamat"><?php echo @field(set_value('address'), $detail->address) ?></textarea>
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Nama Lengkap</label>
                <div class="controls">
                    <input name="email" type="text" placeholder="Alamat Email" value="<?php echo @field(set_value('email'), $detail->email) ?>" />
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Nama Lengkap</label>
                <div class="controls">
                    <input name="group" type="text" placeholder="Group" />
                </div>
                </div>

                <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Simpan</button>

                <?php if($id != 'X'): ?>
                <a href="<?php echo site_url('conversation/view/'.$detail->primary) ?>" class="btn btn-success">
                    <i class="icon-comment icon-white"></i> Lihat Percakapan
                </a>
                <?php endif; ?>
                <a href="<?php echo site_url('addressbook') ?>" class="btn"><i class="icon-share"></i> Kembali</a>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>