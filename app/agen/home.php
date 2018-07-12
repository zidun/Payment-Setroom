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
	<div class="container-fluid">

		<div class="row">
				<video autoplay="" name="media" loop="" width="100%"><source src="../images/gif.mp4"></video>
			<!-- <div class="col-md-12">
				<div class="alert alert-success alert-dimis">
					<center><h4>LOGIN BERHASIL <?php echo $_SESSION['nama_agen']; ?></h4></center>
					<h2>APLIKASI PEMBAYARAN LISTRIK PASCA BAYAR V.1.0</h2>
				</div>
			</div> -->
		</div>
	</div>
</body>
</html>