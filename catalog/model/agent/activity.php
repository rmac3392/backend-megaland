<?php


class ModelAgentActivity extends Model {


	public function addActivity($key, $data) {


		if (isset($data['property_agent_id'])) {


			$property_agent_id = $data['property_agent_id'];


		} else {


			$property_agent_id = 0;


		}





		$this->db->query("INSERT INTO `" . DB_PREFIX . "property_agent` SET `property_agent_id` = '" . (int)$property_agent_id . "', `key` = '" . $this->db->escape($key) . "', `data` = '" . $this->db->escape(json_encode($data)) . "', `ip` = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', `date_added` = NOW()");


	}


}