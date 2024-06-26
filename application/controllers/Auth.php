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
    

    public function searchAdmin() {
		$searchTerm = $this->input->post('search');
		$data['files'] = $this->file->searchFiles($searchTerm);
		$this->load->view('Auth/adminPage', $data);
	}
	


	public function deleteFile($id){
		// Get file data
		$fileData = $this->file->getRows($id);
		
		if(!empty($fileData)){
			// Delete file from the server
			$filePath = 'uploads/files/'.$fileData['file_name'];
			if(file_exists($filePath)){
				unlink($filePath);
			}

			// Delete file data from the database
			$delete = $this->file->delete($id);

			if($delete){
				$this->session->set_flashdata('success', 'File deleted successfully.');
			} else {
				$this->session->set_flashdata('error', 'Some problem occurred, please try again.');
			}
		} else {
			$this->session->set_flashdata('error', 'File not found.');
		}

		redirect('auth/adminPage');
	}

	// application/controllers/Auth.php
	public function adminPage() {
		$data = array();
		$errorUploadType = $statusMsg = '';
		if ($this->input->post('fileSubmit')) {
			if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
				$filesCount = count($_FILES['files']['name']);
				$titles = explode(',', $this->input->post('titles'));
				for ($i = 0; $i < $filesCount; $i++) {
					$_FILES['file']['name']     = $_FILES['files']['name'][$i];
					$_FILES['file']['type']     = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error']    = $_FILES['files']['error'][$i];
					$_FILES['file']['size']     = $_FILES['files']['size'][$i];

					// File upload configuration
					$uploadPath = 'uploads/files/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'jpg|jpeg|png|gif';

					// Load and initialize upload library
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					// Upload file to server
					if ($this->upload->do_upload('file')) {
						$fileData = $this->upload->data();
						$uploadData[$i]['file_name'] = $fileData['file_name'];
						$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
						$uploadData[$i]['title'] = isset($titles[$i]) ? trim($titles[$i]) : '';
					} else {
						$errorUploadType .= $_FILES['file']['name'].' | ';
					}
				}
				$errorUploadType = !empty($errorUploadType) ? '<br/> File Type Error: '.trim($errorUploadType, ' | ') : '';
				if (!empty($uploadData)) {
					// Insert file information into the database
					$insert = $this->file->insert($uploadData);
					$statusMsg = $insert ? 'Files uploaded successfully.' . $errorUploadType : 'Some problem occurred, please try again.';
				} else {
					$statusMsg = "Sorry, there was an error uploading your file." . $errorUploadType;
				}
			} else {
				$statusMsg = "Please select a file to upload.";
			}
		}
		
		
		if ($this->input->post('notificationRead')) {
			$commentId = $this->input->post('commentId');
			$this->comment_model->markAsRead($commentId);
		}
		
		// Bildirimi okundu olarak işaretleme
		if ($this->input->post('notificationRead')) {
			$commentId = $this->input->post('commentId');
			$this->load->model('comment_model');
			$result = $this->comment_model->markAsRead($commentId);
			if ($result) {
				$this->session->set_flashdata('success', 'Bildirim okundu olarak işaretlendi.');
			} else {
				$this->session->set_flashdata('error', 'Bildirim işaretlenirken bir hata oluştu.');
			}
		}

		// Yorumları veritabanından al
		$this->load->model('comment_model');
		$data['comments'] = $this->comment_model->getComments();

		// Tüm yorumların sayısını bildirime aktar
		$data['newCommentCount'] = count($data['comments']);

		$data['files'] = $this->file->getRows();
		$data['statusMsg'] = $statusMsg;
		$this->load->view('Auth/adminPage', $data);
	
	
	    

	
	}

	//kullanicilerimizin yönetim sayfası
	//public function userManagement() {
	//	$data['users'] = $this->auth_model->getAllUsers(); 
	//	$this->load->view('Auth/userManagement', $data);
	//}

	public function userManagement() {
		$data['users'] = $this->auth_model->getAllUsersByRole('user');
		$this->load->view('Auth/userManagement', $data);
	}
	
	
	public function deleteUser($id) {
		if($this->auth_model->deleteUser($id)) {
			$this->session->set_flashdata('success', 'User deleted successfully.');
		} else {
			$this->session->set_flashdata('error', 'Some problem occurred, please try again.');
		}
		redirect('auth/userManagement');
	}
	
	//public function editUser($id) {
	//	$data['user'] = $this->auth_model->getUserById($id);
	//	$this->load->view('Auth/editUser', $data);
	//}
	public function editUser($id) {
		// User modelini yükle
		$this->load->model('auth_model');
	
		// Kullanıcı verisini al
		$user = $this->auth_model->getUserById($id);
	
		// Veriyi kontrol et ve görünümü yükle
		if (!empty($user)) {
			$data['user'] = $user;
			$this->load->view('Auth/editUser', $data);
		} else {
			$this->session->set_flashdata('error', 'User not found.');
			redirect('Auth/userManagement');
		}
	}
	
	
	public function updateUser() {
		$id = $this->input->post('id');
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email')
		);
	
		// Kullanıcı modelini yükle
		$this->load->model('auth_model');
	
		// Kullanıcının mevcut user_type değerini veritabanından çek
		$user = $this->auth_model->getUserById($id);
		$data['user_type'] = $user['user_type']; 
	
		if($this->auth_model->update_user($id, $data)) {
			$this->session->set_flashdata('success', 'User updated successfully.');
		} else {
			$this->session->set_flashdata('error', 'Some problems occurred, please try again.');
		}
		redirect('auth/userManagement');
	}
	
    /*
	public function addComment() {
		$file_id = $this->input->post('file_id');
		$comment = $this->input->post('comment');
		if(!empty($file_id) && !empty($comment)) {
			$data = array(
				'file_id' => $file_id,
				'comment' => $comment,
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->fileUser->addComment($data);
		}
		redirect('Auth/userPage');
	}
    */
	public function addComment() {
        $file_id = $this->input->post('file_id');
        $comment = $this->input->post('comment');
        $user_id = 1; // Geçerli bir user_id değeri belirtin
        
        if (!empty($file_id) && !empty($comment) && !empty($user_id)) {
            $data = array(
                'file_id' => $file_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'created_at' => date('Y-m-d H:i:s'),
                'read_status' => 0
            );
            $this->fileUser->addComment($data);
        }
        redirect('Auth/userPage');
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
    
	public function search() {
		$keyword = $this->input->post('search');
		$data['files'] = $this->fileUser->searchFiles($keyword);
		$this->load->view('Auth/userPage', $data);
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
