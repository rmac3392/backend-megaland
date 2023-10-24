<?php
class ModelAgentMail extends Model {
		
	public  function getMailInfo($type){
		$query=$this->db->query("select * from " . DB_PREFIX . "mail m LEFT JOIN " . DB_PREFIX . "mail_language ml on(m.mail_id=ml.mail_id) where m.type='" .$type."'and ml.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		return $query->row;
	}
	
}