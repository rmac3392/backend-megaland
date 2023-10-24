<?php 
class ControllerPropertyPropertyDetail extends Controller {
    private $error = array();

	public function index() {
		$this->load->language('property/property_detail');
		$this->load->model('tool/image');
		$this->load->model('property/property');
		$this->load->model('agent/agent');
		$this->load->model('tool/image');
		$this->load->model('property/category');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');

		if (isset($this->request->get['property_id'])) {
			$property_id = $this->request->get['property_id'];
		} else {
			$property_id = $this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}

	   	if (isset($this->request->get['filter_propertycategory'])) {
			$filter_propertycategory = $this->request->get['filter_propertycategory'];
		} else {
			$filter_propertycategory = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if(!empty($filter_propertycategory)){
            
			$category_info = $this->model_property_category->getCategory($filter_propertycategory);
            
			if($category_info){

			$data['breadcrumbs'][] = array(
				'text' => $category_info['name'],
				'href' => $this->url->link('property/category','&filter_propertycategory='.$filter_propertycategory)
			);

            }

		}

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
            $data['error_warning'] = '';
        }

		$propertys_info=$this->model_property_property->getProperty($property_id);
   
		if(isset($propertys_info['property_agent_id'])) {
			$data['property_agent_id'] = $propertys_info['property_agent_id'];
		} else {
			$data['property_agent_id'] = '';
		}


		if(empty($propertys_info['name'])) {
		    $this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}

		if (isset($propertys_info['image'])) {
			$image = $this->model_tool_image->resize($propertys_info['image'], 768,505);
		} else {
			$image = $this->model_tool_image->resize('placeholder.png',768,505);
	    }



		$data['image']=$image;


		
		if(isset($propertys_info['name'])){
		$data['name'] = $propertys_info['name'];	
		} else{
		$data['name'] = '';	
		}		

		if(isset($propertys_info['area_type'])){
		$data['area_type'] = $propertys_info['area_type'];	
		} else{
		$data['area_type'] = '';	
		}
        
        //xml
        if(isset($propertys_info['area_type'])){
		$data['area_type'] = $propertys_info['area_type'];	
		} else{
		$data['area_type'] = '';	
		}
		
		if(isset($propertys_info['video'])){
		$data['video'] = $propertys_info['video'];	
		} else{
		$data['video'] = '';	
		}
       


		$data['property_id']=$propertys_info['property_id'];

		$data['price']=$this->currency->format($propertys_info['price'],$this->config->get('config_currency'));

		$data['description']=html_entity_decode($propertys_info['description']);

		$data['bedrooms']=$propertys_info['bedrooms'];
        
		$data['bathrooms']=$propertys_info['bathrooms'];
		$data['area']=$propertys_info['area'];
		$data['local_area']=$propertys_info['local_area'];
		$data['pincode']=$propertys_info['pincode'];
		$data['city']=$propertys_info['city'];
		$data['neighborhood']=$propertys_info['neighborhood'];
		$data['builtin']=$propertys_info['builtin'];
		$data['Parkingspaces']=$propertys_info['Parkingspaces'];

		$property_statusid=$propertys_info['property_status_id'];
		
		$property_status=$this->model_property_property->getPropertyStatus($property_statusid);
		if(!empty($property_status['name'])){
			$data['property_status']=$property_status['name'];
		}else{
			$data['property_status']= '';
		
		}
		//Contact Agent////// 



		$property_agents=$this->model_agent_agent->getouragenticon($propertys_info['property_agent_id']);







		if(isset($property_agents)){



			foreach($property_agents as $property_agent){



				$propertyagent=$this->model_property_property->propertytotalagent($property_agent['property_agent_id']);



				if (isset($property_agent['image'])) {



					$agentimage = $this->model_tool_image->resize($property_agent['image'], 768,505);



				} else {



					$agentimage = $this->model_tool_image->resize('placeholder.png',768,505);



				}



				$data['propertycontactagent'][] = array(



					'agentimage'  => $agentimage,



					'propertyagent'	=> $propertyagent,



					'facebook'  => $property_agent['facebook'],



					'googleplus'  => $property_agent['googleplus'],



					'twitter'  => $property_agent['twitter'],



					'pinterest'  => $property_agent['pinterest'],



					'instagram'  => $property_agent['instagram'],



					'agentname'  => $property_agent['agentname'],

                    'href'        => $this->url->link('property/agentsproperty', 'property_agent_id=' . $property_agent['property_agent_id'])


				);



			}



		}

	



		$data['latitude']			=$propertys_info['latitude'];

	    $data['longitude']			=$propertys_info['longitude'];



		$data['pincode']			=$propertys_info['pincode'];



		$data['local_area']			=$propertys_info['local_area'];



	   $data['mapkey'] = $this->config->get('config_mapkey');



		$getZone     				= $this->model_localisation_zone->getZone($propertys_info['zone_id']);



		if(isset($getZone['name'])){



		$zonename = $getZone['name'];	



		} else{



			



		$zonename = '';	



		}



		$data['zone']		    	=$zonename;



		$getCountry  				= $this->model_localisation_country->getCountry($propertys_info['country_id']);



		$data['country']	    	=$getCountry['name'];





		//Contact Agent end////// 



		if (isset($this->request->post['config_fburl'])) {



			$data['fburl'] = $this->request->post['config_fburl'];



		} else {



			$data['fburl'] = $this->config->get('config_fburl');



		}







		if (isset($this->request->post['config_google'])) {



			$data['google'] = $this->request->post['config_google'];



		} else {



			$data['google'] = $this->config->get('config_google');



		}







		if (isset($this->request->post['config_twet'])) {



			$data['twet'] = $this->request->post['config_twet'];



		} else {



			$data['twet'] = $this->config->get('config_twet');



		}







		if (isset($this->request->post['config_in'])) {



			$data['in'] = $this->request->post['config_in'];



		} else {



			$data['in'] = $this->config->get('config_in');



		}







		if (isset($this->request->post['config_instagram'])) {



			$data['instagram'] = $this->request->post['config_instagram'];



		} else {



			$data['instagram'] = $this->config->get('config_instagram');



		}







		if (isset($this->request->post['config_pinterest'])) {



			$data['pinterest'] = $this->request->post['config_pinterest'];



		} else {



			$data['pinterest'] = $this->config->get('config_pinterest');



		}







		$this->load->model('tool/image');



		$featuresinfo=array();

       if(isset($this->request->get['property_id'])){
		  $property_ids =  $this->request->get['property_id']; 
	   }else{
		  $property_ids = ""; 
		   
	   }

		$features_info=$this->model_property_property->getproperfeatureAll($property_ids);



		if(isset($features_info)){



			foreach($features_info as $infos){



				if (isset($infos['image'])) {



					$features = $this->model_tool_image->resize($infos['image'], 30,30);



				} 



				$data['featuress'][] = array(



					'features'  => $features,



					'name'  => $infos['name'],



				);



			}	



		}



		$propertyimages=$this->model_property_property->getPropertyImages($this->request->get['property_id']);



		if(isset($propertyimages)){



			foreach($propertyimages as $propertyimage){



				if (isset($propertyimage['image'])) {



					$imagesbanner = $this->model_tool_image->resize($propertyimage['image'], 768,505);



				} 



				$data['propertyimagesbanners'][] = array(



					'imagesbanner'  => $imagesbanner,



					'title'  		=> $propertyimage['title'],



					'alt'  		=> $propertyimage['alt'],



				);







			}



		}



		$nearestplace_info=$this->model_property_property->getNeareastplaceAll($this->request->get['property_id']);		



		if(isset($nearestplace_info)){



			foreach($nearestplace_info as $info){

		$nearestdestinies =$this->model_property_property->getNeareastdestiny($this->request->get['property_id'], $info['nearest_place_id']);	

					if(!empty($nearestdestinies['destinies'])){
						$destiny=$nearestdestinies['destinies'];
					}else{
						$destiny='';
					}

				if (isset($info['image'])) {



					$nearplace = $this->model_tool_image->resize($info['image'], 30,30);



				} 



				$data['nearest'][] = array(



					'nearplace'  => $nearplace,



					'name'  => $info['name'],
					'destiny'  => $destiny,



				);



			}	


		}		



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get($propertys_info['name']),



			'href' => $this->url->link('property/category')



		);

