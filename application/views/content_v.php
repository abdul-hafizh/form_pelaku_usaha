    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"><?php echo $mytitle; ?></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo str_replace('_', ' ', strtoupper($uri)); ?></a></li>
                                    <?php if (isset($uri2)) { ?>
                                        <li class="breadcrumb-item active"><?php echo str_replace('_', ' ', strtoupper($uri2)); ?></li>
                                    <?php } ?>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <?php
                    $message = $this->session->userdata("message");
                    $validate = validation_errors();

                    if(!empty($message)){ 
                ?>

                    <div class="alert alert-primary alert-dismissible alert-label-icon rounded-label fade show" role="alert">
                        <i class="ri-error-warning-line label-icon"></i><strong> <?php echo $message ?> </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php } $this->session->unset_userdata("message");

                    if(!empty($validate)){ 
                        
                ?>

                    <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show" role="alert">
                        <i class="ri-error-warning-line label-icon"></i><strong> <?php echo $validate ?> </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php } ?>

                <?php include($body.".php"); ?>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> ©
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Sistem Pencatatan Pelaku Usaha
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->