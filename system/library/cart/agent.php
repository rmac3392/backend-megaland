<?php
namespace Cart;
class Agent{
	private $property_agent_id;
	private $agentname;
	private $email;
	private $contact;
	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['property_agent_id'])) {
			$property_agent_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_agent WHERE property_agent_id = '" . (int)$this->session->data['property_agent_id'] . "' AND status = '1'");
			if ($property_agent_query->num_rows) {
				$this->property_agent_id = $property_agent_query->row['property_agent_id'];
				$this->agentname = $property_agent_query->row['agentname'];
				$this->email = $property_agent_query->row['email'];
				$this->contact = $property_agent_query->row['contact'];
			} else {
				$this->logout();
			}
		}
	}
	public function login($email, $password, $override = false) {
		if ($override) {
			$property_agent_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_agent WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
		} else {
			$property_agent_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_agent WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
		}
		if ($property_agent_query->num_rows) {
			$this->session->data['property_agent_id'] = $property_agent_query->row['property_agent_id'];
			$this->property_agent_id = $property_agent_query->row['property_agent_id'];
			$this->agentname = $property_agent_query->row['agentname'];
			$this->email = $property_agent_query->row['email'];
			$this->contact = $property_agent_query->row['contact'];
			return true;
		} else {
			return false;
		}
	}
	public function logout() {
		unset($this->session->data['property_agent_id']);
		$this->property_agent_id = '';
		$this->agentname = '';
		$this->property_agent_group_id = '';
		$this->email = '';
		$this->contact = '';
	}
	public function isLogged() {
		return $this->property_agent_id;
	}
	public function getId() {
		return $this->property_agent_id;
	}
	public function getFirstName() {
		return $this->agentname;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getTelephone() {
		return $this->contact;
	}
	public function getNewsletter() {
		return $this->newsletter;
	}
}
