<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!-- select2 css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<?php if($userdata['pos_name'] != 'ENUM' && $userdata['pos_name'] != 'VIEWER') { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Filter Data</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('formulir'); ?>" method="post">
                        <div class="row gy-4">                        
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <select class="select-single" name="provinsi">
                                        <option value="">Pilih Provinsi</option>
                                        <?php foreach($provinsi as $v) { ?>
                                            <option value="<?php echo $v['provinsi']; ?>"><?php echo $v['provinsi']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <select class="select-single" name="pendamping">
                                        <option value="">Pilih Pendamping</option>
                                        <?php foreach($pendamping as $v) { ?>
                                            <?php $idpnd = $this->db->distinct()->select('id,fullname')->where('id', $v['pendamping_id'])->get('adm_employee')->row_array();  ?>
                                            <option value="<?php echo $idpnd['id']; ?>"><?php echo $idpnd['fullname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->  
                            <div class="col-xxl-3 col-md-6">
                                <div>                        
                                    <select class="select-single" name="status_approve">
                                        <option value="">Pilih Status</option>                                
                                        <option value="1">Belum Diapprove</option>                                
                                        <option value="2">Sudah Diapprove</option>                                
                                        <option value="3">Tidak Diapprove</option>                                
                                    </select>
                                </div>
                            </div>
                            <!--end col-->                        
                            <div class="col-xxl-3 col-md-6">
                                <div class="d-grid">                            
                                    <input type="submit" class="btn btn-primary btn-block btn-sm" value="Filter">
                                </div>
                            </div>
                            <!--end col-->      
                        </div>
                    </form>                      
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->                                
<?php } ?>  

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h5 class="card-title mb-0">List Formulir</h5>
                </div>
                <div class="float-end">
                    <?php if($userdata['pos_name'] == 'ENUM') { ?>
                        <a href="<?php echo site_url('formulir/tambah_data');?>" class="btn btn-sm btn-primary"><i class="ri-add-line align-middle me-1"></i> Tambah Data</a>
                    <?php } ?>
                    <?php if($userdata['pos_name'] != 'ENUM') { ?>
                        <a href="<?php echo site_url('formulir/export_data');?>" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-sm btn-warning"><i class="las la-file-excel"></i> Export Data</a>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th class='col-sm-1 text-center'>No</th>
                            <th>Pelaku Usaha</th>
                            <th>KBLI</th>
                            <th>Nama Produk</th>
                            <th>Jenis Usaha</th>
                            <th>Provinsi</th>
                            <th>Petugas</th>
                            <th>Pendamping</th>
                            <th>Status Approve</th>
                            <th>Status Pendampingan</th>
                            <th>Foto Produk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($list_formulir as $v) { ?>
                            <tr> 
                                <td class='text-center'><?php echo $no++; ?></td>
                                <td><?php echo $v['nama_pelaku_usaha']; ?></td>
                                <td><?php echo $v['kbli']; ?></td>
                                <td><?php echo $v['nama_produk']; ?></td>
                                <td><?php echo $v['jenis_produk']; ?></td>
                                <td><?php echo $v['provinsi']; ?></td>
                                <td><?php $idptg = $this->db->select('fullname')->where('id', $v['user_id'])->get('adm_employee')->row_array(); echo $idptg['fullname']; ?></td>
                                <td><?php $idpnd = $this->db->select('pendamping_id')->where('id', $v['user_id'])->get('adm_employee')->row_array(); $namapnd = $this->db->select('fullname')->where('id', $idpnd['pendamping_id'])->get('adm_employee')->row_array(); echo $namapnd['fullname']; ?></td>
                                <td><?php if ($v['status'] == 2) { echo '<span class="badge bg-success">Sudah Diapprove</span>'; } elseif ($v['status'] == 3) { echo '<span class="badge bg-info">Tidak Diapprove</span>'; } else { echo '<span class="badge bg-danger">Belum Diapprove</span>'; } ?></td>
                                <td><?php echo $v['status_pendamping'] == 2 ? '<span class="badge bg-success">Selesai Pendamping</span>' : '<span class="badge bg-danger">Belum Selesai</span>' ; ?></td>
                                <td>
                                    <div class="avatar-group">
                                        <a href="<?php echo base_url('uploads/formulir/' . $v['foto_ktp']); ?>" target="_blank" class="avatar-group-item" data-img="<?php echo base_url('uploads/formulir/' . $v['foto_ktp']); ?>" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Foto Ktp">
                                            <img src="<?php echo base_url('uploads/formulir/' . $v['foto_ktp']); ?>" alt="" class="rounded-circle avatar-xxs">
                                        </a>                                    
                                        <a href="<?php echo base_url('uploads/formulir/' . $v['foto_produk1']); ?>" target="_blank" class="avatar-group-item" data-img="<?php echo base_url('uploads/formulir/' . $v['foto_produk1']); ?>" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Foto Produk 1">
                                            <img src="<?php echo base_url('uploads/formulir/' . $v['foto_produk1']); ?>" alt="" class="rounded-circle avatar-xxs">
                                        </a>                                                                            
                                        <?php if(!empty($v['foto_produk2'])) { ?>
                                            <a href="<?php echo base_url('uploads/formulir/' . $v['foto_produk2']); ?>" target="_blank" class="avatar-group-item" data-img="<?php echo base_url('uploads/formulir/' . $v['foto_produk2']); ?>" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Foto Produk 2">
                                                <img src="<?php echo base_url('uploads/formulir/' . $v['foto_produk2']); ?>" alt="" class="rounded-circle avatar-xxs">
                                            </a>                                
                                        <?php } ?>
                                        <?php if(!empty($v['foto_produk3'])) { ?>
                                            <a href="<?php echo base_url('uploads/formulir/' . $v['foto_produk3']); ?>" target="_blank" class="avatar-group-item" data-img="<?php echo base_url('uploads/formulir/' . $v['foto_produk3']); ?>" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Foto Produk 3">
                                                <img src="<?php echo base_url('uploads/formulir/' . $v['foto_produk3']); ?>" alt="" class="rounded-circle avatar-xxs">
                                            </a>                                
                                        <?php } ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo site_url('formulir/detail_data/' . $v['id']); ?>" class="btn btn-sm btn-info">View</a>
                                        <?php if($v['status'] != 2 && $userdata['pos_name'] == 'ENUM') { ?>
                                            <a href="<?php echo site_url('formulir/edit_data/' . $v['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <?php } ?>
                                    </div>                                    
                                </td>
                            </tr>    
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>    
    $(document).ready(function () {
        $("#scroll-horizontal").DataTable({ scrollX: !0 });
        $(".select-single").select2();
    })
</script>