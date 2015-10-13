<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="javascript:history.go(-1);" class="btn btn-primary btn-xs"><span class="fa fa-chevron-left" ></span>&nbsp;Kembali</a>
            &nbsp;
            <a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
        </div>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" action="<?= base_url('puskomsi/edit_template'); ?>" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Template</label>
                    <div class="col-sm-8">
                        <input placeholder="Nama Template Kuesioner" required value="<?= $templates['nama_template']; ?>" required class="form-control" name="nama" type="text">
                        <input type="hidden" name="id_template" value="<?= $templates['id_template'] ?>">
                    </div>
                </div><!-- form-group -->

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input class="btn btn-warning btn-xs" type="submit" name="tombol" value="Edit"> 
                        &nbsp;
                        <input class="btn btn-danger btn-xs" type="reset" value="Reset">
                    </div>
                </div><!-- form-group -->
                <h3 style="text-align:center; margin:0px">Pilih Butir Kuesioner</h3>
                    <table class="table table-bordered table-hover table-striped" id="basicTables">

                    <?php foreach ($butirs as $butir_kuesioner) {
                        foreach ($butir_kuesioner['butir_kuesioner'] as $ass) {
                            $dataButirFull[] = $ass['id_butir'];
                        }
                    }
                    if (!empty($templates['kompetensi'])) {
                    foreach ($templates['kompetensi'] as $bk) {
                        if (!empty($bk['butir_kuesioner'])) {
                            foreach ($bk['butir_kuesioner'] as $asd) {
                                $dataButirSelect[] = $asd['id_butir'];
                            }
                        }
                    }
                    } else{ $dataButirSelect = array(); }
                    ?>
                    <?php $nokompetensi=1; $no=0; foreach ($butirs as $kompetensi):?>
                        <tr>
                            <th colspan="3" style="background-color:#C4E3F3;">&nbsp;&nbsp; <?= $nokompetensi.'. '.$kompetensi['nama_kompetensi'] ?></th>
                        </tr>
                        <tr>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: center">Butir Kuesioner</th>
                            <th style="text-align: center">Aksi</th>
                        </tr><tbody>
                        <?php $nobutir=1; if (empty($kompetensi['butir_kuesioner'])) {
                            echo '<tr><td class="danger">&nbsp;</td><td style="text-align: center" class="danger" ><strong>Butir Kuesioner Kosong</strong></td></tr>';
                        }else{foreach ($kompetensi['butir_kuesioner'] as $butir): ?>
                        <tr onclick="javascript:selectRow(this);" style="cursor:pointer;">
                            <td style="text-align: center"><?= $nobutir; ?></td>
                            <td style="text-align: center"><?= $butir['butir'] ?></td>
                            <td style="text-align: center;"><input type="checkbox" <?php if (@$dataButirSelect != null) {if (in_array($dataButirFull[$no], @$dataButirSelect)) {echo  "checked";} }?> id="checkbox<?= $no; ?>" value="<?= $butir['id_butir']?>" name="butir[]"></td>
                        </tr>
                        <?php $nobutir++; $no++; endforeach; }?></tbody>
                    <?php $nokompetensi++; endforeach ?>
                </table>
            </form>
        </div>
    </div>
</div>