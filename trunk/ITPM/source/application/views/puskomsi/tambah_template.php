<div class="panel-body">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:history.go(-1);" class="btn btn-primary btn-xs"><span class="fa fa-chevron-left" ></span>&nbsp;Kembali</a>
			&nbsp;
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
		</div>
		<div class="panel-body">
			<form class="form-horizontal form-bordered" action="<?= base_url('puskomsi/tambah_template'); ?>" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Template</label>
                    <div class="col-sm-8">
                        <input placeholder="Nama Template Kuesioner" required class="form-control" name="nama" type="text">
                    </div>
                </div><!-- form-group -->

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input class="btn btn-success btn-xs" type="submit" name="tombol" value="Simpan"> 
                        &nbsp;
                        <input class="btn btn-danger btn-xs" type="reset" value="Reset">
                    </div>
                </div><!-- form-group -->
                <h3 style="text-align:center; margin:0px">Pilih Butir Kuesioner</h3>
                <?php if (empty($butirs)): ?>
                    <br>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Ooopss !!</strong> Butir Kuesioner Kosong.
                    </div>
                <?php endif ?>
                    <table class="table table-bordered table-hover" id="basicTables">
                    <?php $nokompetensi=1; $no=1; foreach ($butirs as $kompetensi): ?>
                        <tr>
                            <th colspan="3" class="info">&nbsp;&nbsp; <?= $nokompetensi.'. '.$kompetensi['nama_kompetensi'] ?></th>
                        </tr>
                        <tr>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: center">Butir Kuesioner</th>
                            <th style="text-align: center">Aksi</th>
                        </tr><tbody>
                        <?php $nobutir=1; if (empty($kompetensi['butir_kuesioner'])) {
                            echo '<tr class="warning"><td colspan="3" style="text-align: center"><strong>Butir Kuesioner Kosong</strong></td></tr>';
                        }else{foreach ($kompetensi['butir_kuesioner'] as $butir): ?>
                        <tr onclick="javascript:selectRow(this);" style="cursor:pointer;">
                            <td style="text-align: center"><?= $nobutir; ?></td>
                            <td style="text-align: center"><?= $butir['butir'] ?></td>
                            <td style="text-align: center;"><input type="checkbox" id="checkbox<?= $no; ?>" value="<?= $butir['id_butir']?>" name="butir[]"></td>
                        </tr>
                        <?php $nobutir++; $no++; endforeach; }?></tbody>
                    <?php $nokompetensi++; endforeach ?>
                </table>
            </form>
		</div>
	</div>
</div>