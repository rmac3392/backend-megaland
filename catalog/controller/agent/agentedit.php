<?php


class Controlleragentagentedit extends Controller {


	private $error = array();


	public function index() {


		$this->load->language('agent/agentedit');

		$this->load->model('agent/agent');

		$this->load->model('tool/image');

			if (!$this->agent->isLogged()) {


			$this->response->redirect($this->url->link('agent/login', '', true));


		}


		


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {


			$this->model_agent_agent->editAgent($this->agent->getId(),$this->request->post);


			


			$this->response->redirect($this->url->link('agent/updatesuccess'));


		}


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


		'text' => $this->language->get('text_home'),


		'href' => $this->url->link('common/home')


		);


		$data['breadcrumbs'][] = array(


		'text' => $this->language->get('heading_title'),


		'href' => $this->url->link('agent/agentedit')


		);


		


		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title']   			        =$this->language->get('heading_title');
		$data['heading_register']   			     =$this->language->get('heading_register');

		$data['text_account_already']           =$this->language->get('text_account_already');
		$data['text_your_details']   		    =$this->language->get('text_your_details');


		///label name
		$data['text_agent']   					=$this->language->get('text_agent');
		$data['text_image']   					=$this->language->get('text_image');
		$data['text_descriptions']   			=$this->language->get('text_descriptions');
		$data['text_positions']   				=$this->language->get('text_positions');
		$data['text_email']   					=$this->language->get('text_email');
		$data['text_address']   				=$this->language->get('text_address');
		$data['text_contact']   				=$this->language->get('text_contact');
		$data['text_city']   					=$this->language->get('text_city');
		$data['text_postcode']   			    =$this->language->get('text_postcode');
		$data['text_country']   				=$this->language->get('text_country');
		$data['text_zone']   					=$this->language->get('text_zone');
		$data['text_plans']   					=$this->language->get('text_plans');
		$data['text_password']   				=$this->language->get('text_password');
		$data['text_confirm']   				=$this->language->get('text_confirm');
		$data['text_social']   			    	=$this->language->get('text_social');
		$data['text_facebook']   		 		=$this->language->get('text_facebook');
		$data['text_twitter']   				=$this->language->get('text_twitter');
		$data['text_validate']   				=$this->language->get('text_validate');
		$data['text_number']   				    =$this->language->get('text_number');
		$data['text_instagram']   				=$this->language->get('text_instagram');
		$data['text_googleplus']   			    =$this->language->get('text_googleplus');
		$data['text_pinterest']   				=$this->language->get('text_pinterest');
		$data['text_newsletter']   			    =$this->language->get('text_newsletter');
		$data['text_firstname']   				=$this->language->get('text_firstname');
		$data['text_lastname']   				=$this->language->get('text_astname');
		$data['text_telephone']   				=$this->language->get('text_telephone');
		$data['text_fax']   					=$this->language->get('text_fax');
		$data['text_company']   				=$this->language->get('text_company');
		$data['text_address_2']   				=$this->language->get('text_address_2');
		$data['text_none']   					=$this->language->get('text_none');
		$data['text_none']   					=$this->language->get('text_none');
		$data['text_loading']   					=$this->language->get('text_loading');
		
		///input  varibale

