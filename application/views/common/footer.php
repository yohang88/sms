<script type="text/javascript">
$(document).ready(function() {
    doPoll();
    function doPoll() {
        $.post("<?php echo site_url('messages/getMessageCount'); ?>", function(data) {
            //alert(data);
            if(data.unresponded > 0) {
                $('#counter_unresponded').html(data.unresponded);
            } else {
                $('#counter_unresponded').html("");
            }

            if(data.outbox > 0) {
                $('#counter_outbox').html(data.outbox);
            } else {
                $('#counter_outbox').html("");
            }

            if(data.failed > 0) {
                $('#counter_failed').html(data.failed);
            } else {
                $('#counter_failed').html("");
            }
            setTimeout(doPoll,5000);
        });
    };
});
</script>

    </body>
</html>