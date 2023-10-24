<?php  


class ControlleragentOuragentview extends Controller {


 private $error = array();


 public function index() {


 


	 if (!$this->agent->isLogged()) {


			$this->response->redirect($this->url->link('agent/login', '', true));


		}


	 


	 $this->load->language('agent/viewagent');


		$this->load->model('agent/agent');


		$this->load->model('tool/image');	


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


		'text' => $this->language->get('text_home'),


		'href' => $this->url->link('common/home')


		);


		


		$data['breadcrumbs'][] = array(


		'text' => $this->language->get('heading_title'),


		'href' => $this->url->link('agent/viewagent')


		);


		


		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}


		$this->document->setTitle($this->language->get('heading_title'));


		$data['heading_title'] 			= $this->language->get('heading_title');


		$data['text_agent']				= $this->language->get('text_agent');


		$data['text_agentname'] 		= $this->language->get('text_agentname');


		$data['text_descriptions'] 	    = $this->language->get('text_descriptions');


		$data['text_positions'] 		= $this->language->get('text_positions');


		$data['text_country'] 			= $this->language->get('text_country');


		$data['text_city'] 				= $this->language->get('text_city');


		$data['text_image'] 			= $this->language->get('text_image');


		$data['text_address'] 			= $this->language->get('text_address');


		$data['text_contact'] 			= $this->language->get('text_contact');


		$data['text_country']			= $this->language->get('text_country');


		$data['text_zone'] 				= $this->language->get('text_zone');


		$data['text_postcode']			= $this->language->get('text_postcode');


		$data['entry_qty'] 				= $this->language->get('entry_qty');


		$data['text_email'] 			= $this->language->get('text_email');


	 	$data['text_plans'] 			= $this->language->get('text_plans');


		


		$this->load->model('tool/image');


         $agents_info=$this->model_agent_agent->getouragent($this->request->get['property_agent_id']);


		if (isset($agents_info['image'])) {


			$image = $this->model_tool_image->resize($agents_info['image'], 135,135);


		} else {


			$image = $this->model_tool_image->resize('placeholder.png',135,135);


		}


	 


	 


	    $data['agentimage']         =$image;


		$data['agentname']			=$agents_info['agentname'];


		$data['description']		= html_entity_decode($agents_info['description']);


		$data['positions']			=$agents_info['positions'];


		$data['email']				=$agents_info['email'];


		$data['contact']			=$agents_info['contact'];


		$data['address']			=$agents_info['address'];


		$data['city']				=$agents_info['city'];


		$data['pincode']			=$agents_info['pincode'];


		$this->load->model('localisation/country'); 
		$this->load->model('localisation/zone');
	 	$this->load->model('membership/plans');

		$getZone     				= $this->model_localisation_zone->getZone($agents_info['zone_id']);

		//$getPlans    				= $this->model_membership_plans->getPlan($agents_info['plans_id']);

		$getCountry  				= $this->model_localisation_country->getCountry($agents_info['country_id']);
		$data['zone']		    	=$getZone['name'];
          //$data['plans']		    $getPlans['name'];
		$data['country']	    	=$getCountry['name'];
		$data['column_images'] 		= $this->language->get('column_images');
		$data['column_left'] 		= $this->load->controller('common/column_left');
		$data['column_right']		= $this->load->controller('common/column_right');
		$data['content_top'] 		= $this->load->controller('common/content_top');
		$data['content_bottom'] 	= $this->load->controller('common/content_bottom');
		$data['footer'] 			= $this->load->controller('common/footer');

		$data['header'] 			= $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('agent/ouragentview',$data));


	}


 }
