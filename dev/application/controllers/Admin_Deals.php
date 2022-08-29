<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Deals extends CI_Controller
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

    $pageData['deals']  = $this->Common_Model->fetch_records('deals');
    $this->load->view('admin/deals_management', $pageData);
  }

  public function get_deal($id)
  {
    $where['id'] = $id;
    $pageData['dealDetails'] = $this->Common_Model->fetch_records('deals', $where, false, true);

    $this->load->view('admin/include/deal_details', $pageData);
  }

  public function add_deal()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $insert['title'] = $this->input->post('title');
    $insert['description'] = $this->input->post('description');
    $insert['link'] = $this->input->post('link');
    $insert['price_inr'] = $this->input->post('price_inr');
    $insert['price_dollar'] = $this->input->post('price_dollar');
    $insert['created'] = $insert['updated'] = date("Y-m-d H:i:s");
    if ($this->Common_Model->insert('deals', $insert)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Deal added successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function delete_deal()
  {
    $response['status'] = 0;
    $where['id'] = $this->input->post('delete_deal_id');
    if ($this->Common_Model->delete('deals', $where)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Deal deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function update_deal()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $update['title'] = $this->input->post('title');
    $update['description'] = $this->input->post('description');
    $update['link'] = $this->input->post('link');
    $update['price_inr'] = $this->input->post('price_inr');
    $update['price_dollar'] = $this->input->post('price_dollar');
    $update['updated'] = date("Y-m-d H:i:s");
    $where['id'] = $this->input->post('deal_id');
    if ($this->Common_Model->update('deals', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Deal updated successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }
}
