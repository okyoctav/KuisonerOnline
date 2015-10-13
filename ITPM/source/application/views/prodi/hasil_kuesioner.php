<div class="panel-body">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh"></span>&nbsp;Refresh</a>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<?= $this->session->flashdata('msg'); ?>
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th style="text-align: center">No.</th>
							<th style="text-align: center">Tahap Belajar</th>
							<th style="text-align: center">Semester</th>
							<th style="text-align: center">Tahun Akademik</th>
							<th style="text-align: center">#</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($settings)) {
							echo '<tr><td colspan="6" class="info" style="text-align: center">Data Kuesioner Kosong</td></tr>';
						}
						$no=1;foreach ($settings as $setting) { ?>
						<tr>
							<td style="text-align: center"><?= $no; ?></td>
							<td style="text-align: center"><?= $setting['tahap_belajar'] ?></td>
							<td style="text-align: center"><?= ucwords($setting['semester']) ?></td>
							<td style="text-align: center"><?= $setting['thn_akademik'] ?></td>
							<td style="text-align: center">
								<a href="<?= base_url('prodi/hasil_kuesioner/'.$setting['id']); ?>" class="btn btn-primary btn-xs"><span class="fa fa-eye"></span>&nbsp;Lihat Hasil</a>
							</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>