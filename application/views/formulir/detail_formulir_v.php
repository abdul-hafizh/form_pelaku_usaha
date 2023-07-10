<!--Swiper slider css-->
<link href="<?php echo base_url(); ?>assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Pelaku Usaha</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">1. Nama Pelaku Usaha</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nama_pelaku_usaha" placeholder="Nama Pelaku Usaha" value="<?php echo $detail['nama_pelaku_usaha']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">2. NIK</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nik" placeholder="NIK" value="<?php echo $detail['nik']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">3. Nomor Kontak/WA</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="no_telp" placeholder="Nomor Kontak/WA" value="<?php echo $detail['no_telp']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="leaveemails" class="form-label">4. Email</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo $detail['email']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">5. NPWP Jika Ada</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="no_npwp" placeholder="NPWP Jika Ada" value="<?php echo $detail['no_npwp']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">6. Nama/Merek Produk</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nama_produk" placeholder="Nama/Merek Produk" value="<?php echo $detail['nama_produk']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">7. NIB Jika Ada</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="no_nib" placeholder="NIB Jika Ada" value="<?php echo $detail['no_nib']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">8. Jenis Produk <small class="text-muted">(sesuai KBLI)</small></label> 
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="jenis_produk" placeholder="Nama/Merek Produk" value="<?php echo $detail['jenis_produk']; ?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="kbli" placeholder="KBLI" value="<?php echo $detail['kbli']; ?>" readonly >
                    </div>
                </div> <hr/>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">&nbsp;</label>
                    </div>
                    <div class="col-lg-3">
                        <h6><?php echo $detail['kabupaten']; ?></h6>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">9. Alamat Produksi</label>
                    </div>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="alamat_produksi" rows="3" placeholder="Alamat Produksi" readonly ><?php echo $detail['alamat_produksi']; ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">10. Alamat Outlet Penjualan</label>
                    </div>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="alamat_outlet" rows="3" placeholder="Alamat Produksi" readonly ><?php echo $detail['alamat_outlet']; ?></textarea>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Foto KTP dan Produk</h4>
        </div>
        <div class="card-body">
            <div class="swiper responsive-swiper rounded gallery-light pb-4">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_ktp']); ?>" target="_blank" title="Foto KTP">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_ktp']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_ktp'];?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted">at <a href="" class="text-body text-truncate"><?php echo $detail['tanggal_input'];?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk1']); ?>" target="_blank" title="Produk 1">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk1']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk1']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk1']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2']); ?>" target="_blank" title="Produk 2">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk2']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk2']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3']); ?>" target="_blank" title="Produk 3">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk3']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk3']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4']); ?>" target="_blank" title="Produk 4">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk4']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk4']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk5']); ?>" target="_blank" title="Produk 5">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk5']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk5']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk5']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6']); ?>" target="_blank" title="Produk 6">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk6']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk6']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7']); ?>" target="_blank" title="Produk 7">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk7']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk7']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8']); ?>" target="_blank" title="Produk 8">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk8']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk8']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk9']); ?>" target="_blank" title="Produk 9">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk9']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk9']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk9']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-box card">
                            <div class="gallery-container">
                                <a class="image-popup" href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10']); ?>" target="_blank" title="Produk 10">
                                    <img class="gallery-img img-fluid mx-auto" src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10']); ?>" alt="" />
                                    <div class="gallery-overlay">
                                        <h5 class="overlay-caption"><?php echo $detail['foto_produk10']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="box-content">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="flex-grow-1 text-muted"><?php echo $detail['desc_produk10']; ?></div>           
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="swiper-pagination swiper-pagination-dark"></div>
            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->
</div>
<!--end col-->
</div>
<!--end row-->

<!--Swiper slider js-->
<script src="<?php echo base_url(); ?>assets/libs/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".responsive-swiper", {
        loop: !0,
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: { el: ".swiper-pagination", clickable: !0 },
        breakpoints: { 640: { slidesPerView: 2, spaceBetween: 20 }, 768: { slidesPerView: 3, spaceBetween: 40 }, 1200: { slidesPerView: 4, spaceBetween: 50 } },
    });

</script>