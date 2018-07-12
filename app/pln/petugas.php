<?php  
	if (!isset($_GET['menu'])) {
		header("location:hal_utama.php?menu=petugas");
	}

	$table ="petugas";
	$id = @$_GET['id'];
	$where = "md5(sha1(id_petugas)) = '$id'";
	$redirect = "?menu=petugas";

	//autocode
	$today = date("Ymd");
	$petugas = $aksi->caridata("petugas WHERE id_petugas LIKE '%$today%' ORDER BY id_petugas DESC");
	$kode = substr($petugas['id_petugas'], 9,3)+1;
	$id_petugas = sprintf("P".$today.'%03s',$kode);

	// cek username
	@$cek_user = $aksi->cekdata("petugas WHERE username = '$_POST[username]'");
	$field = array(
		'id_petugas'=>@$_POST['id'],
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'akses'=>@$_POST['akses'],
		'nama'=>@$_POST['nama'],
		'alamat'=>@$_POST['alamat'],
		'no_telepon'=>@$_POST['no'],
		'akses'=>"petugas",
		'jk'=>@$_POST['jk'],
	);

	$field_ubah = array(
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'nama'=>@$_POST['nama'],
		'alamat'=>@$_POST['alamat'],
		'no_telepon'=>@$_POST['no'],
		'jk'=>@$_POST['jk'],
	);
	//crud
	if (isset($_POST['simpan'])) {
		if ($cek_user > 0) {
			$aksi->pesan("username sudah ada !!!");
		}else{
			$aksi->simpan($table,$field);
			$aksi->alert("Data berhasil disimpan",$redirect);
		}
	}


	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_POST['ubah'])) {
		@$cek_user = $aksi->cekdata("petugas WHERE username = '$_POST[username]' AND username != '$edit[username]'");
		if ($cek_user > 0) {
			$aksi->pesan("username sudah ada !!!");
		}else{
			$aksi->update($table,$field_ubah,$where);
			$aksi->alert("Data berhasil diubah",$redirect);
		}
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Data berhasil dihapus",$redirect);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PETUGAS</title>
</head>
<body>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php 
								if (@$_GET['id']=="") {
									echo "INPUT PETUGAS";
								}else{
									echo "UBAH PETUGAS";
								} 
							?>
						</div>
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="form-group">
										<label>ID PETUGAS</label>
										<input type="text" name="id" class="form-control" value="<?php if(@$_GET['id']==""){echo @$id_petugas; }else{ echo $edit['id_petugas'];} ?>" readonly required>
									</div>
									<div class="form-group">
										<label>USERNAME</label>
										<input type="text" name="username" class="form-control" value="<?php echo @$edit['username'] ?>" required placeholder="Masukan username Petugas" maxlength="30"> 
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" value="<?php echo @$edit['password'] ?>" required placeholder="Masukan password Petugas" maxlength="30"> 
									</div>
									<div class="form-group">
										<label>JENIS KELAMIN</label>
										<select name="jk" class="form-control" required>
											<option value="L" <?php if(@$edit['jk']=="L"){echo "selected";} ?>>Laki-Laki</option>
											<option value="P" <?php if(@$edit['jk']=="P"){echo "selected";} ?>>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label>NAMA</label>
										<input type="text" name="nama" class="form-control" value="<?php echo @$edit['nama'] ?>" required placeholder="Masukan nama Petugas" maxlength="50"> 
									</div>
									<div class="form-group">
										<label>ALAMAT</label>
										<textarea class="form-control" name="alamat" rows="3" required><?php echo @$edit['alamat']; ?></textarea>
									</div>
									<div class="form-group">
										<label>NO.TELEPON</label>
										<input type="text" name="no" class="form-control" value="<?php echo @$edit['no_telepon']; ?>" required placeholder="Masukan No.Telepon Petugas" onkeypress="return event.charCode >=48 && event.charCode <= 57" maxlength="15">
									</div>
									<div class="form-group">
										<label>FOTO</label>
										<input type="file" name="foto" class="form-control">
									</div>
									<div class="form-group">
										<?php 
										if (@$_GET['id']=="") {?>
											<input type="submit" name="simpan" class="btn btn-primary btn-block btn-lg" value="SIMPAN">
										 <?php }else{?>
											<input type="submit" name="ubah" class="btn btn-success btn-block btn-lg" value="UBAH">
										 <?php } ?>
										<a href="?menu=petugas" class="btn btn-danger btn-lg btn-block">RESET</a>
									</div>
								</form>
							</div>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">DAFTAR PETUGAS</div>
						<div class="panel-body">
							<div class="col-md-12">
								<?php  
									if (isset($_POST['bcari'])) {
										@$text = $_POST['tcari'];
										@$cari = "WHERE id_petugas LIKE '%$text%' OR nama LIKE '%$text%' OR alamat LIKE '%$text%' OR no_telepon LIKE '%$text%' OR jk LIKE '%$text%' OR username LIKE '%$text%'";
									}else{
										$cari = "";
									}
								?>
								<form method="post">
									<div class="input-group">
										<input type="text" name="tcari" class="form-control" value="<?php echo @$text; ?>" placeholder="Masukan Keyword Pencarian ...">
										<div class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;CARI</button>
											<button type="submit" name="refresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;REFRESH</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th>No.</th>
											<th>ID Petugas</th>
											<th>Nama</th>
											<th>No.Telepon</th>
											<th>Alamat</th>
											<th>JK</th>
											<th>Username</th>
											<th>Password</th>
											<th>Akses</th>
											<th colspan="2">Aksi</th>
										</thead>
										<tbody>
											<?php  
												$no = 0;
												$a = $aksi->tampil($table,$cari,"ORDER BY id_petugas DESC");
												if ($a=="") {
													$aksi->no_record(11);
												}else{
													foreach ($a as $r) {
														$cek = $aksi->cekdata(" penggunaan WHERE id_petugas = '$r[id_petugas]'");
														if($r['id_petugas']!=$_SESSION['id_petugas']){
															$no++;

												?>

												<tr>
													<td align="center"><?php echo $no; ?>.</td>
													<td><?php echo $r['id_petugas']; ?></td>
													<td><?php echo $r['nama']; ?></td>
													<td><?php echo $r['no_telepon']; ?></td>
													<td><?php echo $r['alamat']; ?></td>
													<td><?php if($r['jk']=="L"){echo "Laki-Laki";}else{echo "Perempuan";} ?></td>
													<td><?php echo $r['username']; ?></td>
													<td><?php echo substr(md5($r['password']), 0,10); ?></td>
													<td><?php echo $r['akses']; ?></td>
													<?php  
														if ($cek == 0) { ?>
															<td align="center">
																<a href="?menu=petugas&hapus&id=<?php echo md5(sha1($r['id_petugas'])); ?>" onclick="return confirm('Yakin Akan hapus data ini ?')">
																	<span class="glyphicon glyphicon-trash"></span>
																</a>
															</td>
													<?php }else{ ?>
														<td>&nbsp;</td>
													<?php } ?>
													<td align="center">
														<a href="?menu=petugas&edit&id=<?php echo md5(sha1($r['id_petugas'])); ?>">
																<span class="glyphicon glyphicon-edit"></span>
														</a>
													</td>
												</tr>

										<?php	} } } ?>
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