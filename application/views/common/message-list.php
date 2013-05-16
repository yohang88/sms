<?php
    $messages_count = count($messages);
    if($messages_count > 0):
?>
<form>
<table class="bordered striped hovered message-list">
    <thead>
        <tr>
            <th>Pengirim</th>
            <th class="right" width="180">Waktu</th>
            <th>Isi Pesan</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
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
                    $number = $message->sender;
                    break;                    
            }
        ?>
        <tr onclick="alert('test')">
            <td width="150px"><?php echo $this->contact->getDetail($number)->name; ?></td>
            <td width="150px" class="right"><?php echo nice_date($message->sent); ?></td>
            <td><?php echo substr($message->text, 0, 40); ?></td>
            <td width="150px"><a class="button mini" href="<?php echo site_url('conversation/view/'.$number) ?>">Lihat</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot></tfoot>
</table>
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