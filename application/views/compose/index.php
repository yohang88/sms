<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/token-input.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/token-input-facebook.css" type="text/css" />    
    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tokeninput.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#phone").tokenInput("<?php echo site_url('addressbook/ajaxListSearch2') ?>", {
        theme: "facebook",
        animateDropdown: false,
        method: "POST",
        preventDuplicates: true
    });

	var sms_char;    
    sms_char = 160;
		
	// Character counter
	$('.word_count').each(function(){   
	text_character = "karakter";
	text_message = "pesan";
	var length = $(this).val().length;  
	var message = Math.ceil(length/sms_char);
	$(this).parent().find('.counter').html( length + ' ' + text_character + ' / ' + message + ' ' + text_message);  
    $(this).keyup(function(){  
        var new_length = $(this).val().length;  
        var message = Math.ceil(new_length/sms_char);
         $(this).parent().find('.counter').html( new_length + ' ' + text_character + ' / ' + message + ' ' + text_message);  
    });  
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
				<?php echo validation_errors(); ?>
			
                <?php echo form_open('compose/send'); ?>
                <div class="input-control text">
                    <input name="number" type="phone" placeholder="Nomor Telepon" id="phone" />
                    <button class="btn-clear"></button>
                </div>
                <div class="input-control textarea">
                    <textarea name="text" placeholder="Isi Pesan" class="word_count"></textarea>
                    <div><span class="counter"></span></div>
                </div>             
                <div class="input-control">
                <input type="submit" value="Kirim"/>
                <input type="reset"  value="Reset"/>                
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>