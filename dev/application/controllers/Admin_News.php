<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_News extends CI_Controller
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

    $pageData['newses']  = $this->Common_Model->fetch_records('newses', array('is_deleted' => 0), false, false, 'id');
    $this->load->view('admin/news_management', $pageData);
  }

  public function get_news($id)
  {
    $where['id'] = $id;
    $pageData['newsDetails'] = $this->Common_Model->fetch_records('newses', $where, false, true);

    $this->load->view('admin/include/news_details', $pageData);
  }

  public function add_news()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $insert['title'] = $this->input->post('title');
    $insert['description'] = $this->input->post('description');
    $insert['link'] = $this->input->post('link');
    $insert['comment'] = $this->input->post('comment');
    $insert['is_deleted'] = 0;
    $insert['user_id'] = $this->session->userdata('id');
    $insert['created'] = $insert['updated'] = date("Y-m-d H:i:s");
    if ($_FILES['image']['error'] == 0) {
      $config['upload_path'] = "assets/site/img/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('image')) {
        $newsImage = $this->upload->data("file_name");

        $insert['image'] = "assets/site/img/" .$newsImage;
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    if ($this->Common_Model->insert('newses', $insert)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('News added successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function delete_news()
  {
    $response['status'] = 0;
    $where['id'] = $this->input->post('delete_news_id');
    $newsDetails = $this->Common_Model->fetch_records('newses', $where, false, true);
    if($newsDetails['image'] != '' || $newsDetails['image'] != null){
      if(file_exists($newsDetails['image'])) unlink($newsDetails['image']);
    }
    $update['is_deleted'] = 1;
    if ($this->Common_Model->delete('newses', $where)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('News deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function update_news()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $update['title'] = $this->input->post('title');
    $update['description'] = $this->input->post('description');
    $update['link'] = $this->input->post('link');
    $update['comment'] = $this->input->post('comment');
    $update['updated'] = date("Y-m-d H:i:s");
    $where['id'] = $this->input->post('news_id');
    if ($_FILES['image']['error'] == 0) {
      $newsDetails = $this->Common_Model->fetch_records('newses', $where, false, true);
      if($newsDetails['image'] != '' || $newsDetails['image'] != null){
        if(file_exists($newsDetails['image'])) unlink($newsDetails['image']);
      }
      $config['upload_path'] = "assets/site/img/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('image')) {
        $newsImage = $this->upload->data("file_name");

        $update['image'] = "assets/site/img/" .$newsImage;
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    if ($this->Common_Model->update('newses', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('News updated successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }
}
