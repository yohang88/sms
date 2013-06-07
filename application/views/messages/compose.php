<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/token-input.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/token-input-facebook.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" type="text/css" />

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.autogrow-textarea.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tokeninput.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#text").autogrow();

    var img_path = '<?php echo base_url(); ?>assets/img/';
    $(".datepicker").datepicker({
        minDate: 0, maxDate: '+1Y',
        dateFormat: 'yy-mm-dd', showOn: 'button', buttonImage: img_path + 'calendar.gif', buttonImageOnly: false
    });

    $(".ui-datepicker-trigger").addClass('btn');

    $("#phone").tokenInput("<?php echo site_url('addressbook/ajaxListSearch2') ?>", {
        theme: "facebook",
        animateDropdown: false,
        method: "POST",
        preventDuplicates: true,
        searchingText: "Sedang mencari dari buku telepon...",
        hintText: "Ketik nama yang akan dimasukkan",
        noResultsText: "Tidak ditemukan dalam buku telepon",
        prePopulate: <?php echo $target_json ?>
    });

	var sms_char;
    sms_char = 160;

	// Character counter
	$('.word_count').each(function(){
        countChar();
        $(this).keyup(function(){
            countChar();
        });
	});

    $("input[name='sendoption']").click(function() {
        if($(this).val()=='sendoption1')  { $("#person").show(); $("#import").hide(); $("#manually").hide();}
        if($(this).val()=='sendoption2')  { $("#person").hide(); $("#import").hide(); $("#manually").show();}
        if($(this).val()=='sendoption3')  { $("#person").hide(); $("#import").show(); $("#manually").hide();}
    });

});

var template_select;
var template = [];
<?php
foreach($js_templates as $key => $value) {
    echo "template[".$key."] = ".json_encode($value).";\n";
}
?>

var sms_char;
sms_char = 160;
text_character = "karakter";
text_message = "SMS";
function countChar() {
    var new_length = $("#text").val().length;
    var message = Math.ceil(new_length/sms_char);
    $("#text").parent().find('.counter').html(new_length + ' ' + text_character + ' / ' + message + ' ' + text_message);
}

function changeTemplate() {
    template_select = $("#template").val();
    $("#template_content").text(template[template_select]);
};

function submitTemplate() {
    var box = $("#text");
    $("#text").val(template[template_select] + box.val());
    $("#text").autogrow();
    $('#myModal').modal('toggle');
    countChar();
}
</script>

<div id="header">
    <div class="container">
        <div class="page-header">
            <h1><i class="icon-edit icon-large"></i> Kirim Pesan Baru</h1>
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

                <?php echo form_open_multipart('messages/send'); ?>

                <div class="compose-send-option">

                    <div class="radio">
                        <input type="radio" id="sendoption1" name="sendoption" value="sendoption1" checked="checked" />
                        <label for="sendoption1">Buku Telepon</label>
                    </div>

                    <div class="radio">
                        <input type="radio" id="sendoption2" name="sendoption" value="sendoption2" />
                        <label for="sendoption3">Manual </label>
                    </div>

                    <div class="radio">
                        <input type="radio" id="sendoption3" name="sendoption" value="sendoption3"  />
                        <label for="sendoption4">File Excel</label>
                    </div>

                    <div class="clearfix"></div>

                    <div id="person">
                        <input name="number" type="phone" placeholder="Nomor Telepon" id="phone" />
                    </div>

                    <div id="manually" class="hidden">
                    <input type="text" name="manualvalue" class="span6" />
                    </div>

                    <div id="import" class="hidden">
                        <input type="file" name="import_file" id="import_file" class="span6" />
                    </div>

                </div> <!-- // compose-send-option -->

                <div class="input-control textarea">
                    <?php
                        $sms_signature_enable = $this->configurations->getConfig('sms_signature_enable');
                        $sms_signature        = $this->configurations->getConfig('sms_signature');
                    ?>
                    <textarea id="text" name="text" placeholder="Isi Pesan" class="word_count span6" rows="4"><?php if($sms_signature_enable AND !empty($sms_signature)) echo "\n\n\n" . $sms_signature; ?></textarea>
                        <a href="#myModal" role="button" class="btn btn-success" data-toggle="modal" style="vertical-align:top"><i class="icon-bolt"></i> Ambil Template</a>
                    <div><span class="counter"></span></div>
                </div>

                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 id="myModalLabel">Ambil Template</h3>
                </div>

                <div class="modal-body">
                    <p>Pilih Template yang akan dimasukkan ke dalam pesan:</p>
                    <?php echo form_dropdown('template', $templates, '', 'class="span5" id="template" onChange="changeTemplate();"'); ?>
                    <p><small id="template_content"></small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="submitTemplate()" class="btn btn-primary"><i class="icon-ok"></i> Masukkan ke Pesan</button>
                    <button class="btn" data-dismiss="modal">Batal</button>
                </div>
                </div>

                <br />
                <label>Jadwal Pengiriman</label>
                <div>
                <div class="input-append">
                    <input name="date" type="text" placeholder="Tanggal Pengiriman" id="date" class="datepicker span2" />
                </div>
                <select name="hour" class="span1"><?php echo get_hour();?></select> :
                <select name="minute" class="span1"><?php echo get_minute();?></select>
                </div>

                <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Kirim</button>
                <button type="reset" class="btn">Reset</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>