<?php

class newUser extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
	  $this->load->helper('form');
    if( !$this->session->userdata('isLoggedIn') ) {
		
        redirect('/login/show_login');
    }
  }

  function show_newUser() {
    
    $user_id = $this->session->userdata('id');
    $is_admin = $this->session->userdata('isAdmin');
    
    $data['is_admin'] = $is_admin;
    $data['email'] = $this->session->userdata('email');
    $data['name'] = $this->session->userdata('name');

    $this->load->view('newUser',$data);
	
  }
	
  function create_new_user() {
    $userInfo = $this->input->post(null,true);
	if(isset($_POST['isAdmin'])) {
		$userInfo['isAdmin'] = true;
	}
	else {
		$userInfo['isAdmin'] = false;
	}
	
    if( count($userInfo) ) {
      $this->load->model('user_m');
      $saved = $this->user_m->create_new_user($userInfo);
    }

    if ( isset($saved) && $saved ) {
		echo "success";
        //redirect('/newUser/show_newUser');
		//echo (int) $userInfo['isAdmin'];
		/*$saved = true;
		$data['error'] = $saved;

        $this->load->helper('form');
        $this->load->view('newUser',$data);*/
    }
  }


}
