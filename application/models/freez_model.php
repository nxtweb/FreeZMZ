<?php

class Freez_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Sms_model');
	}


	function register_user($user)
	{
		$this->db->insert('freez_users', $user);
		return true;
	}

	function login_user($user)
	{

		$sql = "SELECT * FROM `freez_users` WHERE phone = '".$user['phone']."' AND password='".$user['password']."' AND activate='1'";
		$query = $this->db->query($sql);

		$count=$query->num_rows(); 

			if ($count > 0){

				return true;
			}

			else return false;;
		}

	function activate_user($user)
	{
		$sql = "UPDATE `freez_users` SET activate= '1' WHERE phone = '".$user['phone']."'";	
		$query = $this->db->query($sql);
		return true;
	}	

	function get_user_code($user)
	{
		$sql = "SELECT * FROM `freez_users` WHERE phone = '".$user['phone']."'";
		$query = $this->db->query($sql);

		$count=$query->num_rows(); 

			if ($count > 0){
			
			foreach($query->result() as $result){
			$dataset= $result;
			$code[]= $dataset->activate;


			}
			return $code;
		}	
	}

	function check_user($user)
	{
		$sql = "SELECT * FROM `freez_users` WHERE phone = '".$user['phone']."'";
		$query = $this->db->query($sql);

		$count=$query->num_rows(); 

			if ($count > 0){
			return true;
		}	
		else return false;
	}


	function send_activate_code($code)
	{
			$recipient = $code['phone'];
			$message = $code['activate'];
			$message="Welcome to freeZMZ, your activation code is ".$message;
			//echo $message;

			//send the message
			/*
	* Requirements: your PHP installation needs cUrl support, which not all PHP installations
	* include by default.
	* 
	* Simply substitute your own username, password and phone number
	* below, and run the test code:
	*/
	$username = 'tigopesa';
	$password = 'tigopesa';
	/*
	* Your phone number, including country code, i.e. +44123123123 in this case:
	*/
	$msisdn = $recipient;

	/*
	* We recommend that you use port 5567 instead of port 80, but your
	* firewall will probably block access to this port (see FAQ for more
	* details):
	* $port = 5567;
	*/
	$url = 'http://bulksms.vsms.net/eapi/submission/send_sms/2/2.0';
	$port = 80;

	/*
	* A 7-bit GSM SMS message can contain up to 160 characters (longer messages can be
	* achieved using concatenation).
	*
	* All non-alphanumeric 7-bit GSM characters are included in this example. Note that Greek characters,
	* and extended GSM characters (e.g. the caret "^"), may not be supported
	* to all networks. Please let us know if you require support for any characters that
	* do not appear to work to your network.
	*/
	$seven_bit_msg = $message;
	/*
	* A Unicode SMS can contain only 70 characters. Any Unicode character can be sent,
	* including those GSM and accented ISO-8859 European characters that are not
	* catered for by the GSM character set, but note that mobile phones are only able
	* to display certain Unicode characters, based on their geographic market.
	* Nonetheless, every mobile phone should be able to display at least the text
	* "Unicode test message:" from the test message below. Your browser may be able to
	* display more of the characters than your phone. The text of the message below is:
	*/
	$unicode_msg = $message;
	
	/*
	* There are a number of 8 bit messages that one can send to a handset, the most popular of the lot is Service Indication(Wap Push).
	* Some other popular ones are vCards and vCalendars, headers may vary depending on which of message one opts to send.
	* The User Data Header(UDH) is solely responsible for determining which
	* type of messages will be sent to one's handset. 
	* In a nutshell, SI(service indication) messages will have, in the final message body, both the UDH
	* and WSP(Wireless Session Protocol) appended to each other forming a prefix of the ASCII string of the Hex value
	* of the actual content. For example, suppose our intended Wap message body is as follows:
	*
	* <si><indication href="http://www.bulksms.com">Visit BulkSMS.com homepage</indication></si>
	*
	* Our headers will be -- UDH + WSP = FINAL_HEADER
	* '0605040B8423F0' + 'DC0601AE' = '0605040B8423F0DC0601AE'
	*
	* The UDH contains a destination port(0B84) and the origin port(23F0)
	* the WSP is broken down into the following:
	*
	* DC - Transaction ID (used to associate PDUs)
	* 06 - PDU type (push PDU)
	* 01 - HeadersLen (total of content-type and headers, i.e. zero headers)
	* AE - Content Type: application/vnd.wap.sic
	*
	* For this example our 8 bit message(what becomes our Wap Push) will look like this:
	* $msg = '0605040B8423F0DC0601AE02056a0045c60d0362756c6b736d732e636f6d00010356697369742042756c6b534d532e636f6d20686f6d6570616765000101';
	*
	* You will only get UDH for both vCard and vCalendar type of 8 bit messages and no WSP, which will look something to this effect:
	* '06050423F4000'
	*
	* In order to convert an xml document into its binary representation (wbxml), one would need to install a wbxml library (libwbxml)
	* Once that has been successfully achieved, that binary representation will then be finally converted into its hexadecimal value
	* in order to complete the transaction. With that done, the appropriate headers are then appended to this hex string to complete
	* the Wap Push/8-bit messaging 
	*
	* $eight_bit_msg = get_headers( $msg_type ) . xml_to_wbxml( $msg_body );
	* get_headers(...) function commented out. uncomment when you use it.
	* $msg_type = 'wap_push';
	* $msg_body = '<si><indication href="http://www.bulksms.com">Visit BulkSMS.com homepage</indication></si>';
	*/
	$eight_bit_msg = $message;

	/*
	* These error codes will be retried if encountered. For your final application,
	* you may wish to include statuses such as "25: You do not have sufficient credits"
	* in this list, and notify yourself upon such errors. However, if you are writing a
	* simple application which does no queueing (e.g. a Web page where a user simply
	* POSTs a form back to the page that will send the message), then you should not
	* add anything to this list (perhaps even removing the item below), and rather just
	* display an error to your user immediately.
	*/
	$transient_errors = array(
		40 => 1 # Temporarily unavailable
	);

	/*
	* Sending 7-bit message
	*/
	$post_body = $this->Sms_model->seven_bit_sms( $username, $password, $seven_bit_msg, $msisdn );
	$result = $this->Sms_model->send_message( $post_body, $url, $port );
	if( $result['success'] ) {
		//echo "message Sent";
	}
	else {
		//$this->Sms_model->print_ln( $this->Sms_model->formatted_server_response( $result ) );
	}

	/*
	* Sending unicode message
	*/
	$post_body = $this->Sms_model->unicode_sms( $username, $password, $unicode_msg, $msisdn );
	$result = $this->Sms_model->send_message( $post_body, $url, $port );		
	if( $result['success'] ) {
		echo "message Sent";
	}
	else {
		//$this->Sms_model->print_ln( $this->Sms_model->formatted_server_response( $result ) );
	}
	
	/*
	* Sending 8-bit message
	*/
	$post_body = $this->Sms_model->eight_bit_sms( $username, $password, $eight_bit_msg, $msisdn );
	$result = $this->Sms_model->send_message( $post_body, $url, $port );
	if( $result['success'] ) {
		//echo "message Sent";
	}
	else {
		//$this->Sms_model->print_ln( $this->Sms_model->formatted_server_response( $result ) );
	}


	/*
	* If you don't see this, and no errors appeared to screen, you should
	* check your Web server's error logs for error output:
	*/ 
	//$this->Sms_model->print_ln("Script ran to completion");
		return true;


	}


}	
	
?>