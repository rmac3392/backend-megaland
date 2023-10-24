<?php
class ControlleragentLogin extends Controller {


	private $error = array();


	public function index() {


		if ($this->agent->isLogged()) {


			$this->response->redirect($this->url->link('agent/dashboard', '', true));


		}


		$this->load->model('agent/agent');


		$this->load->model('agent/wishlist');


		$this->load->language('agent/login');


		$this->document->setTitle($this->language->get('heading_title'));


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {    


			


			// Wishlist


			if (isset($this->session->data['wishlist']) && is_array($this->session->data['wishlist'])) {


				$this->load->model('agent/wishlist');


				foreach ($this->session->data['wishlist'] as $key => $property_id) {


					$this->model_agent_wishlist->addWishlist($property_id);


					unset($this->session->data['wishlist'][$key]);


				}


			}


			


		


			if (isset($this->request->post['redirect']) && $this->request->post['redirect'] != $this->url->link('agent/logout', '', true) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)) {


				$this->response->redirect(str_replace('&amp;', '&', $this->request->post['redirect']));


			} else {


				$this->response->redirect($this->url->link('agent/dashboard', '', true));





			}


		}


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/home')


		);


		$data['breadcrumbs'][] = array(





			'text' => $this->language->get('text_login'),





			'href' => $this->url->link('agent/login', '', true)


		);





		$data['heading_title']              		= $this->language->get('heading_title');


		$data['text_new_agent']             		= $this->language->get('text_new_agent');


		$data['text_agentsignup']           		= $this->language->get('text_agentsignup');


		$data['text_register_agent']       			= $this->language->get('text_register_agent');


		$data['text_returning_agent']       		= $this->language->get('text_returning_agent');


		$data['text_i_am_returning_agent']  		= $this->language->get('text_i_am_returning_agent');


		$data['text_forgotten']             		= $this->language->get('text_forgotten');


		$data['entry_email']                		= $this->language->get('entry_email');


		$data['entry_password'] 					= $this->language->get('entry_password');


		$data['button_continue']					= $this->language->get('button_continue');


		$data['button_login']    					= $this->language->get('button_login');





		if (isset($this->session->data['error'])) {


			$data['error_warning'] = $this->session->data['error'];


			


			unset($this->session->data['error']);





		} elseif (isset($this->error['warning'])) {





			$data['error_warning'] = $this->error['warning'];





		} else {





			$data['error_warning'] = '';


		}





		$data['action']    = $this->url->link('agent/login', '', true);


		$data['register']  = $this->url->link('agent/agentsignup', '', true);


		$data['forgotten'] = $this->url->link('account/forgotten', '', true);





		if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)) {





			$data['redirect'] = $this->request->post['redirect'];





		} elseif (isset($this->session->data['redirect'])) {


			$data['redirect'] = $this->session->data['redirect'];


			unset($this->session->data['redirect']);





		} else {


			$data['redirect'] = '';


		}


		if (isset($this->session->data['success'])) {


			$data['success'] = $this->session->data['success'];


			unset($this->session->data['success']);





		} else {


			$data['success'] = '';





		}


		if (isset($this->request->post['email'])) {


			$data['email'] = $this->request->post['email'];


		} else {


			$data['email'] = '';


		}





		if (isset($this->request->post['password'])) {


			$data['password'] = $this->request->post['password'];


		} else {


			$data['password'] = '';


		}





		$data['column_left']        = $this->load->controller('common/column_left');


		$data['column_right']       = $this->load->controller('common/column_right');


		$data['content_top']        = $this->load->controller('common/content_top');


		$data['content_bottom']     = $this->load->controller('common/content_bottom');


		$data['footer']             = $this->load->controller('common/footer');


		$data['header']             = $this->load->controller('common/header');


		$this->response->setOutput($this->load->view('agent/login', $data));


	}


	protected function validate() {


		$agent_info = $this->model_agent_agent->getAgentByEmail($this->request->post['email']);


		if ($agent_info && !$agent_info['approved']) {


			$this->error['warning'] = $this->language->get('error_approved');


		}


		if (!$this->error) {


			if (!$this->agent->login($this->request->post['email'], $this->request->post['password'])) {


				$this->error['warning'] = $this->language->get('error_login');		


			}	


		}


		return !$this->error;


	}	


}