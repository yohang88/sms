<?php
    $data['messages'] = $messages;
?>
<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Interaksi<small>sms</small></h1>
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
                <script>
                    document.write('<a href="' + document.referrer + '" class="button"><i class="icon-plus-2"></i> Kembali</a>');
                </script>                
                <?php $this->load->view('common/conversation-list', $data) ?>
            </div>
        </div>
    </div>
</div>