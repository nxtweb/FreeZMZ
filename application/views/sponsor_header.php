<html>
	<head>
	<title></title>

		<style type="text/css">
		body{
			background: url();
			margin: auto;
			width:100%;
			text-align: center;
		}

		#top{
			height:60px;
			border-bottom: 1px solid green;
			margin: auto;
		}

		#logo{
			float: left;
			padding-top: 30px;
			margin-left: 150px;
		}

		#login{
			float: right;
			padding-top: 30px;
			margin-right: 250px;
		}


		#slider{
			height:400px;
			background-color: black;
			border: 1px solid grey;
			margin: auto;
		}

		#menu{
			border:1px solid grey;
			margin: auto;
			height: 35px;
			float: bottom;
			background-color: #333333;
		}

		#body{
			height:80%;
			border:1px solid grey;
			margin:auto;
			background-color:grey;
		}

			#content{
				width:600px;
				height: auto;
				padding: 20px;
				text-align: justify;
				margin-left: 150px;
				float: left;
			}

			#side_bar{
				float: left;
				margin-left: 60px;
			}

			#form{
				width:300px;
				margin:25px;
				margin-top:125px;
				height:250px;
				border:1px solid grey;
				background-color: white;
			}

			#sms_form{
				width:300px;
				margin:25px;
				margin-left:auto;
				margin-right: auto;
				margin-top:125px;
				height:300px;
				border:1px solid grey;
			}




			#footer{
				background-color: black;
				color: white;
				height: 50px;

			}

		</style>
	</head>

<body>
	<div id="top">
		<div id="logo"><a href="http://localhost/freez/index.php/freez/">LOGO GOES HERE</a></div>	
    
		<div id="login">
			<?php
			if($this->session->userdata('logged_in')){
				echo "<i>welcome ".$this->session->userdata('sponsor_name')."</i> &nbsp  &nbsp  &nbsp  <a href='href='http://localhost/freez/index.php/freez/logout'>Log Out</a>";
			}
			else echo '
			<form action="sponsor_login" method="post">
				<input type="text" name="name" placeholder="name"/>
				<input type="password" name="password" placeholder="password"/>
				<input type="submit" value="Login">
			</form>	';

			?>
		</div>	
	</div>
