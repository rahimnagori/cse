<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    $this->load->library('session');
  }

  public function index()
  {
    $freeCategory = [
      'id' => 'free',
      'category_name' => 'Free Courses',
      'totalCourses' => 0,
      'static' => 'true'
    ];
    $paidCategory = [
      'id' => 'paid',
      'category_name' => 'Paid Courses',
      'totalCourses' => 0,
      'static' => 'true'
    ];
    $pageData = $this->Common_Model->get_userdata();
    $pageData['courses'] = $this->Common_Model->fetch_records('courses');
    $dynamicCategories = $this->Common_Model->fetch_records('categories');
    $staticCategories['free'] = $freeCategory;
    $staticCategories['paid'] = $paidCategory;
    foreach($dynamicCategories as $key => $category){
      $totalCourses = $this->Common_Model->fetch_records('courses', array('category' => $category['id']), 'id, title, type, category');
      foreach($totalCourses as $singleCourse){
        $staticCategories['free']['totalCourses'] = ($singleCourse['type'] == 0) ? $staticCategories['free']['totalCourses'] + 1 : $staticCategories['free']['totalCourses'];
        $staticCategories['paid']['totalCourses'] = ($singleCourse['type'] == 1) ? $staticCategories['paid']['totalCourses'] + 1 : $staticCategories['paid']['totalCourses'];
      }
      $dynamicCategories[$key]['totalCourses'] = count($totalCourses);
    }
    $pageData['categories'] = array_merge($staticCategories, $dynamicCategories);
    $pageData['reviews'] = $this->Common_Model->fetch_records('reviews');
    $pageData['deals'] = $this->Common_Model->fetch_records('deals');
    $pageData['newses'] = $this->Common_Model->fetch_records('newses');
    $pageData['highlights'] = $this->Common_Model->fetch_records('highlights', false, false, true);

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/index', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function about()
  {
    $pageData = $this->Common_Model->get_userdata();

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/about', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function terms()
  {
    $pageData = $this->Common_Model->get_userdata();

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/terms', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function privacy()
  {
    $pageData = $this->Common_Model->get_userdata();

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/privacy', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function refund()
  {
    $pageData = $this->Common_Model->get_userdata();

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/refund', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function contact_request()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    $this->form_validation->set_rules('full_name', 'full_name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    // $this->form_validation->set_rules('phone', 'phone', 'required');
    $this->form_validation->set_rules('message', 'message', 'required');
    if ($this->form_validation->run()) {
      $insert = $this->input->post();
      $insert['created'] = $insert['updated'] = date("Y-m-d H:i:s");
      $contactId = $this->Common_Model->insert('contact_requests', $insert);
      if ($contactId) {
        $this->Common_Model->send_contact_form_to_admin($contactId);
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Message sent successfully.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function get_course($id)
  {
    $pageData['courseDetails'] = $this->Common_Model->fetch_records('courses', array('id' => $id), false, true);
    $this->load->view('site/include/course_details', $pageData);
  }
}
