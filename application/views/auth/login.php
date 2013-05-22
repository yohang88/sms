<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>SMS <small>center</small></h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
            <?php echo form_open('auth/validate'); ?>
        	<h2>Log in Pengguna</h2>

            <?php $this->load->view('common/notif_area'); ?>

            <div class="input-control text">
            <input type="text" name="login" id="login" placeholder="Nama Pengguna" />
            </div>

            <div class="input-control text">
            <input type="password" name="password" id="password" placeholder="Kata Sandi" />
            </div>

            <div class="input-control">
                <button value="send" class="btn btn-primary">Masuk</button>
            </div>
            <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>