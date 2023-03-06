<?php
class Common_Model extends CI_Model
{
  function join_records($table, $joins, $where = false, $select = '*', $ob = false, $obc = 'DESC', $groupBy = false)
  {
    /* https://github.com/rahimnagori/cheat-sheet/blob/master/ci_dynamic_join.php */
    $this->db->select($select);
    $this->db->from($table);
    foreach ($joins as $join) {
      $this->db->join($join[0], $join[1], $join[2]);
    }
    if ($where) $this->db->where($where);
    if ($groupBy) $this->db->group_by($groupBy);
    if ($ob) $this->db->order_by($ob, $obc);
    $query = $this->db->get();
    return $query->result_array();
  }

  function fetch_records($table, $where = false, $select = false, $singleRecords = false, $orderBy = false, $orderDirection = 'DESC', $groupBy = false, $where_in_key = false, $where_in_value = false, $limit = false, $start = 0)
  {
    if ($where) $this->db->where($where);
    if ($where_in_key) $this->db->where_in($where_in_key, $where_in_value);
    if ($select) $this->db->select($select);
    if ($groupBy) $this->db->group_by($groupBy);
    if ($orderBy) $this->db->order_by($orderBy, $orderDirection);
    if ($limit) $this->db->limit($limit, $start);
    $query = $this->db->get($table);
    return ($singleRecords) ? $query->row_array() : $query->result_array();
  }

  public function get_user($where)
  {
    $this->db->or_where('username', $where);
    $this->db->or_where('email', $where);
    $query = $this->db->get('users');
    return $query->row_array();
  }

  public function get_admin($where)
  {
    // $this->db->where('username', $where);
    $this->db->where('email', $where);
    $query = $this->db->get('admins');
    return $query->row_array();
  }

  public function update($table, $where, $updateData)
  {
    $this->db->where($where);
    return $this->db->update($table, $updateData) ? true : false;
  }

  public function insert($table, $data)
  {
    return ($this->db->insert($table, $data)) ? $this->db->insert_id() : false;
  }

  public function delete($table, $where)
  {
    $this->db->where($where);
    $delete = $this->db->delete($table);
    return $delete ? true : false;
  }

  public function success($message)
  {
    return '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $message . '</div>';
  }

  public function error($message)
  {
    return '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $message . '</div>';
  }

  public function history($message)
  {
    $insert['user_id'] = ($this->session->userdata('id')) ? $this->session->userdata('id') : 0;
    $insert['action'] = $message;
    $this->insert('histories', $insert);
  }

  public function send_mail($to, $subject, $body, $bcc = false, $attachments = [])
  {
    $settings = $this->fetch_records('emails', array('id' => 1), 'default_email', true);
    $this->load->library('parser');
    $response['status'] = 0;
    $PROJECT = $this->config->item('PROJECT');
    $config = array();
    $config['mailtype'] = "html";
    $config['charset'] = "utf-8";
    $config['newline'] = "\r\n";
    $config['wordwrap'] = TRUE;
    $config['validate'] = FALSE;

    $this->load->library('email', $config);
    $this->email->initialize($config);

    $this->email->set_header("MIME-Version", "1.0");
    $this->email->set_header("Reply-To", $settings['default_email']);
    $this->email->set_header("X-Mailer", "PHP/" . phpversion());

    $this->email->from($settings['default_email'], 'Admin');
    $this->email->to($to);
    $this->email->set_crlf("\r\n");
    $this->email->subject($subject);

    if ($bcc) {
      $this->email->bcc($bcc);
    }

    $pageData['body'] = $body;
    $pageData['PROJECT'] = $PROJECT;
    $msg = $this->load->view('site/include/email_template', $pageData, true);
    // $this->load->view('site/include/email_template', $pageData); /* Debug */

    if (!empty($attachments)) {
      /* It accepts absolute path ex: site_url('/assets.../filename') */
      foreach ($attachments as $attachment) {
        if (is_array($attachment)) {
          $this->email->attach($attachment['path'], 'attachment', $attachment['filename']);
        } else {
          $this->email->attach($attachment);
        }
      }
    }
    $this->email->message($msg);
    try {
      $this->email->send();
      $response['status'] = 1;
    } catch (Exception $e) {
      $response['responseMessage'] = $e->getMessage();
      $response['status'] = 2;
    }
    return $response;
  }

  public function generate_password($passwordLength)
  {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i <= $passwordLength; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass);
  }

  public function generate_username($userdata)
  {
    $totalUsers = count($this->fetch_records('users')) + 1;
    return $userdata['first_name'] . $totalUsers . $this->generate_password(4);
  }

  public function getAdmin($adminId)
  {
    $where['id'] = $adminId;
    $pageData['adminData'] = $this->fetch_records('admins', $where, false, true);
    return $pageData;
  }

  public function get_userdata()
  {
    $pageData['emails'] = $this->Common_Model->fetch_records('emails', false, false, true);
    $pageData['upcomingCourses'] = $this->Common_Model->fetch_records('upcoming_courses', array('type' => 0));
    $pageData['youtubePlaylists'] = $this->Common_Model->fetch_records('upcoming_courses', array('type' => 1));
    $pageData['urls'] = $this->Common_Model->fetch_records('urls', array('id' => 1), false, true);
    $pageData['isFreeCategoryActive'] = $this->Common_Model->fetch_records('urls_new', false, 'input_value', true, false, false, false, 'input_name', 'free_category_active');
    $pageData['isPaidCategoryActive'] = $this->Common_Model->fetch_records('urls_new', false, 'input_value', true, false, false, false, 'input_name', 'paid_category_active');
    $pageData['isAllCategoryActive'] = $this->Common_Model->fetch_records('urls_new', false, 'input_value', true, false, false, false, 'input_name', 'all_category_active');
    return $pageData;
  }

  public function send_contact_form_to_admin($id)
  {
    $pageData = [];
    $pageData['userdata'] = $this->fetch_records('contact_requests', array('id' => $id), false, true);
    $subject = 'Received a new contact request.';
    $pageData['emailContent'] = "<p>Hello Admin, you have received a new contact request.";
    $body = $this->load->view('admin/include/contact_form', $pageData, true);
    $attachments = [];
    // if ($pageData['userdata']['resume'] != '' || $pageData['userdata']['resume'] != null) {
    //   $attachments[] = site_url($pageData['userdata']['resume']);
    // }
    $settings = $this->fetch_records('emails', array('id' => 1), 'default_email', true);
    if ($this->config->item('ENVIRONMENT') == 'production') {
      $this->send_mail($settings['default_email'], $subject, $body, false, $attachments);
    }
    /* $this->load->view('site/include/registration_form', $pageData); */
  }
}
