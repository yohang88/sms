<div id="header">
    <div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Daftar Anggota<small>Group</small></h1>
                <i class="page-icon icon-enter"></i>
            </div>
        </div>
    </div>
</div>

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

<div class="page secondary with-sidebar">
    <?php $this->load->view('common/sidebar'); ?>
    <div class="page-region">
        <div class="page-region-content">
            <div class="span10">
                <h2>Group: <?php echo $this->contactgroup->getDetail($group_id)->name ?></h2>
                <fieldset>
                <legend>Tambahkan Anggota</legend>
                <?php echo form_open('group/addmember', '', array('group_id' => $group_id)); ?>
                <div class="input-control text">
                    <input name="numbers" type="phone" placeholder="Nomor Telepon" id="phone" />
                    <button class="btn-clear"></button>
                </div>
                <div class="input-control">
                <input type="submit" value="Tambah"/>
                </div>
                <?php echo form_close() ?>
                </fieldset>
                <?php if($members): ?>
                <div class="contactlist-holder">
                <table class="striped hovered">
                    <thead>
                    <tr>
                       <th>Nama</th>
                       <th class="right">Nomor Telepon</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($members as $member): ?>
                    <tr>
                        <td width="250px"><span style="cursor: pointer;" onclick="document.location.href='<?php echo site_url('addressbook/edit/'.$member->id) ?>'"><?php echo $member->name ?></span></td>
                        <td width="110px"><?php echo $member->primary ?></td>
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