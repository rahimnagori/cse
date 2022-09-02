<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Contacts extends CI_Controller
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

    $pageData['contactRequests']  = $this->Common_Model->fetch_records('contact_requests', false, false, false, 'id');
    $this->load->view('admin/contact_requests', $pageData);
  }

  public function delete_enquiry()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $this->form_validation->set_rules('delete_user_enquiry_id', 'delete_user_enquiry_id', 'required');
    if ($this->form_validation->run()) {
      $where['id'] = $this->input->post('delete_user_enquiry_id');
      if ($this->Common_Model->delete('contact_requests', $where)) {
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('User enquiry deleted successfully.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }

    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }
}
