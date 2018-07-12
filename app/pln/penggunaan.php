<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=penggunaan');
	}
	//dasar
	$table = "penggunaan";
	$id = @$_GET['id'];
	$where = " id_penggunaan = '$id'";
	$redirect = "?menu=penggunaan";

	if (isset($_POST['id_pelanggan'])) {
		$id_pel = $_POST['id_pelanggan'];
		$penggunaan = $aksi->caridata("penggunaan WHERE id_pelanggan = '$id_pel' AND meter_akhir = '0'");
		if ($penggunaan == "") {
			$aksi->pesan('Data Bulan ini sudah diinput');
		}
	}elseif(isset($_GET['hapus']) OR isset($_GET['edit'])){
		$penggunaan = $aksi->caridata("penggunaan WHERE id_penggunaan = '$id'");
		$id_pel = $penggunaan['id_pelanggan'];
	}

		@$pelanggan = $aksi->caridata("pelanggan WHERE id_pelanggan = '$id_pel'");
		@$tarif = $aksi->caridata("tarif WHERE id_tarif = '$pelanggan[id_tarif]'");
		@$tarif_perkwh = $tarif['tarif_perkwh'];
		@$id_guna = $penggunaan['id_penggunaan'];
		@$mawal = $penggunaan['meter_awal'];
		@$bulan = $penggunaan['bulan'];
		@$tahun = $penggunaan['tahun'];

		if ($bulan==12) {
			if($bulan<10){
				$bln = ($bulan+1);
				$next_bulan = "0".$bln;
			}else{
				$next_bulan = $bulan+1;
			}
				$next_tahun = $tahun+1;
		}else{
			if ($bulan<10) {
				$bln = ($bulan+1);
				$next_bulan = "0".$bln;
			}else{
				$next_bulan = $bulan+1;
			}
				$next_tahun = $tahun;
		}
		// echo $next_tahun."-".$next_bulan."-".$mawal."-".@$id_pel."<br>";

	@$id_pelanggan = $_POST['id_pelanggan'];
	@$meter_akhir = $_POST['meter_akhir'];
	@$meter_awal = $_POST['meter_awal'];
	@$tgl_cek = $_POST['tgl_cek'];
	@$jumlah_meter = ($meter_akhir-$mawal);
	@$jumlah_bayar = ($jumlah_meter*$tarif_perkwh);
	@$id_penggunaan_next = $id_pel.$next_bulan.$next_tahun;

	// echo $id_penggunaan_next."-".$tahun."-".$bulan;
	@$field_next = array(
		'id_penggunaan'=>$id_penggunaan_next,
		'id_pelanggan'=>$id_pelanggan,
		'bulan'=>$next_bulan,
		'tahun'=>$next_tahun,
		'meter_awal'=>$meter_akhir,
	);


	@$field = array(
		'meter_akhir'=>$meter_akhir,
		'tgl_cek'=>$tgl_cek,
		'id_petugas'=>$_SESSION['id_petugas'],
	);

	@$field_update = array('meter_awal'=>$meter_akhir,);

	@$field_tagihan = array(
		'id_pelanggan'=>$id_pelanggan,
		'bulan'=>$bulan,
		'tahun'=>$tahun,
		'jumlah_meter'=>$jumlah_meter,
		'tarif_perkwh'=>$tarif_perkwh,
		'jumlah_bayar'=>$jumlah_bayar,
		'status'=>"Belum Bayar",
		'id_petugas'=>$_SESSION['id_petugas'],
	);

	@$field_tagihan_update = array(
		'jumlah_meter'=>$jumlah_meter,
		'tarif_perkwh'=>$tarif_perkwh,
		'jumlah_bayar'=>$jumlah_bayar,
		'status'=>"Belum Bayar",
		'id_petugas'=>$_SESSION['id_petugas'],
	);

	if (isset($_POST['bsimpan'])) {
		if ($meter_akhir <= $meter_awal) {
			$aksi->pesan("Meter Akhir Tidak Mungkin Kurang dari Meter Awal");
		}else{
			$aksi->simpan("tagihan",$field_tagihan);
			$aksi->update($table,$field,"id_penggunaan = '$id_guna'");
			$aksi->simpan($table,$field_next);
			$aksi->alert("Data Berhasil Disimpan",$redirect);
		}
	}


	if (isset($_POST['bubah'])) {
		// echo "<br>".$id_penggunaan_next."-".$bulan."-".$tahun;
		$aksi->update($table,$field_update,"id_penggunaan = '$id_penggunaan_next'");
		$aksi->update("tagihan",$field_tagihan_update,"id_pelanggan = '$id_pel' AND bulan = '$bulan' AND tahun = '$tahun'");
		$aksi->update($table,$field,$where);
		$aksi->alert("Data Berhasil Diubah",$redirect);
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->update("penggunaan", 
						array(
							'meter_akhir'=>0,
							'tgl_cek'=>"",
							'id_petugas'=>"",),
						$where);
		$aksi->hapus("penggunaan","id_penggunaan = '$id_penggunaan_next'");
		$aksi->hapus("tagihan","id_pelanggan = '$id_pel' AND bulan = '$bulan' AND tahun = '$tahun'");
		$aksi->alert("Data Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_pelanggan LIKE '%$text%' OR id_penggunaan LIKE '%$text%' OR meter_awal LIKE '%$text%' OR meter_akhir LIKE '%$text%' OR tahun LIKE '%$text%' OR nama_pelanggan LIKE '%$text%' OR nama_petugas LIKE '%$text%'";
	}else{
		$cari=" WHERE meter_akhir != 0";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PELANGGAN</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<?php if(!@$_GET['id']){ ?>
							<div class="panel-heading">INPUT PENGGUNAAN</div>
						<?php }else{ ?>
							<div class="panel-heading">UBAH PENGGUNAAN - <?php echo @$id; ?></div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
								<div class="col-md-12">
									<div class="form-group">
										<label>ID PELANGGAN</label>&nbsp;&nbsp;<span style="color:blue;font-size: 10px;">[TEKAN TAB]</span>
										<input type="text" name="id_pelanggan" class="form-control" placeholder="Masukan ID Pelanggan" onchange="submit()" required value="<?php if(@$_GET['id']==""){echo @$id_pel;}else{ echo @$edit['id_pelanggan'];} ?>" list="id_pel" onkeypress='return event.charCode >=48 && event.charCode <=57' <?php if(@$_GET['id']){echo "readonly";} ?>>
										<datalist id="id_pel">
											<?php  
												$a = mysql_query("SELECT * FROM pelanggan");
												while ($b = mysql_fetch_array($a)) { ?>
													<option value="<?php echo $b['id_pelanggan'] ?>"><?php echo $b['nama']; ?></option>
												<?php } ?>
										</datalist>
									</div>
									<div class="form-group">
										<label>BULAN PENGGUNAAN</label>
										<input type="text" name="no_meter" class="form-control" placeholder="Bulan penggunaan" required readonly value="<?php if(@$_GET['id']==""){ @$aksi->bulan(@$bulan);echo " ".@$tahun;}else{@$aksi->bulan(@$edit['bulan']);echo " ".@$edit['tahun'];} ?>">
									</div>
									<div class="form-group">
										<label>METER AWAL</label>
										<input type="text" name="meter_awal" class="form-control" placeholder="Meter Awal" required readonly value="<?php if(@$_GET['id']==""){echo @$mawal;}else{echo @$edit['meter_awal'];} ?>">
									</div>
									<div class="form-group">
										<label>METER AKHIR</label>
										<input type="text" name="meter_akhir" class="form-control" placeholder="Masukan Meter Akhir" required value="<?php echo @$edit['meter_akhir']; ?>" onkeypress='return event.charCode >=48 && event.charCode <=57'>
									</div>
									<div class="form-group">
										<label>TANGGAL PENGECEKAN</label>
										<input type="date" name="tgl_cek" class="form-control" placeholder="Masukan Nama" required value="<?php echo @$edit['tgl_cek'] ?>">
									</div>

									<div class="form-group">
										<?php  
										  if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SIMPAN">
										  <?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UBAH">
										<?php } ?>

										<a href="?menu=penggunaan" class="btn btn-danger btn-lg btn-block">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">DAFTAR PENGGUNAAN</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form method="post">
								<div class="input-group">
									<input type="text" name="tcari" class="form-control" value="<?php echo @$text ?>" placeholder="Masukan Keyword Pencarian (Kode Penggunaan, ID Pelanggan, Bulan[contoh : 01,09,12], Tahun, Nama Pelanggan, Nama Petugas) ......">
									<div class="input-group-btn">
										<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;CARI</button>
										<button type="submit"  name="brefresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;REFRESH</button>
									</div>
								</div>
							</form>
						</div>
						
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<th><center>No.</center></th>
										<th>Kode Penggunaan</th>
										<th>ID Pelanggan</th>
										<th>Nama</th>
										<th>Bulan</th>
										<th>Meter Awal</th>
										<th>Meter Akhir</th>
										<th>Tanggal Cek</th>
										<th>Petugas</th>
										<th colspan="1"><center>AKSI</center></th>
									</thead>
									<tbody>
										<?php  
											$no=0;
											$data = $aksi->tampil("qw_penggunaan",$cari,"ORDER BY tgl_cek DESC");
											if ($data=="") {
												$aksi->no_record(8);
											}else{
												foreach ($data as $r) {
													$cek = $aksi->cekdata("tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND bulan = '$r[bulan]' AND tahun = '$r[tahun]' AND status = 'Belum Bayar'");
												$no++; ?>

												<tr>
													<td align="center"><?php echo $no; ?>.</td>
													<td><?php echo $r['id_penggunaan'] ?></td>
													<td><?php echo $r['id_pelanggan'] ?></td>
													<td><?php echo $r['nama_pelanggan'] ?></td>
													<td><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun'];?></td>
													<td><?php echo $r['meter_awal'] ?></td>
													<td><?php echo $r['meter_akhir'] ?></td>
													<td><?php $aksi->format_tanggal($r['tgl_cek']); ?></td>
													<td><?php echo $r['nama_petugas'] ?></td>
													<?php  
														if ($cek == 0) { ?>
															<td colspan="2"></td>
														<?php }else{?>
															<td align="center"><a href="?menu=penggunaan&hapus&id=<?php echo $r['id_penggunaan']; ?>" ><span class="glyphicon glyphicon-trash"></span></a></td>
															<!-- <td align="center"><a href="?menu=penggunaan&edit&id=<?php echo $r['id_penggunaan']; ?>" ><span class="glyphicon glyphicon-edit"></span></a></td> -->
														<?php } ?>
												</tr>

										<?php } } ?>
									 </tbody>
								</table>
							</div>
						</div>
					</div>	
					<div class="panel-footer">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>