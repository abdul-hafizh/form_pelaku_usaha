<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/logo/favicon.png"> -->
    <!-- Layout config Js -->
    <script src="<?php echo base_url();?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo base_url();?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="#" class="d-inline-block auth-logo"></a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium"></p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 shadow-lg">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <!-- <img class="mb-3" src="<?php echo base_url();?>assets/images/logo/logo-wege.png" alt="Logo" height="45"> -->
                                    <h5 class="text-muted">LOGIN</h5>
                                    <p class="text-muted">Aplikasi Registrasi Petugas Pendamping <br/> Sertifikasi Produk Halal</p> <hr/>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="<?php echo site_url("log/in") ?>" method="post">
                                        <?php
                                            $pesan = $this->session->userdata('message');
                                            $pesan = (empty($pesan)) ? "" : $pesan;
                                            if(!empty($pesan)){ ?>
                                                <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-3" role="alert">
                                                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Failed</strong>
                                                    - <?php echo $pesan ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                        <?php } $this->session->unset_userdata('message'); ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username_login" placeholder="Enter username" required>
                                        </div>

                                        <div class="mb-5">
                                            <div class="float-end">
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5" placeholder="Enter password" name="password_login" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <input class="btn btn-primary w-100" type="submit" value="Sign In">
                                        </div>

                                        <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title">ver 1.0</h5>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        
                        <div class="mt-4 text-center">
                            <p class="mb-0">Tidak memiliki akun ? <a href="#" class="fw-semibold text-primary text-decoration-underline" data-bs-toggle="modal" data-bs-target="#daftarModal"> Daftar </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer start-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> Crafted with <i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
    
    <!-- jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>    
    <!--select2 css-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <div id="daftarModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 overflow-hidden">
                <div class="modal-body p-5">
                    <h5 class="mb-3">Daftar</h5> <hr/>
                    <form action="<?php echo site_url('log/submit_daftar'); ?>" method="post">                        
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <label class="label-control">Nama Lengkap</label>
                                <input type="text" class="form-control col-lg-7" name="fullname" placeholder="Nama Lengkap" required>                                
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <label class="label-control">NIK</label>
                                <input type="number" class="form-control col-lg-7" name="nik" placeholder="NIK" required>                                
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <label class="label-control">Phone</label>
                                <input type="text" maxlength="25" class="form-control col-lg-7" name="phone" placeholder="08123....." onkeypress="return onlyNumber(event)" required>                                
                            </div>
                        </div>                        
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <label class="label-control">Username</label>
                                <input type="text" class="form-control col-lg-7" name="user_name_inp" placeholder="Username" required>                                
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <label class="label-control">Password</label>
                                <input type="password" class="form-control col-lg-7" name="password_inp" placeholder="Password" required>                                
                            </div>
                        </div>                        
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <label class="label-control">Provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi" required>
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach($provinsi as $v) { ?>
                                        <option value="<?php echo $v['province_name']; ?>"><?php echo $v['province_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <label class="label-control">Kabupaten</label>
                                <select class="form-control" name="kabupaten" id="kabupaten" disabled>
                                    <option value="">Pilih Kabupaten</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group row mb-2">
                            <div class="col-md-12">
                                <label class="label-control">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat" required></textarea>
                            </div>
                        </div>  
                        <div class="form-group row last mb-3">
                            <div class="col-md-12">
                                <label class="label-control">Nama Pendamping</label>
                                <select class="form-control" name="pendamping" id="pendamping" required disabled>
                                    <option value="">Pilih Pendamping</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" onclick="return confirm('Apakah Anda yakin?');">Submit</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>    
        $(document).ready(function () {
            $(".select-single").select2();

            $("#provinsi").on("change", function () {
                let provinsi = $("#provinsi").val();
                $.ajax({
                    url: "<?php echo site_url('log/get_regency');?>",
                    data: { provinsi: provinsi },
                    method: "post",
                    dataType: "json",
                    success: function (data) {
                        kabupaten = '<option value="">Pilih Kabupaten</option>';                    
                        $.each(data, function (i, item) {   
                            kabupaten += '<option value="' + item.regency_name +'">' + item.regency_name + "</option>";
                        });                    
                        $("#kabupaten").html(kabupaten).removeAttr("disabled");
                    },
                });

                $.ajax({
                    url: "<?php echo site_url('log/get_pendamping');?>",
                    data: { provinsi: provinsi },
                    method: "post",
                    dataType: "json",
                    success: function (data) {
                        pendamping = '<option value="">Pilih Pendamping</option>';                    
                        $.each(data, function (i, item) {   
                            pendamping += '<option value="' + item.id +'">' + item.fullname + "</option>";
                        });                    
                        $("#pendamping").html(pendamping).removeAttr("disabled");
                    },
                });
            });
        })
        
    </script>

</body>
</html>