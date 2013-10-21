<?php
class Sponsor extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Sponsor_model');
		$this->load->library('session');
	}

function Index()
	    {
	    	$this->load->view('sponsor_header');
			$this->load->view('sponsor_body');
			$this->load->view('footer');
	    }	

function add_sponsor()
		{
			$sponsor['name'] = $_POST['name'];
			$sponsor['password'] = $_POST['password'];

			if($this->Sponsor_model->check_sponsor($sponsor))
			{
				echo "Sorry, this Sponsor has already been registered";
			}
			else

			if ($this->Sponsor_model->register_sponsor($sponsor))
			{
				$id=$this->Sponsor_model->login_sponsor($sponsor);
				$newdata = array(
                   'sponsor_name'  => $sponsor['name'],
                   'sponsor_id' =>$id,
                   'logged_in' => TRUE
               		);
               		$this->session->set_userdata($newdata);

               		$sponsor['message']=$this->Sponsor_model->get_sponsor_message($id);
				$this->load->view('sponsor_header');
				$this->load->view('sponsor_form', $sponsor);
				$this->load->view('footer');
			}
		}

function sponsor_login()
		{
			$sponsor['name'] = $_POST['name'];
			$sponsor['password'] = $_POST['password'];

			if($this->Sponsor_model->login_sponsor($sponsor))
				{
					$id=$this->Sponsor_model->get_sponsor_id($sponsor);
					
					$newdata = array(
                   'sponsor_name'  => $sponsor['name'],
                   'sponsor_id' =>$id,
                   'logged_in' => TRUE
               		);
               		$this->session->set_userdata($newdata);

               		$sponsor['message']=$this->Sponsor_model->get_sponsor_message($id);

					$this->load->view('sponsor_header', $sponsor);
					$this->load->view('sponsor_form', $sponsor);
					$this->load->view('footer');
				}	
			else echo "Incorrect username or password";	
		}


function add_sponsor_message($sponsor)
		{
			$message['name']=$sponsor;
			$message['message'] = $_POST['message'];
			$message['sponsor_id']=$this->session->userdata('sponsor_id');

			if ($this->Sponsor_model->add_sponsor_message($message))
			{
			echo "message added";
			}

		}	

		function logout()
	{
			$this->session->sess_destroy();
		    $this->load->view('sponsor_header');
			$this->load->view('sponsor_body');
			$this->load->view('footer');
	}			


	
	}
?>	