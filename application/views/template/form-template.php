<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.autogrow-textarea.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#text").autogrow();

    $('.word_count').each(function(){
        countChar();
        $(this).keyup(function(){
            countChar();
        });
    });

});

var sms_char;
sms_char = 160;
text_character = "karakter";
text_message = "SMS";
function countChar() {
    var new_length = $("#text").val().length;
    var message = Math.ceil(new_length/sms_char);
    $("#text").parent().find('.counter').html(new_length + ' ' + text_character + ' / ' + message + ' ' + text_message);
}

</script>

<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Ubah Data</h1>
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
                <?php echo form_open('template/save', array('class' => 'form-horizontal'), array('id' => $id)); ?>
                <div class="control-group">
                <label class="control-label">Judul Template</label>
                <div class="controls">
                    <input name="title" type="text" class="span5" placeholder="Judul Template" value="<?php echo @field(set_value('title'), $detail->title) ?>" />
                </div>
                </div>

                <div class="control-group">
                <label class="control-label">Isi Template</label>
                <div class="controls">
                    <textarea id="text" name="content" placeholder="Isi Template" class="span5 word_count"><?php echo @field(set_value('content'), $detail->content) ?></textarea>
                    <div><span class="counter"></span></div>
                </div>
                </div>

                <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Simpan</button>
                <a href="<?php echo site_url('template') ?>" class="btn"><i class="icon-share"></i> Kembali</a>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>