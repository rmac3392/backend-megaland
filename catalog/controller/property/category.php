<?php
 class Controllerpropertycategory extends Controller {
	    public function index() {
		$this->load->language('property/category');
		$this->load->model('property/category');
		$this->load->model('tool/image');
		if (isset($this->request->get['filter'])) {



			$filter = $this->request->get['filter'];



		} else {



			$filter = false;



		}

		if (isset($this->request->get['filter_propertystatus'])){



			$filter_propertystatus = $this->request->get['filter_propertystatus'];



		}else{



			$filter_propertystatus = false;



		}



		



		if (isset($this->request->get['property_agent_id'])){



			$property_agent_id = $this->request->get['property_agent_id'];



		}else{



			$property_agent_id = false;



		}
	



		if (isset($this->request->get['filter_propertycategory'])){
			$filter_propertycategory = $this->request->get['filter_propertycategory'];
		}else{

        	$filter_propertycategory = false;



		}



		



		if (isset($this->request->get['filter_city'])){



			$filter_city = $this->request->get['filter_city'];



		}else{



			$filter_city = false;



		}



		



		if (isset($this->request->get['filter_address'])){



			$filter_address = $this->request->get['filter_address'];



		}else{



			$filter_address = false;



		}



		



		



		if (isset($this->request->get['filter_neighborhood'])){



			$filter_neighborhood = $this->request->get['filter_neighborhood'];



		}else{



			$filter_neighborhood = false;



		}



		



		if (isset($this->request->get['filter_bed_rooms'])){



			$filter_bed_rooms = $this->request->get['filter_bed_rooms'];



		}else{



			$filter_bed_rooms= false;



		}



		



		if (isset($this->request->get['filter_bath_rooms'])){



			$filter_bath_rooms = $this->request->get['filter_bath_rooms'];



		}else{



			$filter_bath_rooms= false;



		}



		



		if (isset($this->request->get['filter_zipcode'])) {



			$filter_zipcode = $this->request->get['filter_zipcode'];



		} else {



			$filter_zipcode = false;



		}



		



		if (isset($this->request->get['filter_country_id'])) {



			$filter_country_id = $this->request->get['filter_country_id'];



		} else {



			$filter_country_id = false;



		}



		



		if (isset($this->request->get['filter_zone_id'])) {



			$filter_zone_id = $this->request->get['filter_zone_id'];



		} else {



			$filter_zone_id = false;



		}



		



		if (isset($this->request->get['filter_nearest'])) {



			$filter_nearest = $this->request->get['filter_nearest'];



		} else {



			$filter_nearest= false;



		}


		if (isset($this->request->get['filter_features'])) {
			$filter_features = $this->request->get['filter_features'];
		} else {
			$filter_features = false;
		}



		if(isset($this->request->get['filter_area'])) {
		list($area_from,$area_to)=explode(';',$this->request->get['filter_area']);
		$data['area_from'] =$area_from;
		$data['area_to'] =$area_to;
		} else {

		$data['area_from'] ='0';
		$data['area_to'] ='10';
		$area_from='';
		$area_to='';
		}


		
		if(isset($this->request->get['filter_range'])) {

		list($range_from,$range_to)=explode(';',$this->request->get['filter_range']);

		$data['range_from'] =$range_from;
		$data['range_to'] =$range_to;
		} else {
		$data['range_from'] ='0';
		$data['range_to'] ='10';
		$range_from='';
		$range_to='';
		
		}

		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ppd.name';
		}


		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}


		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}


		if (isset($this->request->get['limit'])) {

			$limit = (int)$this->request->get['limit'];


		} else {

			$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');

		}



		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')



		);



			if(!empty($filter_propertycategory))


			{

			$category_info = $this->model_property_category->getCategory($filter_propertycategory);

			if($category_info) {

				$this->document->setTitle($category_info['meta_title']);

				$this->document->setDescription($category_info['meta_description']);

				$this->document->setKeywords($category_info['meta_keyword']);
				$data['heading_title1'] = $category_info['name'];

				}


			}

			else


			{


				$this->document->setTitle($this->language->get('heading_title1'));
				$data['heading_title1'] = $this->language->get('heading_title1');


			}

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');
			 $data['text_tax'] = $this->language->get('text_tax');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');
			$data['text_details'] = $this->language->get('text_details');
			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');
			$data['text_details'] = $this->language->get('text_details');
			$data['text_rent'] = $this->language->get('text_rent');
			$data['text_price'] = $this->language->get('text_price');
			$data['text_sqft'] = $this->language->get('text_sqft');
			$data['text_none'] = $this->language->get('text_none');
			$data['text_amenities'] = $this->language->get('text_amenities');
			$data['text_NearestPlace'] = $this->language->get('text_NearestPlace');
			$data['text_apartment'] = $this->language->get('text_apartment');
			$data['text_4Daysago'] = $this->language->get('text_4Daysago');
			$data['text_bedrooms'] = $this->language->get('text_bedrooms');
			$data['text_bathrooms'] = $this->language->get('text_bathrooms');
			$data['text_garge'] = $this->language->get('text_garge');
			$data['text_nearest'] = $this->language->get('text_nearest');

			$url = '';


			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}


			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}


			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}


			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}


			if (isset($this->request->get['filter_propertystatus'])) {
				$url .= '&filter_propertystatus=' . $this->request->get['filter_propertystatus'];
			}

			if (isset($this->request->get['filter_area'])) {
				$url .= '&filter_area=' . $this->request->get['filter_area'];
			}

			if (isset($this->request->get['filter_range'])) {
				$url .= '&filter_range=' . $this->request->get['filter_range'];
			}



			if (isset($this->request->get['filter_propertycategory'])) {
				$url .= '&filter_propertycategory=' . $this->request->get['filter_propertycategory'];
			}


			if (isset($this->request->get['filter_city'])) {
				$url .= '&filter_city=' . $this->request->get['filter_city'];
			}

			if (isset($this->request->get['filter_address'])) {
				$url .= '&filter_address=' . $this->request->get['filter_address'];
			}

			if (isset($this->request->get['filter_neighborhood'])) {
				$url .= '&filter_neighborhood=' . $this->request->get['filter_neighborhood'];
			}


			if (isset($this->request->get['filter_country_id'])) {
				$url .= '&filter_country_id=' . $this->request->get['filter_country_id'];
			}

			if (isset($this->request->get['filter_zone_id'])) {
				$url .= '&filter_zone_id=' . $this->request->get['filter_zone_id'];
			}

			if (isset($this->request->get['filter_bed_rooms'])) {
				$url .= '&filter_bed_rooms=' . $this->request->get['filter_bed_rooms'];
			}


			if (isset($this->request->get['filter_bath_rooms'])) {
				$url .= '&filter_bath_rooms=' . $this->request->get['filter_bath_rooms'];
			}


			if (isset($this->request->get['property_agent_id'])) {
				$url .= '&property_agent_id=' . $this->request->get['property_agent_id'];
			}

			if (isset($this->request->get['filter_nearest'])) {
				$url .= '&filter_nearest=' . $this->request->get['filter_nearest'];
			}


			if (isset($this->request->get['filter_zipcode'])) {
				$url .= '&filter_zipcode=' . $this->request->get['filter_zipcode'];
			}


			$this->load->model('property/property');

			$this->load->model('tool/image');

			$this->load->model('property/property_status');

			$data['propertys'] = array();
		

		$filter_data = array(

			'filter_propertystatus'    	    => $filter_propertystatus,
			'filter_propertycategory'       => $filter_propertycategory,
			'filter_city'        			=> $filter_city, 
			'filter_address'        		=> $filter_address, 
			'filter_neighborhood'       	=> $filter_neighborhood,
			'filter_zipcode'             	=> $filter_zipcode,
			'filter_country_id'           	=> $filter_country_id,
			'filter_zone_id'          	 	=> $filter_zone_id,
			'filter_bed_rooms'           	=> $filter_bed_rooms,
			'filter_bath_rooms'           	=> $filter_bath_rooms,
			'area_from'	           			=> $area_from,
			'area_to'	           			=> $area_to,
			'range_from'	           			=> $range_from,
			'range_to'	           			=> $range_to,
			'agent_id'          		 	=> $property_agent_id,
			'sort'              			=> $sort,
			'order'             		 	=> $order,
			'start'             		 	=> ($page - 1) * $limit,
			'limit'             		 	=> $limit

		);


		$property_total=$this->model_property_property->getTotalProperty($filter_data);

		$propertys=$this->model_property_property->getPropertys($filter_data);

       foreach($propertys as $property){

		  $rent=$this->model_property_property_status->getOrderStatus($property['property_status_id']);

			if(isset($rent['name'])){

			$propertyrent=$rent['name'];         

			}else{

			$propertyrent='';

			}	



			if ($property['image']) {
				$image = $this->model_tool_image->resize($property['image'], 

			$this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));

			} else {

				$image = $this->model_tool_image->resize('placeholder.png',  


				$this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));



			}	



		   



		   $category='';

			$category_ids=$this->model_property_property->getpropertytocategory($property['property_id']);


			if(isset($category_ids)){

				foreach($category_ids as $category_id){

					$category_info=$this->model_property_category->getCategory($category_id);

					if(isset($category_info['name'])){

						$category .=$category_info['name'];         

					}


				}



			}



			$features_info=$this->model_property_property->getproperfeature($property['property_id']);

			$features=array();


			 foreach($features_info as $info){

				 if ($info['image']) {

					$features[]= $this->model_tool_image->resize($info['image'],30,30);



				}



			}



			$nearestplace_info=$this->model_property_property->getNeareastplace($property['property_id']);
			 //print_r($nearestplace_info);die();

	    	$nearestplaces=array();
				foreach($nearestplace_info as $neares){
				if ($neares['image']) {

						$nearestplaces[] = $this->model_tool_image->resize($neares['image'],30,30);

				   } 

				}		



				$rent=$this->model_property_property_status->getOrderStatus($property['property_status_id']);



				if(isset($rent['name'])){



				$propertyrent=$rent['name'];         



				}else{



					$propertyrent='';



				}	

			if(!empty($property['area_type'])){
			$area_typ = $property['area_type'];
			}else{
			$area_typ='';
			}

			$data['propertys'][] = array(



				'property_id'  => $property['property_id'],


				'name'  => $property['propetyname'],


				'thumb'  => $image,


				'propertyrent'  => $propertyrent,


				'category'  => $category,



				'features'  => $features,



				'nearestplaces'  =>$nearestplaces,



				'price'  => $this->currency->format($property['price'],$this->config->get('config_currency')),



				'area'          => $property['area'],
				'area_type'     => $area_typ,
				
				'neighborhood'  => $property['neighborhood'],



				'bedrooms'  => $property['bedrooms'],



				'bathrooms'  => $property['bathrooms'],



				'local_area'  => $property['local_area'],



				'date_added'   => $this->timeAgo($property['date_added']),



				'href'        => $this->url->link('property/property_detail', '&property_id=' . $property['property_id'] . $url)



			);



	   }



		



	



			$pagination = new Pagination();

			$pagination->total = $property_total;

			$pagination->page = $page;

			$pagination->limit = $limit;

			$pagination->url = $this->url->link('property/category',$url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($property_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($property_total - $limit)) ? $property_total : ((($page - 1) * $limit) + $limit), $property_total, ceil($property_total / $limit));



			if ($page == 1) {


			    $this->document->addLink($this->url->link('property/category',  true), 'canonical');



			} elseif ($page == 2) {



			    $this->document->addLink($this->url->link('property/category',  true), 'prev');



			} else {



			    $this->document->addLink($this->url->link('property/category',  '&page='. ($page - 1), true), 'prev');



			}







			if ($limit && ceil($property_total / $limit) > $page) {



			    $this->document->addLink($this->url->link('property/category',  '&page='. ($page + 1), true), 'next');



			}


			$data['sort'] 					= $sort;

			$data['order'] 					= $order;

			$data['filter_propertystatus'] 	= $filter_propertystatus;

			$data['filter_city']			= $filter_city;

			$data['filter_neighborhood'] 	= $filter_neighborhood;

			$data['filter_zipcode'] 		= $filter_zipcode;

			$data['filter_propertycategory']= $filter_propertycategory;

			$data['filter_country_id'] 		= $filter_country_id;

			$data['filter_zone_id'] 		= $filter_zone_id;

			$data['filter_bed_rooms'] 		= $filter_bed_rooms;

			$data['filter_bath_rooms'] 		= $filter_bath_rooms;

			$data['filter_features'] 		= $filter_features;

			$data['filter_nearest'] 		= $filter_nearest;

			$data['limit'] = $limit;



	
			$data['sorts'][] = array(



				'text'  => $this->language->get('text_default'),



				'value' => 'p.sort_order-ASC',



				'href'  => $this->url->link('property/category',  '&sort=p.sort_order&order=ASC' . $url)



			);







			$data['sorts'][] = array(



				'text'  => $this->language->get('text_name_asc'),



				'value' => 'pd.name-ASC',



				'href'  => $this->url->link('property/category',  '&sort=pd.name&order=ASC' . $url)



			);







			$data['sorts'][] = array(



				'text'  => $this->language->get('text_name_desc'),



				'value' => 'pd.name-DESC',



				'href'  => $this->url->link('property/category',  '&sort=pd.name&order=DESC' . $url)



			);







			$data['sorts'][] = array(



				'text'  => $this->language->get('text_price_asc'),



				'value' => 'p.price-ASC',



				'href'  => $this->url->link('property/property',  '&sort=p.price&order=ASC' . $url)



			);







			$data['sorts'][] = array(



				'text'  => $this->language->get('text_price_desc'),



				'value' => 'p.price-DESC',



				'href'  => $this->url->link('property/category',  '&sort=p.price&order=DESC' . $url)



			);







			if ($this->config->get('config_review_status')) {



				$data['sorts'][] = array(



					'text'  => $this->language->get('text_rating_desc'),



					'value' => 'rating-DESC',



					'href'  => $this->url->link('property/category',  '&sort=rating&order=DESC' . $url)



				);







				$data['sorts'][] = array(



					'text'  => $this->language->get('text_rating_asc'),



					'value' => 'rating-ASC',



					'href'  => $this->url->link('property/category',  '&sort=rating&order=ASC' . $url)



				);



			}







			$data['sorts'][] = array(



				'text'  => $this->language->get('text_model_asc'),



				'value' => 'p.model-ASC',



				'href'  => $this->url->link('property/category',  '&sort=p.model&order=ASC' . $url)



			);







			$data['sorts'][] = array(



				'text'  => $this->language->get('text_model_desc'),



				'value' => 'p.model-DESC',



				'href'  => $this->url->link('property/category',  '&sort=p.model&order=DESC' . $url)



			);







			$url = '';







			if (isset($this->request->get['filter'])) {



				$url .= '&filter=' . $this->request->get['filter'];



			}







			if (isset($this->request->get['sort'])) {



				$url .= '&sort=' . $this->request->get['sort'];



			}







			if (isset($this->request->get['order'])) {



				$url .= '&order=' . $this->request->get['order'];



			}







			$data['limits'] = array();







			$limits = array_unique(array($this->config->get($this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));







			sort($limits);







			foreach($limits as $value) {



				$data['limits'][] = array(



					'text'  => $value,



					'value' => $value,



					'href'  => $this->url->link('property/category',  $url . '&limit=' . $value)



				);



			}







			$url = '';







			if (isset($this->request->get['filter'])) {



				$url .= '&filter=' . $this->request->get['filter'];



			}







			if (isset($this->request->get['sort'])) {



				$url .= '&sort=' . $this->request->get['sort'];



			}







			if (isset($this->request->get['order'])) {



				$url .= '&order=' . $this->request->get['order'];



			}







			if (isset($this->request->get['limit'])) {



				$url .= '&limit=' . $this->request->get['limit'];



			}







			$data['sort'] = $sort;



			$data['order'] = $order;



			$data['continue'] = $this->url->link('common/home');



			$data['column_left'] = $this->load->controller('common/column_left');



			$data['column_right'] = $this->load->controller('common/column_right');



			$data['content_top'] = $this->load->controller('common/content_top');



			$data['content_bottom'] = $this->load->controller('common/content_bottom');



			$data['footer'] = $this->load->controller('common/footer');



			$data['header'] = $this->load->controller('common/header');



			



			



			/* if ($data['propertys']) { */



			



			$featurelay = $this->config->get('tmdrealstate_properites');







				if($featurelay=='1'){



					



					$this->response->setOutput($this->load->view('property/category', $data));				



				} elseif($featurelay=='2'){



					



					$this->response->setOutput($this->load->view('property/category1', $data));



				} elseif($featurelay=='3'){



					



					$this->response->setOutput($this->load->view('property/category2', $data));							



				} else {				



				



					$this->response->setOutput($this->load->view('property/category', $data));			



				} 	



		



		 /* } */



					



		} 



	



	



	function timeAgo($time_ago){



		$time_ago      = strtotime($time_ago);



		$cur_time      = time();



		$time_elapsed  = $cur_time - $time_ago;



		$seconds    = $time_elapsed ;



		$minutes    = round($time_elapsed / 60);



		$hours      = round($time_elapsed / 3600);



		$days       = round($time_elapsed / 86400);



		$weeks      = round($time_elapsed / 604800);



		$months     = round($time_elapsed / 2600640);



		$years      = round($time_elapsed / 31207680);



		// Seconds



		if($seconds <= 60){



			return "just now";



		}



		//Minutes



		else if($minutes <=60){



			if($minutes==1){



				return "one minute ago";



			} else {



				return "$minutes minutes ago";



			}



		}



		//Hours



		else if($hours <=24){



			if($hours==1){



				return "an hour ago";



			} else {



				return "$hours hrs ago";



			}



		}



		//Days



		else if($days <= 7){



			if($days==1){



				return "yesterday";



			} else {



				return "$days days ago";



			}



		}



		//Weeks



		else if($weeks <= 4.3){



			if($weeks==1){



				return "a week ago";



			} else {



				return "$weeks weeks ago";



			}



		}



		//Months



		else if($months <=12){



			if($months==1){



				return "a month ago";



			} else {



				return "$months months ago";



			}



		}



		//Years



		else{



			if($years==1){



				return "one year ago";



			} else {



				return "$years years ago";



			}



		}



	}



	



	



}



