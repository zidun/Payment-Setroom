<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=laporan');
	}

	if (isset($_POST['bcari'])) {
		$bulanini = $_POST['bulan'];
        $tahunini = $_POST['tahun'];

        $cari = "WHERE MONTH(tgl_bayar) = '$bulanini' AND YEAR(tgl_bayar) ='$tahunini' AND id_agen = '$_SESSION[id_agen]'";
		$link_print = "print.php?bulan=$bulanini&tahun=$tahunini";
        $link_excel = "print.php?excel&bulan=$bulanini&tahun=$tahunini";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						LAPORAN RIWAYAT TRANSAKSI
						<div class="pull-right">
							<a href="<?php echo $link_print ?>" target="_blank"><div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;<label>CETAK</label></a>
							&nbsp;&nbsp;
							<a href="<?php echo $link_excel ?>" target="_blank"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;&nbsp;<label>EXPORT EXCEL</label></a>
						</div>
					</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form method="post">
								<div class="input-group">
									<div class="input-group-addon">Bulan</div>
									<select name="bulan" class="form-control">
										<?php  

											for ($a=1; $a <=12 ; $a++) { 
												if ($a<10) {
													$b = "0".$a;
												}else{
													$b = $a;
												} ?>
												<option value="<?php echo $b; ?>" <?php if(@$b==@$bulanini){echo "selected";} ?>><?php $aksi->bulan($b);?></option>
												
											<?php } ?>
									</select>
									<div class="input-group-addon" id="pri">Tahun</div>
									<select name="tahun" class="form-control">
										<?php 
										for ($a=date("Y"); $a < 2031; $a++) {
										?>
										<option value="<?php echo $a; ?>" <?php if(@$a==@$tahunini){echo "selected";} ?>><?php echo @$a; ?></option>
										<?php } ?>
									</select>
									<div class="input-group-btn">
										<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;CARI</button>
										<button type="submit"  name="brefresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;REFRESH</button>
									</div>
								</div>
							</form>
						</div>
						<?php  
                            if(isset($_POST['bcari'])){ ?>
                             	 <div class="col-md-12">
                             	 	<center><label>Laporan Transaksi Bulan <?php $aksi->bulan($bulanini); echo " Tahun ".$tahunini; ?></label></center>
                           			<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<th>No.</th>
												<th>ID Pembayaran</th>
												<th>ID Pelanggan</th>
												<th>Nama Pelanggan</th>
												<th>Waktu</th>
												<th>Bulan Bayar</th>
												<th><center>Jumlah Bayar</center></th>
												<th><center>Biaya Admin</center></th>
												<th><center>Total Akhir</center></th>
												<th><center>Bayar</center></th>
												<th><center>Kembali</center></th>
												<th><center>Petugas</center></th>
											</thead>
											<tbody>
												<?php  
													$no=0;
													$data = $aksi->tampil("qw_pembayaran",@$cari," order by id_pembayaran desc");
													if ($data=="") {
														$aksi->no_record(13);
													}else{
														foreach ($data as $r) {
														$no++; ?>
															<tr>
																<td><?php echo $no; ?>.</td>
																<td><?php echo $r['id_pembayaran']; ?></td>
																<td><?php echo $r['id_pelanggan']; ?></td>
																<td><?php echo $r['nama_pelanggan']; ?></td>
																<td><?php echo $r['waktu_bayar']; ?></td>
																<td><?php $aksi->bulan($r['bulan_bayar']);echo " ".$r['tahun_bayar']; ?></td>
																<td><?php $aksi->rupiah($r['jumlah_bayar']); ?></td>
																<td><?php $aksi->rupiah($r['biaya_admin']); ?></td>
																<td><?php $aksi->rupiah($r['total_akhir']); ?></td>
																<td><?php $aksi->rupiah($r['bayar']); ?></td>
																<td><?php $aksi->rupiah($r['kembali']); ?></td>
																<td><?php echo $r['nama_agen']?></td>
															</tr>
				
													<?php }} ?>
										 	</tbody>
										</table>
									</div>
                           </div>
                           
                           <?php }else{
                           		$bulanini = date("m");
                           		$tahunini = date("Y");
                           		$cari ="";
                           } ?> 

                   </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>