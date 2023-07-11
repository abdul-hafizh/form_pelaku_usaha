<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/app-assets/vendors/css/datatables/dataTables.bootstrap4.min.css">

<?php
    $pesan = $this->session->userdata('message');
    $pesan = (empty($pesan)) ? "" : $pesan;
    if(!empty($pesan)){ ?>
    <div class="alert bg-light-danger alert-dismissible">
        <?php echo $pesan ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="ft-x font-medium-2 text-bold-700"></i></span>
        </button>
    </div>
<?php } $this->session->unset_userdata('message'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom pb-2">
                <div class="float-start">
                    <h5 class="card-title mb-0">List Employee</h5>
                </div>
                <div class="float-end">
                    <a href="<?php echo site_url('employee/add');?>" class="btn btn-primary btn-sm"><i class="ri-add-line align-middle me-1"></i> Tambah Employee</a>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered data-table-conf">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Posisi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($get_employee as $v) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++;?></td>
                                        <td><?php echo $v['fullname'];?></td>
                                        <td><?php echo $v['email'];?></td>
                                        <td><?php echo $v['phone'];?></td>
                                        <td><?php echo $v['pos_name'];?></td>
                                        <td><?php echo $v['status'] == 2 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>'; ?></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="<?php echo site_url('employee/update/' . $v['id']);?>" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                                    <li>
                                                        <a href="<?php echo site_url('employee/trash/' . $v['id']);?>" onclick="return confirm('Apakah Anda yakin?');" class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                        </a>
                                                    </li>
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
    </div>
</div>

<script src="<?php echo base_url()?>assets/app-assets/vendors/js/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/app-assets/vendors/js/datatable/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('.data-table-conf').DataTable({
            "ordering": false
        });
    });
</script>