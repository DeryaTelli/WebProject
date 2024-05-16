<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('Auth/login');
	}
	public function register(){
		$this->load->view('Auth/register');
	}
	public function adminPage(){
		$this->load->view('Auth/adminPage');
	}
	public function userPage(){
		$this->load->view('Auth/userPage');
	}

	public function registration_form()
	{
		$this->auth_model->register_user();
	}
	public function login_form(){
		$this->auth_model->login_user();
	}

	


}
