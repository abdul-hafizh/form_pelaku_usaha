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
        $config['max_size'] = 1024 * 50;
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

        $enum = $this->Administration_m->getPosition("ENUM");
        $srv = $this->Administration_m->getPosition("VIEWER");

        $data['provinsi'] = $this->Formulir_m->getFormulirProv($this->data['userdata']['employee_id'])->result_array();

        if(!$enum){            
            $data['provinsi'] = $this->Formulir_m->getFormulirProv()->result_array();
            $data['pendamping'] = $this->Formulir_m->getFormulirPend()->result_array();
        
        }
        if($srv){            
            $data['provinsi'] = $this->Formulir_m->getFormulirProv($this->data['userdata']['employee_id'])->result_array();
        }


		$this->template("formulir/list_formulir_v", "List Formulir", $data);
    }

    public function get_data(){
        $post = $this->input->post();     
        
        $draw = $post['draw'];
        $row = $post['start'];
        $rowperpage = $post['length']; 
        $search = $post['search']['value']; 
        $columnIndex = $post['order'][0]['column'];
        $columnName = $post['columns'][$columnIndex]['data'];
        $prov = isset($post['s_provinsi']) ? $post['s_provinsi'] : "";
        $pend = $post['s_pendamping'] > 0 ? $post['s_pendamping'] : 0;
        $stat = $post['s_status'] > 0 ? $post['s_status'] : 0;     
                
        $enum = $this->Administration_m->getPosition("ENUM");
        $srv = $this->Administration_m->getPosition("VIEWER");
        $pusat = $this->Administration_m->getPosition("KORWIL");

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_pelaku_usaha', $search);
            $this->db->or_like('kbli', $search);
            $this->db->or_like('nama_produk', $search);
            $this->db->or_like('jenis_produk', $search);
            $this->db->or_like('formulir.provinsi', $search);
            $this->db->or_like('fullname', $search);
            $this->db->group_end();
        }
        $this->db->limit($rowperpage, $row);
        $result = $this->Formulir_m->getFormulir($this->data['userdata']['employee_id'], $prov, $pend, $stat);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_pelaku_usaha', $search);
            $this->db->or_like('kbli', $search);
            $this->db->or_like('nama_produk', $search);
            $this->db->or_like('jenis_produk', $search);
            $this->db->or_like('formulir.provinsi', $search);
            $this->db->or_like('fullname', $search);
            $this->db->group_end();
        }
        $count = $this->Formulir_m->getFormulir($this->data['userdata']['employee_id'], $prov, $pend, $stat);

        if(!$enum){     
            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('nama_pelaku_usaha', $search);
                $this->db->or_like('kbli', $search);
                $this->db->or_like('nama_produk', $search);
                $this->db->or_like('jenis_produk', $search);
                $this->db->or_like('formulir.provinsi', $search);
                $this->db->or_like('fullname', $search);
                $this->db->group_end();
            }       
            $this->db->limit($rowperpage, $row);
            $result = $this->Formulir_m->getFormulir("", $prov, $pend, $stat);

            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('nama_pelaku_usaha', $search);
                $this->db->or_like('kbli', $search);
                $this->db->or_like('nama_produk', $search);
                $this->db->or_like('jenis_produk', $search);
                $this->db->or_like('formulir.provinsi', $search);
                $this->db->or_like('fullname', $search);
                $this->db->group_end();
            }
            $count = $this->Formulir_m->getFormulir("", $prov, $pend, $stat);
        }

        if($srv){            
            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('nama_pelaku_usaha', $search);
                $this->db->or_like('kbli', $search);
                $this->db->or_like('nama_produk', $search);
                $this->db->or_like('jenis_produk', $search);
                $this->db->or_like('formulir.provinsi', $search);
                $this->db->or_like('fullname', $search);
                $this->db->group_end();
            }
            $this->db->limit($rowperpage, $row);
            $result = $this->Formulir_m->getFormulirSrv($this->data['userdata']['employee_id'], $prov, $pend, $stat);

            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('nama_pelaku_usaha', $search);
                $this->db->or_like('kbli', $search);
                $this->db->or_like('nama_produk', $search);
                $this->db->or_like('jenis_produk', $search);
                $this->db->or_like('formulir.provinsi', $search);
                $this->db->or_like('fullname', $search);
                $this->db->group_end();
            }
            $count = $this->Formulir_m->getFormulirSrv($this->data['userdata']['employee_id'], $prov, $pend, $stat);
        }  

        if($pusat){            
            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('nama_pelaku_usaha', $search);
                $this->db->or_like('kbli', $search);
                $this->db->or_like('nama_produk', $search);
                $this->db->or_like('jenis_produk', $search);
                $this->db->or_like('formulir.provinsi', $search);
                $this->db->or_like('fullname', $search);
                $this->db->group_end();
            }
            $this->db->limit($rowperpage, $row);
            $result = $this->Formulir_m->getFormulirPusat($this->data['userdata']['employee_id'], $prov, $pend, $stat);

            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('nama_pelaku_usaha', $search);
                $this->db->or_like('kbli', $search);
                $this->db->or_like('nama_produk', $search);
                $this->db->or_like('jenis_produk', $search);
                $this->db->or_like('formulir.provinsi', $search);
                $this->db->or_like('fullname', $search);
                $this->db->group_end();
            }
            $count = $this->Formulir_m->getFormulirPusat($this->data['userdata']['employee_id'], $prov, $pend, $stat);
        }                    

        $totalRecords = $count->num_rows();
        $totalRecordwithFilter = $count->num_rows();

        $data = array();
        
        foreach($result->result_array() as $v) {
            $idpnd = $this->db->select('pendamping_id')->where('id', $v['user_id'])->get('adm_employee')->row_array(); $namapnd = $this->db->select('fullname')->where('id', $idpnd['pendamping_id'])->get('adm_employee')->row_array();
            $status_app = '<span class="badge bg-danger">Belum Diapprove</span>'; if ($v['status'] == 2) { $status_app = '<span class="badge bg-success">Sudah Diapprove</span>'; } elseif ($v['status'] == 3) { $status_app = '<span class="badge bg-info">Tidak Diapprove</span>'; }
            $foto_ktp ='<a href="' . base_url('uploads/formulir/' . $v['foto_ktp']) . '" target="_blank" class="avatar-group-item" data-img="' . base_url('uploads/formulir/' . $v['foto_ktp']) . '" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Foto Ktp">
                            <img src="' . base_url('uploads/formulir/' . $v['foto_ktp']) . '" alt="" class="rounded-circle avatar-xxs">
                        </a>';
            $foto_prod1 ='<a href="' . base_url('uploads/formulir/' . $v['foto_produk1']) . '" target="_blank" class="avatar-group-item" data-img="' . base_url('uploads/formulir/' . $v['foto_produk1']) . '" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Foto Produk 1">
                            <img src="' . base_url('uploads/formulir/' . $v['foto_produk1']) . '" alt="" class="rounded-circle avatar-xxs">
                        </a>';      

            if(!empty($v['foto_produk2'])) {
                $foto_prod2 ='<a href="' . base_url('uploads/formulir/' . $v['foto_produk2']) . '" target="_blank" class="avatar-group-item" data-img="' . base_url('uploads/formulir/' . $v['foto_produk2']) . '" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Foto Produk 2">
                            <img src="' . base_url('uploads/formulir/' . $v['foto_produk2']) . '" alt="" class="rounded-circle avatar-xxs">
                        </a>'; 
            } else $foto_prod2 = '';
                        
            if(!empty($v['foto_produk3'])) {
                $foto_prod3 ='<a href="' . base_url('uploads/formulir/' . $v['foto_produk3']) . '" target="_blank" class="avatar-group-item" data-img="' . base_url('uploads/formulir/' . $v['foto_produk3']) . '" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Foto Produk 3">
                                <img src="' . base_url('uploads/formulir/' . $v['foto_produk3']) . '" alt="" class="rounded-circle avatar-xxs">
                            </a>';        
            } else $foto_prod3 = '';
            
            if($v['status'] != 2 && $this->data['userdata']['pos_name'] == 'ENUM') {

                $action = '<div class="btn-group" role="group">
                        <a href="' .  site_url('formulir/detail_data/' . $v['id']) . '" class="btn btn-sm btn-info">View</a>
                        <a href="' . site_url('formulir/edit_data/' . $v['id']) . '" class="btn btn-sm btn-warning">Edit</a>
                    </div>';

            } else {
                $action = '<div class="btn-group" role="group">
                        <a href="' .  site_url('formulir/detail_data/' . $v['id']) . '" class="btn btn-sm btn-info">View</a>                        
                    </div>';
            }

            $data[] = array(
                "nama_pelaku_usaha" => $v['nama_pelaku_usaha'],
                "kbli" => $v['kbli'],
                "nama_produk" => $v['nama_produk'],
                "jenis_produk" => $v['jenis_produk'],
                "provinsi" => $v['provinsi'],
                "petugas" => $v['fullname'],
                "pendamping" => $namapnd['fullname'],
                "status_app" => $status_app,
                "status_pend" => $v['status_pendamping'] == 2 ? '<span class="badge bg-success">Selesai Pendamping</span>' : '<span class="badge bg-danger">Belum Selesai</span>',
                "foto" => '<div class="avatar-group">' . $foto_ktp . $foto_prod1 . $foto_prod2 . $foto_prod3 . '</div>',
                "action" => $action
            );
        }
        
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        
        echo json_encode($response);
    }

    public function tambah_data(){

        $data = array();

        $position = $this->Administration_m->getPosition("ENUM");

        $this->db->select('id');
        $this->db->from('adm_employee');
        $this->db->where('id >=', 780);
        $query = $this->db->get();

        $list_ids = array();

        foreach ($query->result_array() as $row) {
            $list_ids[] = $row['id'];
        }
        
        if (!in_array($this->data['userdata']['employee_id'], $list_ids)) {
            $this->noAccess("Maaf, pengisian data sudah ditutup.");
        }

        if(!$position){
            $this->noAccess("Hanya Petugas yang dapat mengubah data.");
        }

        $data['kabupaten'] = $this->Formulir_m->getKabupaten()->result_array();
        $data['provinsi'] = $this->Formulir_m->getProvinsi()->result_array();

		$this->template("formulir/add_formulir_v", "Tambah Data Pelaku Usaha", $data);
    }

    public function edit_data($id){

        $data = array();

        $position = $this->Administration_m->getPosition("ENUM");

        if(!$position){
            $this->noAccess("Hanya Petugas yang dapat mengubah data.");
        }

        $data['detail'] = $this->Formulir_m->getDetail($id, $this->data['userdata']['employee_id'])->row_array();
        $data['kabupaten'] = $this->Formulir_m->getKabupaten()->result_array();
        $data['provinsi'] = $this->Formulir_m->getProvinsi()->result_array();

		$this->template("formulir/edit_formulir_v", "Edit Data Pelaku Usaha", $data);
    }

    public function detail_data($id){

        $data = array();

        $position = $this->Administration_m->getPosition("ENUM");

        $data['detail'] = $this->Formulir_m->getDetail($id, $this->data['userdata']['employee_id'])->row_array();        
        $data['surveyor'] = $this->Formulir_m->getSurveyor()->result_array();
        $data['form_srv'] = $this->Formulir_m->getFormSrv($id)->row_array();

        if(!$position){
            
            $data['detail'] = $this->Formulir_m->getDetail($id)->row_array();
            $data['pendamping'] = $this->db->get_where('adm_employee', ['id' => $data['detail']['user_id']])->row_array();
        }

        $pusat = $this->db->select('fullname')->join('task', 'adm_employee.id = task.user_id', 'left')->where('task.formulir_id', $data['detail']['id'])->get('adm_employee')->row_array();

        $data['pusat'] = $pusat != NULL ? " | " . $pusat['fullname'] : "";

		$this->template("formulir/detail_formulir_v", "Detail Data Pelaku Usaha", $data);
    }

    public function submit_formulir(){

        $post = $this->input->post(); 

        if (count($post) == 0) {
            $this->setMessage("Isi data dengan Benar.");
            redirect(site_url('formulir/tambah_data'));
        }

        $this->db->trans_begin();

        $dir = './uploads/' . $this->data['dir'];

        // start upload 

            if(!empty($_FILES['foto_ktp']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_ktp_' . date('his') . '_' . $_FILES['foto_ktp']['name'];
                $_FILES['file']['type'] = $_FILES['foto_ktp']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_ktp']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_ktp']['error'];
                $_FILES['file']['size'] = $_FILES['foto_ktp']['size'];
                if($this->upload->do_upload('file')){ $uploadKtp = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk1']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod1_' . date('his') . '_' . $post['produk1_inp'] . '_' . $post['desc_produk1'] . '_' . $_FILES['foto_produk1']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk1']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk1']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk1']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk1']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk1 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk1_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod1_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk1_2']) ? $post['desc_produk1_2'] . '_' . $_FILES['foto_produk1_2']['name'] : $_FILES['foto_produk1_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk1_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk1_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk1_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk1_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk1_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk1_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod1_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk1_3']) ? $post['desc_produk1_3'] . '_' . $_FILES['foto_produk1_3']['name'] : $_FILES['foto_produk1_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk1_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk1_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk1_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk1_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk1_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod2_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk2']) ? $post['desc_produk2'] . '_' . $_FILES['foto_produk2']['name'] : $_FILES['foto_produk2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk2_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod2_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk2_2']) ? $post['desc_produk2_2'] . '_' . $_FILES['foto_produk2_2']['name'] : $_FILES['foto_produk2_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk2_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk2_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk2_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk2_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk2_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk2_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod2_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk2_3']) ? $post['desc_produk2_3'] . '_' . $_FILES['foto_produk2_3']['name'] : $_FILES['foto_produk2_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk2_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk2_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk2_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk2_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk2_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod3_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk3']) ? $post['desc_produk3'] . '_' . $_FILES['foto_produk3']['name'] : $_FILES['foto_produk3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk3_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod3_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk3_2']) ? $post['desc_produk3_2'] . '_' . $_FILES['foto_produk3_2']['name'] : $_FILES['foto_produk3_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk3_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk3_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk3_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk3_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk3_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk3_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod3_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk3_3']) ? $post['desc_produk3_3'] . '_' . $_FILES['foto_produk3_3']['name'] : $_FILES['foto_produk3_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk3_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk3_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk3_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk3_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk3_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk4']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod4_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk4']) ? $post['desc_produk4'] . '_' . $_FILES['foto_produk4']['name'] : $_FILES['foto_produk4']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk4']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk4']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk4']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk4']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk4 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk4_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod4_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk4_2']) ? $post['desc_produk4_2'] . '_' . $_FILES['foto_produk4_2']['name'] : $_FILES['foto_produk4_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk4_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk4_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk4_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk4_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk4_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk4_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod4_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk4_3']) ? $post['desc_produk4_3'] . '_' . $_FILES['foto_produk4_3']['name'] : $_FILES['foto_produk4_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk4_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk4_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk4_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk4_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk4_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk5']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod5_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk5']) ? $post['desc_produk5'] . '_' . $_FILES['foto_produk5']['name'] : $_FILES['foto_produk5']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk5']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk5']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk5']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk5']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk5 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk5_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod5_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk5_2']) ? $post['desc_produk5_2'] . '_' . $_FILES['foto_produk5_2']['name'] : $_FILES['foto_produk5_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk5_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk5_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk5_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk5_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk5_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk5_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod5_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk5_3']) ? $post['desc_produk5_3'] . '_' . $_FILES['foto_produk5_3']['name'] : $_FILES['foto_produk5_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk5_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk5_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk5_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk5_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk5_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk6']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod6_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk6']) ? $post['desc_produk6'] . '_' . $_FILES['foto_produk6']['name'] : $_FILES['foto_produk6']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk6']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk6']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk6']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk6']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk6 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk6_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod6_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk6_2']) ? $post['desc_produk6_2'] . '_' . $_FILES['foto_produk6_2']['name'] : $_FILES['foto_produk6_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk6_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk6_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk6_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk6_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk6_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk6_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod6_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk6_3']) ? $post['desc_produk6_3'] . '_' . $_FILES['foto_produk6_3']['name'] : $_FILES['foto_produk6_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk6_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk6_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk6_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk6_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk6_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk7']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod7_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk7']) ? $post['desc_produk7'] . '_' . $_FILES['foto_produk7']['name'] : $_FILES['foto_produk7']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk7']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk7']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk7']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk7']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk7 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk7_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod7_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk7_2']) ? $post['desc_produk7_2'] . '_' . $_FILES['foto_produk7_2']['name'] : $_FILES['foto_produk7_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk7_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk7_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk7_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk7_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk7_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk7_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod7_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk7_3']) ? $post['desc_produk7_3'] . '_' . $_FILES['foto_produk7_3']['name'] : $_FILES['foto_produk7_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk7_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk7_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk7_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk7_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk7_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk8']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod8_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk8']) ? $post['desc_produk8'] . '_' . $_FILES['foto_produk8']['name'] : $_FILES['foto_produk8']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk8']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk8']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk8']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk8']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk8 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk8_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod8_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk8_2']) ? $post['desc_produk8_2'] . '_' . $_FILES['foto_produk8_2']['name'] : $_FILES['foto_produk8_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk8_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk8_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk8_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk8_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk8_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk8_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod8_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk8_3']) ? $post['desc_produk8_3'] . '_' . $_FILES['foto_produk8_3']['name'] : $_FILES['foto_produk8_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk8_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk8_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk8_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk8_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk8_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk9']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod9_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk9']) ? $post['desc_produk9'] . '_' . $_FILES['foto_produk9']['name'] : $_FILES['foto_produk9']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk9']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk9']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk9']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk9']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk9 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk9_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod9_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk9_2']) ? $post['desc_produk9_2'] . '_' . $_FILES['foto_produk9_2']['name'] : $_FILES['foto_produk9_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk9_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk9_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk9_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk9_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk9_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk9_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod9_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk9_3']) ? $post['desc_produk9_3'] . '_' . $_FILES['foto_produk9_3']['name'] : $_FILES['foto_produk9_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk9_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk9_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk9_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk9_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk9_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk10']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod10_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk10']) ? $post['desc_produk10'] . '_' . $_FILES['foto_produk10']['name'] : $_FILES['foto_produk10']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk10']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk10']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk10']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk10']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk10 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk10_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod10_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk10_2']) ? $post['desc_produk10_2'] . '_' . $_FILES['foto_produk10_2']['name'] : $_FILES['foto_produk10_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk10_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk10_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk10_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk10_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk10_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk10_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod10_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk10_3']) ? $post['desc_produk10_3'] . '_' . $_FILES['foto_produk10_3']['name'] : $_FILES['foto_produk10_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk10_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk10_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk10_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk10_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk10_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_kuis1']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_' . date('his') . '_' . $_FILES['foto_kuis1']['name'];
                $_FILES['file']['type'] = $_FILES['foto_kuis1']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_kuis1']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_kuis1']['error'];
                $_FILES['file']['size'] = $_FILES['foto_kuis1']['size'];
                if($this->upload->do_upload('file')){ $uploadfoto_kuis1 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_kuis2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_' . date('his') . '_' . $_FILES['foto_kuis2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_kuis2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_kuis2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_kuis2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_kuis2']['size'];
                if($this->upload->do_upload('file')){ $uploadfoto_kuis2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_pu']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_' . date('his') . '_' . $_FILES['foto_pu']['name'];
                $_FILES['file']['type'] = $_FILES['foto_pu']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_pu']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_pu']['error'];
                $_FILES['file']['size'] = $_FILES['foto_pu']['size'];
                if($this->upload->do_upload('file')){ $uploadfoto_pu = $this->upload->data(); }
            }


        // end upload

        $data = array(
            'nama_pelaku_usaha' => $post['nama_pelaku_usaha'],
            'nik' => $post['nik'],
            'produk_1' => $post['produk1_inp'],
            'produk_2' => $post['produk2_inp'],
            'produk_3' => $post['produk3_inp'],
            'no_telp' => $post['no_telp'],
            'email' => $post['email'],
            'no_npwp' => $post['no_npwp'],
            'no_nib' => $post['no_nib'],
            'modal' => $post['modal'],
            'jml_produksi' => $post['jml_produksi'],
            'satuan' => $post['satuan'],
            'tahun_berdiri' => $post['tahun_berdiri'],
            'bulan_berdiri' => $post['bulan_berdiri'],
            'nama_produk' => $post['nama_produk'],
            'jenis_produk' => $post['jenis_produk'],
            'kbli' => $post['kbli'],
            'provinsi' => $post['provinsi'],
            'kabupaten' => $post['kabupaten'],
            'alamat_produksi' => $post['alamat_produksi'],
            'alamat_outlet' => $post['alamat_outlet'],
            'foto_ktp' => isset($uploadKtp['file_name']) ? $uploadKtp['file_name'] : '',
            'foto_produk1' => isset($uploadProduk1['file_name']) ? $uploadProduk1['file_name'] : '',
            'foto_produk1_2' => isset($uploadProduk1_2['file_name']) ? $uploadProduk1_2['file_name'] : '',
            'foto_produk1_3' => isset($uploadProduk1_3['file_name']) ? $uploadProduk1_3['file_name'] : '',
            'foto_produk2' => isset($uploadProduk2['file_name']) ? $uploadProduk2['file_name'] : '',
            'foto_produk2_2' => isset($uploadProduk2_2['file_name']) ? $uploadProduk2_2['file_name'] : '',
            'foto_produk2_3' => isset($uploadProduk2_3['file_name']) ? $uploadProduk2_3['file_name'] : '',
            'foto_produk3' => isset($uploadProduk3['file_name']) ? $uploadProduk3['file_name'] : '',
            'foto_produk3_2' => isset($uploadProduk3_2['file_name']) ? $uploadProduk3_2['file_name'] : '',
            'foto_produk3_3' => isset($uploadProduk3_3['file_name']) ? $uploadProduk3_3['file_name'] : '',
            'foto_produk4' => isset($uploadProduk4['file_name']) ? $uploadProduk4['file_name'] : '',
            'foto_produk4_2' => isset($uploadProduk4_2['file_name']) ? $uploadProduk4_2['file_name'] : '',
            'foto_produk4_3' => isset($uploadProduk4_3['file_name']) ? $uploadProduk4_3['file_name'] : '',
            'foto_produk5' => isset($uploadProduk5['file_name']) ? $uploadProduk5['file_name'] : '',
            'foto_produk5_2' => isset($uploadProduk5_2['file_name']) ? $uploadProduk5_2['file_name'] : '',
            'foto_produk5_3' => isset($uploadProduk5_3['file_name']) ? $uploadProduk5_3['file_name'] : '',
            'foto_produk6' => isset($uploadProduk6['file_name']) ? $uploadProduk6['file_name'] : '',
            'foto_produk6_2' => isset($uploadProduk6_2['file_name']) ? $uploadProduk6_2['file_name'] : '',
            'foto_produk6_3' => isset($uploadProduk6_3['file_name']) ? $uploadProduk6_3['file_name'] : '',
            'foto_produk7' => isset($uploadProduk7['file_name']) ? $uploadProduk7['file_name'] : '',
            'foto_produk7_2' => isset($uploadProduk7_2['file_name']) ? $uploadProduk7_2['file_name'] : '',
            'foto_produk7_3' => isset($uploadProduk7_3['file_name']) ? $uploadProduk7_3['file_name'] : '',
            'foto_produk8' => isset($uploadProduk8['file_name']) ? $uploadProduk8['file_name'] : '',
            'foto_produk8_2' => isset($uploadProduk8_2['file_name']) ? $uploadProduk8_2['file_name'] : '',
            'foto_produk8_3' => isset($uploadProduk8_3['file_name']) ? $uploadProduk8_3['file_name'] : '',
            'foto_produk9' => isset($uploadProduk9['file_name']) ? $uploadProduk9['file_name'] : '',
            'foto_produk9_2' => isset($uploadProduk9_2['file_name']) ? $uploadProduk9_2['file_name'] : '',
            'foto_produk9_3' => isset($uploadProduk9_3['file_name']) ? $uploadProduk9_3['file_name'] : '',
            'foto_produk10' => isset($uploadProduk10['file_name']) ? $uploadProduk10['file_name'] : '',
            'foto_produk10_2' => isset($uploadProduk10_2['file_name']) ? $uploadProduk10_2['file_name'] : '',
            'foto_produk10_3' => isset($uploadProduk10_3['file_name']) ? $uploadProduk10_3['file_name'] : '',
            'desc_produk1' => $post['desc_produk1'],
            'desc_produk1_2' => $post['desc_produk1_2'],
            'desc_produk1_3' => $post['desc_produk1_3'],
            'desc_produk2' => $post['desc_produk2'],
            'desc_produk2_2' => $post['desc_produk2_2'],
            'desc_produk2_3' => $post['desc_produk2_3'],
            'desc_produk3' => $post['desc_produk3'],
            'desc_produk3_2' => $post['desc_produk3_2'],
            'desc_produk3_3' => $post['desc_produk3_3'],
            'desc_produk4' => $post['desc_produk4'],
            'desc_produk4_2' => $post['desc_produk4_2'],
            'desc_produk4_3' => $post['desc_produk4_3'],
            'desc_produk5' => $post['desc_produk5'],
            'desc_produk5_2' => $post['desc_produk5_2'],
            'desc_produk5_3' => $post['desc_produk5_3'],
            'desc_produk6' => $post['desc_produk6'],
            'desc_produk6_2' => $post['desc_produk6_2'],
            'desc_produk6_3' => $post['desc_produk6_3'],
            'desc_produk7' => $post['desc_produk7'],
            'desc_produk7_2' => $post['desc_produk7_2'],
            'desc_produk7_3' => $post['desc_produk7_3'],
            'desc_produk8' => $post['desc_produk8'],
            'desc_produk8_2' => $post['desc_produk8_2'],
            'desc_produk8_3' => $post['desc_produk8_3'],
            'desc_produk9' => $post['desc_produk9'],
            'desc_produk9_2' => $post['desc_produk9_2'],
            'desc_produk9_3' => $post['desc_produk9_3'],
            'desc_produk10' => $post['desc_produk10'],
            'desc_produk10_2' => $post['desc_produk10_2'],
            'desc_produk10_3' => $post['desc_produk10_3'],
            'foto_kuis1' => isset($uploadfoto_kuis1['file_name']) ? $uploadfoto_kuis1['file_name'] : '',
            'foto_kuis2' => isset($uploadfoto_kuis2['file_name']) ? $uploadfoto_kuis2['file_name'] : '',
            'foto_pu' => isset($uploadfoto_pu['file_name']) ? $uploadfoto_pu['file_name'] : '',
            'status' => 1,
            'tanggal_input' => date('Y-m-d H:i:s'),
            'user_id' => $this->data['userdata']['employee_id']
        );

        $simpan = $this->db->insert('formulir', $data);
        
        if($simpan){

            $formulir_id = $this->db->insert_id();

            $task_1 = $this->Formulir_m->getTask(284)->num_rows();
            $task_2 = $this->Formulir_m->getTask(651)->num_rows();
            $task_3 = $this->Formulir_m->getTask(652)->num_rows();
            $task_4 = $this->Formulir_m->getTask(653)->num_rows();
            
            if (!empty($formulir_id)) {
                
                if ($task_1 == $task_2 && $task_1 == $task_3 && $task_1 == $task_4 && $task_2 == $task_3 && $task_2 == $task_4) {
                    
                    $assign = 284;

                } else if ($task_1 > $task_2 && $task_1 > $task_3 && $task_1 > $task_4 && $task_2 == $task_3 && $task_2 == $task_4 && $task_3 == $task_4) {

                    $assign = 651;

                } else if ($task_1 == $task_2 && $task_1 > $task_3 && $task_1 > $task_4 && $task_2 > $task_3 && $task_2 > $task_4) {

                    $assign = 652;

                } else if ($task_1 == $task_2 && $task_1 == $task_3 && $task_1 > $task_4 && $task_2 > $task_4 && $task_3 > $task_4) {

                    $assign = 653;

                }                
                
                $data_pusat = array(
                    'user_id' => $assign,
                    'formulir_id' => $formulir_id,
                    'created_date' => date('Y-m-d H:i:s')
                );

                $this->db->insert('task', $data_pusat);
                
            }
            
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

        if (count($post) == 0) {
            $this->setMessage("Isi data dengan Benar.");
            redirect(site_url('formulir'));
        }

        $this->db->trans_begin();

        $dir = './uploads/' . $this->data['dir'];

        // start upload 

            if(!empty($_FILES['foto_ktp']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_ktp_' . date('his') . '_' . $_FILES['foto_ktp']['name'];
                $_FILES['file']['type'] = $_FILES['foto_ktp']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_ktp']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_ktp']['error'];
                $_FILES['file']['size'] = $_FILES['foto_ktp']['size'];
                if($this->upload->do_upload('file')){ $uploadKtp = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk1']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod1_' . date('his') . '_' . $post['produk1_inp'] . '_' . $post['desc_produk1'] . '_' . $_FILES['foto_produk1']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk1']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk1']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk1']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk1']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk1 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk1_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod1_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk1_2']) ? $post['desc_produk1_2'] . '_' . $_FILES['foto_produk1_2']['name'] : $_FILES['foto_produk1_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk1_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk1_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk1_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk1_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk1_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk1_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod1_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk1_3']) ? $post['desc_produk1_3'] . '_' . $_FILES['foto_produk1_3']['name'] : $_FILES['foto_produk1_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk1_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk1_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk1_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk1_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk1_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod2_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk2']) ? $post['desc_produk2'] . '_' . $_FILES['foto_produk2']['name'] : $_FILES['foto_produk2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk2_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod2_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk2_2']) ? $post['desc_produk2_2'] . '_' . $_FILES['foto_produk2_2']['name'] : $_FILES['foto_produk2_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk2_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk2_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk2_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk2_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk2_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk2_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod2_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk2_3']) ? $post['desc_produk2_3'] . '_' . $_FILES['foto_produk2_3']['name'] : $_FILES['foto_produk2_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk2_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk2_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk2_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk2_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk2_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod3_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk3']) ? $post['desc_produk3'] . '_' . $_FILES['foto_produk3']['name'] : $_FILES['foto_produk3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk3_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod3_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk3_2']) ? $post['desc_produk3_2'] . '_' . $_FILES['foto_produk3_2']['name'] : $_FILES['foto_produk3_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk3_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk3_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk3_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk3_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk3_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk3_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod3_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk3_3']) ? $post['desc_produk3_3'] . '_' . $_FILES['foto_produk3_3']['name'] : $_FILES['foto_produk3_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk3_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk3_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk3_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk3_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk3_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk4']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod4_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk4']) ? $post['desc_produk4'] . '_' . $_FILES['foto_produk4']['name'] : $_FILES['foto_produk4']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk4']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk4']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk4']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk4']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk4 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk4_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod4_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk4_2']) ? $post['desc_produk4_2'] . '_' . $_FILES['foto_produk4_2']['name'] : $_FILES['foto_produk4_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk4_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk4_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk4_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk4_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk4_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk4_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod4_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk4_3']) ? $post['desc_produk4_3'] . '_' . $_FILES['foto_produk4_3']['name'] : $_FILES['foto_produk4_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk4_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk4_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk4_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk4_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk4_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk5']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod5_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk5']) ? $post['desc_produk5'] . '_' . $_FILES['foto_produk5']['name'] : $_FILES['foto_produk5']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk5']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk5']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk5']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk5']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk5 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk5_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod5_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk5_2']) ? $post['desc_produk5_2'] . '_' . $_FILES['foto_produk5_2']['name'] : $_FILES['foto_produk5_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk5_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk5_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk5_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk5_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk5_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk5_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod5_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk5_3']) ? $post['desc_produk5_3'] . '_' . $_FILES['foto_produk5_3']['name'] : $_FILES['foto_produk5_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk5_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk5_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk5_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk5_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk5_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk6']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod6_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk6']) ? $post['desc_produk6'] . '_' . $_FILES['foto_produk6']['name'] : $_FILES['foto_produk6']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk6']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk6']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk6']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk6']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk6 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk6_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod6_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk6_2']) ? $post['desc_produk6_2'] . '_' . $_FILES['foto_produk6_2']['name'] : $_FILES['foto_produk6_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk6_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk6_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk6_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk6_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk6_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk6_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod6_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk6_3']) ? $post['desc_produk6_3'] . '_' . $_FILES['foto_produk6_3']['name'] : $_FILES['foto_produk6_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk6_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk6_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk6_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk6_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk6_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk7']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod7_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk7']) ? $post['desc_produk7'] . '_' . $_FILES['foto_produk7']['name'] : $_FILES['foto_produk7']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk7']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk7']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk7']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk7']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk7 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk7_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod7_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk7_2']) ? $post['desc_produk7_2'] . '_' . $_FILES['foto_produk7_2']['name'] : $_FILES['foto_produk7_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk7_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk7_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk7_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk7_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk7_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk7_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod7_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk7_3']) ? $post['desc_produk7_3'] . '_' . $_FILES['foto_produk7_3']['name'] : $_FILES['foto_produk7_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk7_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk7_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk7_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk7_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk7_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk8']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod8_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk8']) ? $post['desc_produk8'] . '_' . $_FILES['foto_produk8']['name'] : $_FILES['foto_produk8']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk8']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk8']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk8']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk8']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk8 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk8_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod8_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk8_2']) ? $post['desc_produk8_2'] . '_' . $_FILES['foto_produk8_2']['name'] : $_FILES['foto_produk8_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk8_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk8_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk8_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk8_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk8_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk8_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod8_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk8_3']) ? $post['desc_produk8_3'] . '_' . $_FILES['foto_produk8_3']['name'] : $_FILES['foto_produk8_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk8_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk8_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk8_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk8_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk8_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk9']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod9_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk9']) ? $post['desc_produk9'] . '_' . $_FILES['foto_produk9']['name'] : $_FILES['foto_produk9']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk9']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk9']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk9']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk9']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk9 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk9_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod9_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk9_2']) ? $post['desc_produk9_2'] . '_' . $_FILES['foto_produk9_2']['name'] : $_FILES['foto_produk9_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk9_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk9_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk9_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk9_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk9_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk9_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod9_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk9_3']) ? $post['desc_produk9_3'] . '_' . $_FILES['foto_produk9_3']['name'] : $_FILES['foto_produk9_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk9_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk9_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk9_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk9_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk9_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk10']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod10_' . date('his') . '_' . $post['produk1_inp'] . '_' . isset($post['desc_produk10']) ? $post['desc_produk10'] . '_' . $_FILES['foto_produk10']['name'] : $_FILES['foto_produk10']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk10']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk10']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk10']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk10']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk10 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk10_2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod10_2_' . date('his') . '_' . $post['produk2_inp'] . '_' . isset($post['desc_produk10_2']) ? $post['desc_produk10_2'] . '_' . $_FILES['foto_produk10_2']['name'] : $_FILES['foto_produk10_2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk10_2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk10_2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk10_2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk10_2']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk10_2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_produk10_3']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_prod10_3_' . date('his') . '_' . $post['produk3_inp'] . '_' . isset($post['desc_produk10_3']) ? $post['desc_produk10_3'] . '_' . $_FILES['foto_produk10_3']['name'] : $_FILES['foto_produk10_3']['name'];
                $_FILES['file']['type'] = $_FILES['foto_produk10_3']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_produk10_3']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_produk10_3']['error'];
                $_FILES['file']['size'] = $_FILES['foto_produk10_3']['size'];
                if($this->upload->do_upload('file')){ $uploadProduk10_3 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_kuis1']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_' . date('his') . '_' . $_FILES['foto_kuis1']['name'];
                $_FILES['file']['type'] = $_FILES['foto_kuis1']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_kuis1']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_kuis1']['error'];
                $_FILES['file']['size'] = $_FILES['foto_kuis1']['size'];
                if($this->upload->do_upload('file')){ $uploadfoto_kuis1 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_kuis2']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_' . date('his') . '_' . $_FILES['foto_kuis2']['name'];
                $_FILES['file']['type'] = $_FILES['foto_kuis2']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_kuis2']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_kuis2']['error'];
                $_FILES['file']['size'] = $_FILES['foto_kuis2']['size'];
                if($this->upload->do_upload('file')){ $uploadfoto_kuis2 = $this->upload->data(); }
            }

            if(!empty($_FILES['foto_pu']['name'])){
                $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_' . date('his') . '_' . $_FILES['foto_pu']['name'];
                $_FILES['file']['type'] = $_FILES['foto_pu']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['foto_pu']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['foto_pu']['error'];
                $_FILES['file']['size'] = $_FILES['foto_pu']['size'];
                if($this->upload->do_upload('file')){ $uploadfoto_pu = $this->upload->data(); }
            }

        // end upload

        $row_data = $this->Formulir_m->getDetail($post['id_form'], $this->data['userdata']['employee_id'])->row_array();

        $data = array(
            'nama_pelaku_usaha' => $post['nama_pelaku_usaha'],
            'nik' => $post['nik'],
            'produk_1' => $post['produk1_inp'],
            'produk_2' => $post['produk2_inp'],
            'produk_3' => $post['produk3_inp'],
            'no_telp' => $post['no_telp'],
            'email' => $post['email'],
            'no_npwp' => $post['no_npwp'],
            'no_nib' => $post['no_nib'],
            'modal' => $post['modal'],
            'jml_produksi' => $post['jml_produksi'],
            'satuan' => $post['satuan'],
            'tahun_berdiri' => $post['tahun_berdiri'],
            'bulan_berdiri' => $post['bulan_berdiri'],
            'status' => 1,
            'nama_produk' => $post['nama_produk'],
            'jenis_produk' => $post['jenis_produk'],
            'kbli' => $post['kbli'],
            'provinsi' => $post['provinsi'],
            'kabupaten' => $post['kabupaten'],
            'alamat_produksi' => $post['alamat_produksi'],
            'alamat_outlet' => $post['alamat_outlet'],
            'foto_ktp' => isset($uploadKtp['file_name']) ? $uploadKtp['file_name'] : $row_data['foto_ktp'],
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
            'foto_produk1_2' => isset($uploadProduk1_2['file_name']) ? $uploadProduk1_2['file_name'] : $row_data['foto_produk1_2'],
            'foto_produk1_3' => isset($uploadProduk1_3['file_name']) ? $uploadProduk1_3['file_name'] : $row_data['foto_produk1_3'],
            'foto_produk2_2' => isset($uploadProduk2_2['file_name']) ? $uploadProduk2_2['file_name'] : $row_data['foto_produk2_2'],
            'foto_produk2_3' => isset($uploadProduk2_3['file_name']) ? $uploadProduk2_3['file_name'] : $row_data['foto_produk2_3'],
            'foto_produk3_2' => isset($uploadProduk3_2['file_name']) ? $uploadProduk3_2['file_name'] : $row_data['foto_produk3_2'],
            'foto_produk3_3' => isset($uploadProduk3_3['file_name']) ? $uploadProduk3_3['file_name'] : $row_data['foto_produk3_3'],
            'foto_produk4_2' => isset($uploadProduk4_2['file_name']) ? $uploadProduk4_2['file_name'] : $row_data['foto_produk4_2'],
            'foto_produk4_3' => isset($uploadProduk4_3['file_name']) ? $uploadProduk4_3['file_name'] : $row_data['foto_produk4_3'],
            'foto_produk5_2' => isset($uploadProduk5_2['file_name']) ? $uploadProduk5_2['file_name'] : $row_data['foto_produk5_2'],
            'foto_produk5_3' => isset($uploadProduk5_3['file_name']) ? $uploadProduk5_3['file_name'] : $row_data['foto_produk5_3'],
            'foto_produk6_2' => isset($uploadProduk6_2['file_name']) ? $uploadProduk6_2['file_name'] : $row_data['foto_produk6_2'],
            'foto_produk6_3' => isset($uploadProduk6_3['file_name']) ? $uploadProduk6_3['file_name'] : $row_data['foto_produk6_3'],
            'foto_produk7_2' => isset($uploadProduk7_2['file_name']) ? $uploadProduk7_2['file_name'] : $row_data['foto_produk7_2'],
            'foto_produk7_3' => isset($uploadProduk7_3['file_name']) ? $uploadProduk7_3['file_name'] : $row_data['foto_produk7_3'],
            'foto_produk8_2' => isset($uploadProduk8_2['file_name']) ? $uploadProduk8_2['file_name'] : $row_data['foto_produk8_2'],
            'foto_produk8_3' => isset($uploadProduk8_3['file_name']) ? $uploadProduk8_3['file_name'] : $row_data['foto_produk8_3'],
            'foto_produk9_2' => isset($uploadProduk9_2['file_name']) ? $uploadProduk9_2['file_name'] : $row_data['foto_produk9_2'],
            'foto_produk9_3' => isset($uploadProduk9_3['file_name']) ? $uploadProduk9_3['file_name'] : $row_data['foto_produk9_3'],
            'foto_produk10_2' => isset($uploadProduk10_2['file_name']) ? $uploadProduk10_2['file_name'] : $row_data['foto_produk10_2'],
            'foto_produk10_3' => isset($uploadProduk10_3['file_name']) ? $uploadProduk10_3['file_name'] : $row_data['foto_produk10_3'],            
            'desc_produk1' => $post['desc_produk1'],
            'desc_produk1_2' => $post['desc_produk1_2'],
            'desc_produk1_3' => $post['desc_produk1_3'],
            'desc_produk2' => $post['desc_produk2'],
            'desc_produk2_2' => $post['desc_produk2_2'],
            'desc_produk2_3' => $post['desc_produk2_3'],
            'desc_produk3' => $post['desc_produk3'],
            'desc_produk3_2' => $post['desc_produk3_2'],
            'desc_produk3_3' => $post['desc_produk3_3'],
            'desc_produk4' => $post['desc_produk4'],
            'desc_produk4_2' => $post['desc_produk4_2'],
            'desc_produk4_3' => $post['desc_produk4_3'],
            'desc_produk5' => $post['desc_produk5'],
            'desc_produk5_2' => $post['desc_produk5_2'],
            'desc_produk5_3' => $post['desc_produk5_3'],
            'desc_produk6' => $post['desc_produk6'],
            'desc_produk6_2' => $post['desc_produk6_2'],
            'desc_produk6_3' => $post['desc_produk6_3'],
            'desc_produk7' => $post['desc_produk7'],
            'desc_produk7_2' => $post['desc_produk7_2'],
            'desc_produk7_3' => $post['desc_produk7_3'],
            'desc_produk8' => $post['desc_produk8'],
            'desc_produk8_2' => $post['desc_produk8_2'],
            'desc_produk8_3' => $post['desc_produk8_3'],
            'desc_produk9' => $post['desc_produk9'],
            'desc_produk9_2' => $post['desc_produk9_2'],
            'desc_produk9_3' => $post['desc_produk9_3'],
            'desc_produk10' => $post['desc_produk10'],
            'desc_produk10_2' => $post['desc_produk10_2'],
            'desc_produk10_3' => $post['desc_produk10_3'],
            'foto_kuis1' => isset($uploadfoto_kuis1['file_name']) ? $uploadfoto_kuis1['file_name'] : $row_data['foto_kuis1'],
            'foto_kuis2' => isset($uploadfoto_kuis2['file_name']) ? $uploadfoto_kuis2['file_name'] : $row_data['foto_kuis2'],
            'foto_pu' => isset($uploadfoto_pu['file_name']) ? $uploadfoto_pu['file_name'] : $row_data['foto_pu'],
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

    public function approval(){

        $post = $this->input->post(); 

        $this->db->trans_begin();      
        
        $dir = './uploads/' . $this->data['dir'];

        if(!empty($_FILES['file_nib']['name'])){
            $_FILES['file']['name'] = $this->data['userdata']['employee_id'] . '_nib_' . date('his') . '_' . $_FILES['file_nib']['name'];
            $_FILES['file']['type'] = $_FILES['file_nib']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['file_nib']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['file_nib']['error'];
            $_FILES['file']['size'] = $_FILES['file_nib']['size'];
            if($this->upload->do_upload('file')){ $uploadNib = $this->upload->data(); }
        }

        $data = array(            
            'status' => 2,
            'no_nib' => $post['no_nib'],
            'kbli' => $post['kbli'],
            'tanggal_approve' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $post['id_form']);
        $simpan = $this->db->update('formulir', $data);

        $data_srv = array(            
            'id_formulir' => $post['id_form'],
            'id_surveyor' => $post['surveyor'],
            'id_pu' => $post['id_pu'],
            'klasifikasiproduk' => $post['klasifikasiproduk'],
            'rincianproduk' => $post['rincianproduk'],
            'username' => $post['username'],
            'username_oss' => $post['username_oss'],
            'password' => $post['password'],
            'password_oss' => $post['password_oss'],
            'file_nib' => isset($uploadNib['file_name']) ? $uploadNib['file_name'] : '',
            'tanggal_input' => date('Y-m-d H:i:s'),
            'input_by' => $this->data['userdata']['employee_id']
        );

        $simpan_srv = $this->db->insert('formulir_surveyor', $data_srv);
        
        if($simpan && $simpan_srv){
            
            if ($this->db->trans_status() === FALSE)  {
                $this->setMessage("Failed Approve data.");
                $this->db->trans_rollback();
            } else {
                $this->setMessage("Success Approve data.");
                $this->db->trans_commit();
            }            

            redirect(site_url('formulir/detail_data/' . $post['id_form']));
        
        } else {
            $this->renderMessage("error");
        }
    }

    public function unapproval(){

        $post = $this->input->post(); 

        $this->db->trans_begin();        

        $data = array(            
            'status' => 3,
            'alasan' => $post['alasan'],
            'tanggal_approve' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $post['id_form']);
        $simpan = $this->db->update('formulir', $data);
        
        if($simpan){
            
            if ($this->db->trans_status() === FALSE)  {
                $this->setMessage("Failed Unapprove data.");
                $this->db->trans_rollback();
            } else {
                $this->setMessage("Success Unapprove data.");
                $this->db->trans_commit();
            }            

            redirect(site_url('formulir/detail_data/' . $post['id_form']));
        
        } else {
            $this->renderMessage("error");
        }
    }

    public function update_status_pendamping($id){

        $post = $this->input->post(); 

        $this->db->trans_begin();        

        $row_data = $this->Formulir_m->getDetail($id)->row_array();

        if($row_data['status'] == 2) {
            $data = array(   
                'status_pendamping' => 2,
                'tanggal_selesai' => date('Y-m-d H:i:s')
            );
    
            $this->db->where('id', $id);
            $simpan = $this->db->update('formulir', $data);
            
            if($simpan){
                
                if ($this->db->trans_status() === FALSE)  {
                    $this->setMessage("Failed ubah data.");
                    $this->db->trans_rollback();
                } else {
                    $this->setMessage("Success ubah data.");
                    $this->db->trans_commit();
                }            
    
                redirect(site_url('formulir/detail_data/' . $id));
            
            } else {
                $this->renderMessage("error");
                redirect(site_url('formulir/detail_data/' . $id));
            }

        } else {
            $this->setMessage("Data Belum Diapprove.");
            $this->db->trans_rollback();
            redirect(site_url('formulir/detail_data/' . $id));
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

    public function export_data() {
      
        $data = array();

        $data['list_formulir'] = $this->Formulir_m->getFormulirEksport()->result_array();

        $pos = $this->Administration_m->getPosition("VIEWER");

        if($pos) {
            $data['list_formulir'] = $this->Formulir_m->getFormulirEksportSrv($this->data['userdata']['employee_id'])->result_array();
        }
        
        $data['nama_file'] = "Data Form " . date('Y-m-d H:i:s');

		$this->load->view("formulir/export_formulir_v", $data);
    }

    public function get_regency()
    {
        $provinces = $this->input->post('provinsi', true);
        $data = $this->db->get_where('adm_ref_locations', ['province_name' => $provinces, 'regency_name !=' => NULL, 'district_name' => NULL])->result_array();
        echo json_encode($data);
    }

}
