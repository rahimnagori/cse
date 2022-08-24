<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Reviews extends CI_Controller
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

    $pageData['reviews']  = $this->Common_Model->fetch_records('reviews');
    $this->load->view('admin/reviews_management', $pageData);
  }

  public function add_review()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $insert['name'] = $this->input->post('name');
    $insert['designation'] = $this->input->post('designation');
    $insert['review'] = $this->input->post('review');
    if ($_FILES['image']['error'] == 0) {
      $config['upload_path'] = "assets/site/img/reviews/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('image')) {
        $insert['image'] = $config['upload_path'] . $this->upload->data("file_name");
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    if ($this->Common_Model->insert('reviews', $insert)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Review added successfully');
    }

    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function get_review($id)
  {
    $where['id'] = $id;
    $pageData['reviewDetails'] = $this->Common_Model->fetch_records('reviews', $where, false, true);
    if (!empty($pageData['reviewDetails'])) {
      $this->load->view('admin/include/review_details', $pageData);
    } else {
      echo "<p>Review not found</p>";
    }
  }

  public function delete_review()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $where['id'] = $this->input->post('delete_review_id');
    $reviewDetails = $this->Common_Model->fetch_records('reviews', $where, false, true);
    if ($reviewDetails['image']) {
      if (file_exists($reviewDetails['image'])) unlink($reviewDetails['image']);
    }
    if ($this->Common_Model->delete('reviews', $where)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Review deleted successfully.');
    }

    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function update_review()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $update['name'] = $this->input->post('name');
    $update['designation'] = $this->input->post('designation');
    $update['review'] = $this->input->post('review');
    $where['id'] = $this->input->post('review_id');
    if ($_FILES['image']['error'] == 0) {
      $reviewDetails = $this->Common_Model->fetch_records('reviews', $where, false, true);
      $config['upload_path'] = "assets/site/img/reviews/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('image')) {
        $update['image'] = $config['upload_path'] . $this->upload->data("file_name");
        if ($reviewDetails['image']) {
          if (file_exists($reviewDetails['image'])) unlink($reviewDetails['image']);
        }
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    if ($this->Common_Model->update('reviews', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Review updated successfully');
    }

    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }
}
