<div id="header">
    <div class="container">
        <div class="page-header">
            <h1><i class="icon-home icon-large"></i> Halaman Depan</h1>
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
                <?php
                    if(empty($config->logo_file)) {
                        $logo_url = base_url('assets/img/logo.jpg');
                    } else {
                        $logo_url = base_url('uploads') . DS . $config->logo_file;
                    }
                ?>
                <img style="width: 64px; height: 64px; float:left; margin-right: 20px" src="<?php echo $logo_url ?>" />
                <h4>SMS Center</h4>
                <p>Versi 1.0</p>
                <div class="statistic">
                <?php $this->load->view('home/statistic'); ?>
                </div>
            </div>
        </div>
    </div>
</div>