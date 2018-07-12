<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=pelanggan');
	}
	//dasar
	$table = "pelanggan";
	$id = @$_GET['id'];
	$where = " md5(sha1(id_pelanggan)) = '$id'";
	$redirect = "?menu=pelanggan";

	//kode auto
	$id_pel = date("YmdHis");
	if (date('z') < 10) {
		$no_met = "00".date("zymNHs");
	}elseif (date('z') < 100 ) {
		$no_met ="0".date("zymNHs");
	}else{
		$no_met=date("zymNHs");
	}

	//untuk kebutuhan crud
	@$tenggang = date("d");
	@$id_pelanggan = $_POST['id_pelanggan'];
	@$no_meter = $_POST['no_meter'];
	@$nama = $_POST['nama'];
	@$alamat = $_POST['alamat'];
	@$id_tarif = $_POST['id_tarif'];
	//tampung data
	$simpan_pelanggan = array(
		'id_pelanggan'=>$id_pelanggan,
		'no_meter'=>$no_meter,
		'nama'=>$nama,
		'alamat'=>$alamat,
		'tenggang'=>$tenggang,
		'id_tarif'=>$id_tarif,
	);

	$ubah_pelanggan = array(
		'nama'=>$nama,
		'alamat'=>$alamat,
		'id_tarif'=>$id_tarif,
	);

	//untuk penggunaan default meter awal
	if (date("d") > 25) {
		if(date("m") <10){
			$bln = date("m")+1;
			$bulan = "0".$bln;
		}else{
			$bulan = date("m")+1;
		}
		$tahun = date("Y");
	}elseif(date("d") > 25 && date("m")==12 ){
		$bln = date("m")+1;
		$bulan = "0".$bln;
		$tahun = date("Y")+1;
	}else{
		$bulan = date("m");
		$tahun = date("Y");
	}

	echo $bulan." ".$tahun;

	$simpan_penggunaan = array(
		'id_penggunaan'=>$id_pelanggan.$bulan.$tahun,
		'id_pelanggan'=>$id_pelanggan,
		'bulan'=>$bulan,
		'tahun'=>$tahun,
		'meter_awal'=>0,
	); 

	if (isset($_POST['bsimpan'])) {
		$aksi->simpan("penggunaan",$simpan_penggunaan);
		$aksi->simpan($table,$simpan_pelanggan);
		$aksi->alert("Data Berhasil Disimpan",$redirect);
	}

	if (isset($_POST['bubah'])) {
		$aksi->update($table,$ubah_pelanggan,$where);
		$aksi->alert("Data Berhasil Diubah",$redirect);
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus("penggunaan","id_pelanggan = '$id'");
		$aksi->hapus($table,$where);
		$aksi->alert("Data Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_pelanggan LIKE '%$text%' OR nama LIKE '%$text%' OR no_meter LIKE '%$text%' OR alamat LIKE '%$text%' OR tenggang LIKE '%$text%'";
	}else{
		$cari="";
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
				<div class="col-md-3">
					<div class="panel panel-default">
						<?php if(!@$_GET['id']){ ?>
							<div class="panel-heading">INPUT PELANGGAN</div>
						<?php }else{ ?>
							<div class="panel-heading">UBAH PELANGGAN</div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
								<div class="col-md-12">
									<div class="form-group">
										<label>ID PELANGGAN</label>
										<input type="text" name="id_pelanggan" class="form-control" placeholder="Masukan ID Pelanggan" required readonly value="<?php if(@$_GET['id']==""){echo $id_pel;}else{echo @$edit['id_pelanggan'];} ?>">
									</div>
									<div class="form-group">
										<label>NO.METER</label>
										<input type="text" name="no_meter" class="form-control" placeholder="Masukan NO.METER" required readonly value="<?php if(@$_GET['id']==""){echo $no_met;}else{ echo @$edit['no_meter'];} ?>">
									</div>
									<div class="form-group">
										<label>NAMA</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required value="<?php echo @$edit['nama']; ?>">
									</div>
									<div class="form-group">
										<label>ALAMAT</label>
										<textarea name="alamat" class="form-control" required rows="3"><?php echo @$edit['alamat']; ?></textarea>
									</div>
									<div class="form-group">
										<label>JENIS TARIF</label>
										<select name="id_tarif" class="form-control" required> 
											<?php  
												$b = $aksi->caridata("tarif WHERE id_tarif = '$edit[id_tarif]'");
												if (@$_GET['id']) {?>
													<option selected value="<?php echo $b['id_tarif'] ?>"><?php echo $b['kode_tarif']; ?></option>
												<?php } ?> 
													<option></option>
											<?php  
												$a = mysql_query("SELECT * FROM tarif");
												while ($tarif = mysql_fetch_array($a)) { ?>
													<option value="<?php echo $tarif['id_tarif'] ?>"><?php echo $tarif['kode_tarif']; ?></option>
											<?php }?>
										</select>
									</div>
									<div class="form-group">
										<?php  
										  if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SIMPAN">
										  <?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UBAH">
										<?php } ?>

										<a href="?menu=pelanggan" class="btn btn-danger btn-lg btn-block">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">DAFTAR PELANGGAN</div>
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="input-group">
										<input type="text" name="tcari" class="form-control" value="<?php echo @$text ?>" placeholder="Masukan Keyword Pencarian......">
										<div class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;CARI</button>
											<button type="submit"  name="brefresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;REFRESH</button>
										</div>
									</div>
								</form>
							</div>
							<br>
						<label class="label-danger">* Jika kolom berwarna merah ,Pelanggan memiliki tunggakan >= 3 bulan</label>
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th>No.</th>
											<th>ID Pelanggan</th>
											<th>No.Meter</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th>Tenggang</th>
											<th>Kode Tarif</th>
											<th colspan="2"><center>AKSI</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"");
												if ($data=="") {
													$aksi->no_record(9);
												}else{
													foreach ($data as $r) {
														$a = $aksi->caridata("tarif WHERE id_tarif = '$r[id_tarif]'");
														$cek = $aksi->cekdata("penggunaan WHERE id_pelanggan ='$r[id_pelanggan]' AND meter_awal = '0' AND meter_akhir = '0'");
														$cek2 = $aksi->cekdata("tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar'");
													$no++; ?>
												<?php  if($cek2 >= 3){ ?>
													<tr style="background-color: #d9534f;">
												<?php }else{ ?>
													<tr>
												<?php } ?>
														<td><?php echo $no; ?>.</td>
														<td><?php echo $r['id_pelanggan'] ?></td>
														<td><?php echo $r['no_meter'] ?></td>
														<td><?php echo $r['nama'] ?></td>
														<td><?php echo $r['alamat'] ?></td>
														<td><?php echo $r['tenggang'] ?></td>
														<td><?php echo $a['kode_tarif'] ?></td>
														<?php  
															if($cek == 0){ ?>
																<td>&nbsp;</td>
															<?php }else{?>
																<td align="center"><a href="?menu=pelanggan&hapus&id=<?php echo md5(sha1($r['id_pelanggan'])); ?>" ><span class="glyphicon glyphicon-trash"></span></a></td>
															<?php } ?>
																<td align="center"><a href="?menu=pelanggan&edit&id=<?php echo md5(sha1($r['id_pelanggan'])); ?>" ><span class="glyphicon glyphicon-edit"></span></a></td>
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
	</div>
</body>
</html>