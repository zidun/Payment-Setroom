<?php  
	include '../config/koneksi.php';
	include '../library/fungsi.php';
	date_default_timezone_set("Asia/Jakarta");
	session_start();

	$aksi= new oop();

	if (isset($_GET['tarif'])) {
		$table = "tarif";
		$cari="";
		$judul = "LAPORAN DAFTAR TARIF";
		$filename = $judul;

		 if(isset($_GET['excel'])){
	    	header("Content-type:aplication/vnd-ms-excel");
			header("Content-type: application/image/png");
	    	header("Content-disposition:attachment; filename=".$filename.".xls");
	    }

	}elseif (isset($_GET['pelanggan'])) {
		$table = "pelanggan";
		$cari = "";
		$judul = "LAPORAN DAFTAR PELANGGAN";
		$filename = $judul;
		 if(isset($_GET['excel'])){
	    	header("Content-type:aplication/vnd-ms-excel");
			header("Content-type: application/image/png");
	    	header("Content-disposition:attachment; filename=".$filename.".xls");
	    }
		
	}elseif (isset($_GET['agen'])) {
		$table = "agen";
		$cari = "";
		$judul = "LAPORAN DAFTAR AGEN";
		$filename = $judul;
		 if(isset($_GET['excel'])){
	    	header("Content-type:aplication/vnd-ms-excel");
			header("Content-type: application/image/png");
	    	header("Content-disposition:attachment; filename=".$filename.".xls");
	    }
		
	}elseif (isset($_GET['tagihan_bulan'])) {
		$status = $_GET['status'];
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$table = "qw_tagihan";
		$cari = "WHERE status = '$status' AND bulan = '$bulan' AND tahun ='$tahun'";
		$judul = "LAPORAN TAGIHAN ".strtoupper($status)." BULAN $bulan TAHUN $tahun";
		$filename = $judul;
		 if(isset($_GET['excel'])){
	    	header("Content-type:aplication/vnd-ms-excel");
			header("Content-type: application/image/png");
	    	header("Content-disposition:attachment; filename=".$filename.".xls");
	    }
		
	}elseif (isset($_GET['tunggakan'])) {
		$table = "pelanggan";
		$cari = "";
		$judul = "LAPORAN PELANGGAN YANG MEMILIKI TUNGGAKAN LEBIH DARI 3 BULAN";
		$filename = $judul;
		 if(isset($_GET['excel'])){
	    	header("Content-type:aplication/vnd-ms-excel");
			header("Content-type: application/image/png");
	    	header("Content-disposition:attachment; filename=".$filename.".xls");
	    }
		
	}elseif (isset($_GET['riwayat_penggunaan'])) {
		$table = "qw_tagihan";
		$id_pelanggan = $_GET['id_pelanggan'];
		$tahun = $_GET['tahun'];
		$pelanggan = $aksi->caridata("pelanggan WHERE id_pelanggan = '$id_pelanggan'");

		$cari = "WHERE id_pelanggan = '$id_pelanggan' AND tahun = '$tahun'";

		$judul = "LAPORAN RIWAYAT PENGGUNNAN ".strtoupper($pelanggan['nama'])." ($id_pelanggan) PADA TAHUN $tahun";
		$filename = $judul;
		 if(isset($_GET['excel'])){
	    	header("Content-type:aplication/vnd-ms-excel");
			header("Content-type: application/image/png");
	    	header("Content-disposition:attachment; filename=".$filename.".xls");
	    }
		
	}
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>PRINT LAPORAN</title>
	<style type="text/css">
		#footer{
			/*background-color: yellow;*/
			position:absolute;
			bottom:1px;
			padding-right: 100px;
			padding-left: 20px;
			width:100%;
			font-weight: bold;
		  	color:black;
		  	font:13px Arial;
		  }
	</style>
