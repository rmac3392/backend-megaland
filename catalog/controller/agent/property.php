<?php
class ControllerAgentproperty extends Controller {
  private $error = array();
  public function index() {
		if (!$this->agent->isLogged()) {
			$this->response->redirect($this->url->link('agent/login', '', true));
		}
		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('agent/login', '', true));
		$this->load->model('property/property');
		$this->load->language('agent/property');
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){
			$this->model_property_property->addProperty($this->request->post);
			$this->response->redirect($this->url->link('agent/property/view'));
		     $this->session->data['success'] = $this->language->get('text_success');

		} 



		$data['heading_title']           = $this->language->get('heading_title');
		$data['heading_add']           = $this->language->get('heading_add');
		$data['heading_agentsignup']           = $this->language->get('heading_agentsignup');


		$this->document->setTitle($this->language->get('heading_title'));

		////// ///label name

		$data['text_meta_title']               = $this->language->get('text_meta_title');
		$data['text_meta_descriptions']        = $this->language->get('text_meta_descriptions');
		$data['text_meta_keyword']             = $this->language->get('text_meta_keyword');
		$data['text_name']                     = $this->language->get('text_name');
		$data['text_description']              = $this->language->get('text_description');
		$data['text_tag']                      = $this->language->get('text_tag');
		$data['text_SEO_URL']                  = $this->language->get('text_SEO_URL');
		$data['text_sort_order']               = $this->language->get('text_sort_order');
		$data['text_images']                   = $this->language->get('text_images');
		$data['text_status']                   = $this->language->get('text_status');
		$data['text_video']                    = $this->language->get('text_video');
		$data['text_property_status']          = $this->language->get('text_property_status');
		$data['text_Price']                    = $this->language->get('text_Price');
		$data['text_pricelabel']               = $this->language->get('text_pricelabel');
		$data['text_category']                 = $this->language->get('text_category');
		$data['text_country']                  = $this->language->get('text_country');
		$data['text_Zone_region']              = $this->language->get('text_Zone_region');
		$data['text_city']                     = $this->language->get('text_city');
		$data['text_local_area']               = $this->language->get('text_local_area');
		$data['text_pincode']                  = $this->language->get('text_pincode');
		$data['text_map']                      = $this->language->get('text_map');
		$data['text_latitude']                 = $this->language->get('text_latitude');
		$data['text_longitude']                = $this->language->get('text_longitude');
		$data['text_images']                   = $this->language->get('text_images');
		$data['text_builtin']                  = $this->language->get('text_builtin');
		$data['text_loading']                  = $this->language->get('text_loading');
		$data['text_Parkingspaces']            = $this->language->get('text_Parkingspaces');
		$data['text_roomcount']                = $this->language->get('text_roomcount');
		$data['text_bathrooms']                = $this->language->get('text_bathrooms');
		$data['text_area']                     = $this->language->get('text_area');
		$data['text_neighborhood']             = $this->language->get('text_neighborhood');
		$data['text_image']                    = $this->language->get('text_image');
		$data['text_none']                     = $this->language->get('text_none');
		$data['text_bedrooms']                 = $this->language->get('text_bedrooms');
		$data['text_select']                   = $this->language->get('text_select');


		////// ///input value name
		$data['entry_meta_title']                = $this->language->get('entry_meta_title');
		$data['entry_meta_descriptions']         = $this->language->get('entry_meta_descriptions');
		$data['entry_meta_keyword']              = $this->language->get('entry_meta_keyword');
		$data['entry_name']                      = $this->language->get('entry_name');
		$data['entry_description']               = $this->language->get('entry_description');
		$data['entry_tag']                       = $this->language->get('entry_tag');
		$data['entry_SEO_URL']                   = $this->language->get('entry_SEO_URL');
		$data['entry_sort_order']                = $this->language->get('entry_sort_order');
		$data['entry_images']                    = $this->language->get('entry_images');
		$data['entry_status']                    = $this->language->get('entry_status');
		$data['entry_video']                     = $this->language->get('entry_video');
		$data['entry_property_status']           = $this->language->get('entry_property_status');
		$data['entry_Price']                     = $this->language->get('entry_Price');
		$data['entry_pricelabel']                = $this->language->get('entry_pricelabel');
		$data['entry_category']                  = $this->language->get('entry_category');
		$data['entry_country']                   = $this->language->get('entry_country');
		$data['entry_Zone_region']               = $this->language->get('entry_Zone_region');
		$data['entry_city']                      = $this->language->get('entry_city');
		$data['entry_local_area']                = $this->language->get('entry_local_area');
		$data['entry_pincode']                   = $this->language->get('entry_pincode');
		$data['entry_map']                       = $this->language->get('entry_map');
		$data['entry_latitude']                  = $this->language->get('entry_latitude');
		$data['entry_longitude']                 = $this->language->get('entry_longitude');
		$data['entry_images']                    = $this->language->get('entry_images');
		$data['entry_builtin']                   = $this->language->get('entry_builtin');
		$data['entry_Parkingspaces']             = $this->language->get('entry_Parkingspaces');
		$data['entry_roomcount']                 = $this->language->get('entry_roomcount');
		$data['entry_bathrooms']                 = $this->language->get('entry_bathrooms');
		$data['entry_area']                      = $this->language->get('entry_area');
		$data['entry_neighborhood']              = $this->language->get('entry_neighborhood');
		$data['entry_kanal']                       = $this->language->get('entry_kanal');


		$data['entry_enable']                    = $this->language->get('entry_enable');
		$data['entry_disable']                   = $this->language->get('entry_disable');
		$data['entry_select']                    = $this->language->get('entry_select');
		$data['entry_arealenght']                = $this->language->get('entry_arealenght');
		$data['entry_bedrooms']                  = $this->language->get('entry_bedrooms');
		$data['entry_destinies']                 = $this->language->get('entry_destinies');
		$data['entry_image']                     = $this->language->get('entry_image');
		$data['entry_enable']                    = $this->language->get('entry_enable');
		$data['entry_disable']                   = $this->language->get('entry_disable');


		$data['button_upload']               = $this->language->get('button_upload');
		$data['button_save']                 = $this->language->get('button_save');
		$data['button_cancel']               = $this->language->get('button_cancel');
		$data['button_add']                  = $this->language->get('button_add');
      
        $data['tab_general']                 = $this->language->get('tab_general');
		$data['tab_data']                    = $this->language->get('tab_data');
		$data['tab_Address_Map']             = $this->language->get('tab_Address_Map');
		$data['tab_image']                   = $this->language->get('tab_image');
		$data['tab_feature']                 = $this->language->get('tab_feature');
		$data['tab_neareast_place']          = $this->language->get('tab_neareast_place');
		$data['tab_customfield']             = $this->language->get('tab_customfield');
        

        // agent Property listing 
		$data['column_description']                 = $this->language->get('column_description');
		$data['column_property_status']             = $this->language->get('column_property_status');
		$data['column_image']                       = $this->language->get('column_image');
		$data['column_name']                        = $this->language->get('column_name');
		$data['column_price']                       = $this->language->get('column_price');
    	$data['cancel']                             = $this->url->link('agent/property/view');


		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$this->load->model('localisation/country');



		$data['countrys'] = $this->model_localisation_country->getCountries();



	  	$this->load->model('property/feature');



		if (isset($this->request->get['property_id'])) {



			$property_id = $this->request->get['property_id'];



		} else {



			$property_id = '';



		}



		$data['feature_c']=array();



		$checkfeatures = $this->model_property_feature->checkFeatures($property_id);



	  



		$data['feature']=array();



	  



		foreach($checkfeatures as $checkf){



			$data['checkfeatures'][]=array(



				'feature_id'=>$checkf['feature_id'],



			);



			$data['feature_c'][]=$checkf['feature_id'];



		}



	  	



		$this->load->model('property/feature');



		$features = $this->model_property_feature->getFeatures(array());



	  



		$this->load->model('tool/image');



	  



		foreach($features as $feature){



			if (is_file(DIR_IMAGE . $feature['image'])){



				$image = $this->model_tool_image->resize($feature['image'], 40, 40);



			} else {



				$image = $this->model_tool_image->resize('no_image.png', 40, 40);



			}



			$data['feature'][] = array(



				'feature_id' 	=> $feature['feature_id'],



				'name' 			=> $feature['name'],



				'image' => $image,



			);



		}	



	  



	  	$this->load->model('property/nearest_place');



		$this->load->model('property/property');



	  



		$data['nearestplace'] = array();  



		$nearestplaces =$this->model_property_nearest_place->getNearestPlaces(array());



		$this->load->model('tool/image');



		



	  	$data['nearestplace']=array();



	  



		if(isset($nearestplaces)){



			foreach($nearestplaces as $nearestplace){



				if (is_file(DIR_IMAGE . $nearestplace['image'])){



					$image = $this->model_tool_image->resize($nearestplace['image'], 40, 40);



				} else {



					$image = $this->model_tool_image->resize('no_image.png', 40, 40);



				}



				$destinies= $this->model_property_property->getNearestplaceid($property_id,$nearestplace['nearest_place_id']);



					$data['nearestplace'][] = array(



						'nearest_place_id' => $nearestplace['nearest_place_id'],



						'name' => $nearestplace['name'],



						'destinies' =>$destinies,



						'image' => $image,



					);



			}



		}



		//form edit end/////



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('text_home'),



			'href' => $this->url->link('common/home')



		);



	  



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('breadcrumbs_property'),



			'href' => $this->url->link('agent/property')



		);



	  



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('breadcrumbs_propertylist'),



			'href' => $this->url->link('agent/property/view')



		);



	  



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', true));



		if (isset($this->error['warning'])) {



			$data['error_warning'] = $this->error['warning'];



		} else {



			$data['error_warning'] = '';



		}



	  



		if (isset($this->error['attribute_group'])) {



			$data['error_attribute_group'] = $this->error['attribute_group'];



		} else {



			$data['error_attribute_group'] = '';



		}



	  



		if (isset($this->error['name'])) {



			$data['error_name'] = $this->error['name'];



		} else {



			$data['error_name'] = '';



		}



	  



		if (isset($this->error['name'])) {



			$data['error_name'] = $this->error['name'];



		} else {



			$data['error_name'] = '';



		}



		



		if (isset($this->error['meta_title'])) {



			$data['error_meta_title'] = $this->error['meta_title'];



		} else {



			$data['error_meta_title'] = '';



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

		if (isset($this->error['property_status_id'])) {
			$data['error_property_status_id'] = $this->error['property_status_id'];
		} else {
			$data['error_property_status_id'] = '';
		}


	  







		if (isset($this->request->get['property_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')){



				$property_info = $this->model_property_property->getPropertyEdit($this->request->get['property_id']);

					

		}



		$this->load->model('tool/image');



		if (isset($this->request->post['image'])) {



			$data['image'] =$this->request->post['image'];



		} elseif (!empty($property_info)){



			$data['image'] =$property_info['image'];



		} else {



			$data['image'] = '';



		}



	  



		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])){



			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);



		} elseif(!empty($property_info) && is_file(DIR_IMAGE .$property_info['image'])){



			$data['thumb'] = $this->model_tool_image->resize($property_info['image'], 100, 100);



		} else {



			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);



		}



	  	$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

	  	if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])){
			$data['thumb_image'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif(!empty($property_info) && is_file(DIR_IMAGE .$property_info['image'])){
			$data['thumb_image'] = $this->model_tool_image->resize($property_info['image'], 100, 100);
		} else {
			$data['thumb_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
	  	$data['placeholder1'] = $this->model_tool_image->resize('no_image.png', 100, 100);






		if (isset($this->request->post['Property_description'])) {



			$data['Property_description'] = $this->request->post['Property_description'];



		} elseif (isset($property_info)){



			$data['Property_description'] = $this->model_property_property->getPropertyDescription($this->request->get['property_id']);



		} else {



			$data['Property_description'] = array();



		}



	  



		if (isset($this->request->post['sort_order'])){



			$data['sort_order'] = $this->request->post['sort_order'];



		} elseif (isset($property_info['sort_order'])){



			$data['sort_order'] = $property_info['sort_order'];



		} else {



			$data['sort_order'] = '';		



		}


		if (isset($this->request->post['area_type'])){



			$data['area_type'] = $this->request->post['area_type'];



		} elseif (isset($property_info['area_type'])){



			$data['area_type'] = $property_info['area_type'];



		} else {



			$data['area_type'] = '';		



		}



	  



		if (isset($this->request->post['agent'])){



			$data['agent'] = $this->request->post['agent'];



		}elseif (isset($property_info['agent'])){



			$data['agent'] = $property_info['agent'];



		} else {



			$data['agent'] = '';		



		}



		if (isset($this->request->post['video'])){



			$data['video'] = $this->request->post['video'];



		} elseif (isset($property_info['video'])){



			$data['video'] = $property_info['video'];



		} else {



			$data['video'] = '';		



		}



		



		if (isset($this->request->post['property_agent_id'])){



			$data['property_agent_id'] = $this->request->post['property_agent_id'];



		} elseif (isset($property_info['property_agent_id'])){



			$data['property_agent_id'] = $property_info['property_agent_id'];



		} else {



			$data['property_agent_id'] = '';		



		}



		



		if (isset($this->request->post['bathrooms'])){



			$data['bathrooms'] = $this->request->post['bathrooms'];



		} elseif (isset($property_info['bathrooms'])){



			$data['bathrooms'] = $property_info['bathrooms'];



		} else {



			$data['bathrooms'] = '';		



		}







		if (isset($this->request->post['property_status_id'])){



			$data['property_status_id'] = $this->request->post['property_status_id'];



		} elseif (isset($property_info['property_status_id'])){



			$data['property_status_id'] = $property_info['property_status_id'];



		} else {



			$data['property_status_id'] = '';		



		}



		if (isset($this->request->post['city'])){



			$data['city'] = $this->request->post['city'];



		} elseif (isset($property_info['city'])){



			$data['city'] = $property_info['city'];



		} else {



			$data['city'] = '';		



		}



		



		if (isset($this->request->post['local_area'])){



			$data['local_area'] = $this->request->post['local_area'];



		}elseif (isset($property_info['local_area'])){



			$data['local_area'] = $property_info['local_area'];



		} else {



			$data['local_area'] = '';		



		}



		if (isset($this->request->post['neighborhood'])){



			$data['neighborhood'] = $this->request->post['neighborhood'];



		} elseif (isset($property_info['neighborhood'])){



			$data['neighborhood'] = $property_info['neighborhood'];



		} else {



			$data['neighborhood'] = '';		



		}



		



		if (isset($this->request->post['price'])){



			$data['price'] = $this->request->post['price'];



		} elseif (isset($property_info['price'])){



			$data['price'] = $property_info['price'];



		} else {



			$data['price'] = '';		



		}



		if (isset($this->request->post['area'])){



			$data['area'] = $this->request->post['area'];



		} elseif (isset($property_info['area'])){



			$data['area'] = $property_info['area'];



		} else {



			$data['area'] = '';		



		}

		

	

		if (isset($this->request->post['lenght'])){



			$data['lenght'] = $this->request->post['lenght'];



		} elseif (isset($property_info['lenght'])){



			$data['lenght'] = $property_info['lenght'];



		} else {



			$data['lenght'] = '';		



		}	







		if (isset($this->request->post['bedrooms'])){



			$data['bedrooms'] = $this->request->post['bedrooms'];



		} elseif (isset($property_info['bedrooms'])){



			$data['bedrooms'] = $property_info['bedrooms'];



		} else {



			$data['bedrooms'] = '';		



		}







		if (isset($this->request->post['destinies'])){



			$data['destinies'] = $this->request->post['destinies'];



		} elseif (isset($property_info['destinies'])){



			$data['destinies'] = $property_info['destinies'];



		} else {



			$data['destinies'] = '';		



		}



		if (isset($this->request->post['roomcount'])){



			$data['roomcount'] = $this->request->post['roomcount'];



		} elseif (isset($property_info['roomcount'])){



			$data['roomcount'] = $property_info['roomcount'];



		} else {



			$data['roomcount'] = '';		



		}







		if (isset($this->request->post['Parkingspaces'])){



			$data['Parkingspaces'] = $this->request->post['Parkingspaces'];



		} elseif (isset($property_info['Parkingspaces'])){



			$data['Parkingspaces'] = $property_info['Parkingspaces'];



		} else {



			$data['Parkingspaces'] = '';		



		}







		if (isset($this->request->post['builtin'])){



			$data['builtin'] = $this->request->post['builtin'];



		} elseif (isset($property_info['builtin'])){



			$data['builtin'] = $property_info['builtin'];



		} else {



			$data['builtin'] = '';		



		}



		



		if (isset($this->request->post['pincode'])){



			$data['pincode'] = $this->request->post['pincode'];



		} elseif (isset($property_info['pincode'])){



			$data['pincode'] = $property_info['pincode'];



		}else {



			$data['pincode'] = '';		



		}



		if (isset($this->request->post['latitude'])){



			$data['latitude'] = $this->request->post['latitude'];



		} elseif (isset($property_info['latitude'])){



			$data['latitude'] = $property_info['latitude'];



		} else {



			$data['latitude'] = '';		



		}



		if (isset($this->request->post['longitude'])){



			$data['longitude'] = $this->request->post['longitude'];



		} elseif (isset($property_info['longitude'])){



			$data['longitude'] = $property_info['longitude'];



		} else {



			$data['longitude'] = '';		



		}







		if (isset($this->request->post['property_status'])){



			$data['property_status'] = $this->request->post['property_status'];



		} elseif (isset($property_info['property_status'])){



			$data['property_status'] = $property_info['property_status'];



		}else {



			$data['property_status'] = '';		



		}



		if (isset($this->request->post['country_id'])){



			$data['country_id'] = $this->request->post['country_id'];



		} elseif (isset($property_info['country_id'])){



			$data['country_id'] = $property_info['country_id'];



		} else {



			$data['country_id'] = '';		



		}



		if (isset($this->request->post['zone_id'])){



			$data['zone_id'] = $this->request->post['zone_id'];



		} elseif (isset($property_info['zone_id'])){



			$data['zone_id'] = $property_info['zone_id'];



		} else {



			$data['zone_id'] = '';		



		}



		if (isset($this->request->post['pricelabel'])){



			$data['pricelabel'] = $this->request->post['pricelabel'];



		} elseif (isset($property_info['pricelabel'])){



			$data['pricelabel'] = $property_info['pricelabel'];



		}else {



			$data['pricelabel'] = '';		



		}



		if (isset($this->request->post['property_agent_id'])){



			$data['property_agent_id'] = $this->request->post['property_agent_id'];



		} elseif (isset($property_info['property_agent_id'])){



			$data['property_agent_id'] = $property_info['property_agent_id'];



		} else{



			$data['property_agent_id'] = '';		



		}




		// Custom Fields
		$this->load->model('customer/custom_field');

		$data['custom_fields'] = $this->model_customer_custom_field->getCustomFields($this->config->get('config_customer_group_id'));
		
		if (isset($this->request->post['custom_field'])) {
			$data['account_custom_field'] = $this->request->post['custom_field'];
		} elseif (isset($property_info)) {
			$data['account_custom_field'] = json_decode($property_info['custom_field'], true);
		} else {
			$data['account_custom_field'] = array();
		}
  		

		if (isset($this->request->post['images_tab'])) {

			$image_tabs = $this->request->post['images_tab'];

		} elseif (isset($this->request->get['property_id'])) {

			$image_tabs = $this->model_property_property->getPropertyImages($this->request->get['property_id']);

		} else {

			$image_tabs = array();

		}



		$this->load->model('tool/image');



		$data['image_tabs'] = array();



		if (isset($image_tabs)) {

			foreach ($image_tabs as $image_tab) {

				

				//DIR_IMAGE . $image_tab['image'];

				if (!empty('upload/' . $image_tab['image'])){

					$image = $image_tab['image'];

					$prothumb = $image_tab['image'];

				} else	{

					$image = '';

					$prothumb = 'no_image.png';

				}

				

				$data['image_tabs'][] = array(

					'image'      => $image,

					'prothumb'      => $this->model_tool_image->resize($prothumb, 105, 105),

					'property_images_id' => $image_tab['property_images_id'],

				);

			}

		}



		/// name this is input 	  



		if(!empty($data['property_agent_id'])){	



			$this->load->model('agent/agent');



			$agent_info=$this->model_agent_agent->getAgent($data['property_agent_id']);



			$data['agent']=$agent_info['agentname'];



		}else{



			$data['agent']='';



		}



		if (isset($this->request->post['property_status_id'])) {



			$data['property_status_id'] = $this->request->post['property_status_id'];



		}elseif (isset($property_info['property_status_id'])){



			$data['property_status_id'] = $property_info['property_status_id'];



		}else{



			$data['property_status_id'] = '';		



		}



		if(!empty($data['property_status_id'])){	



			$this->load->model('property/property_status');



			$propertstatus_info=$this->model_property_property_status->getOrderStatus($data['property_status_id']);



			$data['property_status']=$propertstatus_info['name'];



		}else{



			$data['property_status']='';



		}



		///getpropertycategoryid multiple id show///



		///



		if (isset($this->request->post['category_id'])){



			$category_ids = $this->request->post['category_id'];



		}elseif (!empty($property_info)){



			$category_ids = $this->model_property_property->getpropertycategoryid($this->request->get['property_id']);



		}else{



			$category_ids = '';



		}



		



		/// name this is input 



		$data['categories']=array();



		$this->load->model('catalog/category');



		if(!empty($category_ids)){



			foreach($category_ids as $category_id){



				$category_info=$this->model_catalog_category->getCategory($category_id);



				///subcategory//


			if(!empty($category_info['path'])){

					$category=$category_info['path'].' > '.$category_info['name'];

				} elseif(empty($category_info['path']) && empty($category_info['name'])) {

					$category='';

				}
				else{
					$category=$category_info['name'];

				}




				///subcategory//



				$data['categories'][]=array(



					'category_id'=>$category_id,



					'name'=>$category,



				);



			}



		}



		if (isset($this->request->post['features'])){



			$data['features'] = $this->request->post['features'];



		}elseif (isset($this->request->get['property_id'])){



			$data['features'] = $property_info = $this->model_property_feature->getFeature($this->request->get['property_id']);



		}else{



			$data['features'] =array();		



		}



		if (isset($this->request->post['feature_id'])) {



			$data['feature_id'] = $this->request->post['feature_id'];



		}elseif (isset($property_info['feature_id'])){



			$data['feature_id'] = $property_info['feature_id'];



		}else{



			$data['feature_id'] = '';		



		}


         
         ///area type start
		$data['areatypes'] = $this->model_property_property->getpropertyunits(0);

         ///area type  end 



		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');

		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');


		$data['column_left'] 	= $this->load->controller('common/column_left');



		$data['column_right'] 	= $this->load->controller('common/column_right');



		$data['content_top'] 	= $this->load->controller('common/content_top');



		$data['content_bottom'] = $this->load->controller('common/content_bottom');



		$data['footer'] 		= $this->load->controller('common/footer');



		$data['header'] 		= $this->load->controller('common/header');



		$this->response->setOutput($this->load->view('agent/property', $data));



	}



	



	



	public function view(){



		if (!$this->agent->isLogged()) {



			$this->response->redirect($this->url->link('agent/login', '', true));



		}



		$this->load->model('property/property');



		$this->load->language('agent/property');



		



		if (isset($this->request->get['filter_name'])){



			$filter_name = $this->request->get['filter_name'];



		}else{



			$filter_name = false;



		}



		if (isset($this->request->get['filter_propertystatus'])){



			$filter_propertystatus = $this->request->get['filter_propertystatus'];



		}else{



			$filter_propertystatus = false;



		}



		if (!empty($this->request->get['filter_price_from'])){



			$filter_price_from = $this->request->get['filter_price_from'];} 



			else{$filter_price_from = false;



		}



		



		if (!empty($this->request->get['filter_price_to'])){



			$filter_price_to = $this->request->get['filter_price_to'];



		} else {



			$filter_price_to = false;



		}



			



		if (isset($this->request->get['filter_status'])) {



			$filter_status = $this->request->get['filter_status'];



		} else {



			$filter_status = null;



		}   



		



		



		if (isset($this->request->get['sort'])){



			$sort = $this->request->get['sort'];} 



			else{$sort = 'pd.name';



		}



		if (isset($this->request->get['order'])) {



			$order = $this->request->get['order'];



		} else {



			$order = 'ASC';



		}



		if (isset($this->request->get['page'])){



			$page = $this->request->get['page'];



		} else {



			$page = 1;



		}



		



		if (isset($this->request->get['limit'])) {



			$limit = (int)$this->request->get['limit'];



		} else {



			$limit = $this->config->get($this->config->get('config_theme').'_product_limit');



		}



		



		$url = '';



		if (isset($this->request->get['filter_name'])) {



			$url .= '&filter_name=' . $this->request->get['filter_name'];



		}



		if (isset($this->request->get['filter_propertystatus'])){



			$url .= '&filter_propertystatus=' .$this->request->get['filter_propertystatus'];



		}



		if (isset($this->request->get['filter_status'])){



			$url .= '&filter_status=' .$this->request->get['filter_status'];



		}



		if (isset($this->request->get['filter_price_from'])){



			$url .= '&filter_price_from=' .$this->request->get['filter_price_from'];



		}



		if (isset($this->request->get['limit'])) {



		 $url .= '&limit=' . $this->request->get['limit'];



		}



		



		if (isset($this->request->get['filter_price_to'])){



			$url .= '&filter_price_to=' .$this->request->get['filter_price_to'];



		}



		$url = '';



		if (isset($this->request->get['sort'])){



			$url .= '&sort=' . $this->request->get['sort'];



		}



		if (isset($this->request->get['order'])){



			$url .= '&order='.$this->request->get['order'];



		}



		if (isset($this->request->get['page'])){



			$url .= '&page='.$this->request->get['page'];



		}
		$this->document->setTitle($this->language->get('heading_list'));

		$data['heading_list']  						= $this->language->get('heading_list');
		$data['text_none']  			 			= $this->language->get('text_none');
		$data['text_form']      					= $this->language->get('text_form');
        $data['text_list']      					= $this->language->get('text_list');
		$data['text_no_results']      				= $this->language->get('text_no_results');
		$data['text_upload']      					= $this->language->get('text_upload');
		
		
      // agent Property listing 
		$data['column_status']  					= $this->language->get('column_status');
		$data['column_price_from']  				= $this->language->get('column_price_from');
		$data['column_property_status']  	 		= $this->language->get('column_property_status');
		$data['column_action']  					= $this->language->get('column_action');
		$data['column_image']   					= $this->language->get('column_image');
		$data['column_name']					 	= $this->language->get('column_name');
		$data['column_price']       				= $this->language->get('column_price');
		$data['text_select']      			 		= $this->language->get('text_select');
		$data['text_enable']      			 		= $this->language->get('text_enable');
		$data['text_disable']      			 		= $this->language->get('text_disable');
		$data['text_pricefrom']      			 		= $this->language->get('text_pricefrom');
		$data['text_pricerange']      			 		= $this->language->get('text_pricerange');
		$data['message_confirm']       		 	 	= $this->language->get('message_confirm');

        ///button start
		$data['button_filter'] 	                    = $this->language->get('button_filter');
        $data['button_approve'] 					= $this->language->get('button_approve');
        $data['button_add']         				= $this->language->get('button_add');
        $data['button_cancle']     			 		= $this->language->get('button_cancle');
		$data['button_delete']      				= $this->language->get('button_delete');
		$data['button_edit']        				= $this->language->get('button_edit');
		$data['button_view']        				= $this->language->get('button_view');

		///filter search 
		$data['filter_price_range'] = $this->language->get('filter_price_range');
		$data['filter_price_from']  = $this->language->get('filter_price_from');
		$data['filter_enable']      = $this->language->get('filter_enable');
		$data['filter_disable']     = $this->language->get('filter_disable');
		$data['filter_name']        = $this->language->get('filter_name');
		$data['filter_select']      = $this->language->get('filter_select');
		$data['filter_status']      = $this->language->get('filter_status');




		$data['button_filter'] 	                    = $this->language->get('button_filter');



		if (isset($this->request->post['selected'])){



			$data['selected'] = (array) $this->request->post['selected'];



		}else{



			$data['selected'] = array();



		}



		$data['breadcrumbs'] = array();



		$url = '';



		$data['breadcrumbs'] = array();



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('text_home'),



			'href' => $this->url->link('common/dashboard')



		);



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('heading_title'),



			'href' => $this->url->link('agent/property')



		);



		////////select for list///////



		$data['results'] = '';



		if (isset($this->error['warning'])){



			$data['error_warning'] = $this->error['warning'];



		}else{



			$data['error_warning'] = '';



		}



		if (isset($this->session->data['success'])){



			$data['success'] = $this->session->data['success'];



			unset($this->session->data['success']);



		} else{



			$data['success'] = '';



		}



		if (isset($this->request->post['selected'])){



			$data['selected'] = (array) $this->request->post['selected'];



		} else{



			$data['selected'] = array();



		}







		///list/////



		$data['property']=array();



		$filter_data = array(



		'agent_id'			    => $this->agent->getId(),



		'filter_name' 			=> $filter_name,



		'filter_price_from' 	=> $filter_price_from,



		'filter_price_to' 		=> $filter_price_to,



		'filter_propertystatus'	=> $filter_propertystatus,



		'filter_status' 		=> $filter_status,



		'sort'  				=> $sort,



		'order' 				=> $order,



		'start'              	=> ($page - 1) * $limit,



	   	'limit'             	=> $limit



		);	



		$this->load->model('tool/image');



		$this->load->model('property/property_status');



		$this->load->model('property/property');



		$propert_total = $this->model_property_property->getTotalProperty($filter_data);



		//print_r($propert_total);die();



		$results=$this->model_property_property->getPropertyViews($filter_data);



		



		//print_r($results);die();



		foreach($results as $result){



			



			if ($result['status']){

				$status = $this->language->get('filter_enable');

			} else{
				$status = $this->language->get('filter_disable');



			}



			if (is_file(DIR_IMAGE . $result['image'])){



				$image = $this->model_tool_image->resize($result['image'], 50, 50);



			} 



			else{



				$image = $this->model_tool_image->resize('no_image.png', 50, 50);



			}



			$propertstatus_info=$this->model_property_property_status->getOrderStatus($result['property_status_id']);



			if(isset($propertstatus_info['name'])){



				$property_status=$propertstatus_info['name'];         



			} else {



				$property_status='';



			}



			$data['property'][]=array(



				'property_id'=>$result['property_id'],



				'name'=>$result['propetyname'],



				'property_status' =>$property_status,



				'image' => $image,



				'price'=>$result['price'],



		



				'status'=>$status,



				'hreffull'=> $this->url->link('property/property_detail','&property_id=' .$result['property_id']),



				'edit'=> $this->url->link('agent/property/edit','&property_id=' .$result['property_id'])



			);







		}	



		$pagination = new Pagination();



		$pagination->total = $propert_total;



		$pagination->page = $page;



		$pagination->limit = $limit;



		$pagination->url = $this->url->link('agent/property/view', '&page={page}');



		$data['pagination'] = $pagination->render();



		$data['results'] = sprintf($this->language->get('text_pagination'), ($propert_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($propert_total - $limit)) ? $propert_total : ((($page - 1) * $limit) + $limit), $propert_total, ceil($propert_total / $limit));







		$data['add']    = $this->url->link('agent/property');



		$data['delete'] = $this->url->link('agent/property/delete');



		$data['cancel'] = $this->url->link('agent/property/view');



		//action button



		if ($order == 'ASC'){



			$url .= '&order=DESC';



		} else {



			$url .= '&order=ASC';



		}



		if (isset($this->request->get['page'])){



			$url .= '&page=' . $this->request->get['page'];



		}


		

		$data['sort_name']  		= $this->url->link('agent/property/view','&sort=name'.$url , true);



		$data['sort_propertystatus']= $this->url->link('agent/property/view','&sort=property_status_id'.$url , true);



		$data['sort_price']  		= $this->url->link('agent/property/view','&sort=price'.$url , true);



		$data['sort_status']  		= $this->url->link('agent/property/view','&sort=status'.$url , true);


		$data['filter_name']		= $filter_name;
		$data['filter_price_from']	= $filter_price_from;
		$data['filter_price_to']	= $filter_price_to;
		$data['filter_propertystatus'] =$filter_propertystatus;
		$data['filter_status'] =$filter_status;
		

		$data['sort'] = $sort;



		$data['order'] = $order;
	if(isset($data['filter_propertystatus'])) {
			$status_info = $this->model_property_property->getPropertyStatus($data['filter_propertystatus']);
		}

		if(isset($status_info['name'])) {
			$data['statusname'] = $status_info['name'];
		} else {
			$data['statusname'] ='';
		}


		



		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');



		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');



		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');



		 $this->load->model('customer/custom_field');
        $data['custom_fields']= $this->model_customer_custom_field->getCustomFields(array());



		$data['column_left'] 	= $this->load->controller('common/column_left');



		$data['column_right'] 	= $this->load->controller('common/column_right');



		$data['content_top'] 	= $this->load->controller('common/content_top');



		$data['content_bottom'] = $this->load->controller('common/content_bottom');



		$data['footer'] 		= $this->load->controller('common/footer');



		$data['header'] 		= $this->load->controller('common/header');



		$this->response->setOutput($this->load->view('agent/property_list', $data));



	}



	



	



	public function delete(){



		$this->load->language('agent/property');



		$this->load->model('property/property');



		if (isset($this->request->post['selected'])) {



			foreach ($this->request->post['selected'] as $property_id){



				$this->model_property_property->deleteProperty($property_id);



			}



			$this->session->data['success'] = $this->language->get('text_successdelete');



			$this->response->redirect($this->url->link('agent/property/view'));



		}



		$this->view();



	}







	public function edit(){

		$this->load->language('agent/property');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('property/property');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
 
		 $this->model_property_property->editProperty($this->request->get['property_id'],$this->request->post);
			$this->session->data['success'] = $this->language->get('text_successedit');



			$url = '';



			if (isset($this->request->get['sort'])) {



				$url .= '&sort=' . $this->request->get['sort'];



			}



			if (isset($this->request->get['order'])) {



				$url .= '&order=' . $this->request->get['order'];



			}



			if (isset($this->request->get['page'])) {



				$url .= '&page=' . $this->request->get['page'];



			}



			$this->response->redirect($this->url->link('agent/property/view'));



		}



		$this->index();



	}



	public function validateForm(){



		foreach ($this->request->post['Property_description'] as $language_id => $value) {



			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 64)){



				$this->error['name'][$language_id] = $this->language->get('error_name');



			}





			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 64)){



				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');



			}



			if ((utf8_strlen($value['meta_description']) < 3) || (utf8_strlen($value['meta_title']) > 64)){



				$this->error['meta_description'][$language_id] = $this->language->get('error_meta_description');



			}



		}


		if (empty($this->request->post['property_status_id'])) {
			
			$this->error['property_status_id'] = $this->language->get('error_status');
		}


		if ($this->request->post['country_id'] == '') {



			$this->error['country'] = $this->language->get('error_country');



		}

		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {


			$this->error['zone'] = $this->language->get('error_zone');


		}

		if ($this->error && !isset($this->error['warning'])) {
		$this->error['warning'] = $this->language->get('error_warning');
		}


		return !$this->error;



	}



   



	public function upload(){



		$this->load->language('tool/upload');



		$json = array();



		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {



			// Sanitize the filename



			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));



			// Validate the filename length



			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {



				$json['error'] = $this->language->get('error_filename');



			}



			// Allowed file extension types



			$allowed = array();



			$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));



			$filetypes = explode("\n", $extension_allowed);



			foreach ($filetypes as $filetype) {



				$allowed[] = trim($filetype);



			}



			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {



				$json['error'] = $this->language->get('error_filetype');



			}



			// Allowed file mime types



			$allowed = array();



			$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));



			$filetypes = explode("\n", $mime_allowed);



			foreach ($filetypes as $filetype) {



				$allowed[] = trim($filetype);



			}



			if (!in_array($this->request->files['file']['type'], $allowed)) {



				$json['error'] = $this->language->get('error_filetype');







			}



			// Check to see if any PHP files are trying to be uploaded



			$content = file_get_contents($this->request->files['file']['tmp_name']);



			if (preg_match('/\<\?php/i', $content)) {



				$json['error'] = $this->language->get('error_filetype');



			}



			// Return any upload error



			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {



				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);



			}



		} else {



			$json['error'] = $this->language->get('error_upload');



		}



		if (!$json) {



			$targetDir = DIR_IMAGE.'catalog/';



			$file = $filename;



			$location = $targetDir.$file;



			$location1 = 'catalog/'.$file;



			move_uploaded_file($this->request->files['file']['tmp_name'], $location);



			$json['location1'] =$location1;



			$json['success'] = $this->language->get('text_upload');



		}



			$this->response->addHeader('Content-Type: application/json');



			$this->response->setOutput(json_encode($json));



		} 





	public function propertyupload(){



		$this->load->language('tool/upload');



		$json = array();



		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {



			// Sanitize the filename



			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));



			// Validate the filename length



			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {



				$json['error'] = $this->language->get('error_filename');



			}



			// Allowed file extension types



			$allowed = array();



			$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));



			$filetypes = explode("\n", $extension_allowed);



			foreach ($filetypes as $filetype) {



				$allowed[] = trim($filetype);



			}



			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {



				$json['error'] = $this->language->get('error_filetype');



			}



			// Allowed file mime types



			$allowed = array();



			$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));



			$filetypes = explode("\n", $mime_allowed);



			foreach ($filetypes as $filetype) {



				$allowed[] = trim($filetype);



			}



			if (!in_array($this->request->files['file']['type'], $allowed)) {



				$json['error'] = $this->language->get('error_filetype');







			}



			// Check to see if any PHP files are trying to be uploaded



			$content = file_get_contents($this->request->files['file']['tmp_name']);



			if (preg_match('/\<\?php/i', $content)) {



				$json['error'] = $this->language->get('error_filetype');



			}



			// Return any upload error



			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {



				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);



			}



		} else {



			$json['error'] = $this->language->get('error_upload');



		}



		if (!$json) {



			$targetDir = DIR_IMAGE.'catalog/';



			$file = $filename;



			$location = $targetDir.$file;



			$location1 = 'catalog/'.$file;



			move_uploaded_file($this->request->files['file']['tmp_name'], $location);



			$json['location1'] =$location1;



			$json['success'] = $this->language->get('text_upload');



		}



			$this->response->addHeader('Content-Type: application/json');



			$this->response->setOutput(json_encode($json));



		} 



	



	public function getmapproperty(){



			$json[]=array();



			if (($this->request->server['REQUEST_METHOD'] == 'POST')) {



				// Country 



				$this->load->model('localisation/country');



				$country='';



				if(isset($this->request->post['country_id'])){



					$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);



					$country=$country_info['name'];



				}



				



				// Zone



				$this->load->model('localisation/zone');



				$zone='';



				if(isset($this->request->post['zone_id'])){



					$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);



					$zone=$zone_info['name'];



				}



				$city='';



				if(isset($this->request->post['city'])){
					$city=$this->request->post['city'];
				}



				$local_area='';

			   if(isset($this->request->post['local_area'])){
			   	$local_area=$this->request->post['local_area'];

				}



				$pincode='';

				if(isset($this->request->post['pincode'])){
					$pincode=$this->request->post['pincode'];
				}


				$address=$country .' '. $zone .' '. $city .' '. $local_area .' '. $pincode;

				 $address = str_replace(" ", "+", $address);



				 $key=$this->config->get('config_mapkey');

				 $url = "https://maps.google.com/maps/api/geocode/json?key=$key&address=$address";



				 $response = file_get_contents($url);


				 $json1 = json_decode($response,TRUE); //generate array object from the response from the web

				if(isset($json1['results'][0]['geometry']['location']['lat'])){
					$json['lat']=$json1['results'][0]['geometry']['location']['lat'];
					$json['lng']=$json1['results'][0]['geometry']['location']['lng'];
					$json['success']='Address Found';

				}else{

			     $json['error']='Address Not Found';



				}



			}	



			$this->response->addHeader('Content-Type: application/json');



			$this->response->setOutput(json_encode($json));



	



	}



	



	public function deleteimg() {



		$json=array();



		$this->load->model('property/property');	



		$this->model_property_property->deleteimage($this->request->post['property_images_id']);



		$json['success']='Your Image removed successfully!';



		$this->response->setOutput(json_encode($json));



	}



	



	public function autocomplete(){



	if (isset($this->request->get['filter_name'])){



		if (isset($this->request->get['sort'])) 



		{



			$sort = $this->request->get['sort'];



		} 



		else



		{



			$sort = 'name';



		}







		if (isset($this->request->get['order'])) 



		{



			$order = $this->request->get['order'];



		} 



		else



		{



			$order = 'ASC';



		}







		if (isset($this->request->get['page'])) 



		{



			$page = $this->request->get['page'];



		} 



		else 



		{



		$page = 1;



		}



		$this->load->model('property/property_status');



		$filter_data = array(



		'filter_name'=> $this->request->get['filter_name'],



		'order' => $order,



		'sort' => $sort,



		'start' => ($page - 1) * $this->config->get('config_limit_admin'),



		'limit' => $this->config->get('config_limit_admin')



		);



		$results = $this->model_property_property_status->getpropertystatusouto($filter_data);



		foreach ($results as $result) {



		$json[] = array(



		'property_status_id' => $result['property_status_id'],



		'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))



		);



		}



	}



		$sort_order = array();



		foreach ($json as $key => $value) 



		{



			$sort_order[$key] = $value['name'];



		}



		array_multisort($sort_order, SORT_ASC, $json);



		$this->response->addHeader('Content-Type: application/json');



		$this->response->setOutput(json_encode($json));



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

	public function uploadfile(){
		$this->load->language('agent/property');
		$json = array();
		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
				$json['error'] = $this->language->get('error_filename');
			}
			// Allowed file extension types
			$allowed = array();
			$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));
			$filetypes = explode("\n", $extension_allowed);
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}
			// Allowed file mime types
			$allowed = array();
			$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));
			$filetypes = explode("\n", $mime_allowed);
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			if (!in_array($this->request->files['file']['type'], $allowed)) {
				$json['error'] = $this->language->get('error_filetype');

			}
			// Check to see if any PHP files are trying to be uploaded
			$content = file_get_contents($this->request->files['file']['tmp_name']);
			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_filetype');
			}
			// Return any upload error
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}
		if (!$json) {
			$targetDir = DIR_IMAGE.'catalog/';
			$file = $filename;
			$location = $targetDir.$file;
			$location1 = 'catalog/'.$file;
			move_uploaded_file($this->request->files['file']['tmp_name'], $location);
			$json['location1'] =$location1;
			$json['success'] = $this->language->get('text_upload');
		}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
	}


}