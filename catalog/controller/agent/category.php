<?php


class ControllerAgentCategory extends Controller {


	public function index() {


		$this->load->language('agent/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}





		if (isset($this->request->get['sort'])) {
         $sort = $this->request->get['sort'];


		} else {


			$sort = 'p.sort_order';


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





		if (isset($this->request->get['path'])) {


			$url = '';





			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}





			if (isset($this->request->get['limit'])) {


				$url .= '&limit=' . $this->request->get['limit'];


			}





			$path = '';





			$parts = explode('_', (string)$this->request->get['path']);





			$category_id = (int)array_pop($parts);





			foreach ($parts as $path_id) {


				if (!$path) {


					$path = (int)$path_id;


				} else {


					$path .= '_' . (int)$path_id;


				}





				$category_info = $this->model_catalog_category->getCategory($path_id);





				if ($category_info) {


					$data['breadcrumbs'][] = array(


						'text' => $category_info['name'],


						'href' => $this->url->link('agent/category', 'path=' . $path . $url)


					);


				}


			}


		} else {


			$category_id = 0;


		}





		$category_info = $this->model_catalog_category->getCategory($category_id);


		if ($category_info) {


			$this->document->setTitle($category_info['meta_title']);


			$this->document->setDescription($category_info['meta_description']);


			$this->document->setKeywords($category_info['meta_keyword']);


			$data['heading_title'] = $category_info['name'];


			$data['heading_title1'] = $this->language->get('heading_title1');


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


			$data['text_rent'] = $this->language->get('Rent');


			$data['text_price'] = $this->language->get('Price');


			$data['text_sqft'] = $this->language->get('Sq Ft');


			$data['text_none'] = $this->language->get('text_none');


			$data['text_amenities'] = $this->language->get('Amenities');


			$data['text_NearestPlace'] = $this->language->get('Nearest Place');


			$data['text_apartment'] = $this->language->get('text_apartment');


			$data['text_4Daysago'] = $this->language->get('text_4Daysago');


			$data['text_bedrooms'] = $this->language->get('text_bedrooms');


			$data['text_bathrooms'] = $this->language->get('text_bathrooms');


			$data['text_garge'] = $this->language->get('text_garge');


			$data['text_nearest'] = $this->language->get('text_nearest');


		// Set the last category breadcrumb


			$data['breadcrumbs'][] = array(


				'text' => $category_info['name'],


				'href' => $this->url->link('property/category', 'path=' . $this->request->get['path'])


			);





			if ($category_info['image']) {


				$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));


			} else {


				$data['thumb'] = '';


			}





			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');


			$data['compare'] = $this->url->link('property/compare');





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





			$this->load->model('property/property');


			$this->load->model('tool/image');


			$this->load->model('property/property_status');


			$data['categories'] = array();


			$results = $this->model_catalog_category->getCategories($category_id);


			//print_r($results);die();


			foreach ($results as $result) {


				$filter_data = array(


					'filter_category_id'  => $result['category_id'],


					'filter_sub_category' => true


				);


				$data['categories'][] = array(


					'name' => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),


					'href' => $this->url->link('agent/property_detail', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url)


				);


				//print_r($data['categories']);die();


			}


      $filter_data = array(


				'filter_category_id' => $category_id,


				'filter_filter'      => $filter,


				'sort'               => $sort,


				'order'              => $order,


				'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


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


			


			$features_info=$this->model_property_property->getproperfeature($property['property_id']);


			$features=array();


			 foreach($features_info as $info){


				 if ($info['image']) {


					$features[]= $this->model_tool_image->resize($info['image'],20,20);


				}


			}


			$nearestplace_info=$this->model_property_property->getNeareastplace($property['property_id']);


			 //print_r($nearestplace_info);die();


			$nearestplaces=array();


			foreach($nearestplace_info as $neares){


				


			  if ($neares['image']) {


		 		$nearestplaces[] = $this->model_tool_image->resize($neares['image'],20,20);


			 } 


			}		





			$rent=$this->model_property_property_status->getOrderStatus($property['property_status_id']);


			if(isset($rent['name'])){


				$propertyrent=$rent['name'];         


			}else{


				$propertyrent='';


			}		


			$data['propertys'][] = array(


						'property_id'  => $property['property_id'],


						'name'  => $property['name'],


						'thumb'  => $image,


						'propertyrent'  => $propertyrent,


						'features'  => $features,


						'nearestplaces'  =>$nearestplaces,


						'price'  => $this->currency->format($property['price'],$this->session->data['currency']),


						'area'  => $property['area'],


						'neighborhood'  => $property['neighborhood'],


						'bedrooms'  => $property['bedrooms'],


						'bathrooms'  => $property['bathrooms'],


						'href'      => $this->url->link('agent/property_detail', 'property_id=' . $property['property_id']));


		   }





			$url = '';





			if (isset($this->request->get['filter'])) {


				$url .= '&filter=' . $this->request->get['filter'];


			}





