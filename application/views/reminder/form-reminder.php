<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    var img_path = '<?php echo base_url(); ?>assets/img/';
    $(".datepicker").datepicker({
        minDate: 0, maxDate: '+1Y',
        dateFormat: 'yy-mm-dd', showOn: 'button', buttonImage: img_path + 'calendar.gif', buttonImageOnly: false
    });

    $(".ui-datepicker-trigger").addClass('btn');
});
</script>
<div id="header">
    <div class="container">
        <div class="page-header">
            <h1><i class="icon-group icon-large"></i> Ubah Data Pengingat Otomatis</h1>
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
                <?php echo form_open('reminder/save', array('class' => 'form-horizontal'), array('id' => $id)); ?>
                <div class="control-group">
                <label class="control-label">Nama Lengkap</label>
                <div class="controls">
                    <input name="name" type="text" placeholder="Nama Lengkap" value="<?php echo @field(set_value('name'), $detail->name) ?>" />
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Nomor Telepon</label>
                <div class="controls">
                    <input name="receiver" type="text" placeholder="Nomor Telepon" value="<?php echo @field(set_value('receiver'), $detail->receiver) ?>" />
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Tanggal</label>
                <div class="controls">
                <div class="input-append">
                    <input name="date" type="text" placeholder="Tanggal" id="date" class="datepicker span3" />
                </div>
                </div>
                </div>

                <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Simpan</button>
                <a href="<?php echo site_url('reminder') ?>" class="btn">Kembali</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>