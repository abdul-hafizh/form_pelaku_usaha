<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulir_m extends CI_Model {

	public function __construct(){

		parent::__construct();

		$this->load->helper('security');

	}

	public function getFormulir($user = 0){
		
		if($user > 0) {
			$this->db->where('user_id', $user);
		}
		$this->db->order_by('id', 'desc');

		return $this->db->get('formulir');

	}

	public function getDetail($id, $user = 0){
		
		$this->db->where('id', $id);
		if($user > 0) {
			$this->db->where('user_id', $user);
		}

		return $this->db->get('formulir');

	}
	
	public function getKabupaten(){
		
		$this->db->order_by('regency_name', 'asc');

		return $this->db->get('vw_kabupaten');

	}

}
