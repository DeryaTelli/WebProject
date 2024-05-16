<?php
    class auth_model extends CI_Model{
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function register_user(){
            $data=array(
                "name"=>$this->input->post("name"),
                "surname"=>$this->input->post("surname"),
                "email"=>$this->input->post("email"),
                "password"=>$this->input->post("password"),
                
            );
            $this->db->insert('user_form',$data);
            $this->session->set_flashdata('suc','You are registered please login ');
            redirect(base_url('Auth'));
            
        }

        public function login_user(){
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            $this->db->where('email', $email);
            $this->db->where('password', $password);
            $query = $this->db->get('user_form');
            
            // Kullanıcı var mı yok mu kontrol et
            if ($query->num_rows() > 0) {
                // Kullanıcı bilgilerini al
                $user = $query->row();
        
                // Kullanıcı tipine göre yönlendirme yap
                if ($user->user_type == 'admin') {
                    // Admin ise admin sayfasına yönlendir
                    $this->session->set_flashdata('success', 'Admin olarak başarıyla giriş yaptınız.');
                    redirect(base_url('Auth/adminPage'));
                } elseif ($user->user_type == 'user') {
                    // Kullanıcı ise kullanıcı sayfasına yönlendir
                    $this->session->set_flashdata('success', 'Kullanıcı olarak başarıyla giriş yaptınız.');
                    redirect(base_url('Auth/userPage'));
                } else {
                    // Geçersiz kullanıcı tipi
                    $this->session->set_flashdata('warning', 'Geçersiz kullanıcı tipi');
                    redirect(base_url('Auth'));
                }
            } else {
                // Kullanıcı bulunamadı
                $this->session->set_flashdata('warning', 'Geçersiz e-posta veya şifre');
                redirect(base_url('Auth'));
            }
        }
        
    }

?>