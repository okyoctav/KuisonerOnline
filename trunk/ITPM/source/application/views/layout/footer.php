		                                    </div><!-- contentpanel -->
		                </div>
            </div><!-- mainwrapper -->
        </section>


		<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/modernizr.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/pace.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/retina.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.cookies.js"></script>
        <script src="<?= base_url(); ?>assets/js/morris.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/raphael-2.1.0.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.gritter.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/custom.js"></script>
        <script type="text/javascript">
            <?php if ($this->uri->segment(1) == 'prodi') { ?>
            var audioElement = document.createElement('audio');
            var temp;
            var data;
            function audio () {
              audioElement.setAttribute('src', '<?= base_url() ?>assets/sounds/notif.mp3');
              return audioElement;
            }
            function notif(data){
                var totalNotip = parseInt($('#totalNotip').html()) + 1;
                $('#totalNotip').text(totalNotip);
                $('#notip').text('<li class="media"><div class="media-body"><strong>Data terbaru hasil kuesioner</strong><br>Dosen: <strong>'+data[key]['nama_dosen']+'</strong><br>Nama Matkul: <strong>'+data[key]['nama_matkul']+'</strong><br>Tahap: <strong>'+data[key]['tahap_belajar']+'</strong><br>Semester: <strong>'+data[key]['semester']+'</strong><br>Tahun Akademik: <strong>'+data[key]['thn_akademik']+'</strong></div></li>'+ $('#notip').html());
                jQuery.gritter.add({
                    title:'Hasil Kuesioner',
                    text:'<span style="color:rgb(41, 103, 165);">Data Baru Kuesioner Untuk<br>Dosen: <strong>'+data[key]['nama_dosen']+'</strong><br>Nama Matakuliah: <strong>'+data[key]['nama_matkul']+'</strong><br>Tahap Belajar: <strong>'+data[key]['tahap_belajar']+'</strong><br>Semester: <strong>'+data[key]['semester']+'</strong><br>Tahun Akademik: <strong>'+data[key]['thn_akademik']+'</strong> Telah Masuk</span> <a href="<?= base_url() ?>p2mi/hasil_kuesioner/'+data[key]['id_settings']+'/'+data[key]['id_matkul']+'/'+data[key]['id_dosen']+'">Klik</a>',
                    class_name: 'growl-info',
                    sticky: false,
                    time: ''
                });
                audio().play();
            }
            function cekData () {
                $.ajax({
                    url: "<?= base_url('ajax');?>/hasil_kuesioner",
                    data: {level: "prodi"},
                    type: "POST",
                    dataType: "html",
                    success: function (data) {

                        if (temp != null) {
                            data = JSON.parse(data);
                            for(key in data){
                                if (temp.hasOwnProperty(key)) {
                                    if (data[key]['responden'] != temp[key]['responden']) {
                                        notif(data);
                                    }
                                }else{
                                    notif(data);
                                };
                            }
                            if (temp !== data ) {
                                temp = data;
                            };
                        }else{
                            temp = JSON.parse(data);
                        };
                        setTimeout(cekData, 1000);

                    }
                });
            }
            cekData();
            <?php } if ($this->uri->segment(1) == 'puskomsi') { ?>
            jQuery('.datepicker').datepicker({dateFormat:"yy-mm-dd"});
            function cekDate() {
                var startDate = new Date($('#tanggal_mulai').val()).getTime();
                var endDate = new Date($('#tanggal_selesai').val()).getTime();
                if (startDate >= endDate){
                    alert('Tanggal selesai tidak boleh kurang atau sama dengan tanggal mulai !!!');
                    $('#tanggal_selesai').val('');
                }
            }
            function selectRow(row){

              var firstInput = row.getElementsByTagName('input')[0];
              firstInput.checked = !firstInput.checked;
              
            }
            <?php } if ($this->uri->segment(1) == 'p2mi') { ?>
            function removeBox (box) {
                $(box).fadeOut('slow', function() {
                    $(box).remove();
                });
            }
            var audioElement = document.createElement('audio');
            var temp;
            var data;
            function audio () {
              audioElement.setAttribute('src', '<?= base_url() ?>assets/sounds/notif.mp3');
              return audioElement;
            }
            function notif(data){
                var totalNotip = parseInt($('#totalNotip').html()) + 1;
                $('#totalNotip').text(totalNotip);
                $('#notip').html('<li class="media"><div class="media-body"><strong>Data terbaru hasil kuesioner</strong><br>Dosen: <strong>'+data[key]['nama_dosen']+'</strong><br>Nama Matkul: <strong>'+data[key]['nama_matkul']+'</strong><br>Tahap: <strong>'+data[key]['tahap_belajar']+'</strong><br>Semester: <strong>'+data[key]['semester']+'</strong><br>Tahun Akademik: <strong>'+data[key]['thn_akademik']+'</strong></div></li>' + $('#notip').html());
                jQuery.gritter.add({
                    title:'Hasil Kuesioner',
                    text:'<span style="color:rgb(41, 103, 165);">Data Baru Kuesioner Untuk<br>Dosen: <strong>'+data[key]['nama_dosen']+'</strong><br>Nama Matakuliah: <strong>'+data[key]['nama_matkul']+'</strong><br>Tahap Belajar: <strong>'+data[key]['tahap_belajar']+'</strong><br>Semester: <strong>'+data[key]['semester']+'</strong><br>Tahun Akademik: <strong>'+data[key]['thn_akademik']+'</strong> Telah Masuk</span> <a href="<?= base_url() ?>p2mi/hasil_kuesioner/'+data[key]['id_settings']+'/'+data[key]['id_matkul']+'/'+data[key]['id_dosen']+'">Klik</a>',
                    class_name: 'growl-info',
                    sticky: false,
                    time: ''
                });
                audio().play();
            }
            function cekData () {
                $.ajax({
                    url: "<?= base_url('ajax');?>/hasil_kuesioner",
                    data: {level: "p2mi"},
                    type: "POST",
                    dataType: "html",
                    success: function (data) {

                        if (temp != null) {
                            data = JSON.parse(data);
                            for(key in data){
                                if (temp.hasOwnProperty(key)) {
                                    if (data[key]['responden'] != temp[key]['responden']) {
                                        notif(data);
                                    }
                                }else{
                                    notif(data);
                                };
                            }
                            if (temp !== data ) {
                                temp = data;
                            };
                        }else{
                            temp = JSON.parse(data);
                        };
                        setTimeout(cekData, 1000);

                    }
                });
            }
            cekData();
            <?php } if ($this->uri->segment(1) == 'puskomsi') { ?>
            var audioElement = document.createElement('audio');
            var temp;
            var data;
            function audio () {
              audioElement.setAttribute('src', '<?= base_url() ?>assets/sounds/notif.mp3');
              return audioElement;
            }
            function notif(data){
                var totalNotip = parseInt($('#totalNotip').html()) + 1;
                $('#totalNotip').text(totalNotip);
                $('#notip').append('<li class="media"><div class="media-body"><strong>Butir Kuesioner</strong><br>Data Baru Butir Kuesioner Telah Masuk</span></div></li>');
                jQuery.gritter.add({
                    title:'Butir Kuesioner',
                    text:'<span style="color:rgb(41, 103, 165);">Data Baru Butir Kuesioner Telah Masuk</span>',
                    class_name: 'growl-info',
                    sticky: false,
                    time: ''
                });
                audio().play();
            }
            function cekData () {
                $.ajax({
                    url: "<?= base_url('ajax');?>/butir_kuesioner",
                    type: "GET",
                    dataType: "html",
                    success: function (data) {

                        if (temp != null) {
                            data = JSON.parse(data);
                            if (data['total_butir'] != temp['total_butir']) {
                                notif(data);
                                temp = data;
                            };
                        }else{
                            temp = JSON.parse(data);
                        };
                        setTimeout(cekData, 1000);

                    }
                });
            }
            cekData();
            <?php } if ($this->uri->segment(1) == 'dosen') { ?>
            var audioElement = document.createElement('audio');
            var temp;
            var data;
            function audio () {
              audioElement.setAttribute('src', '<?= base_url() ?>assets/sounds/notif.mp3');
              return audioElement;
            }
            function notif(data){
                var totalNotip = parseInt($('#totalNotip').html()) + 1;
                $('#totalNotip').text(totalNotip);
                $('#notip').append('<li class="media"><div class="media-body"><strong>Data terbaru hasil kuesioner</strong><br>Data Baru Untuk Kuesioner <strong>'+data[key]['nama']+'</strong></span> <a href="<?= base_url() ?>dosen/hasil_kuesioner/'+data[key]['id_matkul']+'/'+data[key]['id_settings']+'">Klik</a></div></li>');
                jQuery.gritter.add({
                    title:'Hasil Kuesioner',
                    text:'<span style="color:rgb(41, 103, 165);">Data Baru Untuk Kuesioner <strong>'+data[key]['nama']+'</strong> Telah Masuk</span> <a href="<?= base_url() ?>dosen/hasil_kuesioner/'+data[key]['id_matkul']+'/'+data[key]['id_settings']+'">Klik</a>',
                    class_name: 'growl-info',
                    sticky: false,
                    time: ''
                });
                audio().play();
            }
            function cekData () {
                $.ajax({
                    url: "<?= base_url('ajax');?>/hasil_kuesioner",
                    data: {id_dosen : "<?= $this->session->userdata('login')[0]['real_id']; ?>",
                           level: "dosen"},
                    type: "POST",
                    dataType: "html",
                    success: function (data) {

                        if (temp != null) {
                            data = JSON.parse(data);
                            for(key in data){
                                if (temp.hasOwnProperty(key)) {
                                    if (data[key]['responden'] != temp[key]['responden']) {
                                        notif(data);
                                    }
                                }else{
                                    notif(data);
                                };
                            }
                            if (temp !== data ) {
                                temp = data;
                            };
                        }else{
                            temp = JSON.parse(data);
                        };
                        setTimeout(cekData, 1000);

                    }
                });
            }
            cekData();
            <?php } 
            if ( /*($this->uri->segment(2) == 'hasil_kuesioner' && $this->uri->segment(1) == 'dosen' && $this->uri->segment(3) != '') || */ ($this->uri->segment(1) == 'prodi' && $this->uri->segment(5) != '') || ($this->uri->segment(1) == 'p2mi' && $this->uri->segment(5) != '')) { foreach ($butir as $key2 => $val2):?>
                var m4 = new Morris.Bar({
                    // ID of the element in which to draw the chart.
                    element: '<?= strtolower(str_replace(' ', '-',$butir[$key2]["butir"])) ?>',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: [
                    <?php for ($no=5; $no >= 1 ; $no--) { ?>
                        { y: <?php switch ($no) {
            case 1:
                //echo "'sangat tidak baik/sangat rendah/tidak pernah/tidak lengkap'";
                echo "'1 Poin'";
            break;
            case 2:
                //echo "'tidak baik/rendah/jarang/kurang lengkap'";
                echo "'2 Poin'";
            break;
            case 3:
                //echo "'biasa/cukup/kadang-kadang/cukup lengkap'";
                echo "'3 Poin'";
            break;
            case 4:
                //echo "'baik/tinggi/sering/lengkap'";
                echo "'4 Poin'";
            break;
            case 5:
                //echo "'sangat baik/sangat tinggi/selalu/sangat lengkap'";
                echo "'5 Poin'";
            break;
        }?>, a: <?php echo round($butir[$key2]['presentase'.$no],2)?>},
                    <?php } ?>
                    ],
                    xkey: 'y',
                    ykeys: ['a'],
                    ymax:[100],
                    labels: ['Presentase'],
                    barColors: ['#1CAF9A'],
                    lineWidth: '1px',
                    fillOpacity: 0.8,
                    smooth: false,
                    hideHover: true,
                });
                <?php endforeach; } if (($this->uri->segment(2) == 'hasil_kuesioner' && $this->uri->segment(3) != '' && $this->uri->segment(1) == 'prodi' && $this->uri->segment(4) == ''  && $this->uri->segment(5) == '' ) || ($this->uri->segment(2) == 'hasil_kuesioner' && $this->uri->segment(3) != '' && $this->uri->segment(1) == 'p2mi' && $this->uri->segment(4) == ''  && $this->uri->segment(5) == '' )) { ?>
                    Morris.Donut({
                  element: 'donat',
                  data: [
                    <?php $total_data_likert = 0; foreach ($kuesioners as $total_likert) {
                        $total_data_likert += $total_likert['total_likert_per_kompetensi'];
                    } foreach ($kuesioners as $kuesioner) {?>
                        {label: "<?= $kuesioner['nama_kompetensi'] ?>", value: <?= $kuesioner['total_likert_per_kompetensi'] ?>},
                    <?php } ?>
                  ],
                  formatter: function (value, data) { return (((value/<?= $total_data_likert ?>)*100).toFixed(2)) + '%'; }
                });
               <?php }?>
        </script>
    </body>
</html>