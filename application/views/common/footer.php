        <script type="text/javascript">
            $(document).ready(function(){
                $('#draggableDialog').click(function(e) {
                    $.Dialog({
                        'title'      : 'My draggable dialog',
                        'content'    : 'This content can be in HTML.<br />You can add custom function to your buttons!<br /><br /><b>Features:</b><ul><li>Easy to use!</li><li>Customizable</li><li>Powerful!</li></ul>',
                        'draggable'  : true,
                        'buttonsAlign': 'right',
                        'buttons'    : {
                            'Ok'    : {
                                'action': function(){}
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>