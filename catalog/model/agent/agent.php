<?php
class Modelagentagent extends Model {

	public function addAgent($data){

		$sql="INSERT INTO " . DB_PREFIX . "property_agent set agentname='".$this->db->escape($data['agentname'])."',image='".$this->db->escape($data['image'])."',

		description='".$this->db->escape($data['description'])."',positions='".$this->db->escape($data['positions'])."',email='".$this->db->escape($data['email'])."',

		facebook='".$this->db->escape($data['facebook'])."',twitter='".$this->db->escape($data['twitter'])."',googleplus='".$this->db->escape($data['googleplus'])."',

		pinterest='".$this->db->escape($data['pinterest'])."',instagram='".$this->db->escape($data['instagram'])."',contact='".$this->db->escape($data['contact'])."',plans_id='".(int) $data['plans_id']."',country_id='".(int) $data['country_id']."',pincode='".$this->db->escape($data['pincode'])."',	zone_id='".(int) $data['zone_id']."',

		address='".$this->db->escape($data['address'])."',salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt .sha1($data['password'])))) ."',

		city='".$this->db->escape($data['city'])."',status=1,date_added=now()";

		$this->db->query($sql);

		$property_agent_id = $this->db->getLastId();

		$sql="INSERT INTO " . DB_PREFIX . "agent_member SET property_agent_id = '" .(int) $property_agent_id . "',plans_id='".(int) $data['plans_id']."',date_added=now()";

		$this->db->query($sql);

		/// Seller Signup To Mail ///
		$this->load->model('agent/mail');
		$type = 'agent_register_mail';
		
		$mailinfo = $this->model_agent_mail->getMailInfo($type);
		//print_r($mailinfo); die();
		

		/*Status Enabled*/
	if(!empty($mailinfo['message'])){
		if(!empty($mailinfo['status'])){
			$find = array(
				'{agentname}',
				'{email}',										
				'{contact}',
				'{positions}',
				'{country_id}',
				'{zone_id}',										
			);

			$this->load->model('localisation/country');
			$country_info = $this->model_localisation_country->getCountry($data['country_id']);
			if(isset($country_info['name'])) {
				$countryname = $country_info['name'];
			} else {
				$countryname='';
			}

			$this->load->model('localisation/zone');
			$zone_info = $this->model_localisation_zone->getZone($data['zone_id']);
			if(isset($zone_info['name'])) {
				$zonename = $zone_info['name'];
			} else {
				$zonename='';
			}

			$replace = array(
				'agentname'=> $data['agentname'],
				'email' 	=> $data['email'],
				'contact'	=> $data['contact'],
				'positions'	=> $data['positions'],
				'country_id'=> $countryname,
				'zone_id'	=> $zonename,
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

			$mail->setTo($data['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
					
		}
	}
		

	}

	public  function getMailInfo($type){
		$query=$this->db->query("select * from " . DB_PREFIX . "mail vm LEFT JOIN " . DB_PREFIX . "mail_language vml on(vm.mail_id=vml.mail_id) where vm.type='" .$type."'and vml.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
		
	}

	public function getplasid($property_agent_id){

		$sql="select * from " . DB_PREFIX . "agent_member where	property_agent_id='".$property_agent_id."' ";	

		$query=$this->db->query($sql);

		return $query->row;

	

	}



	public function getShowAgent($property_agent_id){

		$sql="select * from " . DB_PREFIX . "property_agent where property_agent_id='".$this->agent->getId()."'";

		$query=$this->db->query($sql);

		return $query->row;

	}

	public function getouragent($property_agent_id){

		$sql="select * from " . DB_PREFIX . "property_agent where property_agent_id='".$property_agent_id."'";

			$query=$this->db->query($sql);

			return $query->row;

	}

	

	public function getouragenticon($property_agent_id){

		$sql="select * from " . DB_PREFIX . "property_agent where property_agent_id='".$property_agent_id."'";

			$query=$this->db->query($sql);

			return $query->rows;

	}

	public function getagentpropertys($property_agent_id){
	$sql= "SELECT * FROM " . DB_PREFIX . "property p LEFT JOIN " . DB_PREFIX . "property_description ppd on (p.property_id=ppd.property_id) WHERE p.property_agent_id = '" . (int) $property_agent_id . "' AND ppd.language_id='" . $this->config->get('config_language_id') . "'";	
		$query=$this->db->query($sql);
		return $query->rows;

	}

	

	public function editCode($email, $code) {

		$this->db->query("UPDATE `" . DB_PREFIX . "property_agent` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

	}

	

	

	public function editPassword($email, $password) {

		$this->db->query("UPDATE " . DB_PREFIX . "property_agent SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

	}

	

	

	/*public function getAgentByEmail($email) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_agent WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");



		return $query->row;

	}*/

	public function getTotalAgentByEmail($email) {

		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "property_agent WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");



		return $query->row['total'];

	}

	

	

	

	

	public function getAgent($property_agent_id){

		$sql="select * from " . DB_PREFIX . "property_agent where 

		property_agent_id='".$property_agent_id."'";

		$query=$this->db->query($sql);

		return $query->row;

	}

	public function editAgent($property_agent_id,$data){

		$sql="update " . DB_PREFIX . "property_agent set agentname='".$this->db->escape($data['agentname'])."',	image='".$this->db->escape($data['image'])."',description='".$this->db->escape($data['description'])."',facebook='".$this->db->escape($data['facebook'])."',twitter='".$this->db->escape($data['twitter'])."',googleplus='".$this->db->escape($data['googleplus'])."',pinterest='".$this->db->escape($data['pinterest'])."',instagram='".$this->db->escape($data['instagram'])."',positions='".$this->db->escape($data['positions'])."',contact='".$this->db->escape($data['contact'])."',country_id='".(int) $data['country_id']."',pincode='".$this->db->escape($data['pincode'])."',	zone_id='".(int) $data['zone_id']."',address='".$this->db->escape($data['address'])."',city='".$this->db->escape($data['city'])."',date_modified=now() where property_agent_id='".$this->agent->getId()."'";
		$query = $this->db->query($sql);
	}

	public function getAgents($data){

		$sql="select * from " . DB_PREFIX . "property_agent where property_agent_id<>0  and approved=1";
		if(isset($data['filter_agentname'])){
			$sql .=" and agentname like '".$this->db->escape($data['filter_agentname'])."%'";

		}

		if(isset($data['filter_status'])){

			$sql .=" and status like '".$this->db->escape($data['filter_status'])."%'";

		}

		$sort_data = array(

			'agentname',

			'status'

		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){

			$sql .= " ORDER BY " . $data['sort'];

		}else{

			$sql .= " ORDER BY sort_order";

		}if (isset($data['order']) && ($data['order'] == 'DESC')){

			$sql .= " DESC";

		}else {

			$sql .= " ASC";

		}

		if(isset($data['start']) || isset($data['limit'])) {

			if ($data['start'] < 0) 

			{

				$data['start'] = 0;

			}

			if ($data['limit'] < 1) 

			{

				$data['limit'] = 20;

			}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];

			}

			$query = $this->db->query($sql);

			return $query->rows;	

	}

	public function getAgentByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_agent WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
		return $query->row;
	}
		

	public function getAgentstotal($data){

		$sql="select count(*) as total from " . DB_PREFIX . "property_agent where property_agent_id<>0";

		$query=$this->db->query($sql);

		return $query->row['total'];

	}

 }