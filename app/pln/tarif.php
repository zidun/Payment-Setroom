<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=tarif');
	}
	//dasar
	$table = "tarif";
	$id = @$_GET['id'];
	$where = " md5(sha1(id_tarif)) = '$id'";
	$redirect = "?menu=tarif";

	//untuk kebutuhan crud
	@$golongan = $_POST['golongan'];
	@$daya = $_POST['daya'];
	@$tarif = $_POST['tarif'];
	@$kode_tarif = $golongan."/".$daya;
	//tampung data
	$data = array(
		'kode_tarif'=>$kode_tarif,
		'golongan'=>$golongan,
		'daya'=>$daya,
		'tarif_perkwh'=>$tarif,
	);

	$cek = $aksi->cekdata("tarif WHERE kode_tarif = '$kode_tarif'");
	if (isset($_POST['bsimpan'])) {
		if ($cek > 0) {
			$aksi->pesan("Data sudah ada");
		}else{
			$aksi->simpan($table,$data);
			$aksi->alert("Data Berhasil Disimpan",$redirect);
		}
	}

	if (isset($_POST['bubah'])) {
		@$cek = $aksi->cekdata("tarif WHERE kode_tarif = '$kode_tarif' AND kode_tarif != '$edit[kode_tarif]'");
		if ($cek > 0) {
			$aksi->pesan("Data sudah ada");
		}else{
			$aksi->update($table,$data,$where);
			$aksi->alert("Data Berhasil Diubah",$redirect);
		}
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Data Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_tarif LIKE '%$text%' OR kode_tarif LIKE '%$text%' OR daya LIKE '%$text%' OR golongan LIKE '%$text%' OR tarif_perkwh LIKE '%$text%'";
	}else{
		$cari="";
	}





?>
<!DOCTYPE html>
<html>
<head>
	<title>TARIF</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="panel panel-default">
						<?php if(!@$_GET['id']){ ?>
							<div class="panel-heading">INPUT TARIF</div>
						<?php }else{ ?>
							<div class="panel-heading">UBAH TARIF</div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
								<div class="col-md-12">
									<div class="form-group">
										<label>GOLONGAN</label>
										<input type="text" name="golongan" class="form-control" placeholder="Masukan Golongan" required value="<?php echo @$edit['golongan']; ?>" list="gol">
										<datalist id="gol">
											<option value="R1">R1</option>
											<option value="R2">R2</option>
											<option value="R3">R3</option>
											<option value="B1">B1</option>
										</datalist>
									</div>
									<div class="form-group">
										<label>DAYA</label>
										<input type="text" name="daya" class="form-control" placeholder="Masukan Daya" required value="<?php echo @$edit['daya']; ?>" list="day">
										<datalist id="day">
											<option value="450VA">450VA</option>
											<option value="900VA">900VA</option>
											<option value="1300VA">1300VA</option>
										</datalist>
									</div>
									<div class="form-group">
										<label>TARIF/KWH</label>
										<input type="text" name="tarif" class="form-control" placeholder="Masukan Tarif" required value="<?php echo @$edit['tarif_perkwh']; ?>" onkeypress='return event.charCode >=48 && event.charCode <=57'>
									</div>
									<div class="form-group">
										<?php  
										  if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SIMPAN">
										  <?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UBAH">
										<?php } ?>

										<a href="?menu=tarif" class="btn btn-danger btn-lg btn-block">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">DAFTAR TARIF</div>
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
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th>No.</th>
											<th>Kode Tarif</th>
											<th>Golongan</th>
											<th>Daya</th>
											<th>Tarif/KWh</th>
											<th colspan="2"><center>AKSI</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"");
												if ($data=="") {
													$aksi->no_record(7);
												}else{
													foreach ($data as $r) {
														$cek = $aksi->cekdata("pelanggan WHERE id_tarif = '$r[id_tarif]'");
													$no++; ?>

													<tr>
														<td><?php echo $no; ?>.</td>
														<td><?php echo $r['kode_tarif'] ?></td>
														<td><?php echo $r['golongan'] ?></td>
														<td><?php echo $r['daya'] ?></td>
														<td><?php $aksi->rupiah($r['tarif_perkwh']) ?></td>
														<?php  
															if($cek > 0){?>
																<td>&nbsp;</td>
															<?php }else{ ?>
																<td align="center"><a href="?menu=tarif&hapus&id=<?php echo md5(sha1($r['id_tarif'])); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
															<?php }?>
														<td align="center"><a href="?menu=tarif&edit&id=<?php echo md5(sha1($r['id_tarif'])); ?>" ><span class="glyphicon glyphicon-edit"></span></a></td>
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