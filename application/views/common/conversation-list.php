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
<?php echo $this->pagination->create_links(); ?>