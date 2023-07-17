<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=". $nama_file .".xls");
?>
<table style="width:100%" border="1">
    <thead>
        <tr>
            <th class='col-sm-1 text-center'>No</th>
            <th>Pelaku Usaha</th>
            <th>NIK</th>
            <th>KBLI</th>
            <th>Nama Produk</th>
            <th>Jenis Usaha</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>No Kontak / WA</th>
            <th>Email</th>
            <th>NPWP</th>
            <th>NIB</th>
            <th>Alamat Produksi</th>
            <th>Alamat Outlet</th>
            <th>Tanggal Input</th>
            <th>Tanggal Update</th>
            <th>Tanggal Selesai</th>
            <th>Input By</th>
            <th>Update By</th>
            <th>Phone Petugas Input</th>
            <th>Phone Petugas Update</th>
            <th>Status Approve</th>
            <th>Status Pendampingan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($list_formulir as $v) { ?>
            <tr> 
                <td class='text-center'><?php echo $no++; ?></td>
                <td><?php echo $v['nama_pelaku_usaha']; ?></td>
                <td><?php echo $v['nik']; ?></td>
                <td><?php echo $v['kbli']; ?></td>
                <td><?php echo $v['nama_produk']; ?></td>
                <td><?php echo $v['jenis_produk']; ?></td>
                <td><?php echo $v['provinsi']; ?></td>
                <td><?php echo $v['kabupaten']; ?></td>
                <td><?php echo $v['no_telp']; ?></td>
                <td><?php echo $v['email']; ?></td>
                <td><?php echo $v['no_npwp']; ?></td>
                <td><?php echo $v['no_nib']; ?></td>
                <td><?php echo $v['alamat_produksi']; ?></td>
                <td><?php echo $v['alamat_outlet']; ?></td>
                <td><?php echo $v['tanggal_input']; ?></td>
                <td><?php echo $v['tanggal_update']; ?></td>
                <td><?php echo $v['tanggal_selesai']; ?></td>
                <td><?php echo $v['nama_input']; ?></td>
                <td><?php echo $v['nama_update']; ?></td>
                <td><?php echo $v['phone_input']; ?></td>
                <td><?php echo $v['phone_update']; ?></td>
                <td><?php if ($v['status'] == 2) { echo '<span>Sudah Diapprove</span>'; } elseif ($v['status'] == 3) { echo '<span>Tidak Diapprove</span>'; } else { echo '<span class="badge bg-danger">Belum Diapprove</span>'; } ?></td>
                <td><?php echo $v['status_pendamping'] == 2 ? '<span>Selesai Pendamping</span>' : '<span>Belum Selesai</span>' ; ?></td>                                
            </tr>    
        <?php } ?>
    </tbody>
</table>