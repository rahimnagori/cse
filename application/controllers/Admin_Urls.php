<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Urls extends CI_Controller
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

    // $pageData['urls']  = $this->Common_Model->fetch_records('urls', false, false, true);
    $pageData['urls']  = $this->Common_Model->fetch_records('urls_new');
    if (!count($pageData['urls'])) redirect('Admin');
    // echo "<pre>";
    // print_r($pageData['urls']);
    // die;
    // $this->load->view('admin/urls_management', $pageData);
    $this->load->view('admin/new_urls_management', $pageData);
  }

  public function update_url()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $urls  = $this->Common_Model->fetch_records('urls', false, false, true);
    foreach ($urls as $key => $value) {
      if ($key == 'id') continue;
      $this->form_validation->set_rules($key, $key, 'required');
      $update[$key] = $this->input->post($key);
    }
    if ($this->form_validation->run()) {
      $where['id'] = 1;
      if ($this->Common_Model->update('urls', $where, $update)) {
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Urls updated successfully.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }

    echo json_encode($response);
  }

  public function update_url_new()
  {
    $response['debug'] = [];
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $urls = $this->Common_Model->fetch_records('urls_new', false, 'id, input_name');
    foreach ($urls as $url) {
      $where['id'] = $url['id'];
      $update['input_value'] = $this->input->post($url['input_name']);
      $response['debug'][] = "<p>" .$this->db->last_query() ."</p>";
      if ($this->Common_Model->update('urls_new', $where, $update)) {
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Urls updated successfully.');
      }
    }

    echo json_encode($response);
  }

  public function highlights()
  {
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $pageData['highlights']  = $this->Common_Model->fetch_records('highlights', false, false, true);
    $this->load->view('admin/highlights_management', $pageData);
  }

  public function update_highlights()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $urls  = $this->Common_Model->fetch_records('highlights', false, false, true);
    foreach ($urls as $key => $value) {
      if ($key == 'id') continue;
      $this->form_validation->set_rules($key, $key, 'required');
      $update[$key] = $this->input->post($key);
    }
    if ($this->form_validation->run()) {
      $where['id'] = 1;
      if ($this->Common_Model->update('highlights', $where, $update)) {
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Highlights updated successfully.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }

    echo json_encode($response);
  }
}
