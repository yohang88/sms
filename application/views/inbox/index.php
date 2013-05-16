<?php
    $data['messages'] = $messages;
    $data['type'] = $type;
?>
<div id="header">
    <div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Kotak Masuk<small>sms masuk</small></h1>
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
                <?php $this->load->view('common/message-list', $data) ?>
            </div>
        </div>
    </div>
</div>