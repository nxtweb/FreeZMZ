<div id="body">

		<div id="sms_form">

			<br>
			<br>
			<form action="http://localhost/freez/index.php/sms/send" method="post">
				<br><label>Your phone number</label><br>
				<input type="text" name="sender" value="<?php echo $phone;?>"/><br><br>
				<input type="text" name="recipient" placeholder="Recipient's Phone number"/><br><br>

				<textarea placeholder="Your message" name='message' rows="5"></textarea><br>

				<input type="submit" value="Send">

			</form>	
		</div>

</div>