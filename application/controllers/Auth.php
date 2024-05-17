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

	public function file(){
		$this->load->model('file');
	}

	public function adminPage(){
		$data=array();
		$errorUploadType=$statusMsg='';
		if($this->input->post('fileSubmit')){
			if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name']))>0){
				$filesCount=count($_FILES['files']['name']);
				for($i=0; $i<$filesCount; $i++){
					$_FILES['file']['name']    =$_FILES['files']['name'][$i];
					$_FILES['file']['type']    =$_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name']=$_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error']   =$_FILES['files']['error'][$i];
					$_FILES['file']['size']    =$_FILES['files']['size'][$i];

					//file upload configuration 
					$uploadPath= 'uploads/files/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'jpg|jpeg|png|gif';


					//load and initialize upload library 
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					//upload file to server 
					if($this->upload->do_upload('file')){
						$fileData=$this->upload->data();
						$uploadData[$i]['file_name'] = $fileData['file_name'];
						$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
					}else{
						$errorUploadType.= $_FILES['file']['name'].' | ';
					}
				}
				$errorUploadType=!empty($errorUploadType)?'<br/> File Type Error:'.trim($errorUploadType,'| '):'';
			    if(!empty($uploadData)){
					//insert file information into the database
					$insert=$this->file->insert($uploadData);
					$statusMsg= $insert?'Files uploaded successfully.'.$errorUploadType:'Some problem occurred, please try again.';
				}else{
					$statusMsg="Sorry, there was an error uploading your file.".$errorUploadType;
				}
			}else{
				$statusMsg="Please select a file to upload.";
			}
		}
		$data['files']=$this->file->getRows();
		$data['statusMsg']=$statusMsg;
		$this->load->view('Auth/adminPage',$data);
	}

	public function __construct() {
        parent::__construct();
        // Load the fileUser model
        $this->load->model('fileUser');
    }

	public function userPage(){
		$data['files']= $this->fileUser->getRows();
		$this->load->view('Auth/userPage',$data);
	}
    
	public function logout() {
        // Destroy session data
        $this->session->sess_destroy();
        // Redirect to login page
        redirect('Auth/');
    }
	

	public function registration_form()
	{
		$this->auth_model->register_user();
	}
	public function login_form(){
		$this->auth_model->login_user();
	}

	


}
