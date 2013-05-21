<?php
    $data['messages'] = $messages;
?>
<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Interaksi <small>sms</small></h1>
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
                <div class="toolbar">
                <script>
                    document.write('<a href="' + document.referrer + '" class="btn btn-primary"><i class="icon-arrow-left icon-white"></i> Kembali</a>');
                </script>
                </div>

                <div class="author">
                    <h4><?php echo $this->contact->getDetail($with_number)->name; ?></h4>
                    <h6><?php echo $with_number; ?></h6>
                </div>
                <?php if(count($messages) > 0): ?>
                <?php $this->load->view('common/conversation-list', $data) ?>
                <?php else: ?>
                    <div class="alert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Kosong!</strong> Tidak ada pesan dalam kotak ini.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>