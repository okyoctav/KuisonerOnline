<div class="panel-body">
	<div class="panel panel-default">
        <div class="panel-heading">
        	<a href="<?= base_url('p2mi/tambah_butir');?>" class="btn btn-primary btn-xs"><span class="fa fa-plus" ></span> &nbsp;Tambah Butir</a>
        	&nbsp;
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
        </div>
        <div class="panel-body">
        	<div class="table-responsive">
        	<?php if (empty($butirs)): ?>
        		<br>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Ooopss !!</strong> Butir Kuesioner Kosong.
                </div>
        	<?php endif ?>
        	<?= $this->session->flashdata('msg'); ?>
				<table class="table table-bordered table-hover">
				<?php $nokompetensi=1; foreach ($butirs as $kompetensi): ?>
					<tr>
						<th colspan="3" style="background-color:#C4E3F3;">&nbsp;&nbsp; <?= $nokompetensi.'. '.$kompetensi['nama_kompetensi'] ?></th>
					</tr>
					<tr>
						<th style="text-align: center">No.</th>
						<th style="text-align: center">Butir Kuesioner</th>
						<th style="text-align: center">Aksi</th>
					</tr><tbody>
					<?php $nobutir=1; if (empty($kompetensi['butir_kuesioner'])) {
						echo '<tr><td colspan="3" style="text-align: center" class="warning" ><strong>Butir Kuesioner Kosong</strong></td></tr>';
					}else{ foreach ($kompetensi['butir_kuesioner'] as $butir): ?>
					<tr>
						<td style="text-align: center"><?= $nobutir; ?></td>
						<td style="text-align: center"><?= $butir['butir'] ?></td>
						<td style="text-align: center"><a href="<?= base_url('p2mi/edit_butir/'.$butir['id_butir']); ?>" class="btn btn-warning btn-xs"><span class="fa fa-pencil" ></span></a></td>
					</tr>
					<?php $nobutir++; endforeach; }?></tbody>
				<?php $nokompetensi++; endforeach ?>
				</table>
        	</div>
        </div>
    </div>
</div>