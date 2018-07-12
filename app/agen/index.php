<br> <br> <br> <br> <br> <br>

<?php  
	include '../config/koneksi.php';//untuk koneksi ke database
	include '../library/fungsi.php';//untuk memasukan library

	session_start();//untuk menampung session
	date_default_timezone_set("Asia/Jakarta"); //untuk mengatur zona waktu

	$aksi = new oop();//untuk memanggil class di library

	//tampung us & pw agar dibaca string bukan syntax
	@$username = mysql_escape_string($_POST['username']);
	@$password = mysql_escape_string($_POST['password']);

	//jika session username petugas tidak kosong, pindah ke halaman utama
	if (@$_SESSION['username_agen']!="") {
		$aksi->redirect("hal_utama.php?menu=home");
	}

	//jika tekan login maka menjalankan fungsi login dari library 
	if (isset($_POST['login'])) {
		$aksi->login("agen",$username,$password,"hal_utama.php?menu=home");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>FORM LOGIN SETROOM PAYMENT</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body style="background:url('../images/bg_agen.jpg');">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<!-- judul -->
						<div class="panel-heading">
							<div style="margin-top: 5px;margin-bottom: 5px;">
								<img src="../images/logo_setroom.png" alt="logo" class="logo" width="90px">
							</div>
							<div style="margin-left: 110px; margin-top: -90px; font-size: 120%;">
								A P L I K A S I &nbsp; P E M B A Y A R A N &nbsp; 
								<br>
								L I S T R I K &nbsp; P A S C A B A Y A R
							</div>
							<div style="margin-left: 110px; font-size: 200%;">
								<strong>FORM LOGIN</strong>
							</div>
						</div>
						<!-- end judul -->

						<!-- isi -->
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="form-group">
										<label>USERNAME</label>
										<input type="text" name="username" class="form-control" placeholder="Masukan username Anda..." required maxlength="30" autocomplete="off">
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" placeholder="Masukan password Anda..." required maxlength="30" autocomplete="off">
									</div>
									<div class="form-group">
										<input type="submit" name="login" class="btn btn-default btn-block btn-lg" value="LOGIN">
									</div>
								</form>
							</div>
						</div>
						<!-- end isi -->

						<!-- footer -->
						<div class="panel-footer">
							<center>&copy;<?php echo date("Y"); ?> - Muhammad Ramdan</center>
						</div>
						<!-- end footer -->
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>