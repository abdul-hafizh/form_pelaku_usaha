<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aset_m extends CI_Model {

	public function __construct(){

		parent::__construct();

	}

	public function do_upload($name) {	
        if(!$this->upload->do_upload($name)) 
        {

            $this->upload->display_errors();

        }
        return $this->upload->data('file_name');
    }

}