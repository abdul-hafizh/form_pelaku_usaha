<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulir extends Telescoope_Controller {

	var $data;

    public function __construct(){

        // Call the Model constructor
        parent::__construct();

        $this->load->model(array('Formulir_m'));

        $this->load->library('session');

        $this->data['data'] = array();

        $this->data['date_format'] = "h:i A | d M Y";

        $this->form_validation->set_error_delimiters('<div class="help-block">', '</div>');

        $userdata = $this->Administration_m->getLogin();

        $this->data['post'] = $this->input->post();

        $this->data['dir'] = 'formulir';

        $this->data['controller_name'] = $this->uri->segment(1);

        $dir = './uploads/'.$this->data['dir'];

        $this->session->set_userdata("module",$this->data['dir']);

        if (!file_exists($dir)){
            mkdir($dir, 0777, true);
        }

        $config['allowed_types'] = '*';
        $config['overwrite'] = false;
        $config['max_size'] = 1024 * 500;
        $config['upload_path'] = $dir;
        $this->load->library('upload', $config);
        $this->load->model("Global_m");
        $this->data['userdata'] = (!empty($userdata)) ? $userdata : array();

        $sess = $this->session->userdata(do_hash(SESSION_PREFIX));

        if(empty($sess)){
            redirect(site_url('log/in'));
        }

    }

    public function index(){

        $data = array();

        $position = $this->Administration_m->getPosition("ADMINISTRATOR");

        $data['list_formulir'] = $this->Formulir_m->getFormulir($this->data['userdata']['employee_id'])->result_array();

        if($position){
            
            $data['list_formulir'] = $this->Formulir_m->getFormulir()->result_array();
        }


		$this->template("formulir/list_formulir_v", "List Formulir", $data);
    }

    public function tambah_data(){

        $data = array();

        $position = $this->Administration_m->getPosition("ENUM");

        if(!$position){
            $this->noAccess("Hanya ENUM yang dapat mengubah data.");
        }

        $data['kabupaten'] = $this->Formulir_m->getKabupaten()->result_array();

		$this->template("formulir/add_formulir_v", "Tambah Data Pelaku Usaha", $data);
    }

    public function edit_data($id){

        $data = array();

        $position = $this->Administration_m->getPosition("ENUM");

        if(!$position){
            $this->noAccess("Hanya ENUM yang dapat mengubah data.");
        }

        $data['detail'] = $this->Formulir_m->getDetail($id, $this->data['userdata']['employee_id'])->row_array();
        $data['kabupaten'] = $this->Formulir_m->getKabupaten()->result_array();

		$this->template("formulir/edit_formulir_v", "Edit Data Pelaku Usaha", $data);
    }

    public function detail_data($id){

        $data = array();

        $position = $this->Administration_m->getPosition("ADMINISTRATOR");

        $data['detail'] = $this->Formulir_m->getDetail($id, $this->data['userdata']['employee_id'])->row_array();

        if($position){
            
            $data['detail'] = $this->Formulir_m->getDetail($id)->row_array();
        }

		$this->template("formulir/detail_formulir_v", "Detail Data Pelaku Usaha", $data);
    }

    public function submit_formulir(){

        $post = $this->input->post(); 

        $this->db->trans_begin();

        $dir = './uploads/' . $this->data['dir'];

        if(!empty($_FILES['foto_ktp']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_ktp_' . date('his') . '_' . $_FILES['foto_ktp']['name'];
            $_FILES['file']['type'] = $_FILES['foto_ktp']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_ktp']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_ktp']['error'];
            $_FILES['file']['size'] = $_FILES['foto_ktp']['size'];
            if($this->upload->do_upload('file')){ $uploadKtp = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk1']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod1_' . date('his') . '_' . $_FILES['foto_produk1']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk1']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk1']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk1']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk1']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk1 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk2']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod2_' . date('his') . '_' . $_FILES['foto_produk2']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk2']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk2']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk2']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk2']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk2 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk3']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod3_' . date('his') . '_' . $_FILES['foto_produk3']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk3']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk3']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk3']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk3']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk3 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk4']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod4_' . date('his') . '_' . $_FILES['foto_produk4']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk4']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk4']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk4']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk4']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk4 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk5']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod5_' . date('his') . '_' . $_FILES['foto_produk5']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk5']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk5']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk5']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk5']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk5 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk6']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod6_' . date('his') . '_' . $_FILES['foto_produk6']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk6']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk6']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk6']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk6']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk6 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk7']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod7_' . date('his') . '_' . $_FILES['foto_produk7']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk7']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk7']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk7']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk7']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk7 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk8']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod8_' . date('his') . '_' . $_FILES['foto_produk8']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk8']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk8']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk8']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk8']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk8 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk9']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod9_' . date('his') . '_' . $_FILES['foto_produk9']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk9']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk9']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk9']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk9']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk9 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk10']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod10_' . date('his') . '_' . $_FILES['foto_produk10']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk10']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk10']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk10']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk10']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk10 = $this->upload->data(); }
        }

        $data = array(
            'nama_pelaku_usaha' => $post['nama_pelaku_usaha'],
            'nik' => $post['nik'],
            'no_telp' => $post['no_telp'],
            'email' => $post['email'],
            'no_npwp' => $post['no_npwp'],
            'no_nib' => $post['no_nib'],
            'nama_produk' => $post['nama_produk'],
            'jenis_produk' => $post['jenis_produk'],
            'kbli' => $post['kbli'],
            'kabupaten' => $post['kabupaten'],
            'alamat_produksi' => $post['alamat_produksi'],
            'alamat_outlet' => $post['alamat_outlet'],
            'foto_ktp' => isset($uploadKtp['file_name']) ? $uploadKtp['file_name'] : '',
            'foto_produk1' => isset($uploadProduk1['file_name']) ? $uploadProduk1['file_name'] : '',
            'foto_produk2' => isset($uploadProduk2['file_name']) ? $uploadProduk2['file_name'] : '',
            'foto_produk3' => isset($uploadProduk3['file_name']) ? $uploadProduk3['file_name'] : '',
            'foto_produk4' => isset($uploadProduk4['file_name']) ? $uploadProduk4['file_name'] : '',
            'foto_produk5' => isset($uploadProduk5['file_name']) ? $uploadProduk5['file_name'] : '',
            'foto_produk6' => isset($uploadProduk6['file_name']) ? $uploadProduk6['file_name'] : '',
            'foto_produk7' => isset($uploadProduk7['file_name']) ? $uploadProduk7['file_name'] : '',
            'foto_produk8' => isset($uploadProduk8['file_name']) ? $uploadProduk8['file_name'] : '',
            'foto_produk9' => isset($uploadProduk9['file_name']) ? $uploadProduk9['file_name'] : '',
            'foto_produk10' => isset($uploadProduk10['file_name']) ? $uploadProduk10['file_name'] : '',
            'desc_produk1' => $post['desc_produk1'],
            'desc_produk2' => $post['desc_produk2'],
            'desc_produk3' => $post['desc_produk3'],
            'desc_produk4' => $post['desc_produk4'],
            'desc_produk5' => $post['desc_produk5'],
            'desc_produk6' => $post['desc_produk6'],
            'desc_produk7' => $post['desc_produk7'],
            'desc_produk8' => $post['desc_produk8'],
            'desc_produk9' => $post['desc_produk9'],
            'desc_produk10' => $post['desc_produk10'],
            'tanggal_input' => date('Y-m-d H:i:s'),
            'user_id' => $this->data['userdata']['employee_id']
        );

        $simpan = $this->db->insert('formulir', $data);
        
        if($simpan){
            
            if ($this->db->trans_status() === FALSE)  {
                $this->setMessage("Failed save data.");
                $this->db->trans_rollback();
            } else {
                $this->setMessage("Success save data.");
                $this->db->trans_commit();
            }            

            redirect(site_url('formulir/tambah_data'));
        
        } else {
            $this->renderMessage("error");
        }
    }

    public function update_formulir(){

        $post = $this->input->post(); 

        $this->db->trans_begin();

        $dir = './uploads/' . $this->data['dir'];

        if(!empty($_FILES['foto_ktp']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_ktp_' . date('his') . '_' . $_FILES['foto_ktp']['name'];
            $_FILES['file']['type'] = $_FILES['foto_ktp']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_ktp']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_ktp']['error'];
            $_FILES['file']['size'] = $_FILES['foto_ktp']['size'];
            if($this->upload->do_upload('file')){ $uploadKtp = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk1']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod1_' . date('his') . '_' . $_FILES['foto_produk1']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk1']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk1']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk1']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk1']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk1 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk2']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod2_' . date('his') . '_' . $_FILES['foto_produk2']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk2']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk2']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk2']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk2']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk2 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk3']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod3_' . date('his') . '_' . $_FILES['foto_produk3']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk3']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk3']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk3']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk3']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk3 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk4']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod4_' . date('his') . '_' . $_FILES['foto_produk4']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk4']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk4']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk4']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk4']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk4 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk5']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod5_' . date('his') . '_' . $_FILES['foto_produk5']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk5']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk5']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk5']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk5']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk5 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk6']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod6_' . date('his') . '_' . $_FILES['foto_produk6']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk6']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk6']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk6']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk6']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk6 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk7']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod7_' . date('his') . '_' . $_FILES['foto_produk7']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk7']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk7']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk7']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk7']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk7 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk8']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod8_' . date('his') . '_' . $_FILES['foto_produk8']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk8']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk8']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk8']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk8']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk8 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk9']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod9_' . date('his') . '_' . $_FILES['foto_produk9']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk9']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk9']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk9']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk9']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk9 = $this->upload->data(); }
        }

        if(!empty($_FILES['foto_produk10']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod10_' . date('his') . '_' . $_FILES['foto_produk10']['name'];
            $_FILES['file']['type'] = $_FILES['foto_produk10']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_produk10']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_produk10']['error'];
            $_FILES['file']['size'] = $_FILES['foto_produk10']['size'];
            if($this->upload->do_upload('file')){ $uploadProduk10 = $this->upload->data(); }
        }

        $row_data = $this->Formulir_m->getDetail($post['id_form'], $this->data['userdata']['employee_id'])->row_array();

        $data = array(
            'nama_pelaku_usaha' => $post['nama_pelaku_usaha'],
            'nik' => $post['nik'],
            'no_telp' => $post['no_telp'],
            'email' => $post['email'],
            'no_npwp' => $post['no_npwp'],
            'no_nib' => $post['no_nib'],
            'nama_produk' => $post['nama_produk'],
            'jenis_produk' => $post['jenis_produk'],
            'kbli' => $post['kbli'],
            'kabupaten' => $post['kabupaten'],
            'alamat_produksi' => $post['alamat_produksi'],
            'alamat_outlet' => $post['alamat_outlet'],
            'foto_ktp' => isset($uploadKtp['file_name']) ? $uploadKtp['file_name'] : '',
            'foto_produk1' => isset($uploadProduk1['file_name']) ? $uploadProduk1['file_name'] : $row_data['foto_produk1'],
            'foto_produk2' => isset($uploadProduk2['file_name']) ? $uploadProduk2['file_name'] : $row_data['foto_produk2'],
            'foto_produk3' => isset($uploadProduk3['file_name']) ? $uploadProduk3['file_name'] : $row_data['foto_produk3'],
            'foto_produk4' => isset($uploadProduk4['file_name']) ? $uploadProduk4['file_name'] : $row_data['foto_produk4'],
            'foto_produk5' => isset($uploadProduk5['file_name']) ? $uploadProduk5['file_name'] : $row_data['foto_produk5'],
            'foto_produk6' => isset($uploadProduk6['file_name']) ? $uploadProduk6['file_name'] : $row_data['foto_produk6'],
            'foto_produk7' => isset($uploadProduk7['file_name']) ? $uploadProduk7['file_name'] : $row_data['foto_produk7'],
            'foto_produk8' => isset($uploadProduk8['file_name']) ? $uploadProduk8['file_name'] : $row_data['foto_produk8'],
            'foto_produk9' => isset($uploadProduk9['file_name']) ? $uploadProduk9['file_name'] : $row_data['foto_produk9'],
            'foto_produk10' => isset($uploadProduk10['file_name']) ? $uploadProduk10['file_name'] : $row_data['foto_produk10'],
            'desc_produk1' => $post['desc_produk1'],
            'desc_produk2' => $post['desc_produk2'],
            'desc_produk3' => $post['desc_produk3'],
            'desc_produk4' => $post['desc_produk4'],
            'desc_produk5' => $post['desc_produk5'],
            'desc_produk6' => $post['desc_produk6'],
            'desc_produk7' => $post['desc_produk7'],
            'desc_produk8' => $post['desc_produk8'],
            'desc_produk9' => $post['desc_produk9'],
            'desc_produk10' => $post['desc_produk10'],
            'tanggal_update' => date('Y-m-d H:i:s'),
            'update_by' => $this->data['userdata']['employee_id']
        );

        $this->db->where('id', $post['id_form']);
        $simpan = $this->db->update('formulir', $data);
        
        if($simpan){
            
            if ($this->db->trans_status() === FALSE)  {
                $this->setMessage("Failed update data.");
                $this->db->trans_rollback();
            } else {
                $this->setMessage("Success update data.");
                $this->db->trans_commit();
            }            

            redirect(site_url('formulir/edit_data/' . $post['id_form']));
        
        } else {
            $this->renderMessage("error");
        }
    }

    public function delete_formulir($id){        

        $this->db->trans_begin();    

        $this->db->where('id', $id);
        $result = $this->db->delete('formulir');
        
        if($result){
            
            if ($this->db->trans_status() === FALSE)  {
                $this->setMessage("Failed delete data.");
                $this->db->trans_rollback();
            } else {
                $this->setMessage("Success delete data.");
                $this->db->trans_commit();
            }            

            redirect(site_url('formulir'));
        
        } else {
            $this->renderMessage("error");
        }
    }

}