		$this->load->model('customer/custom_field');


		
		if(!empty($propertys_info['custom_field'])){
		  $data['custom_fieldsshow']= json_decode($propertys_info['custom_field'], true);
		} else{
		  $data['custom_fieldsshow']='';
	    }

	    $data['customfieldsdetail']=array();
	    if(!empty($data['custom_fieldsshow'])){

		   	foreach($data['custom_fieldsshow'] as $key=>$val){ 
		   		
		   		$custom_fields= $this->model_customer_custom_field->getCustomFieldDescriptionsnew($key);
	          
	          	foreach($custom_fields  as $namecustom){ 
	            	$custom_field=array();
	            	if(isset($custom_field)){      
		            	$custom_field[]=array(
		          			'name' =>$namecustom['name']
		          		);
	            	}
	            }
	          	
	            if(!empty($custom_field) && !empty($val)){  
					$data['customfieldsdetail'][]=array(
		              'custom_field'=> $custom_field,
		              'val' 		=> $val
		            );
			    } 
	           
	           	
           	}
       	}
       	

 //related properties start

      $related_category= $this->model_property_property->getrelatedcategory($property_id);

      if(!empty($related_category['category_id'])){
      	$relatedcategory_id=$related_category['category_id'];
      }else{
      	$relatedcategory_id='';
      }
      
