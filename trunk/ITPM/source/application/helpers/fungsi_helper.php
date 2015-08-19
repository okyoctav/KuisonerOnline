<?php 

	function isLogin()
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
		}
	}

	function createLink($level){
		switch ($level) {
			case '0':
				echo '<li class = "'.activeHome().'"><a href="'.base_url('p2mi').'"><i class="fa fa-home"></i> <span>Halaman Utama</span></a></li>';
				echo '<li class="parent '.activeLink(array('butir_kuesioner'),2).' "><a href="#"><i class="fa fa-bar-chart-o"></i> <span>Kuesioner</span></a>
                        <ul class="children">
                            <li class = "'.activeLink('butir_kuesioner',2).'" ><a href="'.base_url('p2mi/butir_kuesioner').'">Butir Kuesioner</a></li>
                        </ul>
                      </li>';
			break;
			case '1':
				echo '<li class = "'.activeHome().'"><a href="'.base_url('puskomsi').'"><i class="fa fa-home"></i> <span>Halaman Utama</span></a></li>';
				echo '<li class="parent '.activeLink(array('buat_kuesioner','template_kuesioner'),2).' "><a href="#"><i class="fa fa-bar-chart-o"></i> <span>Kuesioner</span></a>
                        <ul class="children">
                        	<li class = "'.activeLink('template_kuesioner',2).'" ><a href="'.base_url('puskomsi/template_kuesioner').'">Template Kuesioner</a></li>
                            <li class = "'.activeLink('buat_kuesioner',2).'" ><a href="'.base_url('puskomsi/buat_kuesioner').'">Buat Kuesioner</a></li>
                        </ul>
                      </li>';
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