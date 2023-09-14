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
                    <div class="row gy-4">                        
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <select class="select-single" name="provinsi" id="provinsi_src">
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
                                <select class="select-single" name="pendamping" id="pendamping_src">
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
                                <select class="select-single" name="status_approve" id="status_src">
                                    <option value="">Pilih Status</option>                                
                                    <option value="1">Belum Diapprove</option>                                
                                    <option value="2">Sudah Diapprove</option>                                
                                    <option value="3">Tidak Diapprove</option>                                
                                </select>
                            </div>
                        </div>
                        <!--end col-->                        
                        <div class="col-xxl-3 col-md-6 btn-group">
                            <button type="button" class="btn btn-block btn-primary btn-sm" id="dt_cari" name="button">Filter</button>                        
                            <button type="button" class="btn btn-block btn-info btn-sm" id="dt_reset" name="button">Reset</button>
                        </div>
                        <!--end col-->      
                    </div>                
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->                                
<?php } else { ?>  

    <input type="hidden" id="provinsi_src" value="">
    <input type="hidden" id="pendamping_src" value="">
    <input type="hidden" id="status_src" value="">

<?php } ?>  

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h5 class="card-title mb-0">List Formulir</h5>
                </div>
                <div class="float-end">                    
                    <a href="<?php echo site_url('formulir/tambah_data');?>" class="btn btn-sm btn-primary"><i class="ri-add-line align-middle me-1"></i> Tambah Data</a>                    
                    <?php if($userdata['pos_name'] != 'ENUM') { ?>
                        <a href="<?php echo site_url('formulir/export_data');?>" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-sm btn-warning"><i class="las la-file-excel"></i> Export Data</a>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Pelaku Usaha</th>
                            <th>KBLI</th>
                            <th>Nama Produk</th>
                            <th>Jenis Usaha</th>
                            <th>Provinsi</th>
                            <th>Petugas</th>
                            <th>Pendamping</th>
                            <th>Status Approve</th>
                            <th>Status Pendampingan</th>
                            <th>Pusat</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
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
        $(".select-single").select2();

        $('#dt_cari').click(function() {
            table.ajax.reload();
        });

        $('#dt_reset').click(function() {
            location.reload();
        });

        var table = $("#scroll-horizontal").DataTable({             
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'<?php echo site_url('formulir/get_data');?>',
                "type": "post",
                "data": function(d){                    
                    d.s_provinsi = $('#provinsi_src').val();
                    d.s_pendamping = $('#pendamping_src').val();
                    d.s_status = $('#status_src').val();
                },
            },
            scrollX: !0,
            'columns': [
                { data: 'nama_pelaku_usaha' },
                { data: 'kbli' },
                { data: 'nama_produk' },
                { data: 'jenis_produk' },
                { data: 'provinsi' },
                { data: 'petugas' },
                { data: 'pendamping' },
                { data: 'status_app' },
                { data: 'status_pend' },
                { data: 'pusat' },
                { data: 'foto' },
                { data: 'action' },
            ]            
        });
    })
</script>