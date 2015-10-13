<?php 

	function isLogin($mahasiswa=null)
	{
		$CI =& get_instance();
        if (!$CI->session->userdata('login')) {
			redirect(base_url('login'),'refresh');
		}
	}

	function alreadyLogin($session = null)
	{
		if ($session['level'] == '0') {
			redirect(base_url('p2mi'),'refresh');
		}else if ($session['level'] == '1') {
            redirect(base_url('puskomsi'),'refresh');
        }else if ($session['level'] == '2') {
            redirect(base_url('mahasiswa'),'refresh');
        }else if ($session['level'] == '3') {
            redirect(base_url('dosen'),'refresh');
        }else if ($session['level'] == '4') {
            redirect(base_url('prodi'),'refresh');
        }
	}

    function cekLevel($session ,$level)
    {
        $CI =& get_instance();
        if ($session['level'] != $level) {
            return false;
        }else{
            return true;
        }
    }

	function createLink($level){
        $CI =& get_instance();
		switch ($level) {
			case '0':
				echo '<li class = "'.activeHome().'"><a href="'.base_url('p2mi').'"><i class="fa fa-home"></i> <span>Halaman Utama</span></a></li>';
				echo '<li class="parent '.activeLink(array('hasil_kuesioner', 'kompetensi_kuesioner','tambah_kompetensi','edit_kompetensi','butir_kuesioner','tambah_butir','edit_butir'),2).' "><a href="#"><i class="fa fa-bar-chart-o"></i> <span>Kuesioner</span></a>
                        <ul class="children">
                            <li class = "'.activeLink(array('kompetensi_kuesioner','tambah_kompetensi','edit_kompetensi'),2).'" ><a href="'.base_url('p2mi/kompetensi_kuesioner').'">Kompetensi Kuesioner</a></li>
                            <li class = "'.activeLink(array('butir_kuesioner','tambah_butir','edit_butir'),2).'" ><a href="'.base_url('p2mi/butir_kuesioner').'">Butir Kuesioner</a></li>
                            <li class = "'.activeLink(array('hasil_kuesioner'),2).' "><a href="'.base_url('p2mi/hasil_kuesioner').'">Hasil Kuesioner</span></a></li>
                        </ul>
                      </li>';
			break;
            case '1':
                echo '<li class = "'.activeHome().'"><a href="'.base_url('puskomsi').'"><i class="fa fa-home"></i> <span>Halaman Utama</span></a></li>';
                echo '<li class="parent '.activeLink(array('kuesioner','edit_kuesioner','buat_kuesioner','template_kuesioner','tambah_template','edit_template'),2).' "><a href="#"><i class="fa fa-bar-chart-o"></i> <span>Kuesioner</span></a>
                        <ul class="children">
                            <li class = "'.activeLink(array('template_kuesioner','tambah_template','edit_template'),2).'" ><a href="'.base_url('puskomsi/template_kuesioner').'">Template Kuesioner</a></li>
                            <li class = "'.activeLink(array('kuesioner','buat_kuesioner','edit_kuesioner'),2).'" ><a href="'.base_url('puskomsi/kuesioner').'">Kuesioner</a></li>
                        </ul>
                      </li>';
            break;
            case '2':
            if (!empty($CI->session->userdata('kuesioner_aktif')[0])) {
                foreach ($CI->session->userdata('kuesioner_aktif') as $key1 => $val1) {
                    if (strtotime($CI->session->userdata('kuesioner_aktif')[$key1]['tanggal_selesai']) < strtotime('now')) {
                        $ada[] = 'ada';
                    }
                }
            }
            if (!empty($ada)) {
                if (in_array('ada',@$ada)) {
                    echo '<li class = "'.activeLink(array('kuesioner','isi_kuesioner'),2).' "><a href="'.base_url('mahasiswa/kuesioner').'"><i class="fa fa-bar-chart-o"></i> <span>Kuesioner</span></a></li>';
                }
            }else{
                echo '<li class = "'.activeHome().'"><a href="'.base_url('mahasiswa').'"><i class="fa fa-home"></i> <span>Halaman Utama</span></a></li>';
                echo '<li class = "'.activeLink(array('jadwal_kuliah'),2).' "><a href="'.base_url('mahasiswa/jadwal_kuliah').'"><i class="fa fa-clock-o"></i> <span>Jadwal Kuliah</span></a></li>';
                echo '<li class = "'.activeLink(array('kuesioner','isi_kuesioner'),2).' "><a href="'.base_url('mahasiswa/kuesioner').'"><i class="fa fa-bar-chart-o"></i> <span>Kuesioner</span></a></li>';
            }
            break;
            case '3':
                echo '<li class = "'.activeHome().'"><a href="'.base_url('dosen').'"><i class="fa fa-home"></i> <span>Halaman Utama</span></a></li>';
                echo '<li class = "'.activeLink(array('hasil_kuesioner'),2).' "><a href="'.base_url('dosen/hasil_kuesioner').'"><i class="fa fa-bar-chart-o"></i> <span>Hasil Kuesioner</span></a></li>';
            break;
            case '4':
                echo '<li class = "'.activeHome().'"><a href="'.base_url('prodi').'"><i class="fa fa-home"></i> <span>Halaman Utama</span></a></li>';
                echo '<li class = "'.activeLink(array('hasil_kuesioner'),2).' "><a href="'.base_url('prodi/hasil_kuesioner').'"><i class="fa fa-bar-chart-o"></i> <span>Hasil Kuesioner</span></a></li>';
            break;
		}
	}



    function activeHome()
    {
        $CI =& get_instance();
        if (!$CI->uri->segment(2)) {
        	return 'active';
        }
    }

    function activeLink($controller,$segment)
    {
        $CI =& get_instance();
        $class = $CI->uri->segment($segment);
        if (is_array($controller) ) {
            if (in_array($class, $controller)) {
                return 'active';
            }
        }else{
            return ($class == $controller) ? 'active' : '';
        }
    }

 ?>