			if (isset($this->request->get['limit'])) {


				$url .= '&limit=' . $this->request->get['limit'];


			}


			


			$pagination = new Pagination();


			$pagination->total = $property_total;


			$pagination->page = $page;


			$pagination->limit = $limit;


			$pagination->url = $this->url->link('agent/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');


			$data['pagination'] = $pagination->render();


			$data['results'] = sprintf($this->language->get('text_pagination'), ($property_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($property_total - $limit)) ? $property_total : ((($page - 1) * $limit) + $limit), $property_total, ceil($property_total / $limit));


			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html


			if ($page == 1) {


			    $this->document->addLink($this->url->link('agent/category', 'path=' . $category_info['category_id'], true), 'canonical');


			} elseif ($page == 2) {


			    $this->document->addLink($this->url->link('agent/category', 'path=' . $category_info['category_id'], true), 'prev');


			} else {


			    $this->document->addLink($this->url->link('agent/category', 'path=' . $category_info['category_id'] . '&page='. ($page - 1), true), 'prev');


			}





			if ($limit && ceil($property_total / $limit) > $page) {


			    $this->document->addLink($this->url->link('agent/category', 'path=' . $category_info['category_id'] . '&page='. ($page + 1), true), 'next');


			}





			$data['sort'] = $sort;


			$data['order'] = $order;


			$data['limit'] = $limit;





			$data['sorts'][] = array(


				'text'  => $this->language->get('text_default'),


				'value' => 'p.sort_order-ASC',


				'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)


			);





			$data['sorts'][] = array(


				'text'  => $this->language->get('text_name_asc'),


				'value' => 'pd.name-ASC',


				'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)


			);





			$data['sorts'][] = array(


				'text'  => $this->language->get('text_name_desc'),


				'value' => 'pd.name-DESC',


				'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)


			);





			$data['sorts'][] = array(


				'text'  => $this->language->get('text_price_asc'),


				'value' => 'p.price-ASC',


				'href'  => $this->url->link('agent/agent', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)


			);





			$data['sorts'][] = array(


				'text'  => $this->language->get('text_price_desc'),


				'value' => 'p.price-DESC',


				'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)


			);





			if ($this->config->get('config_review_status')) {


				$data['sorts'][] = array(


					'text'  => $this->language->get('text_rating_desc'),


					'value' => 'rating-DESC',


					'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)


				);





				$data['sorts'][] = array(


					'text'  => $this->language->get('text_rating_asc'),


					'value' => 'rating-ASC',


					'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)


				);


			}





			$data['sorts'][] = array(


				'text'  => $this->language->get('text_model_asc'),


				'value' => 'p.model-ASC',


				'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)


			);





			$data['sorts'][] = array(


				'text'  => $this->language->get('text_model_desc'),


				'value' => 'p.model-DESC',


				'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)


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


					'href'  => $this->url->link('agent/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)


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





			$this->response->setOutput($this->load->view('agent/category', $data));


		} else {


			$url = '';





			if (isset($this->request->get['path'])) {


				$url .= '&path=' . $this->request->get['path'];


			}





			if (isset($this->request->get['filter'])) {


				$url .= '&filter=' . $this->request->get['filter'];


			}





			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			if (isset($this->request->get['limit'])) {


				$url .= '&limit=' . $this->request->get['limit'];


			}





			$data['breadcrumbs'][] = array(


				'text' => $this->language->get('text_error'),


				'href' => $this->url->link('property/category', $url)


			);





			$this->document->setTitle($this->language->get('text_error'));





			$data['heading_title'] = $this->language->get('text_error');





			$data['text_error'] = $this->language->get('text_error');





			$data['button_continue'] = $this->language->get('button_continue');





			$data['continue'] = $this->url->link('common/home');





			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');





			$data['column_left'] = $this->load->controller('common/column_left');


			$data['column_right'] = $this->load->controller('common/column_right');


			$data['content_top'] = $this->load->controller('common/content_top');


			$data['content_bottom'] = $this->load->controller('common/content_bottom');


			$data['footer'] = $this->load->controller('common/footer');


			$data['header'] = $this->load->controller('common/header');





			$this->response->setOutput($this->load->view('error/not_found', $data));


		}


	}


	


	public function autocomplete() {


		$json = array();





		if (isset($this->request->get['filter_name'])) {


			$this->load->model('catalog/category');





			$filter_data = array(


				'filter_name' => $this->request->get['filter_name'],


				'sort'        => 'name',


				'order'       => 'ASC',


				'start'       => 0,


				'limit'       => 5


			);





			$results = $this->model_catalog_category->getCategories($filter_data);





			foreach ($results as $result) {


				$json[] = array(


					'category_id' => $result['category_id'],


					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))


				);


			}


		}





		$sort_order = array();





		foreach ($json as $key => $value) {


			$sort_order[$key] = $value['name'];


		}





		array_multisort($sort_order, SORT_ASC, $json);





		$this->response->addHeader('Content-Type: application/json');


		$this->response->setOutput(json_encode($json));


	}


}


