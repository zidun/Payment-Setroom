<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=profil');
	}

	$petugas = $aksi->caridata("petugas WHERE id_petugas = '$_SESSION[id_petugas]'");
	$field = array(
		'username'=>@$_POST['username'],
		'password'=>@$_POST['password'],
		'nama'=>@$_POST['nama'],
		'alamat'=>@$_POST['alamat'],
		'no_telepon'=>@$_POST['no'],
		'jk'=>@$_POST['jk'],
	);
	
	@$cek_user = $aksi->cekdata("petugas WHERE username = '$_POST[username]' AND username != '$_SESSION[username_petugas]'");
	if (isset($_POST['ubah'])) {
		if ($cek_user > 0) {
			$aksi->pesan("username sudah ada !!!");
		}else{
			$aksi->update("petugas",$field,"id_petugas = '$_SESSION[id_petugas]'");
			$aksi->alert("Data Berhasil diubah","?menu=profil");
			$_SESSION['nama_petugas']=@$_POST['nama'];
			$_SESSION['username_petugas']=@$_POST['username'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PROFIL</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading"><center><h4>UBAH DATA DIRI</h4></center></div>
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="form-group">
										<label>ID PETUGAS</label>
										<input type="text" name="id" class="form-control" value="<?php echo $petugas['id_petugas'] ?>" readonly>
									</div>
									<div class="form-group">
										<label>USERNAME</label>
										<input type="text" name="username" class="form-control" value="<?php echo $petugas['username'] ?>" required placeholder="Masukan username Anda"> 
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" value="<?php echo $petugas['password'] ?>" required placeholder="Masukan password Anda"> 
									</div>
									<div class="form-group">
										<label>AKSES</label>
										<input type="text" name="akses" class="form-control" value="<?php echo $petugas['akses'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<label>NAMA</label>
										<input type="text" name="nama" class="form-control" value="<?php echo $petugas['nama'] ?>" required placeholder="Masukan nama Anda"> 
									</div>
									<div class="form-group">
										<label>JENIS KELAMIN</label>
										<select name="jk" class="form-control" required>
											<option value="L" <?php if($petugas['jk']=="L"){ echo "selected"; } ?>>Laki-Laki</option>
											<option value="P" <?php if($petugas['jk']=="P"){ echo "selected"; } ?>>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label>ALAMAT</label>
										<textarea class="form-control" name="alamat" rows="3" required><?php echo $petugas['alamat']; ?></textarea>
									</div>
									<div class="form-group">
										<label>NO.TELEPON</label>
										<input type="text" name="no" class="form-control" value="<?php echo $petugas['no_telepon']; ?>" required placeholder="Masukan No.Telepon Anda" onkeypress="return event.charCode >=48 && event.charCode <= 57">
									</div>
									<div class="form-group">
										<input type="submit" name="ubah" class="btn btn-primary btn-block btn-lg" value="UBAH DATA">
									</div>
								</form>
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