		$data['entry_agent']   					=$this->language->get('entry_agent');
		$data['entry_image']   					=$this->language->get('entry_image');
		$data['entry_descriptions']   			=$this->language->get('entry_descriptions');
		$data['entry_positions']   				=$this->language->get('entry_positions');
		$data['entry_email']   					=$this->language->get('entry_email');
		$data['entry_address']   				=$this->language->get('entry_address');
		$data['entry_contact']   				=$this->language->get('entry_contact');
		$data['entry_city']   					=$this->language->get('entry_city');
		$data['entry_postcode']   				=$this->language->get('entry_postcode');
		$data['entry_country']   				=$this->language->get('entry_country');
		$data['entry_zone']   					=$this->language->get('entry_zone');
		$data['entry_plans']   					=$this->language->get('entry_plans');
		$data['entry_password']   				=$this->language->get('entry_password');
		$data['entry_confirm']   				=$this->language->get('entry_confirm');
		$data['entry_social']   				=$this->language->get('entry_social');
		$data['entry_facebook']   				=$this->language->get('entry_facebook');
		$data['entry_twitter']   				=$this->language->get('entry_twitter');
		$data['entry_validate']   				=$this->language->get('entry_validate');
		$data['enter_number']   				=$this->language->get('enter_number');
		$data['entry_instagram']   				=$this->language->get('entry_instagram');
		$data['entry_googleplus']   			=$this->language->get('entry_googleplus');
		$data['entry_pinterest']   				=$this->language->get('entry_pinterest');
		$data['entry_newsletter']   			=$this->language->get('entry_newsletter');
		$data['entry_firstname']   				=$this->language->get('entry_firstname');
		$data['entry_lastname']   				=$this->language->get('entry_lastname');
		$data['entry_telephone']   				=$this->language->get('entry_telephone');
		$data['entry_fax']   					=$this->language->get('entry_fax');
		$data['entry_company']   				=$this->language->get('entry_company');
		$data['entry_address_2']   				=$this->language->get('entry_address_2');
		$data['entry_select']   				   =$this->language->get('entry_select');
		$data['entry_selectplans']   				   =$this->language->get('entry_selectplans');

		///btn

		$data['button_upload']   				=$this->language->get('button_upload');
		$data['button_submit']					=$this->language->get('button_submit');

		///list agent


		


		$agents_info = $this->model_agent_agent->getShowAgent($this->agent->getId());


					 


		$data['property_agent_id']	= $this->agent->getId();	


		$data['agentname']			=$agents_info['agentname'];


		$data['description']		=$agents_info['description'];


		$data['positions']			=$agents_info['positions'];


		$data['email']				=$agents_info['email'];


		$data['contact']			=$agents_info['contact'];


		$data['address']			=$agents_info['address'];


		$data['city']				=$agents_info['city'];


		$data['pincode']	    	=$agents_info['pincode'];








		$data['plans_id']   		=$agents_info['plans_id'];


		$data['facebook']   		=$agents_info['facebook'];


		$data['googleplus']   		=$agents_info['googleplus'];


		$data['instagram']   		=$agents_info['instagram'];


		$data['twitter']   			=$agents_info['twitter'];


		$data['pinterest']   		=$agents_info['pinterest'];








		$data['zone_id'] 	=  $agents_info['zone_id'];


		$data['country_id'] =  $agents_info['country_id'];


		


		


		if (isset($this->request->post['image'])) {


			$data['image'] =$this->request->post['image'];


		} elseif (!empty($agents_info)){


			$data['image'] =$agents_info['image'];


		} else {


			$data['image'] = '';


		}


		


