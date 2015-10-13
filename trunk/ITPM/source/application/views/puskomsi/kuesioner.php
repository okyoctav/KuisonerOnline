<div class="panel-body">
	<div class="panel panel-default">
        <div class="panel-heading">
        	<a href="<?= base_url('puskomsi/buat_kuesioner');?>" class="btn btn-primary btn-xs"><span class="fa fa-plus" ></span> &nbsp;Buat Kuesioner</a>
        	&nbsp;
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
	        				<th style="text-align: center">Tanggal Mulai</th>
	        				<th style="text-align: center">Tanggal Selesai</th>
	        				<th style="text-align: center">Aksi</th>
	        			</tr>
	        		</thead>
	        		<tbody>
		        		<?php if (empty($kuesioners)) {
		        			echo '
		        			<tr class="info text-center">
		        				<td colspan="5">Data Kosong</td>
		        			</tr>';
		        		} $no=1;foreach ($kuesioners as $kuesioner): ?>
		        			<tr>
		        				<td style="text-align: center"><?= $no; ?></td>
		        				<td style="text-align: center"><a href="javascript:void(0);" data-toggle="modal" data-target=".modalKuesioner<?= $kuesioner['id_kuesioner'] ?>"><?= $kuesioner['nama']; ?></a></td>
		        				<td style="text-align: center"><?= $kuesioner['tanggal_mulai'] ?></td>
		        				<td style="text-align: center"><?= $kuesioner['tanggal_selesai'] ?></td>
		        				<td style="text-align: center">
				    				<a href="<?= base_url('puskomsi/edit_kuesioner/'.$kuesioner['id_kuesioner']); ?>" class="btn btn-warning btn-xs">
				    					<span class="fa fa-pencil" ></span>
				    				</a>
		        				</td>
		        			</tr>
		        		<?php $no++;endforeach ?>
	        		</tbody>
	        	</table>
        	</div>
        </div>
    </div>
</div>