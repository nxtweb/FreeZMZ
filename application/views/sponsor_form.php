<div id="body">

		<div id="sms_form">

			<br><br>
			Hello <?php echo $this->session->userdata('sponsor_name');?><br>
			Your current message is <i>"<?php echo $message; ?>"</i>
			<br>
			<form action="add_sponsor_message/<?php echo $name;?>" method="post">

				<textarea placeholder="New message" name='message' rows="5"></textarea><br>

				<input type="submit" value="Broadcast">

			</form>	
		</div>

</div>