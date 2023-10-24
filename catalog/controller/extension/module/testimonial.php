<?php


class ControllerExtensionModuletestimonial extends Controller {


	public function index($setting) {


		if(!empty($setting)) {


		$this->language->load('extension/module/testimonial');


		


		$this->load->model('catalog/testimonial');


		


		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');


		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');


		


		$this->load->model('tool/image');


		


		$data['testimonial'] = array();


		


		$data = array(


			'start' => 0,


			'limit' => $setting['limit']


		);


		


		$data['heading_title'] = $this->language->get('heading_title');


		


		$data['button_cart'] = $this->language->get('button_cart');





		$results = $this->model_catalog_testimonial->gettestimonial($data);


		foreach ($results as $result) {


			


			if ($result['image']) {


				$image = $this->model_tool_image->resize($result['image'], 62, 69);


			} else {


				$image = $this->model_tool_image->resize('placeholder.png', 62, 69);


			}


			


			$data['testimonial'][] = array(


				'testimonial_id' => $result['testimonial_id'],


				'name'    	 => $result['name'],


				'image'    	 => $image,


				'country'    => $result['country'],


				'enquiry'	 => utf8_substr(strip_tags(html_entity_decode($result['enquiry'], ENT_QUOTES, 'UTF-8')), 0, 150) . '..',


				'date'	 =>  $result['date']


			);


		}


		


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/testimonial')) {


			return $this->load->view($this->config->get('config_template') . '/template/extension/module/testimonial', $data);


		} else {


			return $this->load->view('extension/module/testimonial', $data);


		}


	}


	}


}


?>