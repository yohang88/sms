<form>
<table class="bordered striped message-list">
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
                case 'received';
                    $number = $message->sender;
                    break;
            }
        ?>
        <tr>
            <td><?php echo $number; ?></td>
            <td class="right"><?php echo $message->sent; ?></td>
            <td><?php echo substr($message->text, 0, 40); ?></td>
            <td><a class="button" href="<?php echo site_url('conversation/view/'.$number) ?>">Lihat</a></td>
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