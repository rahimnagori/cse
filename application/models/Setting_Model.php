<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

    public function saveSliderData($data) {
        
       return  ($this->db->update('setting', $data,['id' => $data['id']])) ? true : false;
        
    }

    public function getSliderData() {
        $query = $this->db->get('setting');
        return $query->result_array();
    }

    // ... other methods ...
}