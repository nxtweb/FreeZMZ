<?php
class Freez extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Freez_model');
		$this->load->library('session');
	}

function Index()
	    {
	    	$this->load->view('header');
			$this->load->view('body');
			$this->load->view('footer');
	    }	

function Signup()
		{
			$user['phone'] = $_POST['phone'];
			$user['password'] = $_POST['password'];
			$user['activate']=rand(100000,999999);

			if($this->Freez_model->check_user($user))
			{
				echo "Sorry, this number has already been registered";
			}
			else
			if ($this->Freez_model->register_user($user))
				
			{
				if ($this->Freez_model->send_activate_code($user)) {
					}
				
				$this->load->view('header', $user);
				$this->load->view('activate', $user);
				$this->load->view('footer');
			}
		}

function Login()
		{
			$user['phone'] = $_POST['phone'];
			$user['password'] = $_POST['password'];

			if($this->Freez_model->login_user($user))
				{
					$newdata = array(
                   'phone'  => $user['phone'],
                   'logged_in' => TRUE
               );
			$this->session->set_userdata($newdata);

					$this->load->view('header', $user);
					$this->load->view('form', $user);
					$this->load->view('footer');
				}
			else echo "Incorrect username or password";	
		}	

function activate($user)
	{
		$activate['phone']=$user;
		$activate['code']=$_POST['code'];

		$code=$this->Freez_model->get_user_code($activate);

		if($code[0]==$activate['code'])
				{
					$this->Freez_model->activate_user($activate);

					$newdata = array(
                   'phone'  => $activate['phone'],
                   'logged_in' => TRUE
               );
				$this->session->set_userdata($newdata);

					$this->load->view('header', $activate);
					$this->load->view('form', $activate);
					$this->load->view('footer');
				}
		else echo "Incorrect activate code";	


	}	

	function logout()
	{
		    $this->session->sess_destroy();
			$this->load->view('header');
			$this->load->view('body');
			$this->load->view('footer');
	}		


	
	}
?>	