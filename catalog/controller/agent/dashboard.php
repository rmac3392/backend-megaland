<?php
class Controlleragentdashboard extends Controller {



	private $error = array();



	public function index() {



		if (!$this->agent->isLogged()) {



			$this->response->redirect($this->url->link('agent/login', '', true));



		}



		



		$this->load->language('agent/dashboard');



		$this->load->model('agent/agent');



		$this->load->model('tool/image');



		



		$data['breadcrumbs'] = array();



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('text_home'),



			'href' => $this->url->link('common/home')



		);



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('heading_title'),



			'href' => $this->url->link('agent/dashboard')



		);



		



		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title']             =$this->language->get('heading_title');
		
		$data['column_name']              =$this->language->get('column_name');
		$data['column_email']             =$this->language->get('column_email');
		$data['column_descriptions']      =$this->language->get('column_descriptions');
		
    	$data['dashboard_properties']       =$this->language->get('dashboard_properties');
		$data['dashboard_enquiries']        =$this->language->get('dashboard_enquiries');




		$this->load->model('property/property');

		$filter1=array(

			'property_agent_id' => $this->agent->getId(),

		);



		$data['agentproperty']=$this->model_property_property->getTotalPhotos($filter1);



		$data['enquerytotal']=$this->model_property_property->getTotalenquery($filter1);





		if (isset($this->request->get['filter_name'])){



			$filter_name = $this->request->get['filter_name'];



		}else{



			$filter_name = false;



		}



		if (isset($this->request->get['sort'])){



		$sort = $this->request->get['sort'];} 



			else{$sort = 'name';



		}



		if (isset($this->request->get['order'])) {



			$order = $this->request->get['order'];



		}else {



			$order = 'ASC';



		}



		if (isset($this->request->get['page'])){



			$page = $this->request->get['page'];



		}else {



			$page = 1;



		}



		 



		



		$data['enquery']=array();



		



		$filter_data = array(



	    	'agent_id'=> $this->agent->getId(),



			'sort'  => $sort,



			'order' => $order,



			'start' => ($page - 1) * $this->config->get('config_limit_admin'),



			'limit' => 5,



		);



		$enquery_total=$this->model_property_property->getTotalFeature($filter_data);



		



		$enquerylatestlnquery=$this->model_property_property->getLatestEnquery($filter_data);



		 foreach($enquerylatestlnquery as $enquerylatest){



			 $data['enquery'][]=array(



			 'enquiry_id' => $enquerylatest['enquiry_id'],



			 'name' => $enquerylatest['name'],



			 'email' => $enquerylatest['email'],



			 'description' => $enquerylatest['description'],



			  );



		 }



		



		$pagination = new Pagination();



		$pagination = new Pagination();



		$pagination->total = $enquery_total;



		$pagination->page = $page;



		$pagination->limit = $this->config->get('config_limit_admin');



		$pagination->url = $this->url->link('agent/dashboard', '&page={page}');



		$data['pagination'] = $pagination->render();



		$data['results'] = sprintf($this->language->get('text_pagination'), ($enquery_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($enquery_total - $this->config->get('config_limit_admin'))) ? $enquery_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $enquery_total, ceil($enquery_total / $this->config->get('config_limit_admin')));



	



		$data['sort'] = $sort;



		$data['order'] = $order;



			



		if (isset($this->error['warning'])) {



			$data['error_warning'] = $this->error['warning'];



		} else {



			$data['error_warning'] = '';



		}







		$data['action'] = $this->url->link('agent/dashboard', '', true);







		if (isset($this->request->post['country_id'])) {



			$data['country_id'] = (int)$this->request->post['country_id'];



		} elseif (isset($this->session->data['shipping_address']['country_id'])) {



			$data['country_id'] = $this->session->data['shipping_address']['country_id'];



		} 







		if (isset($this->request->post['zone_id'])) {



			$data['zone_id'] = (int)$this->request->post['zone_id'];



		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {



			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];



		}



			 ////plans ////



		 $this->load->model('membership/plans');



		$data['memberships']=$this->model_membership_plans->getPlansies($data);



		 ////plans ////



		



		$this->load->model('localisation/language');



		$data['languages'] = $this->model_localisation_language->getLanguages();



		$this->load->model('localisation/country');



		$data['countries'] = $this->model_localisation_country->getCountries();



		$data['column_left']    = $this->load->controller('common/column_left');



		$data['column_right']   = $this->load->controller('common/column_right');



		$data['content_top']    = $this->load->controller('common/content_top');



		$data['content_bottom'] = $this->load->controller('common/content_bottom');



		$data['footer']         = $this->load->controller('common/footer');



		$data['header']         = $this->load->controller('common/header');



		$this->response->setOutput($this->load->view('agent/dashboard', $data));



	}



}



