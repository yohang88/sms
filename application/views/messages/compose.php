<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/token-input.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/token-input-facebook.css" type="text/css" />

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.autogrow-textarea.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tokeninput.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#text").autogrow();

    $("#phone").tokenInput("<?php echo site_url('addressbook/ajaxListSearch2') ?>", {
        theme: "facebook",
        animateDropdown: false,
        method: "POST",
        preventDuplicates: true,
        searchingText: "Sedang mencari dari buku telepon...",
        hintText: "Ketik nama yang akan dimasukkan",
        noResultsText: "Tidak ditemukan dalam buku telepon"
    });

	var sms_char;
    sms_char = 160;

	// Character counter
	$('.word_count').each(function(){
	text_character = "karakter";
	text_message = "SMS";
	var length = $(this).val().length;
	var message = Math.ceil(length/sms_char);
	$(this).parent().find('.counter').html( length + ' ' + text_character + ' / ' + message + ' ' + text_message);
    $(this).keyup(function(){
        var new_length = $(this).val().length;
        var message = Math.ceil(new_length/sms_char);
         $(this).parent().find('.counter').html( new_length + ' ' + text_character + ' / ' + message + ' ' + text_message);
    });
	});

    $("input[name='sendoption']").click(function() {
        if($(this).val()=='sendoption1')  { $("#person").show(); $("#import").hide(); $("#manually").hide();}
        if($(this).val()=='sendoption2')  { $("#person").hide(); $("#import").hide(); $("#manually").show();}
        if($(this).val()=='sendoption3')  { $("#person").hide(); $("#import").show(); $("#manually").hide();}
    });
});
</script>

<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Kirim Baru <small>sms</small></h1>
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
                    <textarea id="text" name="text" placeholder="Isi Pesan" class="word_count span6" rows="4"></textarea>
                    <div><span class="counter"></span></div>
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