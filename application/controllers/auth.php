<?php

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index()
	{
		$this->user->on_valid_session('home');

		$this->load->view('common/header');
		$this->load->view('auth/login');
		$this->load->view('common/footer');
	}

	function validate()
	{
		$login = $this->input->post('login');
		$password = $this->input->post('password');

		if($this->user->login($login, $password)) {
			$this->session->set_flashdata('success_message', 'Berhasil login.');
			redirect('home');
		} else {
			$this->session->set_flashdata('error_message', 'Invalid login or password.');
			redirect('auth');
		}
	}

	function logout()
	{
		$this->user->destroy_user('auth');
	}
}

