<?php
    $c = $this->uri->segment(1);
    $messages_count = count($messages);
    if($messages_count > 0):
?>
<form>
    <div class="messagelist-holder">
    <table class="table table-striped table-hover">
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
    <tr><td>
    <div class="messagelist-item" style="cursor: pointer;" onclick="document.location.href='<?php echo site_url('conversation/view/'.$number) ?>'">
        <span class="label label-success"><?php echo ($c == 'outbox' || $c == 'failed' ? nice_date($message->inserted) : nice_date($message->sent)); ?></span>
        <span class="label label-info"><?php echo $this->contact->getDetail($number)->name; ?></span>
        <?php echo substr($message->text, 0, 70); ?>
    </div>
    </td></tr>
    <?php endforeach; ?>
    </table>
    </div>
</form>
<?php echo $this->pagination->create_links(); ?>
<?php else: ?>
    <div class="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Kosong!</strong> Tidak ada pesan dalam kotak ini.
    </div>
<?php endif; ?>