</head>
<body style="font-family: 'Arial', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma,  sans-serif;padding: 10px 10px;" >
<!-- INI BAGIAN HEADER LAPORAN -->
	<table width="100%" border="0" cellspacing="0">
		<tr>
			<?php if(isset($_GET['excel'])){ ?>
					<td>&nbsp;</td>
				<?php }else{ ?>
					<td style="margin-top: -20px;" width="15%" valign="top">
						<img src="../images/logo_pln.png" width="90px" height="90px">
					</td>
				<?php } ?>
			<td>
				<h4 style="margin-top: 10px;margin-left: -10px;">PERUSAHAAN LISTRIK MILIK NEGARA</h4>
				<h1 style="margin-top: -20px;margin-left: -10px;" >PT. PLN PERSERO</h1>
				<h5 style="margin-top: -20px;margin-left: -10px;">JL. Kapten Muslihat No.2, Paledang, Bogor Tengah, Kota Bogor, Jawa Barat 16122</h5>
			</td>
		</tr>
		<tr><td colspan="3"><hr style="border: 2px solid black;"></td></tr>
			<?php if (isset($_GET['tagihan_bulan'])) { ?>
				<tr><td colspan="3"><center><strong><h3><?php echo "LAPORAN TAGIHAN ".strtoupper($status)." BULAN ";$aksi->bulan($bulan);echo " TAHUN $tahun"; ?></h3></strong></center></td></tr>
			<?php }else{?>
				<tr><td colspan="3"><center><strong><h3><?php echo @$judul; ?></h3></strong></center></td></tr>
			<?php } ?>
	</table>
<!-- INI END BAGIAN HEADER LAPORAN -->

