<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Playlist extends CI_Controller
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

  public function index($type)
  {
    if (!($type == 0 || $type == 1)) redirect('Playlist-Management/0');
    $where['type'] = $type;
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $pageData['courseTitle'] = $type == 0 ? 'Upcoming Courses' : 'YouTube Playlist';
    $pageData['courseType'] = $type;
    $pageData['upcomingCourses']  = $this->Common_Model->fetch_records('upcoming_courses', $where);
    $this->load->view('admin/upcoming_courses', $pageData);
  }

  public function add_course()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $insert = $this->input->post();
    if ($this->Common_Model->insert('upcoming_courses', $insert)) {
      $response['status'] = 1;
      $message = ($insert['type'] == 0) ? 'Upcoming course' : 'YouTube playlist';
      $response['responseMessage'] = $this->Common_Model->success($message . ' added successfully');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function delete_course()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $where['id'] = $this->input->post('delete_course_id');
    $message = ($this->input->post('course_type') == 0) ? "Upcoming course" : "YouTube playlist";
    if ($this->Common_Model->delete('upcoming_courses', $where)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success($message . ' deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function get($id)
  {
    $where['id'] = $id;
    $pageData['courseDetails'] = $this->Common_Model->fetch_records('upcoming_courses', $where, false, true);
    $this->load->view('admin/include/course_details', $pageData);
  }

  public function update_course()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $update['title'] = $this->input->post('title');
    $type = $this->input->post('type');
    if ($type == 1) {
      $update['url'] = $this->input->post('url');
    }
    $where['id'] = $this->input->post('course_id');
    if ($this->Common_Model->update('upcoming_courses', $where, $update)) {
      $response['status'] = 1;
      $message = ($type == 0) ? "Upcoming course" : "YouTube playlist";
      $response['responseMessage'] = $this->Common_Model->success($message . ' updated successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }
}
