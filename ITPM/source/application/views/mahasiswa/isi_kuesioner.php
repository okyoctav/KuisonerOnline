<div class="panel-body">
	<h2 class="text-center"><?= $kuesioners['nama_kuesioner'] ?></h2>

<div class="row" style="padding:0px 20px 0px 20px;"><div class="row">
<div class="pull-left"><span style="font-size:14px"><strong>Jurusan / Prodi : <?= $kuesioners['jurusan'] ?> </strong></span></div>

<div class="pull-right"><span style="font-size:14px"><strong>Nama Dosen : <?= $kuesioners['nama_dosen'] ?></strong></span></div>
</div>

<div class="row">
<div class="pull-left"><span style="font-size:14px"><strong>Semester : <?= ucwords($kuesioners['semester']).' - '.$kuesioners['thn_akademik'] ?></strong></span></div>

<div class="pull-right"><span style="font-size:14px"><strong>Matakuliah : <?= $kuesioners['nama_matkul']; ?></strong></span></div>
</div></div>

<hr />
<p><span style="font-size:14px"><strong>Petunjuk :</strong></span></p>

<ul>
	<li>
	<p><span style="font-size:14px">Berikan penilaian terhadap komponen evaluasi di bawah ini dengan memilih nilai pada&nbsp; kolom di sebelah kanan yang tersedia<strong>.</strong></span></p>
	</li>
	<li>
	<p><span style="font-size:14px">Sesuai dengan yang Saudara ketahui, berilah penilaian secara jujur, objektif, dan penuh tanggung jawab terhadap DOSEN Saudara. Informasi yang Saudara berikan akan dipergunakan sebagai bahan masukan bagi dosen dan tidak akan berpengaruh terhadap status Saudara sebagai mahasiswa. Penilaian dilakukan terhadap aspek-aspek dalam tabel berikut dengan kriteria rentang skor 1 sampai dengan 5:</span></p>

	<ul>
		<li>
		<p><span style="font-size:14px">1 = sangat tidak baik/sangat rendah/tidak pernah/tidak lengkap</span></p>
		</li>
		<li>
		<p><span style="font-size:14px">2 = tidak baik/rendah/jarang/kurang lengkap</span></p>
		</li>
		<li>
		<p><span style="font-size:14px">3 = biasa/cukup/kadang-kadang/cukup lengkap</span></p>
		</li>
		<li>
		<p><span style="font-size:14px">4 = baik/tinggi/sering/lengkap</span></p>
		</li>
		<li>
		<p><span style="font-size:14px">5 = sangat baik/sangat tinggi/selalu/sangat lengkap</span></p>
		</li>
	</ul>
	</li>
</ul>
	<form action="<?= base_url('mahasiswa/isi_kuesioner') ?>" method="post">
	<input type="hidden" name="id_kontrak_matkul" value="<?= $id_kontrak_matkul ?>">
	    <table class="table table-bordered table-hover table-striped" id="basicTables">
	    <?php $nokompetensi=1; $no=1; foreach ($kuesioners['kuesioner'][0]['kompetensi'] as $kompetensi): ?>
	        <tr>
	            <th colspan="2" style="background-color:#C4E3F3;"><span style="font-size:14px">&nbsp;&nbsp; <?= $nokompetensi.'. '.$kompetensi['nama_kompetensi'] ?></span></th>
	            <th colspan="5" style="background-color:#C4E3F3; text-align: center"><span style="font-size:14px">Nilai</span></th>
	        </tr>
	        <tr>
	            <th style="text-align: center"><span style="font-size:14px">No.</span></th>
	            <th style="text-align: center"><span style="font-size:14px">Butir Butir yang Dinilai</span></th>
	            <th style="text-align: center"><span style="font-size:14px">1</span></th>
	            <th style="text-align: center"><span style="font-size:14px">2</span></th>
	            <th style="text-align: center"><span style="font-size:14px">3</span></th>
	            <th style="text-align: center"><span style="font-size:14px">4</span></th>
	            <th style="text-align: center"><span style="font-size:14px">5</span></th>
	        </tr><tbody>
	        <?php $nobutir=1; if (empty($kompetensi['butir_kuesioner'])) {
	            echo '<tr><td class="danger"><span style="font-size:14px">&nbsp;</span></td><td style="text-align: center" class="danger" ><span style="font-size:14px"><strong>Butir Kuesioner Kosong</strong></span></td></tr>';
	        }else{foreach ($kompetensi['butir_kuesioner'] as $butir): ?>
	        <tr>
	            <td onclick="javascript:selectRow(this);" style="cursor:pointer;text-align: center"><span style="font-size:14px"><?= $nobutir; ?></span></td>
	            <td ><span style="font-size:14px"><?= $butir['butir'] ?></span></td>
	            <td onclick="javascript:selectRow(this);" style="cursor:pointer; text-align: center"><span style="font-size:14px"><input type="radio" required name="jawaban<?= $butir['id_butir'] ?>" value="1"></span></td>
	            <td onclick="javascript:selectRow(this);" style="cursor:pointer; text-align: center"><span style="font-size:14px"><input type="radio" required name="jawaban<?= $butir['id_butir'] ?>" value="2"></span></td>
	            <td onclick="javascript:selectRow(this);" style="cursor:pointer; text-align: center"><span style="font-size:14px"><input type="radio" required name="jawaban<?= $butir['id_butir'] ?>" value="3"></span></td>
	            <td onclick="javascript:selectRow(this);" style="cursor:pointer; text-align: center"><span style="font-size:14px"><input type="radio" required name="jawaban<?= $butir['id_butir'] ?>" value="4"></span></td>
	            <td onclick="javascript:selectRow(this);" style="cursor:pointer; text-align: center"><span style="font-size:14px"><input type="radio" required name="jawaban<?= $butir['id_butir'] ?>" value="5"></span></td>
	        </tr>
	        <?php $nobutir++; $no++; endforeach; }?></tbody>
	    <?php $nokompetensi++; endforeach ?>
	    </table>
	    <div class="form-group">
	    	<label for="isi_saran" class="control-label">Berikan saran / masukan untuk dosen :</label>
	    	<textarea name="saran" required class="form-control"></textarea>
	    </div>
	    <div class="pull-right">
	    <button type="submit" name="tombol" value="Simpan" class="btn btn-primary">Simpan</button>
	    <button type="reset" name="tombol" class="btn btn-danger">Reset</button></div>
    </form>
</div>