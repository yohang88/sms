<div id="header">
    <div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Kirim Baru<small>sms</small></h1>
                <i class="page-icon icon-enter"></i>
            </div>
        </div>
    </div>
</div>

<div class="page secondary with-sidebar">
    <?php $this->load->view('common/sidebar'); ?>
    <div class="page-region">
        <div class="page-region-content">
            <div class="span9">
                <?php echo form_open('compose/send'); ?>
                <div class="input-control text">
                    <input name="number" type="phone" placeholder="Nomor Telepon" />
                    <button class="btn-clear"></button>
                </div>
                <div class="input-control textarea">
                    <textarea name="text" placeholder="Isi Pesan"></textarea>
                </div>
                <div class="input-control">
                <input type="submit" value="Submit"/>
                <input type="reset"  value="Reset"/>                
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>