		if(!empty($agents_info['image'])){


			$data['thumb'] = $this->model_tool_image->resize($agents_info['image'],135,135);


		}else{


			$data['thumb'] = $this->model_tool_image->resize('placeholder.png',135,135);


		}


		


		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}


		if (isset($this->error['agentname'])) {


			$data['error_agentname'] = $this->error['agentname'];


		} else {


			$data['error_agentname'] = '';


		}


		


		if (isset($this->error['email'])) {


			$data['error_email'] = $this->error['email'];


		} else {


			$data['error_email'] = '';


		}


		if (isset($this->error['image'])) {


			$data['error_image'] = $this->error['image'];


		} else {


			$data['error_image'] = '';


		}


	  	if (isset($this->error['address'])) {


			$data['error_address'] = $this->error['address'];


		} else {


			$data['error_address'] = '';


		}


		if (isset($this->error['city'])) {


			$data['error_city'] = $this->error['city'];


		} else {


			$data['error_city'] = '';


		}


	  	if (isset($this->error['country'])) {


			$data['error_country'] = $this->error['country'];


		} else {


			$data['error_country'] = '';


		}



		if (isset($this->error['zone'])) {


			$data['error_zone'] = $this->error['zone'];


		} else {


			$data['error_zone'] = '';


		}


	  	if (isset($this->error['password'])) {


			$data['error_password'] = $this->error['password'];


		} else {


			$data['error_password'] = '';


		}


    	if (isset($this->error['confirm'])) {


			$data['error_confirm'] = $this->error['confirm'];


		} else {


			$data['error_confirm'] = '';


		}


		if (isset($this->error['positions'])) {


			$data['error_positions'] = $this->error['positions'];


		} else {


			$data['error_positions'] = '';


		}


	  	if (isset($this->error['contact'])) {


			$data['error_contact'] = $this->error['contact'];


		} else {


			$data['error_contact'] = '';


		}	


	  	if (isset($this->error['pincode'])) {


			$data['error_postcode'] = $this->error['pincode'];


		} else {


			$data['error_postcode'] = '';


		}




		


		if (isset($this->error['plans_id'])) {


			$data['error_plans'] = $this->error['plans_id'];


		} else {


			$data['error_plans'] = '';


		}


		


		$data['action'] = $this->url->link('agent/agentedit', '', true);





		


		$this->load->model('localisation/language');


		$data['languages'] = $this->model_localisation_language->getLanguages();





		$this->load->model('localisation/country');


		$data['countries'] = $this->model_localisation_country->getCountries();


          ////plans ////


		 $this->load->model('membership/plans');


		$data['memberships']=$this->model_membership_plans->getPlansies($data);


		if (isset($this->request->post['country_id'])) {


			$data['country_id'] = (int)$this->request->post['country_id'];


		} elseif (isset($this->session->data['shipping_address']['country_id'])) {


			$data['country_id'] = $this->session->data['shipping_address']['country_id'];


		} 


		if (isset($this->request->post['zone_id'])) {


			$data['zone_id'] = (int)$this->request->post['zone_id'];


		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {


			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];


		}


			


		 ////plans ////





		$data['column_left']    = $this->load->controller('common/column_left');


		$data['column_right']   = $this->load->controller('common/column_right');


		$data['content_top']    = $this->load->controller('common/content_top');


		$data['content_bottom'] = $this->load->controller('common/content_bottom');


		$data['footer']         = $this->load->controller('common/footer');


		$data['header']         = $this->load->controller('common/header');


		$this->response->setOutput($this->load->view('agent/agentedit', $data));


	}





	public function validate() {


		if ((utf8_strlen(trim($this->request->post['agentname'])) < 1) || (utf8_strlen(trim($this->	request->post['agentname'])) > 32)) {


			$this->error['agentname'] = $this->language->get('error_agentname');


		}


		if ((utf8_strlen(trim($this->request->post['pincode'])) < 1) || (utf8_strlen(trim($this->request->post['pincode'])) > 32)) {


			$this->error['pincode'] = $this->language->get('error_postcode');


		}


		if ((utf8_strlen(trim($this->request->post['positions'])) < 1) || (utf8_strlen(trim($this->request->post['positions'])) > 32)) {


			$this->error['positions'] = $this->language->get('error_positions');


		}





		if ($this->request->post['image'] == '') {


			$this->error['image'] = $this->language->get('error_image');


		}


		


		


		if ($this->request->post['country_id'] == '') {


			$this->error['country'] = $this->language->get('error_country');


		}


		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {


			$this->error['zone'] = $this->language->get('error_zone');


		}
		
		
		if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {


			$this->error['email'] = $this->language->get('error_email');


		}


		if ((utf8_strlen(trim($this->request->post['address'])) < 3) || (utf8_strlen(trim($this->request->post['address'])) > 128)) {


			$this->error['address'] = $this->language->get('error_address');


		}


		if ((utf8_strlen(trim($this->request->post['city'])) < 2) || (utf8_strlen(trim($this->request->post['city'])) > 128)) {


			$this->error['city'] = $this->language->get('error_city');


		}


		return !$this->error;


 	}	


	public function country() {


		$json = array();





		$this->load->model('localisation/country');





		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);





		if ($country_info) {


			$this->load->model('localisation/zone');





			$json = array(


				'country_id'        => $country_info['country_id'],


				'name'              => $country_info['name'],


				'iso_code_2'        => $country_info['iso_code_2'],


				'iso_code_3'        => $country_info['iso_code_3'],


				'address_format'    => $country_info['address_format'],


				'postcode_required' => $country_info['postcode_required'],


				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),


				'status'            => $country_info['status']


			);


		}





		$this->response->addHeader('Content-Type: application/json');


		$this->response->setOutput(json_encode($json));


	}


}