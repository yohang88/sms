<?php
    $data['messages'] = $messages;
    $data['type'] = $type;
?>
<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Kotak Masuk <small>sms diterima</small></h1>
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
                <?php $this->load->view('common/message-list', $data) ?>
            </div>
        </div>
    </div>
</div>