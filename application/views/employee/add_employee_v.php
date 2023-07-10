<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/app-assets/vendors/css/select2.min.css">

<div class="row">
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="card-header border-bottom pb-2">
                <h4 class="card-title">Form Pengisian Employee</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form-bordered" method="post" action="<?php echo site_url('employee/submit');?>">                        
                        <div class="form-group row mb-2">
                            <label class="col-md-3 label-control">Posisi</label>
                            <div class="col-md-9">
                                <div class="position-relative">
                                    <select class="select2 form-control" name="employee_pos_id" required>
                                        <option value="" disabled selected>Pilih Posisi</option>
                                        <?php foreach($get_pos as $v) { ?>
                                            <option value="<?php echo $v['pos_id'];?>"><?php echo $v['pos_name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-3 label-control">Nama Lengkap</label>
                            <div class="col-md-9">
                                <div class="position-relative has-icon-left">
                                    <input type="text" class="form-control col-lg-7" name="fullname" required>
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-3 label-control">Email</label>
                            <div class="col-md-9">
                                <div class="position-relative has-icon-left">
                                    <input type="email" class="form-control col-lg-7" name="email" required>
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row last mb-3">
                            <label class="col-md-3 label-control">Phone</label>
                            <div class="col-md-9">
                                <div class="position-relative has-icon-left">
                                    <input type="text" maxlength="25" class="form-control col-lg-7" name="phone" onkeypress="return onlyNumber(event)" required>
                                    <div class="form-control-position">
                                        <i class="ft-file"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="text-right">
                            <a href="<?php echo site_url('employee');?>" class="btn btn-secondary"><i class="ft-chevrons-left mr-1"></i>Kembali</a>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin simpan data ini?');"><i class="ft-check-square mr-1"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>

<script src="<?php echo base_url()?>assets/app-assets/vendors/js/select2.full.min.js"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
    });
</script>