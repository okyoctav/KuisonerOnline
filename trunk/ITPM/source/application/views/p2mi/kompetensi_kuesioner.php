<div class="panel-body">
	<div class="panel panel-default">
        <div class="panel-heading">
        	<a href="<?= base_url('p2mi/tambah_kompetensi');?>" class="btn btn-primary btn-xs"><span class="fa fa-plus" ></span> &nbsp;Tambah Kompetensi</a>
        	&nbsp;
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
        </div>
        <div class="panel-body">
        	<div class="table-responsive">
        	<?= $this->session->flashdata('msg'); ?>
        		<table class="table table-striped table-bordered responsive">
	        		<thead>
	        			<tr>
	        				<th style="text-align: center">No.</th>
	        				<th style="text-align: center">Kompetensi Kuesioner</th>
	        				<th style="text-align: center">Aksi</th>
	        			</tr>
	        		</thead>
	        		<tbody>
		        		<?php $no=1;foreach ($kompetensi_kuesioners as $kompetensi_kuesioner): ?>
		        			<tr>
		        				<td style="text-align: center"><?= $no; ?></td>
		        				<td style="text-align: center"><?= $kompetensi_kuesioner['nama_kompetensi']; ?></td>
		        				<td style="text-align: center">
				    				<a href="<?= base_url('p2mi/edit_kompetensi/'.$kompetensi_kuesioner['id_kompetensi']); ?>" class="btn btn-warning btn-xs">
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