      $related_proerties= $this->model_property_property->getrelatedproperties($relatedcategory_id, $property_id);
	 	

	 	foreach ($related_proerties as $related_proerty) {

	  	$related_proertyname= $this->model_property_property->getrelatedPropertyName($related_proerty['property_id']);
	
			if(isset($related_proertyname['name'])){
			$relatedname = $related_proertyname['name'];	
			} else{
			$relatedname = '';	
			}

			if (isset($related_proertyname['image'])) {
				$image = $this->model_tool_image->resize($related_proertyname['image'], 
				$this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
			} else {
				$image = $this->model_tool_image->resize('placeholder.png',  
				$this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
			}	

			$relcategory_info=$this->model_property_category->getCategory($related_proerty['category_id']);
			
			if(isset($relcategory_info['name'])){
			$category =$relcategory_info['name'];         
			}else{
			$category ='';	
			}
			if(!empty($related_proertyname['area_type'])){
			$area_typ = $related_proertyname['area_type'];
			}else{
			$area_typ='';
			}
			if(!empty($related_proertyname['local_area'])){
			$local_area = $related_proertyname['local_area'];
			}else{
			$local_area='';
			}
			if(!empty($related_proertyname['neighborhood'])){
			$neighborhood = $related_proertyname['neighborhood'];
			}else{
			$neighborhood='';
			}
			if(!empty($related_proertyname['bedrooms'])){
			$bedrooms = $related_proertyname['bedrooms'];
			}else{
			$bedrooms='';
			}
			if(!empty($related_proertyname['bathrooms'])){
			$bathrooms = $related_proertyname['bathrooms'];
			}else{
			$bathrooms='';
			}
			if(!empty($related_proertyname['area'])){
			$area = $related_proertyname['area'];
			}else{
			$area='';
			}
			if(!empty($related_proertyname['price'])){
			$price = $this->currency->format($related_proertyname['price'],$this->config->get('config_currency'));
			}else{
			$price='';
			}
		
			
	 		$data['relatedproperties'][] = array(
					'property_id'  => $related_proerty['property_id'],
					'relatedname'  => $relatedname,
					'image'  => $image,
					'category'  => $category,
					'local_area'  => $local_area,
					'area_type'     => $area_typ,
					'neighborhood'  => $neighborhood,
					'area'          => $area,
					'bedrooms'  => $bedrooms,
					'bathrooms'  => $bathrooms,
					'price'  => $price,
					'href'        => $this->url->link('property/property_detail', '&property_id=' . $related_proerty['property_id'])


				);

	 	}
	 	

//related properties end

	$share = $this->url->link('property/property_detail', 'property_id=' . (int)$this->request->get['property_id']);

		 $this->document->setTitle($this->language->get($propertys_info['name']));

		

		$this->document->setSeoTitle($propertys_info['meta_title']);
		
		$this->document->setSeoDescription($propertys_info['meta_description']);

		$this->document->setImage($this->model_tool_image->resize($propertys_info['image'], 50,50));

		$this->document->setUrl($share);


		$data['heading_title'] 				        = $this->language->get('heading_title');
		$data['propertydetails_price'] 				= $this->language->get('propertydetails_price');
		$data['propertydetails_sqft'] 				= $this->language->get('propertydetails_sqft');
		$data['propertydetails_amenities'] 			= $this->language->get('propertydetails_amenities');
		$data['propertydetails_nearestplace'] 		= $this->language->get('propertydetails_nearestplace');
		$data['propertydetails_description'] 		= $this->language->get('propertydetails_description');
		$data['propertydetails_customfield'] 		= $this->language->get('propertydetails_customfield');
		$data['propertydetails_video'] 		         = $this->language->get('propertydetails_video');

        //xml 2/10/2018
		$data['text_type'] = $this->language->get('text_type');
		$data['text_bedroom'] = $this->language->get('text_bedroom');
		$data['text_bathroom'] = $this->language->get('text_bathroom');
		$data['text_kitchen'] = $this->language->get('text_kitchen');
		$data['text_garage'] = $this->language->get('text_garage');
		$data['text_hall'] = $this->language->get('text_hall');
		$data['text_feet'] = $this->language->get('text_feet');
		$data['text_parking'] = $this->language->get('text_parking');
		$data['text_built'] = $this->language->get('text_built');
		$data['text_areatype'] = $this->language->get('text_areatype');
		$data['text_propertystatus'] = $this->language->get('text_propertystatus');

		$data['propertydetails_property'] 		 = $this->language->get('propertydetails_property');

		$data['propertydetails_contact'] 		 = $this->language->get('propertydetails_contact');
		$data['propertydetails_contactnow'] 	 = $this->language->get('propertydetails_contactnow');
		$data['popupmessage_sendmsg'] 		     = $this->language->get('popupmessage_sendmsg');
        $data['entry_name'] 				     = $this->language->get('entry_name');
		$data['entry_email'] 				     = $this->language->get('entry_email');
		$data['entry_msg'] 					     = $this->language->get('entry_msg');
		$data['entry_maplocation'] 				 = $this->language->get('entry_maplocation');
		$data['entry_address'] 				 = $this->language->get('entry_address');
		$data['entry_zip'] 				 = $this->language->get('entry_zip');
		$data['entry_city'] 				 = $this->language->get('entry_city');
		$data['entry_neighborhood'] 				 = $this->language->get('entry_neighborhood');
		$data['entry_state_county'] 				 = $this->language->get('entry_state_county');
		$data['entry_relatedproperty'] 		         = $this->language->get('entry_relatedproperty');
		$data['propertydetails_address'] 		         = $this->language->get('propertydetails_address');
		$data['propertydetails_details'] 		         = $this->language->get('propertydetails_details');
		
	
		$data['button_upload'] 				= $this->language->get('button_upload');
		$data['button_submit'] 				= $this->language->get('button_submit');



		$data['column_left'] 				= $this->load->controller('common/column_left');



		$data['column_footer5'] 			= $this->load->controller('common/column_footer5');



		$data['column_right'] 				= $this->load->controller('common/column_right');



		$data['content_top'] 				= $this->load->controller('common/content_top');



		$data['content_bottom'] 			= $this->load->controller('common/content_bottom');



		$data['footer'] 				 	= $this->load->controller('common/footer');



		$data['header'] 					= $this->load->controller('common/header');



		$this->response->setOutput($this->load->view('property/property_detail', $data));



    }
	public function Sendenquery(){


		$json = array();
		$this->load->language('property/property_detail');

		$this->load->model('property/property');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

			if(empty($this->request->post['nameagent']) || (utf8_strlen($this->request->post['nameagent']) < 3)) {
			$json['error']['nameagent']= 'Name must be of 3 characters';	

			}

			if(empty($this->request->post['emailagent']) || !filter_var($this->request->post['emailagent'], FILTER_VALIDATE_EMAIL)) {
				$json['error']['emailagent']= 'E-Mail Address does not appear to be valid!';
			}

			if(empty($this->request->post['description']) || (utf8_strlen($this->request->post['description']) > 150)) {
			$json['error']['description']= 'Description must be less than 150 characters!';	

			}


			 if(empty($json['error'])) {


				$this->model_property_property->addEnquiry($this->request->post,$this->request->get['property_agent_id']);

				$json['success'] = $this->language->get('agent_success');


			}
		}	



		$this->response->addHeader('Content-Type: application/json');



		$this->response->setOutput(json_encode($json));



	 }

 }