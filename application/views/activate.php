<div id="body">

		<div id="sms_form">
            <?php //echo 'the code is'.$activate;
            		echo "Welcome to freeZMZ, the activation code has been sent to your phone, please enter it below to activate your account."
            ?>
			<br><br>
			<br>
			<form action="activate/<?php echo $phone ?>" method="post">
				<input type="text" name="code" placeholder="activate code"/>
				<input type="submit" value="activate">

			</form>	
		</div>

</div>