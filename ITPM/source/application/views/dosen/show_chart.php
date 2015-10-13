<div class="panel-body">
	<ul class="nav nav-tabs nav-justified nav-metro">
	    <li  class="active"><a href="#statistik_hasil" data-toggle="tab"><strong>Statistik Hasil Kuesioner</strong></a></li>
	    <li><a href="#saran" data-toggle="tab"><strong>Saran / Masukan Mahasiswa</strong></a></li>
	</ul>
	<div class="tab-content tab-content-metro mb30">
	    <div class="tab-pane active" id="statistik_hasil">
			<h2 class="text-center"><?= $nama_kuesioner[0]['nama'] ?></h2>
			<table class="table text-center table-bordered">
				<thead>
					<tr>
						<td><strong>Nama: <?= $dosen[0]['nama_dosen'] ?></strong></td>
						<td><strong>Matakuliah: <?= $dosen[0]['nama_matkul'] ?></strong></td>
						<td><strong>Tahap: <?= $dosen[0]['tahap_belajar'] ?></strong></td>
						<td><strong>Semester: <?= ucwords($dosen[0]['semester']) ?></strong></td>
						<td><strong>Tahun: <?= $dosen[0]['thn_akademik'] ?></strong></td>
					</tr>
				</thead>
			</table>
			<?php $num = 1; foreach ($kompetensi as $key1 => $val1) { ?>
				<h3><?= $kompetensi[$key1]['nama_kompetensi']; ?></h3>
			<?php foreach ($butir as $key2 => $val2): if ($butir[$key2]['id_kompetensi'] == $kompetensi[$key1]['id_kompetensi']) {?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered">
						<tbody>
						  <tr class="info text-center">
						    <td colspan="4"><strong><span class="pull-left"><?= $num; ?>.</span>	<?= $butir[$key2]['butir']; ?></strong></td>
						  </tr>
						</tbody>
						  <tr class="text-center">
						    <td><strong>Alternatif Jawaban</strong></td>
						    <td><strong>Jumlah</strong></td>
						    <td><strong>Skala LIKERT</strong></td>
						    <td><strong>Presentase</strong></td>
						  </tr>
						  <tbody>
						  	<?php $responden = 0;$skala_likert = 0;for ($no=5; $no >= 1 ; $no--) { ?>
							  <tr>
							    <td><?php switch ($no) {
							    	case 1:
							    		echo "sangat tidak baik/sangat rendah/tidak pernah/tidak lengkap";
							    	break;
							    	case 2:
							    		echo "tidak baik/rendah/jarang/kurang lengkap";
							    	break;
							    	case 3:
							    		echo "biasa/cukup/kadang-kadang/cukup lengkap";
							    	break;
							    	case 4:
							    		echo "baik/tinggi/sering/lengkap";
							    	break;
							    	case 5:
							    		echo "sangat baik/sangat tinggi/selalu/sangat lengkap";
							    	break;
							    }?></td>
							    <td class="text-center"><?php echo $butir[$key2]['jawab'.$no];$responden += $butir[$key2]['jawab'.$no];?></td>
							    <td class="text-center"><?php echo $butir[$key2]['skala_likert'.$no];$skala_likert += $butir[$key2]['skala_likert'.$no];?></td>
							    <td class="text-center"><?php echo round($butir[$key2]['presentase'.$no],2).' %';?></td>
							  </tr>
							  <?php } ?>
							  <tr>
							    <td class="text-center"><strong>Total</strong></td>
							    <td class="text-center"><strong><?= $responden ?> Orang</strong></td>
							    <td class="text-center"><strong><?= $skala_likert; ?></strong></td>
							    <td class="text-center"><strong>100 %</strong></td>
							  </tr>
							  <tr>
							    <td class="text-center"><strong>Interpretasi Hasil Pengamatan</strong></td>
							    <td colspan="3" class="text-center"><strong><?php $ihp = round(($skala_likert/($responden*5)) * 100,2); if ($ihp <= 20) {echo $ihp.' % '.'( Sangat Tidak Baik )';}elseif ($ihp >= 20 && $ihp <= 40) {echo $ihp.' % '.'( Tidak Baik )';}elseif ($ihp >= 40 && $ihp <= 60) {echo $ihp.' % '.'( Biasa )';}elseif ($ihp >= 60 && $ihp <= 80) {echo $ihp.' % '.'( Baik )';}elseif ($ihp >= 80 && $ihp <= 100) {echo $ihp.' % '.'( Sangat Baik )';} ?></strong></td>
							  </tr>
						  </tbody>
						</table>
					</div>
				</div>
				<!-- <div class="col-md-6">
					<div id="<?= strtolower(str_replace(' ', '-',$butir[$key2]['butir'])); ?>" style="height:400px;"></div>
				</div> -->
				<div class="col-md-12">
					<div class="table-responsive">
						
						<table class="table">
							<tr class="text-center">
								<td width="20%"><strong>Sangat Tidak Baik</strong></td>
								<td width="20%"><strong>Tidak Baik</strong></td>
								<td width="20%"><strong>Biasa</strong></td>
								<td width="20%"><strong>Baik</strong></td>
								<td width="20%"><strong>Sangat Baik</strong></td>
							</tr>
							<tr>
								<td colspan="5">
									<div class="progress progress-striped active">
				                        <div style="width:<?= $ihp ?>%" aria-valuemax="80" aria-valuemin="10" role="progressbar" class="progress-bar progress-bar-primary">
				                        </div>
				                    </div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div> 
			<?php $num++; } endforeach; echo "<hr>"; } ?>
	    </div><!-- tab-pane -->
	  
	    <div class="tab-pane" id="saran">
			<?php $no = 1;foreach ($sarans as $saran): ?>
				<p><?= $no; ?>.&nbsp;<?= $saran['saran']; ?></p>
				<hr>
			<?php $no++;endforeach ?>
	    </div><!-- tab-pane -->
	</div>
</div>