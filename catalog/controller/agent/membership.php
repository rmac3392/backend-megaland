<?php  
class Controlleragentmembership extends Controller {


 private $error = array();


 public function index() {


		$this->load->language('agent/membership');


		$this->load->model('agent/agent');


		$this->load->model('membership/plans');


		$this->load->model('tool/image');	


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/home')


		);


		


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('agent/membership')


		);


		


		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}


	    





		$membership_info=$this->model_agent_agent->getplasid($this->agent->getId());

		if(!empty($membership_info)){
			$data['date_added'] 		=$membership_info['date_added'];
			$agents_info				= $this->model_agent_agent->getShowAgent($membership_info['property_agent_id']);
            $data['agentname']		    = $agents_info['agentname'];
         }
             

		if(!empty($membership_info['plans_id'])){
			$plans_info =$this->model_membership_plans->getPlan($membership_info['plans_id']);

		} 

		if(isset($plans_info)){
			$data['type']		         = $plans_info['type'];
			$data['price']		         = $plans_info['price'];
			$data['number']		         = $plans_info['number'];
			$data['name']		         = $plans_info['name'];

		}


	   //print_r($membership_info);die();


	  


		$this->document->setTitle($this->language->get('heading_title'));


		$data['heading_title'] 			= $this->language->get('heading_title');


		$data['text_membership']		= $this->language->get('text_membership');


		$data['text_current']			= $this->language->get('text_current');


		$data['text_update']			= $this->language->get('text_update');


	 


		$data['text_name']			= $this->language->get('text_name');


		$data['text_price']			= $this->language->get('text_price');


		$data['text_type']			= $this->language->get('text_type');


		$data['text_day']			= $this->language->get('text_day');


	 


	 


	 


	 


       $data['column_images'] 			= $this->language->get('column_images');


		$data['column_left'] 			= $this->load->controller('common/column_left');


		$data['column_right']			= $this->load->controller('common/column_right');


		$data['content_top'] 			= $this->load->controller('common/content_top');


		$data['content_bottom'] 		= $this->load->controller('common/content_bottom');


		$data['footer'] 				= $this->load->controller('common/footer');


		$data['header'] 				= $this->load->controller('common/header');


		$this->response->setOutput($this->load->view('agent/membership', $data));


	}


 }