<!-- INI ISI LAORAN -->
		<?php if (isset($_GET['tarif'])) { ?>
			<table width="100%" border="1" cellspacing="0" cellpadding="3">
				<thead>
					<th><center>No.</center></th>
					<th><center>Kode Tarif</center></th>
					<th><center>Golongan</center></th>
					<th><center>Daya</center></th>
					<th><center>Tarif/KWh</center></th>
				</thead>
				<tbody>
					<?php  
						$no=0;
						$data = $aksi->tampil($table,$cari,"ORDER BY golongan ASC");
						if ($data=="") {
							$aksi->no_record(5);
						}else{
							foreach ($data as $r) {
								$no++; ?>

							<tr>
								<td align="center"><?php echo $no; ?>.</td>
								<td align="center"><?php echo $r['kode_tarif'] ?></td>
								<td align="center"><?php echo $r['golongan'] ?></td>
								<td align="center"><?php echo $r['daya'] ?></td>
								<td align="right"><?php $aksi->rupiah($r['tarif_perkwh']) ?></td>
							</tr>

					<?php } } ?>
				 </tbody>
			</table>

		<?php }elseif (isset($_GET['pelanggan'])) {?>
			<table width="100%" border="1" cellspacing="0" cellpadding="3">
				<thead>
					<th><center>No.</center></th>
					<th><center>ID Pelanggan</center></th>
					<th><center>No.Meter</center></th>
					<th><center>Nama</center></th>
					<th><center>Alamat</center></th>
					<th><center>Tenggang</center></th>
					<th><center>Kode Tarif</center></th>
				</thead>
				<tbody>
					<?php  
						$no=0;
						$data = $aksi->tampil($table,$cari,"ORDER BY id_pelanggan");
						if ($data=="") {
							$aksi->no_record(9);
						}else{
							foreach ($data as $r) {
								$a = $aksi->caridata("tarif WHERE id_tarif = '$r[id_tarif]'");
							$no++; ?>
							<tr>
								<td align="center"><?php echo $no; ?>.</td>
								<td align="center"><?php echo $r['id_pelanggan'] ?></td>
								<td align="center"><?php echo $r['no_meter'] ?></td>
								<td><?php echo $r['nama'] ?></td>
								<td><?php echo $r['alamat'] ?></td>
								<td align="center"><?php echo $r['tenggang'] ?></td>
								<td align="center"><?php echo $a['kode_tarif'] ?></td>
							</tr>

					<?php } } ?>
				 </tbody>
			</table>
			
		<?php }elseif (isset($_GET['agen'])) {?>
			<table width="100%" border="1" cellspacing="0" cellpadding="3">
				<thead>
					<th width="5%"><center>No.</center></th>
					<th width="13%"><center>ID Agen</center></th>
					<th width="20%"><center>Nama</center></th>
					<th width="12%"><center>No.Telepon</center></th>
					<th><center>Alamat</center></th>
					<th width="12%"><center>Biaya Admin</center></th>
				</thead>
				<tbody>
					<?php  
						$no = 0;
						$a = $aksi->tampil($table,$cari,"ORDER BY id_agen DESC");
						if ($a=="") {
							$aksi->no_record(7);
						}else{
							foreach ($a as $r) {
								$cek = $aksi->cekdata(" pembayaran WHERE id_agen = '$r[id_agen]'");
								$no++;
						?>
						<tr>
							<td align="center"><?php echo $no; ?>.</td>
							<td align="center"><?php echo $r['id_agen']; ?></td>
							<td><?php echo $r['nama']; ?></td>
							<td align="center"><?php echo $r['no_telepon']; ?></td>
							<td><?php echo $r['alamat']; ?></td>
							<td align="right"><?php $aksi->rupiah($r['biaya_admin']); ?></td>
						</tr>

				<?php	} } ?>
				</tbody>
			</table>
			
		<?php }elseif (isset($_GET['tagihan_bulan'])) {?>
			<table width="100%" border="1" cellspacing="0" cellpadding="3">
				<thead>
					<th><center>No.</center></th>
					<th><center>ID Pelanggan</center></th>
					<th><center>Nama Pelanggan</center></th>
					<th><center>Bulan</center></th>
					<th><center>Jumlah Meter</center></th>
					<th><center>Jumlah Bayar</center></th>
					<th><center>Status</center></th>
					<th><center>Petugas</center></th>
				</thead>
				<tbody>
					<?php  
						$no=0;
					 	$data = $aksi->tampil($table,$cari,"");
						if ($data=="") {
							$aksi->no_record(8);
						}else{
							foreach ($data as $r) {
								$no++; 
							?>
							<tr>
								<td align="center"><?php echo $no; ?>.</td>
								<td align="center"><?php echo $r['id_pelanggan'] ?></td>
								<td><?php echo $r['nama_pelanggan'] ?></td>
								<td><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun'];?></td>
								<td align="center"><?php echo $r['jumlah_meter'] ?></td>
								<td align="right"><?php $aksi->rupiah($r['jumlah_bayar'])?></td>
								<td align="center"><?php echo $r['status']; ?></td>
								<td align="center"><?php echo $r['nama_petugas']; ?></td>
							</tr>

					<?php } } ?>
				 </tbody>
			</table>
			
		<?php }elseif (isset($_GET['tunggakan'])) {?>
			<table width="100%" border="1" cellspacing="0" cellpadding="3">
				<thead>
					<th><center>No.</center></th>
					<th><center>ID Pelanggan</center></th>
					<th><center>Nama Pelanggan</center></th>
					<th><center>Alamat</center></th>
					<th><center>Banyak Tunggakan</center></th>
					<th><center>Bulan</center></th>
					<th><center>Total Meter</center></th>
					<th><center>Tarif/Kwh</center></th>
					<th><center>Total Tunggakan</center></th>
				</thead>
				
				<tbody>
					<?php  
						$no=0;
						$data = $aksi->tampil($table,$cari,"ORDER BY nama ASC");
						if ($data=="") {
							$aksi->no_record(8);
						}else{
							foreach ($data as $r) {
								$cek = $aksi->cekdata("tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar'");
								?>
							<?php  
								if($cek >= 3){
									$no++; 
									$sum = mysql_fetch_array(mysql_query("SELECT id_pelanggan,COUNT(bulan) as bln_tunggak,sum(jumlah_bayar) jml_bayar,SUM(jumlah_meter) as jml_meter,tarif_perkwh FROM tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar'"));
									$bulan = mysql_query("SELECT * FROM tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar' ");
									?>
									<tr>
										<td align="center"><?php echo $no; ?>.</td>
										<td align="center"><?php echo $r['id_pelanggan'] ?></td>
										<td><?php echo $r['nama'] ?></td>
										<td align="left"><?php echo $r['alamat'] ?></td>
										<td align="center"><?php echo $sum['bln_tunggak']; ?>&nbsp;Bulan</td>
										<td align="center">
											<?php while($bln = mysql_fetch_array($bulan)){
												$aksi->bulan_substr($bln['bulan']);echo substr($bln['tahun'], 2,2).",";
											} ?>
												
										</td>
										<td align="center"><?php echo $sum['jml_meter'] ?></td>
										<td align="right"><?php $aksi->rupiah($sum['tarif_perkwh']); ?></td>
										<td align="right"><?php $aksi->rupiah($sum['jml_bayar']); ?></td>
									</tr>
							<?php } }  }?>
				</tbody>
			</table>
			
		<?php }elseif (isset($_GET['riwayat_penggunaan'])) {?>
			<table width="100%" border="1" cellspacing="0" cellpadding="3">
				<thead>
					<th><center>No.</center></th>
					<th><center>ID Pelanggan</center></th>
					<th><center>Nama Pelanggan</center></th>
					<th><center>Bulan</center></th>
					<th><center>Meter Awal</center></th>
					<th><center>Meter Akhir</center></th>
					<th><center>Jumlah Meter</center></th>
					<th><center>Tarif/KWh</center></th>
					<th><center>Jumlah Bayar</center></th>
				</thead>
				<tbody>
					<?php  
						$no = 0;
						$data = $aksi->tampil($table,$cari,"ORDER BY bulan ASC");
						if ($data=="") {
							$aksi->no_record(9);
						}else{
							foreach ($data as $r) {
								$no++;
								$penggunaan = $aksi->caridata("penggunaan WHERE id_pelanggan = '$r[id_pelanggan]' AND bulan = '$r[bulan]' AND tahun = '$r[tahun]'");
						?>
							<tr>
								<td align="center"><?php echo $no; ?>.</td>
								<td align="center"><?php echo $r['id_pelanggan']; ?></td>
								<td align="left" style="margin-left: 5px;"><?php echo $r['nama_pelanggan']; ?></td>
								<td align="center"><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun']; ?></td>
								<td align="center"><?php echo $penggunaan['meter_awal']; ?></td>
								<td align="center"><?php echo $penggunaan['meter_akhir']; ?></td>
								<td align="center"><?php echo $r['jumlah_meter']; ?></td>
								<td align="right"><?php $aksi->rupiah($r['tarif_perkwh']); ?></td>
								<td align="right"><?php $aksi->rupiah($r['jumlah_bayar']); ?></td>
							</tr>
					<?php } } 
						@$sum = mysql_fetch_array(mysql_query("SELECT SUM(jumlah_meter) as meter,SUM(jumlah_bayar) as bayar FROM tagihan WHERE id_pelanggan = '$id_pelanggan' AND tahun = '$tahun'"));
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6" align="right">TOTAL METER :</td>
						<td align="center"><?php echo $sum['meter'] ; ?></td>
						<td align="right">TOTAL BAYAR :</td>
						<td align="right"><?php $aksi->rupiah($sum['bayar']); ?></td>
					</tr>
				</tfoot>
			</table>
		<?php } ?>
<!-- INI END ISI LAPORAN -->

<!-- INI FOOTER LAPORAN -->
	<div id="footer">
		<table align="right" style="margin-right: 100px;">
			<tr><td rowspan="10" width="50px"></td><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td align="center"><?php $aksi->hari(date("N"));echo ", ";$aksi->format_tanggal(date("Y-m-d")); ?></td>
			</tr>
			<tr>
				<td align="center">Hormat Saya,</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td align="center"><?php echo $_SESSION['nama_petugas']; ?></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
		</table>
	</div>
<!-- INI END FOOTER LAPORAN -->
</body>
</html>