<?php require 'header.php'; require 'required/functions.php'; iNotConnected(); ?>

<?php
	if (empty($_POST) && !isset($_POST['id']))
		$idu = 0;
	else
		$idu = $_POST['id'];

?>

<div class="login">
    <div class="container" style="position: relative; top: 15%; z-index: 2; height: 100%; font-family: Arial">
    	<div class="chatbox">
    		<div class="contact_list">
                
    			<?php include "action/contact.php"; ?>
    		</div>
            <?php if (!empty($_POST)) { ?>
    		<div class="chat_message_list">
    			<div id="msg">
    			</div>
    			<br>
    		</div>
    		<div class="chat_message_box">
    			<input id="text" type="text" name="message" class="form-control" minlength="5" maxlength="70" placeholder="max 70 ...">
    			<center><input id="send" type="submit" class="btn btn-primary" name="send" value="Send"></center>
    			<input id="cid" type="text" name="cid" style="display: hidden; border: 0; width: 0; height: 0; border-radius: 0; background-color: transparent;" value="<?php echo $idu; ?>">
    		</div>
            <?php } ?>
    	</div>
    </div>
</div>

<script>
	 $(document).ready(function(){
	 	Load_external_content();
        $("#send").click(function(){
        	var text = $("#text").val();
        	var cid = $("#cid").val();

            $.ajax({
                url: 'action/put_msg.php',
                type: 'POST',
                data: { id: cid, text:text },
                success: function(data) {
                    $("#text").val('');
                }
            });
        });
	});
	function Load_external_content()
	{
        $.ajax({
                url: 'action/messages.php',
                type: 'POST',
                data: { id: <?php echo $idu; ?> },
                success: function(data) {
                	$("#msg").html(data);
                }
            });
	}
	setInterval('Load_external_content()', 1000);
</script>