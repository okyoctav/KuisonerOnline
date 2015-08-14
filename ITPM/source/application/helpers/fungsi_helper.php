<?php 

	function isLogin()
	{
		$CI =& get_instance();
		if (!$CI->session->userdata('login')[0]['level'] == '0') {
			redirect(base_url('p2mi'),'refresh');
		}else if ($CI->session->userdata('login')[0]['level'] == '1') {
			redirect(base_url('puskomsi'),'refresh');
		}
	}

	function alreadyLogin()
	{
		$CI =& get_instance();
		if ($CI->session->userdata('login')[0]['level'] == '0') {
			redirect(base_url('p2mi'),'refresh');
		}else if ($CI->session->userdata('login')[0]['level'] == '1') {
			redirect(base_url('puskomsi'),'refresh');
		}
	}

	function createLink($level){
		switch ($level) {
			case '0':
				echo '<li class = "'.activeLink('p2mi',1).'"><a href="'.base_url('p2mi').'"><i class="fa fa-home"></i> <span>Halaman Utama</span></a></li>';
				echo '<li class="parent '.activeLink('kuesioner',2).' "><a href="#"><i class="fa fa-bar-chart-o"></i> <span>Kuesioner</span></a>
                        <ul class="children">
                            <li><a href="'.base_url('kuesioner').'">Butir Kuesioner</a></li>
                        </ul>
                      </li>';
			break;
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