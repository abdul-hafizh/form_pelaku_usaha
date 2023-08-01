<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulir_m extends CI_Model {

	public function __construct(){

		parent::__construct();

		$this->load->helper('security');

	}

	public function getFormulir($user = 0, $prov = "", $pend = 0, $stat = 0){
		
		$this->db->select('formulir.*, aa.pendamping_id, aa.fullname');

		if($user > 0) { $this->db->where('formulir.user_id', $user); }
		if(!empty($prov)) { $this->db->where('formulir.provinsi', $prov); }
		if($pend > 0) { $this->db->where('aa.pendamping_id', $pend); }
		if($stat > 0) { $this->db->where('formulir.status', $stat); }
		
		$this->db->order_by('id', 'desc');
		$this->db->join('adm_employee as aa', 'formulir.user_id = aa.id', 'left');		

		return $this->db->get('formulir');

	}

	public function getFormulirProv($user = 0){
		
		$this->db->distinct();
		$this->db->select('provinsi');
		if($user > 0) {
			$this->db->where('user_id', $user);
		}
		$this->db->where('provinsi IS NOT NULL', null, false);
		$this->db->order_by('provinsi', 'asc');

		return $this->db->get('formulir');

	}

	public function getFormulirPend($user = 0){
		
		$this->db->distinct();
		$this->db->select('aa.pendamping_id');
		if($user > 0) {
			$this->db->where('formulir.user_id', $user);
		}
		$this->db->join('adm_employee as aa', 'formulir.user_id = aa.id', 'left');		
		return $this->db->get('formulir');

	}

	public function getFormulirEksport(){
		
		$this->db->select('formulir.*, aa.fullname as nama_input, aa.phone as phone_input, bb.fullname as nama_update, bb.phone as phone_update, formulir_surveyor.username, formulir_surveyor.password');
		$this->db->join('adm_employee as aa', 'formulir.user_id = aa.id', 'left');
		$this->db->join('adm_employee as bb', 'formulir.update_by = bb.id', 'left');
		$this->db->join('formulir_surveyor', 'formulir_surveyor.id_formulir = formulir.id', 'left');		
		$this->db->order_by('formulir.id', 'desc');

		return $this->db->get('formulir');

	}

	public function getFormulirEksportSrv($user = ""){
		
		$this->db->select('formulir.*, aa.fullname as nama_input, aa.phone as phone_input, bb.fullname as nama_update, bb.phone as phone_update, formulir_surveyor.username, formulir_surveyor.password');
		$this->db->join('adm_employee as aa', 'formulir.user_id = aa.id', 'left');
		$this->db->join('adm_employee as bb', 'formulir.update_by = bb.id', 'left');
		$this->db->join('formulir_surveyor', 'formulir_surveyor.id_formulir = formulir.id', 'left');		
		$this->db->where('formulir_surveyor.id_surveyor', $user);
		$this->db->order_by('formulir.id', 'desc');

		return $this->db->get('formulir');

	}

	public function getFormulirSrv($user = 0){
		
		if($user > 0) {
			$this->db->where('aa.pendamping_id', $user);
		}
		$this->db->select('formulir.*, aa.fullname');
		$this->db->join('adm_employee as aa', 'formulir.user_id = aa.id', 'left');
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

	public function getFormSrv($id){
		
		$this->db->where('id_formulir', $id);	
		return $this->db->get('formulir_surveyor');

	}
	
	public function getProvinsi($pos = ""){

		if(!empty($pos)) {
			$this->db->where('province_name', $pos);
		}
		
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

	public function getSurveyor($id = ""){

		$this->db->order_by('id', 'desc');
		if(!empty($pend)){

			$this->db->where("id", $id);

		}
		$this->db->where('adm_pos_id', 4);
		return $this->db->get('adm_employee');

	}

}
