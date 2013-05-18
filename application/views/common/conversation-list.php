<form>
    <div class="conversation-holder">
    <ul class="replies">
        <?php foreach($messages as $message): ?>
        <li class="<?php echo ($message->type == 'SENT' ? "sent" : "received"); ?>">
            <div class="avatar"><img/></div>
            <div class="reply">
                <div class="date"><?php echo $message->sent; ?></div>
                <div class="author"><?php echo $this->contact->getDetail($message->sender)->name; ?></div>
                <div class="text"><?php echo $message->text; ?></div>
                <div class="status-icon">
                    <?php if($message->received != NULL && $message->type == 'SENT'): ?>
                        <i class="icon-checkmark" title="Tersampaikan pada <?php echo $message->received ?>"></i>
                    <?php endif; ?>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    </div>
</form>
<div class="pagination">
    <ul>
        <li class="first"><a></a></li>
        <li class="prev"><a></a></li>
        <li><a>1</a></li>
        <li class="active"><a>2</a></li>
        <li><a>N</a></li>
        <li class="next"><a></a></li>
        <li class="last"><a></a></li>
    </ul>
</div>