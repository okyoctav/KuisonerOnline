<div class="panel-body">
	<div class="panel panel-default">
        <div class="panel-heading">
        	<a href="<?= base_url('puskomsi/tambah_template');?>" class="btn btn-primary btn-xs"><span class="fa fa-plus" ></span> &nbsp;Tambah Template</a>
        	&nbsp;
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
        </div>
        <div class="panel-body">
        	<div class="table-responsive">
        	<?= $this->session->flashdata('msg'); ?>
        		<table class="table table-hover table-bordered responsive">
	        		<thead>
	        			<tr>
	        				<th style="text-align: center">No.</th>
	        				<th style="text-align: center">Nama Template</th>
	        				<th style="text-align: center">Aksi</th>
	        			</tr>
	        		</thead>
	        		<tbody>
		        		<?php $no=1;
		        		if (!empty($templates)) {
		        			foreach ($templates as $template):?>
		        			<tr>
		        				<td style="text-align: center"><?= $no; ?></td>
		        				<td style="text-align: center"><a href="javascript:void(0);" data-toggle="modal" data-target=".modalTemplate<?= $template['id_template'] ?>"><?= $template['nama_template']; ?></a></td>
		        				<td style="text-align: center">
				    				<a href="<?= base_url('puskomsi/edit_template/'.$template['id_template']); ?>" class="btn btn-warning btn-xs">
				    					<span class="fa fa-pencil" ></span>
				    				</a>
		        				</td>
		        			</tr>
		        		<?php $no++;endforeach; }else{?>
		        		<tr><td colspan="3" class="info" style="text-align: center" >Data Kosong</td></tr>
		        		<?php } ?>
	        		</tbody>
	        	</table>
        	</div>
        </div>
    </div>
    <?php if (!empty($templates)) { foreach ($templates as $template): ?>
    	<div class="modal fade modalTemplate<?= $template['id_template'] ?>" tabindex="-1" role="dialog" data-backdrop="static">
		    <div class="modal-dialog modal-lg">
		      <div class="modal-content">
		          <div class="modal-header">
		              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
		              <h4 class="modal-title"><?= $template['nama_template'] ?></h4>
		          </div>
		          <div class="modal-body">
                    <table class="table table-bordered table-hover table-striped" id="basicTables">
                    <?php $nokompetensi=1; $no=1; foreach ($template['kompetensi'] as $kompetensi): ?>
                        <tr>
                            <th colspan="3" style="background-color:#C4E3F3;">&nbsp;&nbsp; <?= $nokompetensi.'. '.$kompetensi['nama_kompetensi'] ?></th>
                        </tr>
                        <tr>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: center">Butir Kuesioner</th>
                        </tr><tbody>
                        <?php $nobutir=1; if (empty($kompetensi['butir_kuesioner'])) {
                            echo '<tr><td class="danger">&nbsp;</td><td style="text-align: center" class="danger" ><strong>Butir Kuesioner Kosong</strong></td></tr>';
                        }else{foreach ($kompetensi['butir_kuesioner'] as $butir): ?>
                        <tr>
                            <td style="text-align: center"><?= $nobutir; ?></td>
                            <td style="text-align: center"><?= $butir['butir'] ?></td>
                        </tr>
                        <?php $nobutir++; $no++; endforeach; }?></tbody>
                    <?php $nokompetensi++; endforeach ?>
                    </table>
		          </div>
		      </div>
		    </div>
	    </div>
    <?php endforeach; } ?>
</div>