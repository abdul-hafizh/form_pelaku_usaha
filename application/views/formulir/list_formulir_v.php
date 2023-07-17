<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h5 class="card-title mb-0">List Formulir</h5>
                </div>
                <div class="float-end">
                    <a href="<?php echo site_url('formulir/tambah_data');?>" class="btn btn-sm btn-primary"><i class="ri-add-line align-middle me-1"></i> Tambah Data</a>
                    <?php if($userdata['pos_name'] != 'ENUM' && $userdata['pos_name'] != 'KORWIL') { ?>
                        <a href="<?php echo site_url('formulir/export_data');?>" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-sm btn-warning"><i class="las la-file-excel"></i> Export Data</a>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">
                <table id="data-form" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th class='col-sm-1 text-center'>No</th>
                            <th>Pelaku Usaha</th>
                            <th>KBLI</th>
                            <th>Nama Produk</th>
                            <th>Jenis Usaha</th>
                            <th>Provinsi</th>
                            <th>No Kontak / WA</th>
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
                                <td><?php echo $v['no_telp']; ?></td>
                                <td><?php if ($v['status'] == 2) { echo '<span class="badge bg-success">Sudah Diapprove</span>'; } elseif ($v['status'] == 3) { echo '<span class="badge bg-danger">Tidak Diapprove</span>'; } else { echo '<span class="badge bg-danger">Belum Diapprove</span>'; } ?></td>
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
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="<?php echo site_url('formulir/detail_data/' . $v['id']); ?>" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <?php if($v['status'] != 2) { ?>
                                                <li><a href="<?php echo site_url('formulir/edit_data/' . $v['id']); ?>" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <?php } ?>
                                            <?php if($userdata['pos_name'] == 'ADMINISTRATOR') { ?>
                                                <li>
                                                    <a href="<?php echo site_url('formulir/delete_formulir/' . $v['id']); ?>" onclick="return confirm('Apakah Anda yakin?');" class="dropdown-item remove-item-btn">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
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

<script>    
    $(document).ready(function () {
        $("#data-form").DataTable();
    })
</script>