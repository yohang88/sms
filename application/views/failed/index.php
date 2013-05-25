<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Kotak Tidak Terkirim <small>sms</small></h1>
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
                <?php $this->load->view('common/message-list', $messages) ?>
            </div>
        </div>
    </div>
</div>