<div id="header">
    <div class="container">
        <div class="page-header">
            <h1><i class="icon-wrench icon-large"></i> Pengaturan Umum</h1>
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
                <?php $this->load->view('common/notif_area'); ?>

                <?php echo validation_errors(); ?>

                <?php $id = @field($this->uri->segment(3, NULL), $this->form_validation->set_value('id'), 'X'); ?>
                <?php echo form_open_multipart('configuration/save', array('class' => 'form-horizontal')); ?>

                <div class="control-group">
                <label class="control-label">Logo</label>
                <div class="controls">
                    <input type="file" name="file_logo" />
                </div>
                </div>

                <fieldset>
                    <legend>Template Akhir Pesan</legend>
                <div class="control-group">
                <label class="control-label">Aktifkan Template</label>
                <div class="controls">
                    <label class="checkbox">
                    <?php
                    $form = array(
                    'name'        => 'signature_active',
                    'id'          => 'signature_active',
                    'value'       => '1',
                    'checked'     => $config->sms_signature_enable
                    );

                    echo form_checkbox($form);
                    ?>
                     Aktif
                    </label>
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Isi Pesan</label>
                <div class="controls">
                    <textarea id="signature" name="signature" placeholder="Isi Pesan" rows="4" class="span5"><?php echo $config->sms_signature; ?></textarea>
                </div>
                </div>
                </fieldset>

                <fieldset>
                <legend>Data</legend>
                <div class="control-group">
                <label class="control-label">Backup</label>
                <div class="controls">
                    <a href="<?php echo site_url('configuration/backupDB') ?>" class="btn btn-success"><i class="icon-shield"></i> Download Semua Data</a>
                </div>
                </div>
                </fieldset>

                <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Simpan</button>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>