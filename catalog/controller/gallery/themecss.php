<?php


class ControllerGalleryThemecss extends Controller {





	public function index() {


	


		header("Content-type: text/css", true);


		


		$data['gallerysetting_namecolor'] = $this->config->get('gallerysetting_namecolor');


		$data['gallerysetting_desccolor'] = $this->config->get('gallerysetting_desccolor');


		$data['gallerysetting_totalphotocolor'] = $this->config->get('gallerysetting_totalphotocolor');


		


		


		echo ".texthover .namephoto{color:".$data['gallerysetting_namecolor']."!important;}";


		echo ".photo h1{color:".$data['gallerysetting_namecolor']."!important;}";


		echo ".texthover .name{color:".$data['gallerysetting_namecolor']."!important;}";


		echo ".description{color:".$data['gallerysetting_desccolor']."!important;}";


		echo ".totalphoto{color:".$data['gallerysetting_totalphotocolor']."!important;}";


		echo ".texthover .namephoto{border-bottom:1px solid ".$data['gallerysetting_namecolor']."!important; border-top:1px solid ".$data['gallerysetting_namecolor']."!important;}";
	}
}