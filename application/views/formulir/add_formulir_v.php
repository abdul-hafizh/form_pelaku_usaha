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
                            <input type="text" class="form-control" name="nama_pelaku_usaha" placeholder="Nama Pelaku Usaha" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">2. NIK</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="number" class="form-control" name="nik" placeholder="NIK" required>
                        </div>
                        <div class="col-lg-3">
                            <input type="file" class="form-control" name="foto_ktp" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">3. Nomor Kontak/WA</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="no_telp" placeholder="Nomor Kontak/WA" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="leaveemails" class="form-label">4. Email</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">5. NPWP <small class="text-muted">Jika ada</small></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="no_npwp" placeholder="NPWP Jika Ada">
                        </div>
                    </div>                    
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">6. NIB <small class="text-muted">Jika ada</small></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="no_nib" placeholder="NIB Jika Ada">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">7. Jenis Produk <small class="text-muted">(sesuai KBLI)</small></label> 
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="jenis_produk" placeholder="Jenis Produk" required>
                        </div>
                        <div class="col-lg-3">
                            <input type="number" class="form-control" name="kbli" placeholder="KBLI" >
                        </div>
                    </div> 
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">8. Merek Produk</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="nama_produk" placeholder="Merek Produk" required>
                        </div>
                    </div> <hr/>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <div class="col-lg-3">
                            <select class="select-single" name="provinsi" id="provinsi">
                                <option value="">Pilih Provinsi</option>
                                <?php foreach($provinsi as $v) { ?>
                                    <option value="<?php echo $v['province_name']; ?>"><?php echo $v['province_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select class="select-single" name="kabupaten" id="kabupaten" disabled>
                                <option value="">Pilih Kabupaten</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">9. Alamat Produksi</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="alamat_produksi" rows="3" placeholder="Alamat Produksi" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">10. Alamat Outlet Penjualan</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="alamat_outlet" rows="3" placeholder="Alamat Outlet" ></textarea>
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
                    <div class="form-floating">
                        <input type="text" class="form-control" name="produk1_inp" placeholder="Nama Produk 1" >
                        <label class="form-label">11. Nama Produk 1</label>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">  
                        <div class="col-lg-3">
                            <label class="form-label">Varian 1</label>
                            <input type="file" class="form-control" name="foto_produk1" required>
                            <input type="text" class="form-control mt-2" name="desc_produk1" placeholder="Keterangan Varian 1" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 2</label>
                            <input type="file" class="form-control" name="foto_produk2">
                            <input type="text" class="form-control mt-2" name="desc_produk2" placeholder="Keterangan Varian 2" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 3</label>
                            <input type="file" class="form-control" name="foto_produk3">
                            <input type="text" class="form-control mt-2" name="desc_produk3" placeholder="Keterangan Varian 3" >
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 4</label>
                            <input type="file" class="form-control" name="foto_produk4">
                            <input type="text" class="form-control mt-2" name="desc_produk4" placeholder="Keterangan Varian 4" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Varian 5</label>
                            <input type="file" class="form-control" name="foto_produk5">
                            <input type="text" class="form-control mt-2" name="desc_produk5" placeholder="Keterangan Varian 5" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 6</label>
                            <input type="file" class="form-control" name="foto_produk6">
                            <input type="text" class="form-control mt-2" name="desc_produk6" placeholder="Keterangan Varian 6" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 7</label>
                            <input type="file" class="form-control" name="foto_produk7">
                            <input type="text" class="form-control mt-2" name="desc_produk7" placeholder="Keterangan Varian 7" >
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 8</label>
                            <input type="file" class="form-control" name="foto_produk8">
                            <input type="text" class="form-control mt-2" name="desc_produk8" placeholder="Keterangan Varian 8" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Varian 9</label>
                            <input type="file" class="form-control" name="foto_produk9">
                            <input type="text" class="form-control mt-2" name="desc_produk9" placeholder="Keterangan Varian 9" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 10</label>
                            <input type="file" class="form-control" name="foto_produk10">
                            <input type="text" class="form-control mt-2" name="desc_produk10" placeholder="Keterangan Varian 10" >
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
                    <div class="form-floating">
                        <input type="text" class="form-control" name="produk2_inp" placeholder="Nama Produk 2" >
                        <label class="form-label">12. Nama Produk 2</label>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">  
                        <div class="col-lg-3">
                            <label class="form-label">Varian 1</label>
                            <input type="file" class="form-control" name="foto_produk1_2">
                            <input type="text" class="form-control mt-2" name="desc_produk1_2" placeholder="Keterangan Varian 1" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 2</label>
                            <input type="file" class="form-control" name="foto_produk2_2">
                            <input type="text" class="form-control mt-2" name="desc_produk2_2" placeholder="Keterangan Varian 2" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 3</label>
                            <input type="file" class="form-control" name="foto_produk3_2">
                            <input type="text" class="form-control mt-2" name="desc_produk3_2" placeholder="Keterangan Varian 3" >
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 4</label>
                            <input type="file" class="form-control" name="foto_produk4_2">
                            <input type="text" class="form-control mt-2" name="desc_produk4_2" placeholder="Keterangan Varian 4" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Varian 5</label>
                            <input type="file" class="form-control" name="foto_produk5_2">
                            <input type="text" class="form-control mt-2" name="desc_produk5_2" placeholder="Keterangan Varian 5" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 6</label>
                            <input type="file" class="form-control" name="foto_produk6_2">
                            <input type="text" class="form-control mt-2" name="desc_produk6_2" placeholder="Keterangan Varian 6" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 7</label>
                            <input type="file" class="form-control" name="foto_produk7_2">
                            <input type="text" class="form-control mt-2" name="desc_produk7_2" placeholder="Keterangan Varian 7" >
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 8</label>
                            <input type="file" class="form-control" name="foto_produk8_2">
                            <input type="text" class="form-control mt-2" name="desc_produk8_2" placeholder="Keterangan Varian 8" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Varian 9</label>
                            <input type="file" class="form-control" name="foto_produk9_2">
                            <input type="text" class="form-control mt-2" name="desc_produk9_2" placeholder="Keterangan Varian 9" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 10</label>
                            <input type="file" class="form-control" name="foto_produk10_2">
                            <input type="text" class="form-control mt-2" name="desc_produk10_2" placeholder="Keterangan Varian 10" >
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
                    <div class="form-floating">
                        <input type="text" class="form-control" name="produk3_inp" placeholder="Nama Produk 3" >
                        <label class="form-label">13. Nama Produk 3</label>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">  
                        <div class="col-lg-3">
                            <label class="form-label">Varian 1</label>
                            <input type="file" class="form-control" name="foto_produk1_3">
                            <input type="text" class="form-control mt-2" name="desc_produk1_3" placeholder="Keterangan Varian 1" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 2</label>
                            <input type="file" class="form-control" name="foto_produk2_3">
                            <input type="text" class="form-control mt-2" name="desc_produk2_3" placeholder="Keterangan Varian 2" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 3</label>
                            <input type="file" class="form-control" name="foto_produk3_3">
                            <input type="text" class="form-control mt-2" name="desc_produk3_3" placeholder="Keterangan Varian 3" >
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 4</label>
                            <input type="file" class="form-control" name="foto_produk4_3">
                            <input type="text" class="form-control mt-2" name="desc_produk4_3" placeholder="Keterangan Varian 4" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Varian 5</label>
                            <input type="file" class="form-control" name="foto_produk5_3">
                            <input type="text" class="form-control mt-2" name="desc_produk5_3" placeholder="Keterangan Varian 5" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 6</label>
                            <input type="file" class="form-control" name="foto_produk6_3">
                            <input type="text" class="form-control mt-2" name="desc_produk6_3" placeholder="Keterangan Varian 6" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 7</label>
                            <input type="file" class="form-control" name="foto_produk7_3">
                            <input type="text" class="form-control mt-2" name="desc_produk7_3" placeholder="Keterangan Varian 7" >
                        </div>                        
                        <div class="col-lg-3">
                            <label class="form-label">Varian 8</label>
                            <input type="file" class="form-control" name="foto_produk8_3">
                            <input type="text" class="form-control mt-2" name="desc_produk8_3" placeholder="Keterangan Varian 8" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Varian 9</label>
                            <input type="file" class="form-control" name="foto_produk9_3">
                            <input type="text" class="form-control mt-2" name="desc_produk9_3" placeholder="Keterangan Varian 9" >
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Varian 10</label>
                            <input type="file" class="form-control" name="foto_produk10_3">
                            <input type="text" class="form-control mt-2" name="desc_produk10_3" placeholder="Keterangan Varian 10" >
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
    })
</script>