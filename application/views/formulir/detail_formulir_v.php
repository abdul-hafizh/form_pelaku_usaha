<!--Swiper slider css-->
<link href="<?php echo base_url(); ?>assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
<!--select2 css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">                
                <div class="float-start">
                    <h5 class="card-title mb-0">Detail Data Pelaku Usaha</h5>
                </div>
                <div class="float-end">
                    <?php if($detail['status'] == 1) { ?>                        
                        <?php if($userdata['pos_name'] == 'KORWIL') { ?>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_approve">
                                <i class="las la-check-circle"></i> Approve
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_unapprove">
                                <i class="las la-times-circle"></i> Unapprove
                            </button> | 
                        <?php } ?>
                        <a href="#" class="btn btn-sm btn-secondary">Belum Diapprove</a>
                        <?php } elseif($detail['status'] == 3) { ?>
                            <a href="#" class="btn btn-sm btn-danger">Tidak Diapprove</a>
                        <?php } else { ?>
                            <a href="#" class="btn btn-sm btn-success">Sudah Diapprove</a>
                            <?php if($userdata['pos_name'] == 'VIEWER' && $detail['status_pendamping'] != 2) { ?>
                                <a href="<?php echo site_url('formulir/update_status_pendamping/' . $detail['id']);?>" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-sm btn-danger"><i class="lab la-telegram-plane"></i> Selesai Pendampingan</a>
                            <?php } ?>
                    <?php } ?>

                </div>
            </div>
            <div class="card-body">
                <?php if(isset($form_srv['username']) && $userdata['pos_name'] != 'ENUM') { ?>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                        &nbsp;
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?php echo $form_srv['username']; ?>" readonly>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" value="<?php echo $form_srv['password']; ?>" readonly>
                    </div>
                </div>
                <?php } ?>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">1. Nama Pelaku Usaha</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nama_pelaku_usaha" placeholder="Nama Pelaku Usaha" value="<?php echo $detail['nama_pelaku_usaha']; ?>" readonly >
                    </div>
                </div>
                <?php if($detail['status'] == 3) { ?>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label text-danger">&nbsp;&nbsp;&nbsp;&nbsp; Alasan Tidak Diapprove</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="alasan" placeholder="Alasan" value="<?php echo $detail['alasan']; ?>" readonly>                            
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="nik" placeholder="NIK" value="<?php echo $detail['nik']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">2. NIK</label>
                    </div>
                    <div class="col-lg-2">
                        <div class="d-inline-flex gap-2 border border-dashed p-2 mb-2 w-75">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_ktp']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_ktp']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
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
                        <label class="form-label">5. NPWP <small class="text-muted">Jika ada</small></label>
                    </div>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="no_npwp" placeholder="NPWP Jika Ada" value="<?php echo $detail['no_npwp']; ?>" readonly >
                    </div>
                </div>                
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">6. NIB <small class="text-muted">Jika ada</small></label>
                    </div>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="no_nib" placeholder="NIB Jika Ada" value="<?php echo $detail['no_nib']; ?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">7. Jenis Usaha <small class="text-muted">(sesuai KBLI)</small></label> 
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="jenis_produk" placeholder="Jenis Usaha" value="<?php echo $detail['jenis_produk']; ?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="kbli" placeholder="KBLI" value="<?php echo $detail['kbli']; ?>" readonly >
                    </div>
                </div> 
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">8. Merek Produk</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nama_produk" placeholder="Merek Produk" value="<?php echo $detail['nama_produk']; ?>" readonly >
                    </div>
                </div> <hr/>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">&nbsp;</label>
                    </div>
                    <div class="col-lg-3">
                        <h6><?php echo $detail['provinsi']; ?></h6>
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

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <label class="form-label">11. Nama Produk 1</label>
                <input type="text" class="form-control" name="produk1_inp" value="<?php echo $detail['produk_1']; ?>" readonly>
            </div>
            <div class="card-body">
                <div class="row mb-3">  
                    <div class="col-lg-3">
                        <label class="form-label">Varian 1</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk1']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk1']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk1']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 2</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk2']?>" readonly >
                    </div>                    
                    <div class="col-lg-3">
                        <label class="form-label">Varian 3</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk3']?>" readonly >
                    </div>                                        
                    <div class="col-lg-3">
                        <label class="form-label">Varian 4</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk4']?>" readonly >
                    </div>                                                            
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">Varian 5</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk5']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk5']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk5']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 6</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk6']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 7</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk7']?>" readonly >
                    </div>                        
                    <div class="col-lg-3">
                        <label class="form-label">Varian 8</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk8']?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">Varian 9</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk9']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk9']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk9']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 10</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk10']?>" readonly >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <label class="form-label">12. Nama Produk 2</label>
                <input type="text" class="form-control" name="produk2_inp" value="<?php echo $detail['produk_2']; ?>" readonly>
            </div>
            <div class="card-body">
                <div class="row mb-3">  
                    <div class="col-lg-3">
                        <label class="form-label">Varian 1</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk1_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk1_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk1_2']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 2</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk2_2']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 3</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk3_2']?>" readonly >
                    </div>                        
                    <div class="col-lg-3">
                        <label class="form-label">Varian 4</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk4_2']?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">Varian 5</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk5_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk5_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk5_2']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 6</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk6_2']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 7</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk7_2']?>" readonly >
                    </div>                        
                    <div class="col-lg-3">
                        <label class="form-label">Varian 8</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk8_2']?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">Varian 9</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk9_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk9_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk9_2']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 10</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10_2']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk10_2']?>" readonly >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <label class="form-label">13. Nama Produk 3</label>
                <input type="text" class="form-control" name="produk3_inp" value="<?php echo $detail['produk_3']; ?>" readonly>
            </div>
            <div class="card-body">
                <div class="row mb-3">  
                    <div class="col-lg-3">
                        <label class="form-label">Varian 1</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk1_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk1_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk1_3']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 2</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk2_3']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 3</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk3_3']?>" readonly >
                    </div>                        
                    <div class="col-lg-3">
                        <label class="form-label">Varian 4</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk4_3']?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">Varian 5</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk5_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk5_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk5_3']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 6</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk6_3']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 7</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk7_3']?>" readonly >
                    </div>                        
                    <div class="col-lg-3">
                        <label class="form-label">Varian 8</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk8_3']?>" readonly >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">Varian 9</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk9_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk9_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk9_3']?>" readonly >
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Varian 10</label>
                        <div class="border border-dashed w-50">
                            <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10_3']); ?>" alt="" class="img-fluid d-block" />
                            </a>
                        </div>
                        <input type="text" class="form-control mt-2" value="<?php echo $detail['desc_produk10_3']?>" readonly >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_approve" tabindex="-1" aria-labelledby="modal_approveLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_approveLabel">Approve <?php echo $detail['nama_pelaku_usaha'];?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('formulir/approval'); ?>" method="post">
                    <div class="row g-3">
                        <div class="col">
                            <input type="hidden" name="id_form" value="<?php echo $detail["id"];?>">
                            <div><hr/>
                                <label class="form-label">Pendamping</label>
                                <select class="form-control" name="surveyor" required>
                                    <option value="">Pilih Pendamping</option>
                                    <?php foreach($surveyor as $v) { ?>
                                        <option value="<?php echo $v['id']; ?>" <?php echo $pendamping['pendamping_id'] == $v['id'] ? "selected" : "" ;?>><?php echo $v['fullname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="mt-2">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>                            
                        </div>
                        <div class="col-lg-12"><hr/>
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-danger">Approve</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_unapprove" tabindex="-1" aria-labelledby="modal_unapproveLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_unapproveLabel">Unapprove <?php echo $detail['nama_pelaku_usaha'];?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('formulir/unapproval'); ?>" method="post">
                    <div class="row g-3">
                        <div class="col">
                            <input type="hidden" name="id_form" value="<?php echo $detail["id"];?>"> <hr/>                            
                            <div class="mt-2">
                                <label class="form-label">Alasan Tidak Diapprove</label>
                                <input type="text" class="form-control" name="alasan" placeholder="Alasan tidak diapprove" required>
                            </div>                         
                        </div>
                        <div class="col-lg-12"><hr/>
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-danger">Unapprove</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

<!--Swiper slider js-->
<script src="<?php echo base_url(); ?>assets/libs/swiper/swiper-bundle.min.js"></script>
<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $(".select-single").select2();
    })

    var swiper = new Swiper(".responsive-swiper", {
        loop: !0,
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: { el: ".swiper-pagination", clickable: !0 },
        breakpoints: { 640: { slidesPerView: 2, spaceBetween: 20 }, 768: { slidesPerView: 3, spaceBetween: 40 }, 1200: { slidesPerView: 4, spaceBetween: 50 } },
    });

</script>