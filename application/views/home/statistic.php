<base href="<?php echo base_url() ?>" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/swfobject.js"></script>

<script type="text/javascript">
swfobject.embedSWF(
"<?php echo base_url(); ?>assets/swf/open-flash-chart.swf", "test_chart", "650", "200",
"9.0.0", "expressInstall.swf",
{"data-file":"<?php echo site_url('commonmessage/statistic');?>"},{"wmode":"transparent"}
);
</script>


<div align="center" id="test_chart">&nbsp;</div>

<?php
$inbox = 250;
$outbox = 500;
?>

<p><span>Inbox:</span> <?php echo $inbox;?></p>
<p><span>Outbox:</span> <?php echo $outbox;?></p>


