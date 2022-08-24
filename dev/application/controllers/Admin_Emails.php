<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Emails extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    if (!$this->check_login()) {
      redirect('Admin');
    }
  }

  public function check_login()
  {
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function index()
  {
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $pageData['emails']  = $this->Common_Model->fetch_records('emails', false, 'default_email, contact_email', true);
    $this->load->view('admin/emails_management', $pageData);
  }

  public function update_email(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $emails  = $this->Common_Model->fetch_records('emails', false, 'default_email, contact_email', true);
    foreach($emails as $key => $email){
      $this->form_validation->set_rules($key, $key, 'required');
      $update[$key] = $this->input->post($key);
    }
    if ($this->form_validation->run()) {
      if($this->Common_Model->update('emails', array('id' => 1), $update)){
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Emails updated successfully.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    echo json_encode($response);
  }

}
