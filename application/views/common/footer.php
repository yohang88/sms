        <script type="text/javascript">
            $(document).ready(function(){
                $('#draggableDialog').click(function(e) {
                    $.Dialog({
                        'title'      : 'My draggable dialog',
                        'content'    : $('#dialog-compose').html(),
                        'draggable'  : true,
                        'buttonsAlign': 'right',
                        'buttons'    : {
                            'Kirim'    : {
                                'action': function(){}
                            },
                            'Keluar'    : {
                                'action': function(){}
                            }                            
                        }
                    });
                });
            });
        </script>
      
        <div id="dialog-compose" style="display:none">
            <div class="span7">
                <?php echo form_open('compose/send'); ?>
                <div class="input-control text">
                    <input name="number" type="phone" placeholder="Nomor Telepon" />
                    <button class="btn-clear"></button>
                </div>
                <div class="input-control textarea">
                    <textarea name="text" placeholder="Isi Pesan"></textarea>
                </div>


   
                <?php echo form_close() ?>
            </div>
        </div>
    </body>
</html>