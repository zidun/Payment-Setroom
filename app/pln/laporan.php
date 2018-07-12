<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=laporan');

	$bulanini = $_POST['bulan'];
	$tahunini = $_POST['tahun'];

	$cari = "WHERE MONTH(tgl_bayar) = '$bulanini' AND YEAR(tgl_bayar) ='$tahunini' AND id_agen = '$_SESSION[id_agen]'";
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
<!-- INI LAPORAN TARIF -->
				<?php  
					if (isset($_GET['tarif'])) { 
						$table = "tarif";
						$cari = "";
						$link_print = "print.php?tarif";
						$link_excel = "print.php?excel&tarif";
						$judul = "LAPORAN DAFTAR TARIF";
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN DAFTAR TARIF
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank"><div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;<label>CETAK</label></a>
									&nbsp;&nbsp;
									<a href="<?php echo $link_excel ?>" target="_blank"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;&nbsp;<label>EXPORT EXCEL</label></a>
								</div>
							</div>
							<div class="panel-body">
										<center><label><?php echo @$judul; ?></label></center>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th><center>No.</center></th>
											<th><center>Kode Tarif</center></th>
											<th><center>Golongan</center></th>
											<th><center>Daya</center></th>
											<th><center>Tarif/KWh</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"ORDER BY golongan ASC");
												if ($data=="") {
													$aksi->no_record(5);
												}else{
													foreach ($data as $r) {
														$no++; ?>

													<tr>
														<td align="center"><?php echo $no; ?>.</td>
														<td align="center"><?php echo $r['kode_tarif'] ?></td>
														<td align="center"><?php echo $r['golongan'] ?></td>
														<td align="center"><?php echo $r['daya'] ?></td>
														<td align="right"><?php $aksi->rupiah($r['tarif_perkwh']) ?></td>
													</tr>

											<?php } } ?>
										 </tbody>
									</table>
								</div>
							</div>
						</div>
<!-- INI END LAPORAN TARIF -->

<!-- INI LAPORAN PELANGGAN -->
					<?php }elseif(isset($_GET['pelanggan'])){ 
						$table = "pelanggan";
						$cari = "";
						$link_print = "print.php?pelanggan";
						$link_excel = "print.php?excel&pelanggan";
						$judul = "LAPORAN DAFTAR PELANGGAN";
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN DAFTAR PELANGGAN
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank"><div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;<label>CETAK</label></a>
									&nbsp;&nbsp;
									<a href="<?php echo $link_excel ?>" target="_blank"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;&nbsp;<label>EXPORT EXCEL</label></a>
								</div>
							</div>
							<div class="panel-body">
										<center><label><?php echo @$judul; ?></label></center>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th><center>No.</center></th>
											<th><center>ID Pelanggan</center></th>
											<th><center>No.Meter</center></th>
											<th><center>Nama</center></th>
											<th><center>Alamat</center></th>
											<th><center>Tenggang</center></th>
											<th><center>Kode Tarif</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"ORDER BY id_pelanggan");
												if ($data=="") {
													$aksi->no_record(9);
												}else{
													foreach ($data as $r) {
														$a = $aksi->caridata("tarif WHERE id_tarif = '$r[id_tarif]'");
													$no++; ?>
													<tr>
														<td align="center"><?php echo $no; ?>.</td>
														<td align="center"><?php echo $r['id_pelanggan'] ?></td>
														<td align="center"><?php echo $r['no_meter'] ?></td>
														<td><?php echo $r['nama'] ?></td>
														<td><?php echo $r['alamat'] ?></td>
														<td align="center"><?php echo $r['tenggang'] ?></td>
														<td align="center"><?php echo $a['kode_tarif'] ?></td>
													</tr>

											<?php } } ?>
										 </tbody>
									</table>
								</div>
							</div>
						</div>
<!-- INI END LAPORAN PELANGGAN -->

