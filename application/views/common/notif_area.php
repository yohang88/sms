<?php 
$is_notification = $this->session->flashdata('notif_type');
$notification_type = $this->session->flashdata('notif_type');
$notification_header = $this->session->flashdata('notif_header');
$notification_text = $this->session->flashdata('notif_text');
if($is_notification): 
?>
<div class="notification notices">
    <div class="bg-color-green">
    <div class="notice-header">
    <?php echo $this->session->flashdata('notif_text'); ?>
    </div>
    </div>
</div>            
<?php endif; ?>