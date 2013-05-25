<div id="header">
    <div class="container">
        <div class="page-header">
            <h1>Daftar Anggota <small>Group</small></h1>
        </div>
    </div>
</div>
<?php $this->load->view('common/subheader'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/token-input.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/token-input-facebook.css" type="text/css" />

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tokeninput.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#phone").tokenInput("<?php echo site_url('group/ajaxListSearch/'.$group_id) ?>", {
        theme: "facebook",
        animateDropdown: false,
        method: "POST",
        preventDuplicates: true
    });
});
</script>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="span3">
                <?php $this->load->view('common/sidebar'); ?>
            </div>
            <div class="span9">
                <h4>Group: <?php echo $this->contactgroup->getDetail($group_id)->name ?></h4>
                <?php echo form_open('group/addMember', '', array('group_id' => $group_id)); ?>
                <input name="numbers" type="phone" placeholder="Nomor Telepon" id="phone" width="100%" />
                <button type="submit" class="btn btn-primary"><i class="icon-plus icon-white"></i> Tambah</button>
                <a href="<?php echo site_url('group') ?>" class="btn">Kembali</a>
                <?php echo form_close() ?>

                <?php $this->load->view('common/notif_area'); ?>

                <?php if($members): ?>
                <div class="contactlist-holder">
                <table class="table table-striped table-hover">
                    <tbody>
                    <?php foreach($members as $member): ?>
                    <tr>
                        <td><strong><?php echo $member->name ?></strong><br /><small><?php echo $member->primary ?></small></td>
                        <td width="110px">
                            <div class="btn-group">
                              <a href="<?php echo site_url('addressbook/edit/'.$member->id) ?>" class="btn"><i class="icon-eye-open"></i> Lihat</a>
                              <a href="<?php echo site_url('group/delMember/'.$group_id.'/'.$member->id); ?>" class="btn btn-danger"><i class="icon-trash icon-white"></i> Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>

                <?php echo $this->pagination->create_links(); ?>

                <?php else: ?>
                <h4>Tidak ada anggota.</h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>