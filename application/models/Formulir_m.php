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

	public function getFormulirSrv($user = 0){
		
		if($user > 0) {
			$this->db->where('formulir_surveyor.id_surveyor', $user);
		}
		$this->db->select('formulir.*');
		$this->db->join('formulir_surveyor', 'formulir_surveyor.id_formulir = formulir.id', 'left');
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
	
	public function getProvinsi(){
		
		$this->db->where('level', 2);
		$this->db->where('regency_name IS NULL', null, true);
		$this->db->order_by('province_name', 'asc');

		return $this->db->get('adm_ref_locations');

	}

	public function getKabupaten(){
		
		$this->db->where('level', 3);
		$this->db->where('regency_name IS NOT NULL', null, false);
		$this->db->order_by('regency_name', 'asc');

		return $this->db->get('adm_ref_locations');

	}

	public function getSurveyor(){

		$this->db->order_by('id', 'desc');
		$this->db->where('adm_pos_id', 4);
		return $this->db->get('adm_employee');

	}

}
