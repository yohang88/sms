<div id="header">
    <div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Pengguna<small>sms center</small></h1>
                <i class="page-icon icon-enter"></i>
            </div>
        </div>
    </div>
</div>

<div class="page secondary with-sidebar">
    <div class="page-region">
    <div class="page-region-content">
        <div class="span5">
            <?php echo form_open('auth/validate'); ?>
        	<h2>Log in Pengguna</h2>

            <div class="error_message"><?php echo $this->session->flashdata('error_message');?></div>
            <div class="success_message"><?php echo $this->session->flashdata('success_message');?></div>

            <div class="input-control text">
            <input type="text" name="login" id="login" placeholder="Nama Pengguna" />
            </div>

            <div class="input-control text">
            <input type="password" name="password" id="password" placeholder="Kata Sandi" />
            </div>

            <div class="input-control">
                <button value="send">Login</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
</div>