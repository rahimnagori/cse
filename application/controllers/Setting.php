<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    $this->load->model('Setting_Model','setting');
    $this->load->library('session');
  }

  public function index()
  {
    
    $admin_id = $this->session->userdata('id');
    $where['id'] = $admin_id;
    $pageData['adminData'] = $this->Common_Model->fetch_records('admins', $where, false, true);
    $where['id'] = 1;
    $pageData['settingData'] = $this->Common_Model->fetch_records('setting', $where, false, true);
    $this->load->view('admin/frontend_setting', $pageData);
  }
  public function submit_video_links() {
    
    $data = array(
        'id' => $this->input->post('id'),
        'slider_name' => $this->input->post('sliderName'),
        'video_link1' => $this->input->post('videoLink1'),
        'video_link2' => $this->input->post('videoLink2'),
        'video_link3' => $this->input->post('videoLink3'),
        'video_link4' => $this->input->post('videoLink4'),
        'video_link5' => $this->input->post('videoLink5'),
        'audio_control' => $this->input->post('audioControl') ? 1 : 0,
        'video_control' => $this->input->post('videoControl') ? 1 : 0
    );


    if($this->setting->saveSliderData($data)){

        $this->session->set_flashdata("responseMessage", "<div class='alert alert-success' role='alert'><strong>Success!</strong> Your Slider Add Successfully.</div>");

    }else{

        $this->session->set_flashdata("responseMessage", "<div class='alert alert-danger' role='alert'><strong>Failed!</strong> Your Slider Adding Failed.</div>");

    }


     redirect('frontend-setting');


    
}

// public function display_slider() {
//     $data['slider_data'] = $this->Slider_model->getSliderData();
//     $this->load->view('slider_view', $data);
// }

}