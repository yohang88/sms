<div id="header">
    <div class="container">
        <div class="page-header">
            <h1><i class="icon-wrench icon-large"></i> Buku Telepon</h1>
        </div>
    </div>
</div>
<?php $this->load->view('common/subheader'); ?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="span3">
                <?php $this->load->view('common/sidebar'); ?>
            </div>
            <div class="span9">

                <div class="toolbar">
                    <div class="input-append">
                      <?php echo form_open(site_url('addressbook/search')) ?>
                      <input class="span3" name="search" placeholder="Cari nama, nomor telepon..." type="text" value="<?php echo @field($search,''); ?>" />
                      <button class="btn" type="submit"><i class="icon-search"></i> Cari</button>
                      <a href="<?php echo site_url('addressbook') ?>" class="btn"><i class="icon-asterisk"></i> Tampil Semua</a>
                      <?php echo form_close() ?>
                  </div>
                  <div class="btn-group pull-right">
                    <a href="<?php echo site_url('addressbook/add') ?>" class="btn btn-success"><i class="icon-plus icon-white"></i> Tambah</a>
                    <a href="#myModal" role="button" class="btn" data-toggle="modal"><i class="icon-upload-alt"></i> Impor Excel</a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 id="myModalLabel">Impor Excel</h3>
            </div>

            <div class="modal-body">
                <?php echo form_open_multipart(site_url('addressbook/import')) ?>
                <p>Pilih File Excel format CSV yang ingin diimpor</p>
                <input type="file" name="import_file" id="import_file" class="span6" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="icon-ok-circle"></i> Impor</button>
                <button class="btn" data-dismiss="modal">Batal</button>
                <?php echo form_close() ?>
            </div>
            </div>

        <?php $this->load->view('common/notif_area'); ?>

        <div class="contactlist-holder">
            <table class="table table-striped table-hover table-condensed">
                <thead>
                    <tr>
                       <th>Nama</th>
                       <th class="right">Nomor Utama</th>
                       <th class="right">Alternatif</th>
                       <th></th>
                   </tr>
               </thead>
               <tbody>
                <?php foreach($contacts as $contact): ?>
                <tr>
                    <td><?php echo $contact->name ?></td>
                    <td width="110px"><?php echo $contact->primary ?></td>
                    <td width="110px"><?php echo $contact->alternate ?></td>
                    <td width="100px">
                        <div class="btn-group">
                          <a href="<?php echo site_url('addressbook/edit/'.$contact->id) ?>" class="btn"><i class="icon-wrench"></i> Ubah</a>
                          <a href="<?php echo site_url('addressbook/delete/'.$contact->id) ?>" class="btn btn-danger"><i class="icon-trash icon-white"></i> Hapus</a>
                      </div>
                  </td>
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