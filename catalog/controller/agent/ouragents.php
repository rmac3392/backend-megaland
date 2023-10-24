<?php  
class ControlleragentOurAgents extends Controller {


 private $error = array();


 public function index() {


	 if (!$this->agent->isLogged()) {


			$this->response->redirect($this->url->link('agent/login', '', true));


		}


	 


		$this->load->language('agent/ouragents');


		$this->load->model('agent/agent');


		$this->load->model('property/property');


		$this->load->model('tool/image');	


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/home')


		);


		


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('agent/ouragents')


		);


		


		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}


		$this->document->setTitle($this->language->get('heading_title'));


		$data['heading_title'] 			= $this->language->get('heading_title');


		$data['text_property'] 			= $this->language->get('text_property');


		$this->load->model('tool/image');


	  if(isset($agents_info)){


		$agents_info=$this->model_agent_agent->getShowAgent($this->agent->getId());


		if (isset($agents_info['image'])) {
			$image = $this->model_tool_image->resize($agents_info['image'], 135,135);

	} else {


			$image = $this->model_tool_image->resize('placeholder.png',135,135);


		}


	   $data['agentimage']          =$image;


	 	$data['agentname']			=$agents_info['agentname'];


		$data['description']		=$agents_info['description'];


		$data['positions']			=$agents_info['positions'];


		$data['email']				=$agents_info['email'];


		$data['contact']			=$agents_info['contact'];


		$data['address']			=$agents_info['address'];


		$data['city']				=$agents_info['city'];


		$data['pincode']			=$agents_info['pincode'];


			


		}


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


		$url = '';


		if (isset($this->request->get['sort'])){


			$url .= '&sort=' . $this->request->get['sort'];


		}


		if (isset($this->request->get['order'])){


		$url .= '&order=' . $this->request->get['order'];


		}


		if (isset($this->request->get['page'])) {


			$url .= '&page=' . $this->request->get['page'];


		}





		if (isset($this->request->get['sort'])){





			$sort = $this->request->get['sort'];


		}else {


			$sort = 'agentname';


		}


		if (isset($this->request->get['sort'])){


			$sort = $this->request->get['sort'];


		}else{


			$sort = 'sort_order';


		}


		if (isset($this->request->get['order'])){


			$order = $this->request->get['order'];


		}else{


			$order = 'ASC';


		}


		if (isset($this->request->get['page'])){


			$page = $this->request->get['page'];


		}else {


			$page = 1;


		}


	 


	 


	 	


		$filter_data = array(


			'sort'  => $sort,


			'order' => $order,


			'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


		);


	 


	 


		$agent_total=$this->model_agent_agent->getAgentstotal($filter_data);


	 


		$agentdetails=$this->model_agent_agent->getAgents($filter_data);


	  


		if ($agentdetails) {


			foreach ($agentdetails as $agent) {


			$propertyagent=$this->model_property_property->propertytotalagent($agent['property_agent_id']);

			//print_r($propertyagent);die();


				if ($agent['image']) {


					$image = $this->model_tool_image->resize($agent['image'], 500, 500);


				} else {


					$image = $this->model_tool_image->resize('placeholder.png', 500, 500);


				}


				$data['agentdetails'][] = array(


					'image'       	=> $image,


					'propertyagent'	=> $propertyagent,


					'agentname'   	=> $agent['agentname'],


					'positions'   	=> $agent['positions'],


					'description'	=> $agent['description'],


					'facebook'		=> $agent['facebook'],


					'twitter' 		=> $agent['twitter'],


					'instagram' 	=> $agent['instagram'],


					'pinterest' 	=> $agent['pinterest'],


					'googleplus'	=> $agent['googleplus'],


					'href'        	=> $this->url->link('agent/ouragentview ', 'property_agent_id=' . $agent['property_agent_id'])


				);


			}

          


		$pagination = new Pagination();


		$pagination = new Pagination();


		$pagination->total = $agent_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_limit_admin');


		$pagination->url = $this->url->link('agent/ouragents', '&page={page}');


		$data['pagination'] = $pagination->render();


		$data['results'] = sprintf($this->language->get('text_pagination'), ($agent_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($agent_total - $this->config->get('config_limit_admin'))) ? $agent_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $agent_total, ceil($agent_total / $this->config->get('config_limit_admin')));


		$data['sort'] = $sort;


		$data['order'] = $order;


		$data['column_images'] 		= $this->language->get('column_images');


		$data['sort'] = $sort;


		$data['order'] = $order;


		$data['column_left'] 		= $this->load->controller('common/column_left');


		$data['column_right']		= $this->load->controller('common/column_right');


		$data['content_top'] 		= $this->load->controller('common/content_top');


		$data['content_bottom'] 	= $this->load->controller('common/content_bottom');


		$data['footer'] 			= $this->load->controller('common/footer');


		$data['header'] 			= $this->load->controller('common/header');


		$this->response->setOutput($this->load->view('agent/ouragents', $data));


	  }


	}


 }