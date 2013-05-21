<?php
$is_notification     = $this->session->flashdata('notif_type');
$notification_type   = $this->session->flashdata('notif_type');
$notification_header = $this->session->flashdata('notif_header');
$notification_text   = $this->session->flashdata('notif_text');
if($is_notification):
?>
<div class="alert alert-<?php echo $notification_type ?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo $this->session->flashdata('notif_text'); ?>
</div>
<?php endif; ?>