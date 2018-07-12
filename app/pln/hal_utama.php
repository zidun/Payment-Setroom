<br> <br> <br><br>
<?php  
	include '../config/koneksi.php';
	include '../library/fungsi.php';

	session_start();
	date_default_timezone_set("Asia/Jakarta");

	$aksi = new oop();
	if (empty($_SESSION['username_petugas'])) {
		$aksi->alert("Harap Login Dulu !!!","index.php");
	}

	if (isset($_GET['logout'])) {
		unset($_SESSION['username_petugas']);
		unset($_SESSION['id_petugas']);
		unset($_SESSION['nama_petugas']);
		unset($_SESSION['akses_petugas']);
		$aksi->alert("logout Berhasil !!!","index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PT. PLN PERSERO</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
 </head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="navbar navbar-fixed-top navbar-inverse inverse">
					<a href="?menu=home" class="navbar-brand" style="margin-top: -10px;">
						<img alt="Brand" src="../images/logo_pln1.png" width="100px">
					</a>
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="kelola">
								<div class="glyphicon glyphicon-edit"></div>&nbsp;
								<strong>DATA DASAR</strong>&nbsp;
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="kelola">
								<li>
									<a href="?menu=tarif"><strong>KELOLA TARIF</strong></a>
								</li>
								<li>
									<a href="?menu=pelanggan"><strong>KELOLA PELANGGAN</strong></a>
								</li>
								<li>
									<a href="?menu=agen"><strong>KELOLA AGEN</strong></a>
								</li>
								<li>
									<a href="?menu=petugas"><strong>KELOLA PETUGAS</strong></a>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="transaksi">
								<div class="glyphicon glyphicon-refresh"></div>&nbsp;
								<strong>TRANSAKSI</strong>&nbsp;
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="transaksi">
								<li>
									<a href="?menu=tagihan"><strong>DAFTAR TAGIHAN</strong></a>
								</li>
								<li>
									<a href="?menu=penggunaan"><strong>KELOLA PENGGUNAAN</strong></a>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="laporan">
								<div class="glyphicon glyphicon-duplicate"></div>&nbsp;
								<strong>LAPORAN</strong>&nbsp;
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="laporan">
								<li>
									<a href="?menu=laporan&tarif"><strong>LAPORAN DATA TARIF</strong></a>
								</li>
								<li>
									<a href="?menu=laporan&pelanggan"><strong>LAPORAN DATA PELANGGAN</strong></a>
								</li>
								<li>
									<a href="?menu=laporan&agen"><strong>LAPORAN DATA AGEN</strong></a>
								</li>
								<li><div class="divider"></div></li>
								<li>
									<a href="?menu=laporan&tagihan_bulan"><strong>LAPORAN TAGIHAN(PERBULAN)</strong></a>
								</li>
								<li>
									<a href="?menu=laporan&tunggakan"><strong>LAPORAN TUNGGAKAN</strong></a>
								</li>
								<li>
									<a href="?menu=laporan&riwayat_penggunaan"><strong>LAPORAN RIWAYAT PENGGUNAAN(PERTAHUN)</strong></a>
								</li>
							</ul>
						</li>
					</ul>

					<ul class="nav navbar-nav navbar-right" style="margin-right: 50px;">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="akun">
								<div class="glyphicon glyphicon-user"></div>&nbsp;
								<strong><?php echo $_SESSION['nama_petugas']; ?></strong>&nbsp;
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="akun">
								<li>
									<a href="?menu=profil">
										<div class="glyphicon glyphicon-cog"></div>&nbsp;
										<strong>PROFIL</strong>
									</a>
								</li>
								<li>
									<a href="?logout" onclick="return confirm('Yakin akan keluar dari aplikasi ini ?')">
										<div class="glyphicon glyphicon-log-out"></div>&nbsp;
										<strong>KELUAR</strong>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php  
		switch (@$_GET['menu']) {
			case 'home':include'home.php'; break;
			case 'tarif':include'tarif.php'; break;
			case 'pelanggan':include'pelanggan.php'; break;
			case 'petugas':include'petugas.php'; break;
			case 'agen':include'agen.php'; break;
			case 'penggunaan':include'penggunaan.php'; break;
			case 'tagihan':include'tagihan.php'; break;
			case 'laporan':include'laporan.php'; break;
			case 'profil':include'profil.php'; break;
			default:$aksi->redirect("?menu=home");break;
		}
	?>

	<br><br>
	<footer class="container-fluid bg-4 text-center" style="background-color: #fffefe">
		<p>
		  	<strong>Copyright&nbsp;&copy;&nbsp;2018 <a target="_blank" href="https://www.instagram.com/rmdnzdn/">ZIDUN</a>.</strong>&nbsp;
		  	<br>
		  	<strong>All rights reserved for UJIKOM GEN-13 RPL PAKET 3.</strong>
		</p>
	</footer>
	
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
</body>
</html>