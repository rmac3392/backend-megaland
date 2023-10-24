<?php


class ControllerCommonSearch extends Controller {


	public function index() {


		$this->load->language('common/search');


		$this->load->model('catalog/search');





		$data['text_search'] = $this->language->get('text_search');


		$data['text_findproperty'] = $this->language->get('text_findproperty');


		$data['text_location'] = $this->language->get('text_location');


		$data['text_city'] = $this->language->get('text_city');


		$data['text_minprice'] = $this->language->get('text_minprice');


		$data['text_maxprice'] = $this->language->get('text_maxprice');


		


		$data['button_search'] = $this->language->get('button_search');





		if (isset($this->request->get['search'])) {


			$data['search'] = $this->request->get['search'];


		} else {


			$data['search'] = '';


		}


			$this->load->model('catalog/search');


		  $data['propertylist']=$this->model_catalog_search->getCategories($data);


		//echo "<pre>";


		//print_r($data['propertylist']);die();





		return $this->load->view('common/search', $data);


	}


	


		 public function searchauto(){


			$this->load->model('catalog/search');


			if (($this->request->server['REQUEST_METHOD'] == 'POST')) {


			  //$this->model_catalog_search->addSearch($this->request->post);	


				  $json['success'] = $this->language->get('text_success');


	


			}


			$this->response->addHeader('Content-Type: application/json');


			$this->response->setOutput(json_encode($json));


	 }


	


}


