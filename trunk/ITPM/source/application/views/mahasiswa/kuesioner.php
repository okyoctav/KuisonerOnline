<div class="panel-body">
	<div class="panel panel-default">
        <div class="panel-heading">
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
        </div>
        <div class="panel-body">
        	<div class="table-responsive">
        	<?= $this->session->flashdata('msg'); ?>
        		<table class="table table-bordered responsive">
	        		<thead>
	        			<tr>
	        				<th style="text-align: center">No.</th>
	        				<th style="text-align: center">Nama Kuesioner</th>
	        				<th style="text-align: center">Nama Dosen</th>
	        				<th style="text-align: center">Nama Matakuliah</th>
	        				<th style="text-align: center">Tahap Belajar</th>
	        				<th style="text-align: center">Semester</th>
	        				<th style="text-align: center">Tahun Akademik</th>
	        			</tr>
	        		</thead>
	        		<tbody>
		        		<?php if (empty($kontrak_matkuls)) {
		        			echo '
		        			<tr class="info text-center">
		        				<td colspan="7">Data Kosong</td>
		        			</tr>';
		        		}  $no=1;foreach ($kontrak_matkuls as $kontrak_matkul): ?>
		        			<tr>
		        				<td style="text-align: center"><?= $no; ?></td>
		        				<td style="text-align: center"><a href="<?= base_url('mahasiswa/isi_kuesioner/'.$kontrak_matkul['id_kontrak_matkul']); ?>"><?= $kontrak_matkul['nama_kuesioner']; ?></a></td>
		        				<td style="text-align: center"><?= $kontrak_matkul['nama_dosen']; ?></td>
		        				<td style="text-align: center"><?= $kontrak_matkul['nama_matkul'] ?></td>
		        				<td style="text-align: center"><?= $kontrak_matkul['tahap_belajar'] ?></td>
		        				<td style="text-align: center"><?= ucwords($kontrak_matkul['semester']) ?></td>
		        				<td style="text-align: center"><?= $kontrak_matkul['thn_akademik'] ?></td>
		        			</tr>
		        		<?php $no++;endforeach ?>
	        		</tbody>
	        	</table>
        	</div>
        </div>
    </div>
</div>