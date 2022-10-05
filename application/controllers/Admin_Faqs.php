<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Faqs extends CI_Controller
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
        $pageData['faqs'] = $this->Common_Model->fetch_records('faqs', false, false, false, 'id');

        $this->load->view('admin/faqs_management', $pageData);
    }

    public function add_faq()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $this->form_validation->set_rules('question', 'question', 'required');
        $this->form_validation->set_rules('answer', 'answer', 'required');
        if ($this->form_validation->run()) {
            $insert['question'] = $this->input->post('question');
            $insert['answer'] = $this->input->post('answer');
            if ($this->Common_Model->insert('faqs', $insert)) {
                $response['status'] = 1;
                $response['responseMessage'] = $this->Common_Model->success('Faq added successfully.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }

    public function delete_faq()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $this->form_validation->set_rules('delete_faq_id', 'delete_faq_id', 'required');
        if ($this->form_validation->run()) {
            $where['id'] = $this->input->post('delete_faq_id');
            if ($this->Common_Model->delete('faqs', $where)) {
                $response['status'] = 1;
                $response['responseMessage'] = $this->Common_Model->success('Faq deleted successfully.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }

    public function get_faq($faqId)
    {
        $where['id'] = $faqId;
        $pageData['faqDetails'] = $this->Common_Model->fetch_records('faqs', $where, false, true);

        $this->load->view('admin/include/faq_details', $pageData);
    }

    public function update_faq()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $this->form_validation->set_rules('question', 'question', 'required');
        $this->form_validation->set_rules('answer', 'answer', 'required');
        if ($this->form_validation->run()) {
            $update['question'] = $this->input->post('question');
            $update['answer'] = $this->input->post('answer');
            $where['id'] = $this->input->post('faq_id');
            if ($this->Common_Model->update('faqs', $where, $update)) {
                $response['status'] = 1;
                $response['responseMessage'] = $this->Common_Model->success('Faq updated successfully.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }
}
