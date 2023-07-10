<!--select2 css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<form action="<?php echo site_url('formulir/submit_formulir'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Data Pelaku Usaha</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">1. Nama Pelaku Usaha</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="nama_pelaku_usaha" placeholder="Nama Pelaku Usaha" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">2. NIK</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="nik" placeholder="NIK" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">3. Nomor Kontak/WA</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="no_telp" placeholder="Nomor Kontak/WA" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="leaveemails" class="form-label">4. Email</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">5. NPWP Jika Ada</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="no_npwp" placeholder="NPWP Jika Ada">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">6. Nama/Merek Produk</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="nama_produk" placeholder="Nama/Merek Produk" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">7. NIB Jika Ada</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="no_nib" placeholder="NIB Jika Ada">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">8. Jenis Produk <small class="text-muted">(sesuai KBLI)</small></label> 
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="jenis_produk" placeholder="Nama/Merek Produk" >
                        </div>
                        <div class="col-lg-3">
                            <input type="number" class="form-control" name="kbli" placeholder="KBLI" >
                        </div>
                    </div> <hr/>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <div class="col-lg-3">
                            <select class="select-single" name="kabupaten" >
                                <option value="">Pilih Kabupaten</option>
                                <?php foreach($kabupaten as $v) { ?>
                                    <option value="<?php echo $v['regency_name']; ?>"><?php echo $v['regency_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">9. Alamat Produksi</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="alamat_produksi" rows="3" placeholder="Alamat Produksi" ></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">10. Alamat Outlet Penjualan</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="alamat_outlet" rows="3" placeholder="Alamat Produksi" ></textarea>
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
                    <h4 class="card-title mb-0">11. Foto Produk/KTP</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-3">                        
                        <div class="col-lg-3">
                            <label class="form-label">Foto KTP</label>
                            <input type="file" class="form-control" name="foto_ktp" required>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Foto 1</label>
                            <input type="file" class="form-control" name="foto_produk1" required>
                            <input type="text" class="form-control mt-2" name="desc_produk1" placeholder="Keterangan Produk 1" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Foto 2</label>
                            <input type="file" class="form-control" name="foto_produk2">
                            <input type="text" class="form-control mt-2" name="desc_produk2" placeholder="Keterangan Produk 2" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Foto 3</label>
                            <input type="file" class="form-control" name="foto_produk3">
                            <input type="text" class="form-control mt-2" name="desc_produk3" placeholder="Keterangan Produk 3" >
                        </div>                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Foto 4</label>
                            <input type="file" class="form-control" name="foto_produk4">
                            <input type="text" class="form-control mt-2" name="desc_produk4" placeholder="Keterangan Produk 4" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Foto 5</label>
                            <input type="file" class="form-control" name="foto_produk5">
                            <input type="text" class="form-control mt-2" name="desc_produk5" placeholder="Keterangan Produk 5" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Foto 6</label>
                            <input type="file" class="form-control" name="foto_produk6">
                            <input type="text" class="form-control mt-2" name="desc_produk6" placeholder="Keterangan Produk 6" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Foto 7</label>
                            <input type="file" class="form-control" name="foto_produk7">
                            <input type="text" class="form-control mt-2" name="desc_produk7" placeholder="Keterangan Produk 7" >
                        </div>                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Foto 8</label>
                            <input type="file" class="form-control" name="foto_produk8">
                            <input type="text" class="form-control mt-2" name="desc_produk8" placeholder="Keterangan Produk 8" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Foto 9</label>
                            <input type="file" class="form-control" name="foto_produk9">
                            <input type="text" class="form-control mt-2" name="desc_produk9" placeholder="Keterangan Produk 9" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Foto 10</label>
                            <input type="file" class="form-control" name="foto_produk10">
                            <input type="text" class="form-control mt-2" name="desc_produk10" placeholder="Keterangan Produk 10" >
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
                        <button type="submit" class="btn btn-primary col-4" onclick="return confirm('Apakah Anda yakin?');">Simpan Data</button>
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
    })
</script>