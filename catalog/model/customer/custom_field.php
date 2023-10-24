<?php


class ModelCustomerCustomField extends Model {


	public function addCustomField($data) {


		$this->db->query("INSERT INTO `" . DB_PREFIX . "custom_field` SET type = '" . $this->db->escape($data['type']) . "', value = '" . $this->db->escape($data['value']) . "', validation = '" . $this->db->escape($data['validation']) . "',status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "'");





		$custom_field_id = $this->db->getLastId();





		foreach ($data['custom_field_description'] as $language_id => $value) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_description SET custom_field_id = '" . (int)$custom_field_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");


		}





		if (isset($data['custom_field_customer_group'])) {


			foreach ($data['custom_field_customer_group'] as $custom_field_customer_group) {


				if (isset($custom_field_customer_group['customer_group_id'])) {


					$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_customer_group SET custom_field_id = '" . (int)$custom_field_id . "', customer_group_id = '" . (int)$custom_field_customer_group['customer_group_id'] . "', required = '" . (int)(isset($custom_field_customer_group['required']) ? 1 : 0) . "'");


				}


			}


		}





		if (isset($data['custom_field_value'])) {


			foreach ($data['custom_field_value'] as $custom_field_value) {


				$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_value SET custom_field_id = '" . (int)$custom_field_id . "', sort_order = '" . (int)$custom_field_value['sort_order'] . "'");





				$custom_field_value_id = $this->db->getLastId();





				foreach ($custom_field_value['custom_field_value_description'] as $language_id => $custom_field_value_description) {


					$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_value_description SET custom_field_value_id = '" . (int)$custom_field_value_id . "', language_id = '" . (int)$language_id . "', custom_field_id = '" . (int)$custom_field_id . "', name = '" . $this->db->escape($custom_field_value_description['name']) . "'");


				}


			}


		}


		


		return $custom_field_id;


	}





	public function editCustomField($custom_field_id, $data) {


		$this->db->query("UPDATE `" . DB_PREFIX . "custom_field` SET type = '" . $this->db->escape($data['type']) . "', value = '" . $this->db->escape($data['value']) . "', validation = '" . $this->db->escape($data['validation']) . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE custom_field_id = '" . (int)$custom_field_id . "'");





		$this->db->query("DELETE FROM " . DB_PREFIX . "custom_field_description WHERE custom_field_id = '" . (int)$custom_field_id . "'");





		foreach ($data['custom_field_description'] as $language_id => $value) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_description SET custom_field_id = '" . (int)$custom_field_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");


		}





		$this->db->query("DELETE FROM " . DB_PREFIX . "custom_field_customer_group WHERE custom_field_id = '" . (int)$custom_field_id . "'");





		if (isset($data['custom_field_customer_group'])) {


			foreach ($data['custom_field_customer_group'] as $custom_field_customer_group) {


				if (isset($custom_field_customer_group['customer_group_id'])) {


					$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_customer_group SET custom_field_id = '" . (int)$custom_field_id . "', customer_group_id = '" . (int)$custom_field_customer_group['customer_group_id'] . "', required = '" . (int)(isset($custom_field_customer_group['required']) ? 1 : 0) . "'");


				}


			}


		}





		$this->db->query("DELETE FROM " . DB_PREFIX . "custom_field_value WHERE custom_field_id = '" . (int)$custom_field_id . "'");


		$this->db->query("DELETE FROM " . DB_PREFIX . "custom_field_value_description WHERE custom_field_id = '" . (int)$custom_field_id . "'");





		if (isset($data['custom_field_value'])) {


			foreach ($data['custom_field_value'] as $custom_field_value) {


				if ($custom_field_value['custom_field_value_id']) {


					$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_value SET custom_field_value_id = '" . (int)$custom_field_value['custom_field_value_id'] . "', custom_field_id = '" . (int)$custom_field_id . "', sort_order = '" . (int)$custom_field_value['sort_order'] . "'");


				} else {


					$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_value SET custom_field_id = '" . (int)$custom_field_id . "', sort_order = '" . (int)$custom_field_value['sort_order'] . "'");


				}





				$custom_field_value_id = $this->db->getLastId();





				foreach ($custom_field_value['custom_field_value_description'] as $language_id => $custom_field_value_description) {


					$this->db->query("INSERT INTO " . DB_PREFIX . "custom_field_value_description SET custom_field_value_id = '" . (int)$custom_field_value_id . "', language_id = '" . (int)$language_id . "', custom_field_id = '" . (int)$custom_field_id . "', name = '" . $this->db->escape($custom_field_value_description['name']) . "'");


				}


			}


		}


	}





	public function deleteCustomField($custom_field_id) {


		$this->db->query("DELETE FROM `" . DB_PREFIX . "custom_field` WHERE custom_field_id = '" . (int)$custom_field_id . "'");


		$this->db->query("DELETE FROM `" . DB_PREFIX . "custom_field_description` WHERE custom_field_id = '" . (int)$custom_field_id . "'");


		$this->db->query("DELETE FROM `" . DB_PREFIX . "custom_field_customer_group` WHERE custom_field_id = '" . (int)$custom_field_id . "'");


		$this->db->query("DELETE FROM `" . DB_PREFIX . "custom_field_value` WHERE custom_field_id = '" . (int)$custom_field_id . "'");


		$this->db->query("DELETE FROM `" . DB_PREFIX . "custom_field_value_description` WHERE custom_field_id = '" . (int)$custom_field_id . "'");


	}





