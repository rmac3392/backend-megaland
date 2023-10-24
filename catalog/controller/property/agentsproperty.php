<?php  

class ControllerPropertyagentsproperty extends Controller {

 private $error = array();

 public function index() {

   $this->load->language('property/agentsproperty');

		$this->load->model('agent/agent');
		$this->load->model('property/category');


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
	 	$data['text_agentproperty'] 			= $this->language->get('text_agentproperty');





		





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





		$data['pincode']			=$agents_info['pincode'];





 





		$this->load->model('localisation/country'); 





		$this->load->model('localisation/zone');





	 	$this->load->model('membership/plans');



		

		$getZone     				= $this->model_localisation_zone->getZone($agents_info['zone_id']);





		$getCountry  				= $this->model_localisation_country->getCountry($agents_info['country_id']);





		//$data['zone']		    	=$getZone['name'];



		if(!isset($getCountry['name']))
		{
				$getCountry['name']='';
		}

	    $data['country']	    	=$getCountry['name'];


//agent property

			$data['agentpropertys']=array();
	    	$property_agents=$this->model_agent_agent->getagentpropertys($this->request->get['property_agent_id']);
	    

	    	foreach ($property_agents as $property_agent) {
	 
			if (!empty($property_agent['image'])) {
				$propertyimage = $this->model_tool_image->resize($property_agent['image'], 
				$this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
			} else {
				$propertyimage = $this->model_tool_image->resize('placeholder.png',  
				$this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
			}

			$category_info=$this->model_property_category->getCategorybyProperty($property_agent['property_id']);
			
			$category_name=$this->model_property_category->getCategory($category_info['category_id']);
			
			if(isset($category_name['name'])){
			$category =$category_name['name'];         
			}else{
			$category ='';	
			}

					$data['agentpropertys'][] = array(
					'property_id'  => $property_agent['property_id'],
					'image'  => $propertyimage,
					'name'  => $property_agent['name'],
					'price'  => $property_agent['price'],
					'bathrooms'  => $property_agent['bathrooms'],
					'bedrooms'  => $property_agent['bedrooms'],
					'area'  => $property_agent['area'],
					'neighborhood'  => $property_agent['neighborhood'],
					'category_name'  => $category,
					'area_type'  => $property_agent['area_type'],
					'local_area'  => $property_agent['local_area'],
					'href'        => $this->url->link('property/property_detail', '&property_id=' . $property_agent['property_id'])
					
				);


	    	}
	    		//echo "<pre>";
	    		//print_r($data['agentpropertys']); die();


		$data['column_images'] 		= $this->language->get('column_images');





		$data['column_left'] 		= $this->load->controller('common/column_left');





		$data['column_right']		= $this->load->controller('common/column_right');





		$data['content_top'] 		= $this->load->controller('common/content_top');





		$data['content_bottom'] 	= $this->load->controller('common/content_bottom');





		$data['footer'] 			= $this->load->controller('common/footer');





		$data['header'] 			= $this->load->controller('common/header');





		$this->response->setOutput($this->load->view('property/agentsproperty',$data));





	}





 }





