<form>
    <div class="conversation-holder">
        <table class="table table-striped table-hover">
        <?php foreach($messages as $message): ?>
        <?php
            $row_class = "";
            switch($message->type) {
                case "RECEIVED":
                    $row_class = "success";
                    break;
                case "SENT":
                    $row_class = "";
                    break;
                case "FAILED":
                    $row_class = "error";
                    break;
                case "QUEUE":
                    $row_class = "warning";
                    break;
            }
        ?>
        <tr class="<?php echo $row_class; ?>">
            <td>
                <div class="text"><?php echo $message->text; ?></div>
            </td>
            <td width="200px">
            <div class="message-meta">
                <?php if($message->type == 'SENT'): ?>
                <div class="meta-label"><i class="icon-pencil"></i> Dibuat</div><div class="meta-content"><?php echo $message->inserted; ?></div>
                <?php endif; ?>
                <div class="meta-label"><i class="icon-envelope"></i> <?php echo ($message->type == 'RECEIVED' ? "Diterima" : "Dikirim"); ?></div><div class="meta-content"><?php echo $message->sent; ?></div>
                <?php if($message->received != NULL && $message->type == 'SENT'): ?>
                <div class="meta-label"><i class="icon-ok"></i> Diterima</div><div class="meta-content"><?php echo $message->received ?></div>
                <?php endif; ?>
            </div>
            </td>
            <td width="50px">
                <div class="btn-group">
                  <a href="<?php echo site_url('messages/delete/'.$message->id); ?>" class="btn btn-danger"><i class="icon-trash icon-white"></i></a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
</form>
<?php echo $this->pagination->create_links(); ?>