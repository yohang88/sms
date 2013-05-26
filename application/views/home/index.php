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
            <div class="span9" style="text-align: center">
             <img src="<?php echo base_url(); ?>assets/img/logo.png" />
             <?php // $this->load->view('home/statistic'); ?>
             </div>
        </div>
    </div>
</div>