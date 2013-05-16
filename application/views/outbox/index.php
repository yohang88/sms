<div id="header">
    <div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Kotak Keluar<small>sms antrian keluar</small></h1>
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
                <?php $this->load->view('common/message-list') ?>
            </div>
        </div>
    </div>
</div>