<?php


class ControllerExtensionModuleAgents extends Controller {


	public function index() {


		$this->load->language('extension/module/agents');

		$data['heading_title']     = $this->language->get('heading_title');
		$data['text_register']     = $this->language->get('text_register');
		$data['text_login']        = $this->language->get('text_login');
		$data['text_logout']       = $this->language->get('text_logout');
        $data['text_membership']   = $this->language->get('text_membership');
		$data['text_dashboard']    = $this->language->get('text_dashboard');
        $data['text_forgot']       = $this->language->get('text_forgot');
        $data['text_chagepass']    = $this->language->get('text_chagepass');
		$data['text_viewagent']    = $this->language->get('text_viewagent');
		$data['text_editagent']    = $this->language->get('text_editagent');
        $data['text_addproperty']  = $this->language->get('text_addproperty');
		$data['text_manage']       = $this->language->get('text_manage');

		$data['logged'] = $this->agent->isLogged();


		$data['signup'] = $this->url->link('agent/agentsignup', '', true);


		$data['login'] = $this->url->link('agent/login', '', true);


		$data['logout'] = $this->url->link('agent/logout', '', true);


		$data['membership'] = $this->url->link('agent/membership', '', true);


		$data['dashboard'] = $this->url->link('agent/dashboard', '', true);


		$data['edit'] = $this->url->link('agent/agentedit', '', true);


		$data['forgotpassword'] = $this->url->link('agent/forgotten', '', true);


		$data['password'] = $this->url->link('agent/password', '', true);


		$data['viewagent'] = $this->url->link('agent/viewagent');


		$data['property'] = $this->url->link('agent/property');


		$data['manage'] = $this->url->link('agent/property/view');





		return $this->load->view('extension/module/agents', $data);


	}


}


