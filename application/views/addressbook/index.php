<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Buku Telepon <small>daftar kontak</small></h1>
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
                <a href="<?php echo site_url('addressbook/add') ?>" class="button"><i class="icon-plus-2"></i>Tambah Baru</a>
                <a class="button"><i class="icon-file-excel"></i>Impor dari Excel</a>
                <div class="contactlist-holder">
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                       <th>Nama</th>
                       <th class="right">Nomor Utama</th>
                       <th class="right">Alternatif</th>
                       <th class="right">Alamat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($contacts as $contact): ?>
                    <tr>
                        <td width="250px"><span style="cursor: pointer;" onclick="document.location.href='<?php echo site_url('addressbook/edit/'.$contact->id) ?>'"><?php echo $contact->name ?></span></td>
                        <td width="110px"><?php echo $contact->primary ?></td>
                        <td width="110px"><?php echo $contact->alternate ?></td>
                        <td><?php echo substr($contact->address, 0, 35) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>

                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>