<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Courses extends CI_Controller
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
        $pageData['courses'] = $this->Common_Model->fetch_records('courses', false, false, false, 'id');

        $this->load->view('admin/courses_management', $pageData);
    }

    public function categories()
    {
        $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));
        $pageData['categories'] = $this->Common_Model->fetch_records('categories');

        $this->load->view('admin/categories_management', $pageData);
    }

    public function add_category()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $this->form_validation->set_rules('category_name', 'category_name', 'required');
        if ($this->form_validation->run()) {
            $insert['category_name'] = $this->input->post('category_name');
            if ($this->Common_Model->insert('categories', $insert)) {
                $response['status'] = 1;
                $response['responseMessage'] = $this->Common_Model->success('Category added successfully.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }

    public function delete_category()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $this->form_validation->set_rules('delete_category_id', 'delete_category_id', 'required');
        if ($this->form_validation->run()) {
            $where['id'] = $this->input->post('delete_category_id');
            if ($this->Common_Model->delete('categories', $where)) {
                $response['status'] = 1;
                $response['responseMessage'] = $this->Common_Model->success('Category deleted successfully.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }

    public function get_category($categoryId)
    {
        $where['id'] = $categoryId;
        $pageData['categoryDetails'] = $this->Common_Model->fetch_records('categories', $where, false, true);

        $this->load->view('admin/include/category_details', $pageData);
    }

    public function update_category()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $this->form_validation->set_rules('category_id', 'category_id', 'required');
        $this->form_validation->set_rules('category_name', 'category_name', 'required');
        if ($this->form_validation->run()) {
            $where['id'] = $this->input->post('category_id');
            $update['category_name'] = $this->input->post('category_name');
            if ($this->Common_Model->update('categories', $where, $update)) {
                $response['status'] = 1;
                $response['responseMessage'] = $this->Common_Model->success('Category updated successfully.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }
}
