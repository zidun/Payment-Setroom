<br>
<?php 
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=home');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<marquee><h3>Selamat Datang <?php echo $_SESSION['nama_petugas']; ?>, di Aplikasi Pembayaran Listrik Pasca Bayar v.1.0</h3></marquee>
				<center><img src="../images/logo_pln2.png" width="90%"></center>
			</div>
		</div>
	</div>
</body>
</html>