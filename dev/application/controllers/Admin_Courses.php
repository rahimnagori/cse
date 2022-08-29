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
        $pageData['categories'] = [];
        $categories = $this->Common_Model->fetch_records('categories');
        foreach ($categories as $category) {
            $pageData['categories'][$category['id']] = $category;
        }

        $this->load->view('admin/courses_management', $pageData);
    }

    public function add_course()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $insert['created'] = date('Y-m-d H:i:s');
        $insert = $this->create_course();
        if ($this->form_validation->run()) {
            if ($insert['thumbnail_type'] == 1) {
                if ($_FILES['thumbnail']['error'] == 0) {
                    $config['upload_path'] = "assets/site/thumbnails/";
                    $config['allowed_types'] = 'jpeg|gif|jpg|png';
                    $config['encrypt_name'] = true;
                    $this->load->library("upload", $config);
                    if ($this->upload->do_upload('thumbnail')) {
                        $insert['thumbnail'] = $config['upload_path'] . $this->upload->data("file_name");;
                    } else {
                        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
                    }
                }
            } else if ($insert['thumbnail_type'] == 2) {
                $insert['thumbnail'] = $this->input->post('thumbnail');
            }
            if ($insert['thumbnail'] != null || $insert['thumbnail'] != '') {
                if ($this->Common_Model->insert('courses', $insert)) {
                    $response['status'] = 1;
                    $response['responseMessage'] = $this->Common_Model->success('Course added successfully.');
                }
            } else {
                $response['status'] = 2;
                $response['responseMessage'] = $this->Common_Model->error('Thumbnail is missing.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }

    private function create_course()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('course_link', 'course_link', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');
        // $this->form_validation->set_rules('thumbnail', 'thumbnail', 'required');
        $this->form_validation->set_rules('thumbnail_type', 'thumbnail_type', 'required');
        $this->form_validation->set_rules('short_description', 'short_description', 'required');
        $this->form_validation->set_rules('detailed_description', 'detailed_description', 'required');
        $this->form_validation->set_rules('ratings', 'ratings', 'required');
        $this->form_validation->set_rules('enrolled', 'enrolled', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $course = [
            'title' => $this->input->post('title'),
            'course_link' => $this->input->post('course_link'),
            'type' => $this->input->post('type'),
            'category' => $this->input->post('category'),
            'thumbnail_type' => $this->input->post('thumbnail_type'),
            'thumbnail' => null,
            'short_description' => $this->input->post('short_description'),
            'detailed_description' => $this->input->post('detailed_description'),
            'ratings' => $this->input->post('ratings'),
            'enrolled' => $this->input->post('enrolled'),
            'price' => $this->input->post('price'),
            'updated' => date("Y-m-d H:i:s")
        ];
        return $course;
    }

    public function delete_course()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $this->form_validation->set_rules('delete_course_id', 'delete_course_id', 'required');
        if ($this->form_validation->run()) {
            $where['id'] = $this->input->post('delete_course_id');
            $courseDetails = $this->Common_Model->fetch_records('courses', $where, false, true);
            if ($courseDetails['thumbnail_type'] == 1) {
                if (file_exists($courseDetails['thumbnail'])) unlink($courseDetails['thumbnail']);
            }
            if ($this->Common_Model->delete('courses', $where)) {
                $response['status'] = 1;
                $response['responseMessage'] = $this->Common_Model->success('Course deleted successfully.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }

    public function get_course($courseId)
    {
        $where['id'] = $courseId;
        $pageData['courseDetails'] = $this->Common_Model->fetch_records('courses', $where, false, true);
        $pageData['categories'] = [];
        $categories = $this->Common_Model->fetch_records('categories');
        foreach ($categories as $category) {
            $pageData['categories'][$category['id']] = $category;
        }

        $this->load->view('admin/include/course_details', $pageData);
    }

    public function update_course()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
        $update = $this->create_course();
        if ($this->form_validation->run()) {
            $where['id'] = $this->input->post('course_id');
            if ($update['thumbnail_type'] == 1) {
                if ($_FILES['thumbnail']['error'] == 0) {
                    $courseDetails = $this->Common_Model->fetch_records('courses', $where, false, true);
                    if (file_exists($courseDetails['thumbnail'])) unlink($courseDetails['thumbnail']);
                    $config['upload_path'] = "assets/site/thumbnails/";
                    $config['allowed_types'] = 'jpeg|gif|jpg|png';
                    $config['encrypt_name'] = true;
                    $this->load->library("upload", $config);
                    if ($this->upload->do_upload('thumbnail')) {
                        $update['thumbnail'] = $config['upload_path'] . $this->upload->data("file_name");;
                    } else {
                        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
                    }
                }else{
                    unset($update['thumbnail']);
                }
            } else if ($update['thumbnail_type'] == 2) {
                $oldThumbnailType = $this->input->post('course_type');
                $oldThumbnail = $this->input->post('old_thumbnail');
                if($oldThumbnailType == 1){
                    if(file_exists($oldThumbnail)) unlink($oldThumbnail);
                }
                $update['thumbnail'] = $this->input->post('thumbnail');
            }
            if (array_key_exists('thumbnail', $update) && ($update['thumbnail'] == null && $update['thumbnail'] == '') ) {
                $response['status'] = 2;
                $response['responseMessage'] = $this->Common_Model->error('Thumbnail is missing.');
            } else {
                if ($this->Common_Model->update('courses', $where, $update)) {
                    $response['status'] = 1;
                    $response['responseMessage'] = $this->Common_Model->success('Course updated successfully.');
                }
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
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
