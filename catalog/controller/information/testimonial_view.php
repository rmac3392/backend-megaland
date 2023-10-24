<?php 


class Controllerinformationtestimonialview extends Controller {


	private $error = array(); 
   
  	public function index() {

		$this->language->load('information/testimonial_view');
    	$this->document->setTitle($this->language->get('heading_title'));  
		$this->load->model('catalog/testimonial');
      	$data['breadcrumbs'] = array();

    	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),        	
        	'separator' => false


      	);

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('information/testimonial'),


        	'separator' => $this->language->get('text_separator')


      	);	


			


    	$data['heading_title'] = $this->language->get('heading_title');


		$data['text_location'] = $this->language->get('text_location');


		$data['text_testimonial'] = $this->language->get('text_testimonial');


		$data['text_address'] = $this->language->get('text_address');


    	$data['text_telephone'] = $this->language->get('text_telephone');


    	$data['text_fax'] = $this->language->get('text_fax');


		$data['entry_name'] = $this->language->get('entry_name');


    	$data['entry_email'] = $this->language->get('entry_email');


    	$data['entry_enquiry'] = $this->language->get('entry_enquiry');


		$data['entry_captcha'] = $this->language->get('entry_captcha');


		$data['button_submit'] = $this->language->get('button_submit');


		$data['button_send'] = $this->language->get('button_send');


		$data['action'] = $this->url->link('information/testimonial');


		$data['store'] = $this->config->get('config_name');


    	$data['address'] = nl2br($this->config->get('config_address'));


    	$data['telephone'] = $this->config->get('config_telephone');


    	$data['fax'] = $this->config->get('config_fax');


    	$data['text_name'] = $this->language->get('text_name');


    	$data['text_country'] = $this->language->get('text_country');


    	$data['text_message2'] = $this->language->get('text_message2');


    	$data['text_captcha'] = $this->language->get('text_captcha');


		$data['text_image'] = $this->language->get('text_image');


		$data['button_upload'] = $this->language->get('button_upload');


		$data['text_loading'] = $this->language->get('text_loading');


    	


		/*****ERROR*******/


		if (isset($this->error['captcha'])) {


			$data['error_captcha'] = $this->error['captcha'];


		} else {


			$data['error_captcha'] = '';


		}


		


		if (isset($this->error['enquiry'])) {


			$data['error_enquiry'] = $this->error['enquiry'];


		} else {


			$data['error_enquiry'] = '';


		}


		


		if(isset($this->error['name'])) {


			$data['error_name'] = $this->error['name'];


		} else {


			$data['error_name'] = '';


		}


		


		if (isset($this->error['country'])) {


			$data['error_country'] = $this->error['country'];


		} else {


			$data['error_country'] = '';


		}


		


		/******ERROR END***********/


		/**POST****/


		// Captcha


		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {


			$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);


		} else {


			$data['captcha'] = '';


		}


		


		$this->load->model('tool/image');


		


		if (isset($this->request->post['image'])) {


			$data['image'] = $this->request->post['image'];


		} else {


			$data['image'] = '';


		}





		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);


		}  else {


			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		}


		


		if(isset($this->request->post['name'])) {


			$data['name'] = $this->request->post['name'];


		} else {


			$data['name'] = $this->customer->getFirstName();


		}


		


		if(isset($this->request->post['country'])) {


			$data['country'] = $this->request->post['country'];


		} else {


			$data['country'] = $this->customer->getFirstName();


		}


		


		if (isset($this->request->post['enquiry'])) {


			$data['enquiry'] = $this->request->post['enquiry'];


		} else {


			$data['enquiry'] = $this->customer->getFirstName();


		}


		


		///testimonia 15/12/2017


			$this->language->load('information/testimonial');


			$data['testimoniainfos']=array();


		    $testimoniainfos=$this->model_catalog_testimonial->gettestimonials(array());	


			foreach($testimoniainfos as $testimoniainfo){


				if ($testimoniainfo['image']){


					$testimoniaimage = $this->model_tool_image->resize($testimoniainfo['image'], 100, 100);


				}else{


					$testimoniaimage = $this->model_tool_image->resize('no_image.png', 100, 100);


				}


				$data['testimoniainfos'][]=array(


				'testimoniainfo'=>$testimoniainfo['enquiry'],


				'name'=>$testimoniainfo['name'],


				'testimoniaimage'=>$testimoniaimage


			);


				


				


			}


             


			


		///testimonia 15/12/2017


	


		


		/*****POST END********/


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['column_right'] = $this->load->controller('common/column_right');


		$data['content_top'] = $this->load->controller('common/content_top');


		$data['content_bottom'] = $this->load->controller('common/content_bottom');


		$data['footer'] = $this->load->controller('common/footer');


		$data['header'] = $this->load->controller('common/header');


		


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/testimonial_view')) {


			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/testimonial_view', $data));


		} else {


			$this->response->setOutput($this->load->view('information/testimonial_view', $data));


		}	


  	}





  





	








  }


?>


