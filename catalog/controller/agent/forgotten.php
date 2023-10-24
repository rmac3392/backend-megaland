<?php
class ControllerAgentForgotten extends Controller {
	private $error = array();
	public function index() {
		if ($this->agent->isLogged()) {
			$this->response->redirect($this->url->link('agent/login', '', true));
		}
		$this->load->language('agent/forgotten');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('agent/agent');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$email   = $this->request->post['email'];
			

			$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
			$random1 = substr($string1,0,3);
			$string2 = str_shuffle('1234567890');
			$random2 = substr($string2,0,3);
			$random  = $random1.$random2;



			$query   = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_agent WHERE LOWER(email) = '" .$email. "'");

			if(isset($query->row['email'])){
				$emailname= $query->row['email'];
			}

	

		   $this->load->model('agent/agent');
			$type = 'agent_forgotten_mail';
    		$mailinfo = $this->model_agent_agent->getMailInfo($type);
		if(!empty($mailinfo['message'])){
		   if(isset($mailinfo['status'])){
				$find = array(
				    '{password}',
	    			'{loginlink}'
	    		);
				$replace = array(
				   'password'  => $random,
					'loginlink'  => $this->url->link('agent/login')
				);


		     	$subject = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['subject']))));
				$message = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['message']))));
				
			

				$mail = new Mail();
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
				$mail->smtp_username = $this->config->get('config_mail_smtp_username');
				$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
				$mail->smtp_port = $this->config->get('config_mail_smtp_port');
				$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

				$mail->setTo($emailname);
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
				$mail->setSubject($subject);
				$mail->setHtml(html_entity_decode($message));
				$mail->send();
				$random   = md5($random);
				$quers    = $this->db->query("UPDATE " . DB_PREFIX . "property_agent set password = '" .$random ."'WHERE LOWER(email) = '" .$this->db->escape(utf8_strtolower($emailname)) . "'");
			    $this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('agent/login'));
			}
		}
		}





		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/home')


		);





		$data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_account'),
			'href' => $this->url->link('agent/login', '', true)


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_forgotten'),


			'href' => $this->url->link('agent/forgotten', '', true)


		);





		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_your_email'] = $this->language->get('text_your_email');


		$data['text_email'] = $this->language->get('text_email');





		$data['entry_email'] = $this->language->get('entry_email');





		$data['button_continue'] = $this->language->get('button_continue');


		$data['button_back'] = $this->language->get('button_back');





		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}





		$data['action'] = $this->url->link('agent/forgotten', '', true);





		$data['back'] = $this->url->link('agent/login', '', true);





		if (isset($this->request->post['email'])) {


			$data['email'] = $this->request->post['email'];


		} else {


			$data['email'] = '';


		}





		$data['column_left'] = $this->load->controller('common/column_left');


		$data['column_right'] = $this->load->controller('common/column_right');


		$data['content_top'] = $this->load->controller('common/content_top');


		$data['content_bottom'] = $this->load->controller('common/content_bottom');


		$data['footer'] = $this->load->controller('common/footer');


		$data['header'] = $this->load->controller('common/header');





		$this->response->setOutput($this->load->view('agent/forgotten', $data));


	}





	protected function validate() {


		if (!isset($this->request->post['email'])) {


			$this->error['warning'] = $this->language->get('error_email');


		} elseif (!$this->model_agent_agent->getTotalAgentByEmail($this->request->post['email'])) {


			$this->error['warning'] = $this->language->get('error_email');


		}





		$agent_info = $this->model_agent_agent->getAgentByEmail($this->request->post['email']);





		if ($agent_info && !$agent_info['approved']) {


			$this->error['warning'] = $this->language->get('error_approved');


		}





		return !$this->error;


	}


}