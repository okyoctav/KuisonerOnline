<div class="panel-body">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:history.go(-1);" class="btn btn-primary btn-xs"><span class="fa fa-chevron-left" ></span>&nbsp;Kembali</a>
			&nbsp;
			<a href="javascript:window.location.reload();" class="btn btn-primary btn-xs"><span class="fa fa-refresh" ></span>&nbsp;Refresh</a>
		</div>
		<div class="panel-body">
			<form class="form-horizontal form-bordered" action="<?= base_url('p2mi/edit_butir'); ?>" method="post">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Kompetensi Kuesioner</label>
                    <div class="col-sm-8">
                        <select name="id_kompetensi" class="form-control">
                            <?php foreach ($kompetensis as $kompetensi): ?>
                                <option value="<?= $kompetensi['id_kompetensi'] ?>"<?php if ($kompetensi['id_kompetensi'] == $butir[0]['id_kompetensi']) { echo "selected";}?>><?= $kompetensi['nama_kompetensi'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div><!-- form-group -->

                <div class="form-group">
                    <label class="col-sm-2 control-label">Butir Kuesioner</label>
                    <div class="col-sm-8">
                        <input placeholder="Butir Kuesioner.." required class="form-control" name="butir" value="<?= $butir[0]['butir']; ?>" type="text">
                        <input type="hidden" name="id_butir" value="<?= $butir[0]['id_butir']; ?>">
                    </div>
                </div><!-- form-group -->

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input class="btn btn-warning btn-xs" type="submit" name="tombol" value="Edit"> 
                        &nbsp;
                        <input class="btn btn-danger btn-xs" type="reset" value="Reset">
                    </div>
                </div><!-- form-group -->
                    
            </form>
		</div>
	</div>
</div>