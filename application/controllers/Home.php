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
    $pageData = $this->Common_Model->get_userdata();
    $staticCategories = [];
    $staticCategoryExist = ($pageData['isFreeCategoryActive']['input_value'] == 1 || $pageData['isPaidCategoryActive']['input_value'] == 1 || $pageData['isAllCategoryActive']['input_value'] == 1) ? true : false;
    if($pageData['isFreeCategoryActive']['input_value'] == 1){
      $staticCategories['free'] = [
        'id' => 'free',
        'category_name' => 'Free Courses',
        'totalCourses' => 0,
        'category_link' => $pageData['urls']['free_category_url'],
        'static' => 'true'
      ];
    }
    if($pageData['isPaidCategoryActive']['input_value'] == 1){
      $staticCategories['paid'] = [
        'id' => 'paid',
        'category_name' => 'Paid Courses',
        'totalCourses' => 0,
        'category_link' => $pageData['urls']['paid_category_url'],
        'static' => 'true'
      ];
    }
    $dynamicCategories = $this->Common_Model->fetch_records('categories', array('is_active' => 1), 'id, category_name');
    $selectedCategories = [];
    foreach($dynamicCategories as $dynamicCategory){
      $selectedCategories[] = $dynamicCategory['id'];
    }
    // echo "<pre>";
    // print_r($selectedCategories);
    // die;
    $pageData['courses'] = $this->Common_Model->fetch_records('courses', false, 'thumbnail_type, type, category, thumbnail, course_link, short_description, ratings, title, enrolled, duration, price, id', false, false, false, false, (empty($selectedCategories)) ? false : 'category', $selectedCategories); 
    // echo "<p>" .$this->db->last_query() ."</p>";
    // echo "<pre>";
    // print_r($selectedCategories);
    // echo "</pre>";
    // die;
    foreach ($dynamicCategories as $key => $category) {
      $totalCourses = $this->Common_Model->fetch_records('courses', array('category' => $category['id']), 'id, title, type, category');
      foreach ($totalCourses as $singleCourse) {
        if(isset($staticCategories['free'])){
          $staticCategories['free']['totalCourses'] = ($singleCourse['type'] == 0) ? $staticCategories['free']['totalCourses'] + 1 : $staticCategories['free']['totalCourses'];
        }
        if(isset($staticCategories['paid'])){
          $staticCategories['paid']['totalCourses'] = ($singleCourse['type'] == 1) ? $staticCategories['paid']['totalCourses'] + 1 : $staticCategories['paid']['totalCourses'];
        }
      }
      $dynamicCategories[$key]['totalCourses'] = count($totalCourses);
    }
    $pageData['categories'] = ($staticCategoryExist) ? array_merge($staticCategories, $dynamicCategories) : $dynamicCategories;
    $pageData['reviews'] = $this->Common_Model->fetch_records('reviews');
    $pageData['deals'] = $this->Common_Model->fetch_records('deals');
    $pageData['newses'] = $this->Common_Model->fetch_records('newses');
    $pageData['highlights'] = $this->Common_Model->fetch_records('highlights', false, false, true);
    // echo "<pre>";
    // print_r($pageData);
    // die;

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

  public function faqs()
  {
    $pageData = $this->Common_Model->get_userdata();
    $pageData['faqs'] = $this->Common_Model->fetch_records('faqs');

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/faqs', $pageData);
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

  public function get_category($id)
  {
    $response['status'] = 0;
    if ($id != 'free' && $id != 'paid' && $id != 'all') {
      $where['id'] = $id;
      $url = $this->Common_Model->fetch_records('categories', $where, 'category_link, category_price', true);
      if ($url['category_link'] != null && $url['category_link'] != 'null') {
        $response['status'] = 1;
        $response['url'] = $url['category_link'];
        $response['category_price'] = $url['category_price'];
      }
    } else {
      $select = '' . $id . '_category_url, ' . $id . '_category_price';
      $url = $this->Common_Model->fetch_records('urls', false, $select, true);
      if ($url['' . $id . '_category_url'] != null && $url['' . $id . '_category_url'] != 'null') {
        $response['status'] = 1;
        $response['url'] = $url['' . $id . '_category_url'];
        $response['category_price'] = $url['' . $id . '_category_price'];
      }
    }
    echo json_encode($response);
  }

  public function test()
  {
    redirect('');
    $insert = [
      [
        'input_class' => 'col-sm-6',
        'input_label' => 'Facebook Url',
        'input_type' => 'url',
        'input_name' => 'facebook_url',
        'input_value' => 'https://www.facebook.com/csepracticals/',
        'input_attr' => 'class="form-control"'
      ],
      [
        'input_class' => 'col-sm-6',
        'input_label' => 'WhatsApp Url',
        'input_type' => 'url',
        'input_name' => 'whatsapp_url',
        'input_value' => 'https://api.whatsapp.com/send?phone=919686081839',
        'input_attr' => 'class="form-control"'
      ],
      [
        'input_class' => 'col-sm-6',
        'input_label' => 'YouTube Url',
        'input_type' => 'url',
        'input_name' => 'youtube_url',
        'input_value' => 'https://www.youtube.com/c/CSEPracticals',
        'input_attr' => 'class="form-control"'
      ],
      [
        'input_class' => 'col-sm-6',
        'input_label' => 'Youtube Subscribe Url',
        'input_type' => 'url',
        'input_name' => 'youtube_subscribe_url',
        'input_value' => 'https://www.youtube.com/c/CSEPracticals?sub_confirmation=1',
        'input_attr' => 'class="form-control"'
      ],
      [
        'input_class' => 'col-sm-6',
        'input_label' => 'Telegram Url',
        'input_type' => 'url',
        'input_name' => 'telegram_url',
        'input_value' => 'https://t.me/telecsepracticals',
        'input_attr' => 'class="form-control"'
      ],
      [
        'input_class' => 'col-sm-6',
        'input_label' => 'Download Full Course Url',
        'input_type' => 'url',
        'input_name' => 'download_full_course_url',
        'input_value' => 'https://csepracticals.teachable.com/p/only-resources',
        'input_attr' => 'class="form-control"'
      ],
      [
        'input_class' => 'col-sm-6',
        'input_label' => 'Login Url',
        'input_type' => 'url',
        'input_name' => 'login_url',
        'input_value' => 'https://sso.teachable.com/secure/368858/identity/login',
        'input_attr' => 'class="form-control"'
      ], [
        'input_class' => 'col-sm-6',
        'input_label' => 'Signup Url',
        'input_type' => 'url',
        'input_name' => 'signup_url',
        'input_value' => 'https://sso.teachable.com/secure/368858/identity/sign_up',
        'input_attr' => 'class="form-control"'
      ], [
        'input_class' => 'col-sm-4',
        'input_label' => 'Free Category Url',
        'input_type' => 'url',
        'input_name' => 'free_category_url',
        'input_value' => 'https://csepracticals.teachable.com/p/only-resources',
        'input_attr' => 'class="form-control"'
      ], [
        'input_class' => 'col-sm-4',
        'input_label' => 'Free Category Price',
        'input_type' => 'number',
        'input_name' => 'free_category_price',
        'input_value' => '0.00',
        'input_attr' => 'class="form-control" step="0.1"'
      ], [
        'input_class' => 'col-sm-4',
        'input_label' => 'Paid Category Url',
        'input_type' => 'url',
        'input_name' => 'paid_category_url',
        'input_value' => 'https://rzp.io/l/MHpJWGo',
        'input_attr' => 'class="form-control"'
      ], [
        'input_class' => 'col-sm-4',
        'input_label' => 'Paid Category Price',
        'input_type' => 'number',
        'input_name' => 'paid_category_price',
        'input_value' => '65.00',
        'input_attr' => 'class="form-control" step="0.1"'
      ],[
        'input_class' => 'col-sm-4',
        'input_label' => 'All Category Url',
        'input_type' => 'url',
        'input_name' => 'all_category_url',
        'input_value' => 'https://rzp.io/l/MHpJWGo',
        'input_attr' => 'class="form-control"'
      ], [
        'input_class' => 'col-sm-4',
        'input_label' => 'All Category Price',
        'input_type' => 'number',
        'input_name' => 'all_category_price',
        'input_value' => '65.00',
        'input_attr' => 'class="form-control" step="0.1"'
      ], [
        'input_class' => 'col-sm-4',
        'input_label' => 'Free Category Active',
        'input_type' => 'checkbox',
        'input_name' => 'free_category_active',
        'input_value' => '1',
        'input_attr' => ''
      ], [
        'input_class' => 'col-sm-4',
        'input_label' => 'Paid Category Active',
        'input_type' => 'checkbox',
        'input_name' => 'paid_category_active',
        'input_value' => '1',
        'input_attr' => ''
      ],  [
        'input_class' => 'col-sm-4',
        'input_label' => 'All Category Active',
        'input_type' => 'checkbox',
        'input_name' => 'all_category_active',
        'input_value' => '1',
        'input_attr' => ''
      ],
    ];
    foreach ($insert as $ins) {
      $this->Common_Model->insert('urls_new', $ins);
      echo "<p>" . $this->db->last_query() . "</p>";
    }
  }
}
