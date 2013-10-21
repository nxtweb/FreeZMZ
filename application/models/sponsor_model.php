<?php

class Sponsor_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}


	function register_sponsor($sponsor)
	{
		$this->db->insert('sponsors', $sponsor);
		return true;
	}

	function login_sponsor($sponsor)
	{

		$sql = "SELECT * FROM `sponsors` WHERE name = '".$sponsor['name']."' AND password='".$sponsor['password']."'";
		$query = $this->db->query($sql);

		$count=$query->num_rows();
		if($count>0){

			return true;
		}

			else return false;;
		}


	function add_sponsor_message($message)
	{
			if(isset($message)){
			$sql = "UPDATE `sponsors` SET message='".$message['message']."' WHERE name='".$message['name']."'";	
			$query = $this->db->query($sql);
			return true;
		}
	}


	function check_sponsor($sponsor)
	{
		$sql = "SELECT * FROM `sponsors` WHERE name = '".$sponsor['name']."'";
		$query = $this->db->query($sql);

		$count=$query->num_rows(); 

			if ($count > 0){
			return true;
		}	
		else return false;
	}	

	function get_sponsor_id($sponsor)
	{
		$sql = "SELECT * FROM `sponsors` WHERE name = '".$sponsor['name']."'";
		$query = $this->db->query($sql);

		$count=$query->num_rows(); 

		foreach($query->result() as $result){
				$dataset= $result;
				$sponsor[]= $dataset->id;
				$sponsor=$sponsor[0];
				}

				return $sponsor;
	}

	function get_sponsor_message($sponsor_id)
	{
		$sql = "SELECT message FROM `sponsors` WHERE id = '".$sponsor_id."'";
		$query = $this->db->query($sql);

		$count=$query->num_rows(); 

			if ($count > 0){
			
			foreach($query->result() as $result){
			$dataset= $result;
			$sponsor_message= $dataset->message;
			$sponsor_message = $sponsor_message;

			}

			return $sponsor_message;
		}	

		

	}
}
	
?>