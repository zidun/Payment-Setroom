<?php  
	include '../config/koneksi.php';
	include '../library/fungsi.php';
	session_start();
	$aksi= new oop();

	$id_pelanggan = $_GET['id_pelanggan'];
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];

	$pembayaran = $aksi->caridata("qw_pembayaran WHERE id_pelanggan = '$id_pelanggan' AND bulan_bayar = '$bulan' AND tahun_bayar = '$tahun' ");
	$penggunaan = $aksi->caridata("penggunaan WHERE id_pelanggan = '$id_pelanggan' AND bulan = '$bulan' AND tahun = '$tahun'");
	$pelanggan = $aksi->caridata("pelanggan WHERE id_pelanggan = '$id_pelanggan'");
	$tarif = $aksi->caridata("tarif WHERE id_tarif = '$pelanggan[id_tarif]'");
?>
<!DOCTYPE html>
<html>
<head>
	<title>CETAK STRUK <?php echo $pembayaran['id_pembayaran']; ?></title>
	<style type="text/css">
		#trans{
			
		}	
	</style>
</head>
<body onload="window.print()"  style="font-family:monospace;" >
	<table style="background: url('../images/struk.png') center no-repeat;
			background-size: 50%;">
		<tr>
			<td colspan="6" align="center"><center>STRUK PEMBAYARAN TAGIHAN LISTRIK</center></td>
		</tr>
		<br>
		<tr>
			<td align="left">IDPEL</td>
			<td align="left">:</td>
			<td align="left"><?php echo $pembayaran['id_pelanggan']; ?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">BL/TH</td>
			<td align="left">:</td>
			<td align="left"><?php $aksi->bulan_substr($bulan);echo substr($tahun, 2,2); ?></td>
		</tr>
		<tr>
			<td align="left">NAMA</td>
			<td align="left">:</td>
			<td align="left"><?php echo $pelanggan['nama']; ?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">STAND METER</td>
			<td align="left">:</td>
			<td align="left"><?php echo $penggunaan['meter_awal']."-".$penggunaan['meter_akhir'];?></td>
		</tr>
		<tr>
			<td align="left">TARIF/DAYA</td>
			<td align="left">:</td>
			<td align="left"><?php echo $tarif['kode_tarif']; ?></td>
		</tr>
		<tr>
			<td align="left">RP. TAG PLN</td>
			<td align="left">:</td>
			<td align="left"><?php $aksi->rupiah($pembayaran['jumlah_bayar']) ; ?></td>
		</tr>
		<tr>
			<td align="left">JFA REF</td>
			<td align="left">:</td>
			<td align="left"><?php echo strtoupper(sha1($pembayaran['id_pembayaran'].$_SESSION['id_agen'])); ?></td>
		</tr>
		<tr>
			<td colspan="6" align="center"><center>PLN Menyatakan struk ini seabgai bukti pembayaran yang sah</center></td>
		</tr>
		<tr>
			<td align="left">ADMIN BANK</td>
			<td align="left">:</td>
			<td align="left"><?php $aksi->rupiah($pembayaran['biaya_admin']) ?></td>
		</tr>
		<tr>
			<td align="left">TOTAL BAYAR</td>
			<td align="left">:</td>
			<td align="left"><?php $aksi->rupiah($pembayaran['total_akhir']) ?></td>
		</tr>
		<tr>
			<td colspan="6" align="center">TERIMA KASIH<td>
		</tr>
		<tr>
			<td colspan="6" align="center">Rincian Tagihan dapat diakses di www.pln.co.id, Informasi Hubungi Call Center:123</td>
		</tr>
		<tr>
			<td colspan="6" align="center">PPOB SETROOM PAYMENT/<?php echo $_SESSION['nama_agen']."/".$pembayaran['waktu_bayar']; ?></td>
		</tr>
	</table>
</body>
</html>