	public function getCustomField($custom_field_id) {


		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field` cf LEFT JOIN " . DB_PREFIX . "custom_field_description cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cf.custom_field_id = '" . (int)$custom_field_id . "' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "'");





		return $query->row;


	}





	





	public function getCustomFieldDescriptionsnew($custom_field_id) {

	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_description WHERE custom_field_id = '" . (int)$custom_field_id . "'");
     return $query->rows;
	}
	
	public function getCustomFieldDescriptions($custom_field_id) {


		$custom_field_data = array();





		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_description WHERE custom_field_id = '" . (int)$custom_field_id . "'");





		foreach ($query->rows as $result) {


			$custom_field_data[$result['language_id']] = array('name' => $result['name']);


		}





		return $custom_field_data;


	}


	


	public function getCustomFieldValue($custom_field_value_id) {


		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value cfv LEFT JOIN " . DB_PREFIX . "custom_field_value_description cfvd ON (cfv.custom_field_value_id = cfvd.custom_field_value_id) WHERE cfv.custom_field_value_id = '" . (int)$custom_field_value_id . "' AND cfvd.language_id = '" . (int)$this->config->get('config_language_id') . "'");





		return $query->row;


	}


	


	public function getCustomFieldValues($custom_field_id) {


		$custom_field_value_data = array();





		$custom_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value cfv LEFT JOIN " . DB_PREFIX . "custom_field_value_description cfvd ON (cfv.custom_field_value_id = cfvd.custom_field_value_id) WHERE cfv.custom_field_id = '" . (int)$custom_field_id . "' AND cfvd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cfv.sort_order ASC");





		foreach ($custom_field_value_query->rows as $custom_field_value) {


			$custom_field_value_data[$custom_field_value['custom_field_value_id']] = array(


				'custom_field_value_id' => $custom_field_value['custom_field_value_id'],


				'name'                  => $custom_field_value['name']


			);


		}





		return $custom_field_value_data;


	}


	


	public function getCustomFieldCustomerGroups($custom_field_id) {


		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field_customer_group` WHERE custom_field_id = '" . (int)$custom_field_id . "'");





		return $query->rows;


	}





	public function getCustomFieldValueDescriptions($custom_field_id) {


		$custom_field_value_data = array();





		$custom_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value WHERE custom_field_id = '" . (int)$custom_field_id . "'");





		foreach ($custom_field_value_query->rows as $custom_field_value) {


			$custom_field_value_description_data = array();





			$custom_field_value_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value_description WHERE custom_field_value_id = '" . (int)$custom_field_value['custom_field_value_id'] . "'");





			foreach ($custom_field_value_description_query->rows as $custom_field_value_description) {


				$custom_field_value_description_data[$custom_field_value_description['language_id']] = array('name' => $custom_field_value_description['name']);


			}





			$custom_field_value_data[] = array(


				'custom_field_value_id'          => $custom_field_value['custom_field_value_id'],


				'custom_field_value_description' => $custom_field_value_description_data,


				'sort_order'                     => $custom_field_value['sort_order']


			);


		}





		return $custom_field_value_data;


	}





	public function getTotalCustomFields() {


		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "custom_field`");





		return $query->row['total'];


	}


	public function getCustomFields($customer_group_id = 0) {
		$custom_field_data = array();

		if (!$customer_group_id) {
			$custom_field_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field` cf LEFT JOIN `" . DB_PREFIX . "custom_field_description` cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cf.status = '1' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cf.status = '1' ORDER BY cf.sort_order ASC");
		} else {
			$custom_field_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field_customer_group` cfcg LEFT JOIN `" . DB_PREFIX . "custom_field` cf ON (cfcg.custom_field_id = cf.custom_field_id) LEFT JOIN `" . DB_PREFIX . "custom_field_description` cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cf.status = '1' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cfcg.customer_group_id = '" . (int)$customer_group_id . "' ORDER BY cf.sort_order ASC");
		}

		foreach ($custom_field_query->rows as $custom_field) {
			$custom_field_value_data = array();

			if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio' || $custom_field['type'] == 'checkbox') {
				$custom_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value cfv LEFT JOIN " . DB_PREFIX . "custom_field_value_description cfvd ON (cfv.custom_field_value_id = cfvd.custom_field_value_id) WHERE cfv.custom_field_id = '" . (int)$custom_field['custom_field_id'] . "' AND cfvd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cfv.sort_order ASC");

				foreach ($custom_field_value_query->rows as $custom_field_value) {
					$custom_field_value_data[] = array(
						'custom_field_value_id' => $custom_field_value['custom_field_value_id'],
						'name'                  => $custom_field_value['name']
					);
				}
			}

			$custom_field_data[] = array(
				'custom_field_id'    => $custom_field['custom_field_id'],
				'custom_field_value' => $custom_field_value_data,
				'name'               => $custom_field['name'],
				'type'               => $custom_field['type'],
				'value'              => $custom_field['value'],
				'validation'         => $custom_field['validation'],
				'location'           => $custom_field['location'],
				'required'           => empty($custom_field['required']) || $custom_field['required'] == 0 ? false : true,
				'sort_order'         => $custom_field['sort_order']
			);
		}

		return $custom_field_data;
	}


}