<div class="panel-body">
	<?php if (!empty($kuesioners)){ ?>
	<table class="table table-bordered text-center">
		<thead>
			<tr>
				<td colspan="4"><strong>Hasil Kuesioner</strong></td>
			</tr>
			<tr>
				<td><strong>Tahap: <?= $kuesioners[0]['tahap_belajar'] ?></strong></td>
				<td><strong>Semester: <?= ucwords($kuesioners[0]['semester']) ?></strong></td>
				<td colspan="2"><strong>Tahun Akademik: <?= $kuesioners[0]['thn_akademik'] ?></strong></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="4">
					<div id="donat" style="height:100%;"></div>
				</td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<td colspan="4" ><strong>Data Dosen Yang Mengajar</strong></td>
			</tr>
			<tr>
				<td><strong>No</strong></td>
				<td><strong>Nama</strong></td>
				<td><strong>Matakuliah</strong></td>
				<td><strong>#</strong></td>
			</tr>
		</thead>
			<?php $no=1;foreach ($dosens as $dosen): ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $dosen['nama_dosen'] ?></td>
					<td><?= $dosen['nama_matkul'] ?></td>
					<td><a href="<?= base_url('p2mi/hasil_kuesioner/'.$dosen['id_settings'].'/'.$dosen['id_matkul'].'/'.$dosen['id_dosen']) ?>" class="btn btn-primary btn-xs"><span class="fa fa-eye"></span> Lihat Hasil</a></td>
				</tr>
			<?php $no++;endforeach ?>
	</table>
	<?php }else { ?>
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<strong>Oopss!</strong> Data Kosong.
	</div>
	<?php } ?>
</div>