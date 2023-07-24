<!--select2 css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jquery validate-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<style>
    label.error {
        color: red;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }
</style>

<form action="<?php echo site_url('formulir/update_formulir'); ?>" method="post" id="basic-form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Data Pelaku Usaha</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">1. Nama Pelaku Usaha</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="nama_pelaku_usaha" placeholder="Nama Pelaku Usaha" value="<?php echo $detail['nama_pelaku_usaha']; ?>" required>
                            <input type="hidden" name="id_form" value="<?php echo $detail['id']; ?>" >
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
                            <input type="text" class="form-control" name="nik" placeholder="NIK" value="<?php echo $detail['nik']; ?>" required>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <label class="input-group-text">Upload KTP</label>                                
                                <input type="file" class="form-control" name="foto_ktp">
                            </div>
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
                            <input type="text" class="form-control" name="no_telp" placeholder="Nomor Kontak/WA" value="<?php echo $detail['no_telp']; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="leaveemails" class="form-label">4. Email</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo $detail['email']; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">5. NPWP <small class="text-muted">Jika ada</small></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="no_npwp" placeholder="NPWP Jika Ada" value="<?php echo $detail['no_npwp']; ?>" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">6. NIB <small class="text-muted">Jika ada</small></label>
                        </div>
                        <div class="col-lg-3">       
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nib_radio" value="option1" <?php echo !empty($detail['no_nib']) ? 'checked' : '' ?>>
                                <label class="form-check-label">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nib_radio" value="option2" <?php echo empty($detail['no_nib']) ? 'checked' : '' ?>>
                                <label class="form-check-label">Belum Ada</label>
                            </div>
                        </div>
                        <div class="col-lg-3 is_nib">
                            <input type="number" class="form-control no_nib_inp" name="no_nib" placeholder="NIB Jika Ada" value="<?php echo $detail['no_nib']; ?>" >
                        </div>
                    </div>
                    <div class="is_no_nib">
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                &nbsp;
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text">Modal</span>
                                    <input type="number" class="form-control modal_inp" min="500000" name="modal" placeholder="Modal Dasar" value="<?php echo $detail['modal']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text">Kapasitas Produksi/Tahun</span>
                                    <input type="number" class="form-control jml_prod_inp" min="1" name="jml_produksi" placeholder="Kapasitas Produksi/Tahun" value="<?php echo $detail['jml_produksi']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text">Satuan</span>
                                    <select class="form-control satuan_inp" name="satuan">
                                        <option value="">Pilih Satuan</option>
                                        <option value="Liter" <?php echo $detail['satuan'] == 'Liter' ? 'selected' : ''; ?>>Liter</option>
                                        <option value="Kg" <?php echo $detail['satuan'] == 'Kg' ? 'selected' : ''; ?>>Kg</option>
                                        <option value="Ton" <?php echo $detail['satuan'] == 'Ton' ? 'selected' : ''; ?>>Ton</option>
                                        <option value="Pcs" <?php echo $detail['satuan'] == 'Pcs' ? 'selected' : ''; ?>>Pcs</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                &nbsp;
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-text">Tahun Berdiri</span>
                                    <input type="number" class="form-control tahun_inp" min="1900" max="2023" name="tahun_berdiri" placeholder="Tahun Berdiri" value="<?php echo $detail['tahun_berdiri']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-text">Bulan</span>
                                    <select class="form-control bulan_inp" name="bulan_berdiri">
                                        <option value="">Pilih Bulan</option>
                                        <option value="Januari" <?php echo $detail['bulan_berdiri'] == 'Januari' ? 'selected' : ''; ?>>Januari</option>
                                        <option value="Februari" <?php echo $detail['bulan_berdiri'] == 'Februari' ? 'selected' : ''; ?>>Februari</option>
                                        <option value="Maret" <?php echo $detail['bulan_berdiri'] == 'Maret' ? 'selected' : ''; ?>>Maret</option>
                                        <option value="April" <?php echo $detail['bulan_berdiri'] == 'April' ? 'selected' : ''; ?>>April</option>
                                        <option value="Mei" <?php echo $detail['bulan_berdiri'] == 'Mei' ? 'selected' : ''; ?>>Mei</option>
                                        <option value="Juni" <?php echo $detail['bulan_berdiri'] == 'Juni' ? 'selected' : ''; ?>>Juni</option>
                                        <option value="Juli" <?php echo $detail['bulan_berdiri'] == 'Juli' ? 'selected' : ''; ?>>Juli</option>
                                        <option value="Agustus" <?php echo $detail['bulan_berdiri'] == 'Agustus' ? 'selected' : ''; ?>>Agustus</option>
                                        <option value="September" <?php echo $detail['bulan_berdiri'] == 'September' ? 'selected' : ''; ?>>September</option>
                                        <option value="Oktober" <?php echo $detail['bulan_berdiri'] == 'Oktober' ? 'selected' : ''; ?>>Oktober</option>
                                        <option value="November" <?php echo $detail['bulan_berdiri'] == 'November' ? 'selected' : ''; ?>>November</option>
                                        <option value="Desember" <?php echo $detail['bulan_berdiri'] == 'Desember' ? 'selected' : ''; ?>>Desember</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">7. Jenis Usaha <small class="text-muted">(sesuai KBLI)</small></label> 
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="jenis_produk" placeholder="Jenis Usaha" value="<?php echo $detail['jenis_produk']; ?>" required>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="kbli" placeholder="KBLI" value="<?php echo $detail['kbli']; ?>" >
                        </div>
                    </div> 
                    
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">8. Merek Produk</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="nama_produk" placeholder="Merek Produk" value="<?php echo $detail['nama_produk']; ?>" required>
                        </div>
                    </div> <hr/>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <div class="col-lg-3">
                            <select class="select-single" name="provinsi" id="provinsi" required>
                                <option value="">Pilih Provinsi</option>
                                <?php foreach($provinsi as $v) { ?>
                                    <option value="<?php echo $v['province_name']; ?>" <?php echo $detail['provinsi'] == $v['province_name'] ? 'selected' : '' ; ?>><?php echo $v['province_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select class="select-single" name="kabupaten" id="kabupaten" disabled>
                            <?php foreach($kabupaten as $v) { ?>
                                    <option value="<?php echo $v['regency_name']; ?>" <?php echo $detail['kabupaten'] == $v['regency_name'] ? 'selected' : '' ; ?>><?php echo $v['regency_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">9. Alamat Produksi</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="alamat_produksi" rows="3" placeholder="Alamat Produksi" required><?php echo $detail['alamat_produksi']; ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">10. Alamat Outlet Penjualan</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="alamat_outlet" rows="3" placeholder="Alamat Produksi" ><?php echo $detail['alamat_outlet']; ?></textarea>
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
                    <input type="text" class="form-control" name="produk1_inp" value="<?php echo $detail['produk_1']; ?>" required>
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
                            <input type="file" class="form-control" name="foto_produk1">
                            <input type="text" class="form-control mt-2" name="desc_produk1" placeholder="Keterangan Varian 1" value="<?php echo $detail['desc_produk1']?>" required>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 2</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk2">
                            <input type="text" class="form-control mt-2" name="desc_produk2" placeholder="Keterangan Varian 2" value="<?php echo $detail['desc_produk2']?>">
                        </div>                    
                        <div class="col-lg-3">
                            <label class="form-label">Varian 3</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk3">
                            <input type="text" class="form-control mt-2" name="desc_produk3" placeholder="Keterangan Varian 3" value="<?php echo $detail['desc_produk3']?>">
                        </div>                                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 4</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk4">
                            <input type="text" class="form-control mt-2" name="desc_produk4" placeholder="Keterangan Varian 4" value="<?php echo $detail['desc_produk4']?>">
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
                            <input type="file" class="form-control" name="foto_produk5">
                            <input type="text" class="form-control mt-2" name="desc_produk5" placeholder="Keterangan Varian 5" value="<?php echo $detail['desc_produk5']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 6</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk6">
                            <input type="text" class="form-control mt-2" name="desc_produk6" placeholder="Keterangan Varian 6" value="<?php echo $detail['desc_produk6']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 7</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk7">
                            <input type="text" class="form-control mt-2" name="desc_produk7" placeholder="Keterangan Varian 7" value="<?php echo $detail['desc_produk7']?>">
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 8</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk8">
                            <input type="text" class="form-control mt-2" name="desc_produk8" placeholder="Keterangan Varian 8" value="<?php echo $detail['desc_produk8']?>">
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
                            <input type="file" class="form-control" name="foto_produk9">
                            <input type="text" class="form-control mt-2" name="desc_produk9" placeholder="Keterangan Varian 9" value="<?php echo $detail['desc_produk9']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 10</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk10">
                            <input type="text" class="form-control mt-2" name="desc_produk10" placeholder="Keterangan Varian 10" value="<?php echo $detail['desc_produk10']?>">
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
                    <input type="text" class="form-control" name="produk2_inp" value="<?php echo $detail['produk_2']; ?>">                    
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
                            <input type="file" class="form-control" name="foto_produk1_2">
                            <input type="text" class="form-control mt-2" name="desc_produk1_2" placeholder="Keterangan Varian 1" value="<?php echo $detail['desc_produk1_2']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 2</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2_2']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk2_2">
                            <input type="text" class="form-control mt-2" name="desc_produk2_2" placeholder="Keterangan Varian 2" value="<?php echo $detail['desc_produk2_2']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 3</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3_2']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk3_2">
                            <input type="text" class="form-control mt-2" name="desc_produk3_2" placeholder="Keterangan Varian 3" value="<?php echo $detail['desc_produk3_2']?>">
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 4</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4_2']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk4_2">
                            <input type="text" class="form-control mt-2" name="desc_produk4_2" placeholder="Keterangan Varian 4" value="<?php echo $detail['desc_produk4_2']?>">
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
                            <input type="file" class="form-control" name="foto_produk5_2">
                            <input type="text" class="form-control mt-2" name="desc_produk5_2" placeholder="Keterangan Varian 5" value="<?php echo $detail['desc_produk5_2']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 6</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6_2']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk6_2">
                            <input type="text" class="form-control mt-2" name="desc_produk6_2" placeholder="Keterangan Varian 6" value="<?php echo $detail['desc_produk6_2']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 7</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7_2']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk7_2">
                            <input type="text" class="form-control mt-2" name="desc_produk7_2" placeholder="Keterangan Varian 7" value="<?php echo $detail['desc_produk7_2']?>">
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 8</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8_2']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk8_2">
                            <input type="text" class="form-control mt-2" name="desc_produk8_2" placeholder="Keterangan Varian 8" value="<?php echo $detail['desc_produk8_2']?>">
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
                            <input type="file" class="form-control" name="foto_produk9_2">
                            <input type="text" class="form-control mt-2" name="desc_produk9_2" placeholder="Keterangan Varian 9" value="<?php echo $detail['desc_produk9_2']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 10</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10_2']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10_2']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk10_2">
                            <input type="text" class="form-control mt-2" name="desc_produk10_2" placeholder="Keterangan Varian 10" value="<?php echo $detail['desc_produk10_2']?>">
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
                    <input type="text" class="form-control" name="produk3_inp" value="<?php echo $detail['produk_3']; ?>">
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
                            <input type="file" class="form-control" name="foto_produk1_3">
                            <input type="text" class="form-control mt-2" name="desc_produk1_3" placeholder="Keterangan Varian 1" value="<?php echo $detail['desc_produk1_3']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 2</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk2_3']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk2_3">
                            <input type="text" class="form-control mt-2" name="desc_produk2_3" placeholder="Keterangan Varian 2" value="<?php echo $detail['desc_produk2_3']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 3</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk3_3']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk3_3">
                            <input type="text" class="form-control mt-2" name="desc_produk3_3" placeholder="Keterangan Varian 3" value="<?php echo $detail['desc_produk3_3']?>">
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 4</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk4_3']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk4_3">
                            <input type="text" class="form-control mt-2" name="desc_produk4_3" placeholder="Keterangan Varian 4" value="<?php echo $detail['desc_produk4_3']?>">
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
                            <input type="file" class="form-control" name="foto_produk5_3">
                            <input type="text" class="form-control mt-2" name="desc_produk5_3" placeholder="Keterangan Varian 5" value="<?php echo $detail['desc_produk5_3']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 6</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk6_3']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk6_3">
                            <input type="text" class="form-control mt-2" name="desc_produk6_3" placeholder="Keterangan Varian 6" value="<?php echo $detail['desc_produk6_3']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 7</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk7_3']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk7_3">
                            <input type="text" class="form-control mt-2" name="desc_produk7_3" placeholder="Keterangan Varian 7" value="<?php echo $detail['desc_produk7_3']?>">
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 8</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk8_3']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk8_3">
                            <input type="text" class="form-control mt-2" name="desc_produk8_3" placeholder="Keterangan Varian 8" value="<?php echo $detail['desc_produk8_3']?>">
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
                            <input type="file" class="form-control" name="foto_produk9_3">
                            <input type="text" class="form-control mt-2" name="desc_produk9_3" placeholder="Keterangan Varian 9" value="<?php echo $detail['desc_produk9_3']?>">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 10</label>
                            <div class="border border-dashed w-50">
                                <a href="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10_3']); ?>" target="_blank" class="bg-light rounded p-1">
                                    <img src="<?php echo base_url('uploads/formulir/' . $detail['foto_produk10_3']); ?>" alt="" class="img-fluid d-block" />
                                </a>
                            </div>
                            <input type="file" class="form-control" name="foto_produk10_3">
                            <input type="text" class="form-control mt-2" name="desc_produk10_3" placeholder="Keterangan Varian 10" value="<?php echo $detail['desc_produk10_3']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning col-4" onclick="return confirm('Apakah Anda yakin?');">Simpan Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>    
    $(document).ready(function () {
        $(".select-single").select2();

        $("#basic-form").validate({
            invalidHandler: function(event, validator) {            
                var errors = validator.numberOfInvalids();
                if (errors) { window.scrollTo({top: 0}); }
            }
        });

        $("#provinsi").on("change", function () {
			let provinsi = $("#provinsi").val();
			$.ajax({
				url: "<?php echo site_url('formulir/get_regency');?>",
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
		});

        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            if(inputValue == 'option1') {
                $(".is_no_nib").hide();
                $(".is_nib").show();
                $(".modal_inp").val("");
                $(".jml_prod_inp").val("");
                $(".satuan_inp").val("");
                $(".tahun_inp").val("");
                $(".bulan_inp").val("");

            } else if(inputValue == 'option2') {
                $(".is_no_nib").show();
                $(".is_nib").hide();
                $(".no_nib_inp").val("");
            }            
        });

        if(!$('.no_nib_inp').val() == ''){
            $(".is_no_nib").hide();
            $(".modal_inp").val("");
            $(".jml_prod_inp").val("");
            $(".satuan_inp").val("");
            $(".tahun_inp").val("");
            $(".bulan_inp").val("");

        } else {
            $(".is_nib").hide();
            $(".no_nib_inp").val("");
        }
    })
</script>
