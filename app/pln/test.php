<!-- INI LAPORAN TAGIHAN PERIODE-->
					<?php }elseif(isset($_GET['tagihan_periode'])){ 
						$data = "";
						if(isset($_POST['bcari'])){
							$table = "qw_tagihan";
                            $status = $_POST['status'];

                            $bulan_dari = $_POST['bulan_dari'];
                            $tahun_dari = $_POST['tahun_dari'];
                            $bulan_sampai = $_POST['bulan_sampai'];
                            $tahun_sampai = $_POST['tahun_sampai'];

                            @$cari = "WHERE status = '$status' AND  bulan = '$bulanini' AND tahun ='$tahunini'";
							$data = $aksi->tampil($table,$cari,"");

							$link_print = "print.php?tagihan_periode&status=$status&bulan_dari=$bulan_dari&tahun_dari=$tahun_dari&bulan_sampai=$bulan_sampai&tahun_sampai=$tahun_sampai";
							$link_excel = "print.php?excel&tagihan_periode&status=$status&bulan_dari=$bulan_dari&tahun_dari=$tahun_dari&bulan_sampai=$bulan_sampai&tahun_sampai=$tahun_sampai";
                        }else{
                        	@$data ="";
                        }
					?>
					<div class="panel panel-default">
						<div class="panel-heading">
							LAPORAN TAGIHAN PER-PERIODE
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
										<div class="input-group-addon">Dari Bulan</div>
										<select name="bulan_dari" class="form-control">
											<option></option>
											<?php  
												for ($a=1; $a <=12 ; $a++) { 
													if ($a<10) {
														$b = "0".$a;
													}else{
														$b = $a;
													} ?>
													<option value="<?php echo $b; ?>" <?php if(@$b==@$bulan_dari){echo "selected";} ?>><?php $aksi->bulan($b); ?></option>
													
												<?php } ?>
										</select>
										<div class="input-group-addon" id="pri">Tahun</div>
										<select name="tahun_dari" class="form-control">
											<option></option>
											<?php 
											for ($a=2018; $a < 2031; $a++) {
											?>
											<option value="<?php echo $a; ?>" <?php if(@$a==@$tahun_dari){echo "selected";} ?>><?php echo @$a; ?></option>
											<?php } ?>
										</select>
										<div class="input-group-addon">Sampai Bulan</div>
										<select name="bulan_sampai" class="form-control">
											<option></option>
											<?php  
												for ($a=1; $a <=12 ; $a++) { 
													if ($a<10) {
														$b = "0".$a;
													}else{
														$b = $a;
													} ?>
													<option value="<?php echo $b; ?>" <?php if(@$b==@$bulan_sampai){echo "selected";} ?>><?php $aksi->bulan($b); ?></option>
													
												<?php } ?>
										</select>
										<div class="input-group-addon" id="pri">Tahun</div>
										<select name="tahun_sampai" class="form-control">
											<option></option>
											<?php 
											for ($a=2018; $a < 2031; $a++) {
											?>
											<option value="<?php echo $a; ?>" <?php if(@$a==@$tahun_sampai){echo "selected";} ?>><?php echo @$a; ?></option>
											<?php } ?>
										</select>
										<div class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;CARI</button>
											<a href="?menu=laporan&tagihan_bulan" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;REFRESH</a>
										</div>
									</div>
								</form>
							</div>
	                            
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
<!-- INI END LAPORAN TAGIHAN PERIODE -->