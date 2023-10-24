<?php


class ControllerExtensionModuleAgent extends Controller {


	public function index($setting) {


		$this->load->language('extension/module/agent');





		$data['heading_title'] = $this->language->get('heading_title');


		$data['text_view'] = $this->language->get('text_view');





		$data['text_tax'] = $this->language->get('text_tax');


		$data['text_viewmore'] = $this->language->get('text_viewmore');


		$data['text_property'] = $this->language->get('text_property');





		$data['button_cart'] = $this->language->get('button_cart');


		$data['button_wishlist'] = $this->language->get('button_wishlist');


		$data['button_compare'] = $this->language->get('button_compare');


		


		


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


			


		$data['viewmore'] = $this->url->link('agent/ouragents', '', true);





		$this->load->model('catalog/product');





		$this->load->model('tool/image');

		$data['products'] = array();


		if (isset($this->request->get['order'])){
			$order = $this->request->get['order'];
		}else{
			$order = 'ASC';
		}

		if (isset($this->request->get['sort'])){
			$sort = $this->request->get['sort'];
		}else{
			$sort = 'sort_order';
		}


		$filter_data = array(


			'sort'  => $sort,


			'order' => $order,


			'start' => 0,


			'limit' => $setting['limit']


			//'limit' => 0


		);


		


		/* Layout */


		


		if (isset($this->request->get['route'])) {


			$route = (string)$this->request->get['route'];


		} else {


			$route = 'common/home';


		}


		


		$this->load->model('design/layout');


		$layout_id = 0;





		if ($route == 'product/category' && isset($this->request->get['path'])) {


			$this->load->model('catalog/category');





			$path = explode('_', (string)$this->request->get['path']);





			$layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));


		}





		if ($route == 'product/product' && isset($this->request->get['product_id'])) {


			$this->load->model('catalog/product');





			$layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);


		}





		if ($route == 'information/information' && isset($this->request->get['information_id'])) {


			$this->load->model('catalog/information');





			$layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);


		}





		if (!$layout_id) {


			$layout_id = $this->model_design_layout->getLayout($route);


		}





		if (!$layout_id) {


			$layout_id = $this->config->get('config_layout_id');


		}





		$this->load->model('extension/module');





		$data['modules'] = array();





		$data['contentbottom'] = $this->model_design_layout->getLayoutModules($layout_id, 'content_bottom');


		$data['columntop'] = $this->model_design_layout->getLayoutModules($layout_id, 'content_top');


		$data['columnleft'] = $this->model_design_layout->getLayoutModules($layout_id, 'column_left');


		$data['columnright'] = $this->model_design_layout->getLayoutModules($layout_id, 'column_footer5');


		/* Layout */





		//$results = $this->model_catalog_product->getProducts($filter_data);


		$this->load->model('agent/agent');


		$this->load->model('property/property');


		$agentdetails=$this->model_agent_agent->getAgents($filter_data);


		


		if ($agentdetails) {


			foreach ($agentdetails as $agent) {


				$propertyagent=$this->model_property_property->propertytotalagent($agent['property_agent_id']);

				
				if ($agent['image']) {


					$image = $this->model_tool_image->resize($agent['image'], $setting['width'], $setting['height']);


				} else {


					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);


				}


				$data['agentdetails'][] = array(


					'image'       => $image,


					'propertyagent'       => $propertyagent,


					'agentname'        => $agent['agentname'],


					'facebook' => $agent['facebook'],


					'twitter' => $agent['twitter'],


					'instagram' => $agent['instagram'],


					'pinterest' => $agent['pinterest'],


					'googleplus' => $agent['googleplus'],


					'positions'        => $agent['positions'],


					'description' => utf8_substr(strip_tags(html_entity_decode($agent['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',


				    'href'        => $this->url->link('property/agentsproperty', 'property_agent_id=' . $agent['property_agent_id'])


				);


			}


			//print_r($data['agentdetails']);die();


			


			


			$agentlayout = $this->config->get('tmdrealstate_agent');





				if($agentlayout=='1'){


					return $this->load->view('extension/module/agent', $data);				


				} elseif($agentlayout=='2'){


					return $this->load->view('extension/module/agent1', $data);


				} elseif($agentlayout=='3'){


					return $this->load->view('extension/module/agent2', $data);


				} else {				


					return $this->load->view('extension/module/agent', $data);			


				} 


			


		}


	}


}


