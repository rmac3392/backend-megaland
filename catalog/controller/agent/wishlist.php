<?php

	class ControllerAgentWishList extends Controller {

	public function index() {

		if (!$this->agent->isLogged()) {

			$this->session->data['redirect'] = $this->url->link('agent/wishlist', '', 'SSL');

			$this->response->redirect($this->url->link('agent/login', '', 'SSL'));

		}

		$this->load->language('agent/wishlist');

		$this->load->model('agent/wishlist');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['property_id'])) {

			// Remove Wishlist

			$this->model_agent_wishlist->deleteWishlist($this->request->get['property_id']);

			$this->session->data['success'] = $this->language->get('text_remove');

			$this->response->redirect($this->url->link('agent/wishlist'));

		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('text_home'),

			'href' => $this->url->link('common/home')

		);

		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),

			'href' => $this->url->link('agent/wishlist')

		);

		$data['heading_title'] 			= $this->language->get('heading_title');

		$data['button_view'] 			= $this->language->get('button_view');

		$data['column_propertyname']	= $this->language->get('column_propertyname');

		$data['text_empty'] 			= $this->language->get('text_empty');

		$data['column_image']			= $this->language->get('column_image');

		$data['column_name'] 			= $this->language->get('column_name');

		$data['column_model']			= $this->language->get('column_model');

		$data['column_stock']			= $this->language->get('column_stock');

		$data['column_price'] 			= $this->language->get('column_price');

		$data['column_view'] 			= $this->language->get('column_view');

		$data['column_remove'] 			= $this->language->get('column_remove');

		$data['button_continue']		 = $this->language->get('button_continue');

		$data['button_cart']			 = $this->language->get('button_cart');

		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->session->data['success'])) {

			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);

		} else {

			$data['success'] = '';

		}

		$data['propertys'] = array();

		$this->load->model('property/property');

		$this->load->model('agent/agent');

		$this->load->model('tool/image');

		$results = $this->model_agent_wishlist->getWishlist();

		foreach ($results as $result) {

				$property_info = $this->model_property_property->getProperty($result['property_id']);

				//print_r($property_info);die();

				if ($property_info) {

				if(!empty($property_info['image'])){

				$image = $this->model_tool_image->resize($property_info['image'],50,50);

				}else{

				$image = $this->model_tool_image->resize('placeholder.png',50,50);

				}



				$agent_info=$this->model_agent_agent->getAgent($property_info['property_agent_id']);

				if(isset($agent_info['agentname'])){

				$agent=$agent_info['agentname'];         

				}else{

				$agent='';

				}



				$data['propertys'][] = array(

				'property_id'	 => $property_info['property_id'],

				'name' 			=> $property_info['name'],

				'image'      	=> $image,

				'agent'       	=> $agent,

				'price'       	=> $this->currency->format($property_info['price'],$this->session->data['currency']),

				'view'      	=> $this->url->link('property/property_detail', 'property_id=' . $property_info['property_id']),

				'remove'     	=> $this->url->link('agent/wishlist', 'property_id=' . $property_info['property_id'])

				);

			} else {

			$this->model_agent_wishlist->deleteWishlist($property_id);

			}

		}

		$data['column_left'] 					= $this->load->controller('common/column_left');

		$data['column_right'] 					= $this->load->controller('common/column_right');

		$data['content_top']	 				= $this->load->controller('common/content_top');

		$data['content_bottom'] 				= $this->load->controller('common/content_bottom');

		$data['footer'] 						= $this->load->controller('common/footer');

		$data['header'] 						= $this->load->controller('common/header');

		

		$this->response->setOutput($this->load->view('agent/wishlist', $data));

	}



	public function add() {

		$this->load->language('agent/wishlist');

		$json = array();

		if (isset($this->request->post['property_id'])) {

			$property_id = $this->request->post['property_id'];

		} else {

			$property_id = 0;

		}

		$this->load->model('property/property');

		$property_info = $this->model_property_property->getProperty($property_id);



		if ($property_info) {

		if ($this->agent->isLogged()) {

		// Edit customers cart

			$this->load->model('agent/wishlist');

				$this->model_agent_wishlist->addWishlist($this->request->post['property_id']);

				$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('property/property', 'property_id=' . (int)$this->request->post['property_id']), $property_info['name'], $this->url->link('agent/wishlist'));

				$json['total'] = sprintf($this->language->get('text_wishlist'), $this->model_agent_wishlist->getTotalWishlist());

			} else {

			if (!isset($this->session->data['wishlist'])) {

				$this->session->data['wishlist'] = array();

			}

			$this->session->data['wishlist'][] = $this->request->post['property_id'];

			$this->session->data['wishlist'] = array_unique($this->session->data['wishlist']);

			$json['success'] = sprintf($this->language->get('text_login'), $this->url->link('agent/login', '', 'SSL'), $this->url->link('agent/agentsignup', '', 'SSL'), $this->url->link('property/property', 'property_id=' . (int)$this->request->post['property_id']), $property_info['name'], $this->url->link('agent/wishlist'));

			$json['total'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));

		}

	}

		$this->response->addHeader('Content-Type: application/json');

		$this->response->setOutput(json_encode($json));

	  }

	}

