<?php
class Login extends CI_Controller {

	public function index()
	{
		$data['main_content'] = 'login_form';
		$this->load->view('includes/template',$data);
	}

	function validate_credentials()
	{
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();

		if($query) //if the user's credentials validated...
		{
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true
			);

			$this->session->set_userdata($data);
			redirect('site/member_area');
		}

		else 
		{
			$this->index();
		}	
	}

	function signup()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template',$data);
	}

	function create_member()
	{
		$this->load->library('form_validation');
		//field name, error message, validation rules
		$this->form_validation->set_rules('username','Userame','trim|required|min_length[4]');
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
			$this->signup();
		}
		else
		{
			$this->load->model('membership_model');
			if($query = $this->membership_model->create_member())
			{
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template',$data);
			}	
			else
			{
				$this->load->view('signup_form');
			}	
		}	
	}

	function logout()  
	{  
    $this->session->sess_destroy();  
    redirect('site/member_area'); 
	} 

	/**
	 * 初次安装
	 *
	 */
	public function install(){
		$this->load->model('membership_model');
		$data = $this->membership_model->init();
		$data['main_content']= $data['text'];
		$this->load->view('abc',$data);
	}
}