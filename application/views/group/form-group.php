<div id="header">
    <div class="container">
        <div class="page-header">
            <h1><i class="icon-group icon-large"></i> Ubah Data Group</h1>
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
                <?php echo form_open('group/save', array('class' => 'form-horizontal'), array('id' => $id)); ?>
                <div class="control-group">
                <label class="control-label">Nama Group</label>
                <div class="controls">
                    <input name="name" type="text" placeholder="Nama Group" value="<?php echo @field(set_value('name'), $detail->name) ?>" />
                </div>
                </div>
                <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Simpan</button>
                <a href="<?php echo site_url('group') ?>" class="btn">Kembali</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>