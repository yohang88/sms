<?php
    $c = $this->uri->segment(1);
    $messages_count = count($messages);
    if($messages_count > 0):
?>
<form>
    <div class="messagelist-holder">
    <?php foreach($messages as $message): ?>
    <?php
        switch($type) {
            case 'sent';
                $number = $message->receiver;
                break;
            case 'scheduled';
                $number = $message->receiver;
                break;
            case 'received';
                $number = $message->sender;
                break;
           case 'queue';
                $number = $message->receiver;
                break;
           case 'failed';
                $number = $message->receiver;
                break;
        }
    ?>
    <div class="messagelist-item" style="cursor: pointer;" onclick="document.location.href='<?php echo site_url('conversation/view/'.$number) ?>'">
        <?php echo ($c == 'outbox' || $c == 'failed' ? nice_date($message->inserted) : nice_date($message->sent)); ?>
        <span class="label info"><?php echo $this->contact->getDetail($number)->name; ?></span>
        <?php echo substr($message->text, 0, 70); ?>
    </div>
    <?php endforeach; ?>
    </div>
</form>
<?php echo $this->pagination->create_links(); ?>
<?php else: ?>
<div class="notices">
    <div class="bg-color-green">
        <a href="#" class="close"></a>
        <div class="notice-image"> <i class="icon-flag-2 fg-color-white"></i> </div>
        <div class="notice-header fg-color-yellow"> Tidak Ada Pesan </div>
        <div class="notice-text"> Tidak ada pesan dalam kotak </div>
    </div>
</div>
<?php endif; ?>