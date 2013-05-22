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
                <?php $this->load->view('common/notif_area'); ?>

                <div class="author">
                    <h4><?php echo ($this->contact->getDetail($with_number) ? $this->contact->getDetail($with_number)->name : $with_number); ?></h4>
                </div>
                <div class="toolbar">
                <script>
                    document.write('<a href="' + document.referrer + '" class="btn btn-primary"><i class="icon-arrow-left icon-white"></i> Kembali</a>');
                </script>

                <?php if($this->contact->getDetail($with_number)): ?>
                <a href="<?php echo site_url('addressbook/edit/'.$this->contact->getDetail($with_number)->id); ?>" class="btn">Lihat Kontak</a>
                <?php endif; ?>

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