<!-- INI LAPORAN AGEN -->
					<?php }elseif(isset($_GET['agen'])){ 
						$table = "agen";
						$cari = "";
						$link_print = "print.php?agen";
						$link_excel = "print.php?excel&agen";
						$judul = "LAPORAN DAFTAR AGEN";
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN DAFTAR AGEN
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank"><div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;<label>CETAK</label></a>
									&nbsp;&nbsp;
									<a href="<?php echo $link_excel ?>" target="_blank"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;&nbsp;<label>EXPORT EXCEL</label></a>
								</div>
							</div>
							<div class="panel-body">
										<center><label><?php echo @$judul; ?></label></center>

								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<th width="5%"><center>No.</center></th>
											<th width="13%"><center>ID Agen</center></th>
											<th width="20%"><center>Nama</center></th>
											<th width="12%"><center>No.Telepon</center></th>
											<th><center>Alamat</center></th>
											<th width="12%"><center>Biaya Admin</center></th>
										</thead>
										<tbody>
											<?php  
												$no = 0;
												$a = $aksi->tampil($table,$cari,"ORDER BY id_agen DESC");
												if ($a=="") {
													$aksi->no_record(7);
												}else{
													foreach ($a as $r) {
														$cek = $aksi->cekdata(" pembayaran WHERE id_agen = '$r[id_agen]'");
														$no++;
												?>
												<tr>
													<td align="center"><?php echo $no; ?>.</td>
													<td align="center"><?php echo $r['id_agen']; ?></td>
													<td><?php echo $r['nama']; ?></td>
													<td align="center"><?php echo $r['no_telepon']; ?></td>
													<td><?php echo $r['alamat']; ?></td>
													<td align="right"><?php $aksi->rupiah($r['biaya_admin']); ?></td>
												</tr>

										<?php	} } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
<!-- INI END LAPORAN AGEN -->

<!-- INI LAPORAN TAGIHAN BULAN -->
					<?php }elseif(isset($_GET['tagihan_bulan'])){ 
						$data ="";
						if(isset($_POST['bcari'])){
						$table = "qw_tagihan";
                            $status = $_POST['status'];
                            $bulanini = $_POST['bulan'];
                            $tahunini = $_POST['tahun'];

                            @$cari = "WHERE status = '$status' AND bulan = '$bulanini' AND tahun ='$tahunini'";

                            $data = $aksi->tampil($table,$cari,"");
                            $link_print = "print.php?tagihan_bulan&status=$status&bulan=$bulanini&tahun=$tahunini";
                            $link_excel = "print.php?excel&tagihan_bulan&status=$status&bulan=$bulanini&tahun=$tahunini";
                            $judul = "LAPORAN TAGIHAN ".strtoupper($status)." BULAN ".strtoupper($bulanini)." TAHUN $tahunini";
                        }else{
                        	@$data ="";
                        }
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN TAGIHAN PER-BULAN
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank"><div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;<label>CETAK</label></a>
									&nbsp;&nbsp;
									<a href="<?php echo $link_excel ?>" target="_blank"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;&nbsp;<label>EXPORT EXCEL</label></a>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-md-12">
									<form method="post">
										<div class="input-group">
											<div class="input-group-addon">STATUS</div>
											<select name="status" class="form-control" required>
												<option></option>
												<option value="Terbayar" <?php if(@$status == "Terbayar"){echo "selected";} ?>>Terbayar</option>
												<option value="Belum Bayar" <?php if(@$status == "Belum Bayar"){echo "selected";} ?>>Belum Bayar</option>
											</select>
											<div class="input-group-addon">Bulan</div>
											<select name="bulan" class="form-control">
												<option></option>
												<?php  
													for ($a=1; $a <=12 ; $a++) { 
														if ($a<10) {
															$b = "0".$a;
														}else{
															$b = $a;
														} ?>
														<option value="<?php echo $b; ?>" <?php if(@$b==@$bulanini){echo "selected";} ?>><?php $aksi->bulan($b); ?></option>
														
													<?php } ?>
											</select>
											<div class="input-group-addon" id="pri">Tahun</div>
											<select name="tahun" class="form-control">
												<option></option>
												<?php 
												for ($a=2018; $a < 2031; $a++) {
												?>
												<option value="<?php echo $a; ?>" <?php if(@$a==@$tahunini){echo "selected";} ?>><?php echo @$a; ?></option>
												<?php } ?>
											</select>
											<div class="input-group-btn">
												<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;CARI</button>
												<a href="?menu=laporan&tagihan_bulan" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;REFRESH</a>
											</div>
										</div>
									</form>
								</div>
										<center><label>LAPORAN TAGIHAN <?php echo strtoupper(@$status)." BULAN ";$aksi->bulan(@$bulanini);echo " TAHUN ".@$tahunini; ?></label></center>
                             	<div class="col-md-12">
                           			<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<th><center>No.</center></th>
												<th><center>ID Pelanggan</center></th>
												<th><center>Nama Pelanggan</center></th>
												<th><center>Bulan</center></th>
												<th><center>Jumlah Meter</center></th>
												<th><center>Jumlah Bayar</center></th>
												<th><center>Status</center></th>
												<th><center>Petugas</center></th>
											</thead>
											<tbody>
												<?php  
													$no=0;
													if ($data=="") {
														$aksi->no_record(8);
													}else{
														foreach ($data as $r) {
															$no++; 
														?>

														<tr>
															<td align="center"><?php echo $no; ?>.</td>
															<td align="center"><?php echo $r['id_pelanggan'] ?></td>
															<td><?php echo $r['nama_pelanggan'] ?></td>
															<td><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun'];?></td>
															<td align="center"><?php echo $r['jumlah_meter'] ?></td>
															<td align="right"><?php $aksi->rupiah($r['jumlah_bayar'])?></td>
															<td align="center"><?php echo $r['status']; ?></td>
															<td align="center"><?php echo $r['nama_petugas']; ?></td>
														</tr>

												<?php } } ?>
											 </tbody>
										</table>
									</div>
                           		</div>
		                   </div>
						</div>
<!-- INI END LAPORAN TAGIHAN BULAN -->

<!-- INI LAPORAN TUNGGAKAN -->
					<?php }elseif(isset($_GET['tunggakan'])){ 
							$table = "qw_tagihan";
							$cari = "WHERE status = 'Belum Bayar'";
							$link_print = "print.php?tunggakan";
							$link_excel = "print.php?excel&tunggakan";
							$judul = "LAPORAN PELANGGAN YANG MEMILIKI TUNGGAKAN LEBIH DARI 3 BULAN";
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN DAFTAR PELANGGAN YANG MEMILIKI TUNGGAKAN
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank"><div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;<label>CETAK</label></a>
									&nbsp;&nbsp;
									<a href="<?php echo $link_excel ?>" target="_blank"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;&nbsp;<label>EXPORT EXCEL</label></a>
								</div>
							</div>
							<div class="panel-body">
                             	<div class="col-md-12">
										<center><label><?php echo @$judul; ?></label></center>
                           			<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<th><center>No.</center></th>
												<th><center>ID Pelanggan</center></th>
												<th><center>Nama Pelanggan</center></th>
												<th><center>Alamat</center></th>
												<th><center>Banyak Tunggakan</center></th>
												<th><center>Bulan</center></th>
												<th><center>Total Meter</center></th>
												<th><center>Tarif/Kwh</center></th>
												<th><center>Total Tunggakan</center></th>
											</thead>
											
											<tbody>
												<?php  
													$no=0;
													$data = $aksi->tampil("pelanggan","","ORDER BY nama ASC");
													if ($data=="") {
														$aksi->no_record(8);
													}else{
														foreach ($data as $r) {
															$cek = $aksi->cekdata("tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar'");
															?>
														<?php  
															if($cek >= 3){
																$no++; 
																$sum = mysql_fetch_array(mysql_query("SELECT id_pelanggan,COUNT(bulan) as bln_tunggak,sum(jumlah_bayar) jml_bayar,SUM(jumlah_meter) as jml_meter,tarif_perkwh FROM tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar'"));
																$bulan = mysql_query("SELECT * FROM tagihan WHERE id_pelanggan = '$r[id_pelanggan]' AND status = 'Belum Bayar' ");
																?>
																<tr>
																	<td align="center"><?php echo $no; ?>.</td>
																	<td align="center"><?php echo $r['id_pelanggan'] ?></td>
																	<td><?php echo $r['nama'] ?></td>
																	<td align="left"><?php echo $r['alamat'] ?></td>
																	<td align="center"><?php echo $sum['bln_tunggak']; ?>&nbsp;Bulan</td>
																	<td align="center">
																		<?php while($bln = mysql_fetch_array($bulan)){
																			$aksi->bulan_substr($bln['bulan']);echo substr($bln['tahun'], 2,2).",";
																		} ?>
																			
																	</td>
																	<td align="center"><?php echo $sum['jml_meter'] ?></td>
																	<td align="right"><?php $aksi->rupiah($sum['tarif_perkwh']); ?></td>
																	<td align="right"><?php $aksi->rupiah($sum['jml_bayar']); ?></td>
																</tr>
														<?php } }  }?>
											</tbody>
										</table>
									</div>
                           		</div>
		                   </div>
						</div>
<!-- INI END LAPORAN TUNGGAKAN -->

<!-- INI LAPORAN RIWAYAT PENGGUNAAN -->
					<?php }elseif(isset($_GET['riwayat_penggunaan'])){ 
							if (isset($_POST['bcari'])) {
								$table = "qw_tagihan";
								$id_pelanggan = $_POST['id_pelanggan'];
								$pelanggan = $aksi->caridata("pelanggan WHERE id_pelanggan = '$id_pelanggan'");
								$tahun = $_POST['tahun'];

								$cari = "WHERE id_pelanggan = '$id_pelanggan' AND tahun = '$tahun'";
								$data = $aksi->tampil($table,$cari,"ORDER BY bulan ASC");

								$link_print = "print.php?riwayat_penggunaan&id_pelanggan=$id_pelanggan&tahun=$tahun";
								$link_excel = "print.php?excel&riwayat_penggunaan&id_pelanggan=$id_pelanggan&tahun=$tahun";
								$judul = "LAPORAN RIWAYAT PENGGUNNAN $id_pelanggan - ".strtoupper($pelanggan['nama'])." PADA TAHUN $tahun";
							}else{
								$data ="";
							}
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								LAPORAN RIWAYAT PENGGUNNAN PERTAHUN
								<div class="pull-right">
									<a href="<?php echo $link_print ?>" target="_blank"><div class="glyphicon glyphicon-print"></div>&nbsp;&nbsp;<label>CETAK</label></a>
									&nbsp;&nbsp;
									<a href="<?php echo $link_excel ?>" target="_blank"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;&nbsp;<label>EXPORT EXCEL</label></a>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-md-12">
									<form method="post">
										<div class="input-group">
											<div class="input-group-addon">ID PELANGGAN</div>
											<input type="text" name="id_pelanggan" class="form-control" placeholder="Masukan ID Pelanggan" value="<?php echo @$id_pelanggan ?>" list="id_pel" onkeypress='return event.charCode >=48 && event.charCode <=57' <?php if(@$_GET['id']){echo "readonly";} ?>>
											<datalist id="id_pel">
												<?php  
													$a = mysql_query("SELECT * FROM pelanggan");
													while ($b = mysql_fetch_array($a)) { ?>
														<option value="<?php echo $b['id_pelanggan'] ?>"><?php echo $b['nama']; ?></option>
												<?php } ?>
											</datalist>
											<div class="input-group-addon" id="pri">Tahun</div>
											<select name="tahun" class="form-control">
												<option></option>
												<?php 
												for ($a=2018; $a < 2031; $a++) {
												?>
												<option value="<?php echo $a; ?>" <?php if(@$a==@$tahun){echo "selected";} ?>><?php echo @$a; ?></option>
												<?php } ?>
											</select>
											<div class="input-group-btn">
												<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;CARI</button>
												<a href="?menu=laporan&riwayat_penggunaan" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;REFRESH</a>
											</div>
										</div>
									</form>
								</div>
										<center><label><?php echo @$judul; ?></label></center>
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<th><center>No.</center></th>
												<th><center>ID Pelanggan</center></th>
												<th><center>Nama Pelanggan</center></th>
												<th><center>Bulan</center></th>
												<th><center>Meter Awal</center></th>
												<th><center>Meter Akhir</center></th>
												<th><center>Jumlah Meter</center></th>
												<th><center>Tarif/KWh</center></th>
												<th><center>Jumlah Bayar</center></th>
											</thead>
											<tbody>
												<?php  
													$no = 0;
													if ($data=="") {
														$aksi->no_record(9);
													}else{
														foreach ($data as $r) {
															$no++;
															$penggunaan = $aksi->caridata("penggunaan WHERE id_pelanggan = '$r[id_pelanggan]' AND bulan = '$r[bulan]' AND tahun = '$r[tahun]'");
													?>
														<tr>
															<td align="center"><?php echo $no; ?>.</td>
															<td align="center"><?php echo $r['id_pelanggan']; ?></td>
															<td align="left"><?php echo $r['nama_pelanggan']; ?></td>
															<td align="center"><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun']; ?></td>
															<td align="center"><?php echo $penggunaan['meter_awal']; ?></td>
															<td align="center"><?php echo $penggunaan['meter_akhir']; ?></td>
															<td align="center"><?php echo $r['jumlah_meter']; ?></td>
															<td align="right"><?php $aksi->rupiah($r['tarif_perkwh']); ?></td>
															<td align="right"><?php $aksi->rupiah($r['jumlah_bayar']); ?></td>
														</tr>
												<?php } } 
													@$sum = mysql_fetch_array(mysql_query("SELECT SUM(jumlah_meter) as meter,SUM(jumlah_bayar) as bayar FROM tagihan WHERE id_pelanggan = '$id_pelanggan' AND tahun = '$tahun'"));
												?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="6" align="right">TOTAL METER :</td>
													<td align="center"><?php echo $sum['meter'] ; ?></td>
													<td align="right">TOTAL BAYAR :</td>
													<td align="right"><?php $aksi->rupiah($sum['bayar']); ?></td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
<!-- INI END LAPORAN RIWAYAT PENGGUNAAN -->
				
			</div>
		</div>
	</div>
</body>
</html>