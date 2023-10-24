<?php


class ModelMembershipPlans extends Model {


	public function addPlans($data) {


		


		$this->db->query("INSERT INTO " . DB_PREFIX . "plans SET  price = '" . (float)$data['price']. "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', number = '" . (int)$data['number'] . "', type = '" . (int)$data['type'] . "', date_modified = NOW(), date_added = NOW()");





		$plans_id = $this->db->getLastId();





		if (isset($data['image'])) {


			$this->db->query("UPDATE " . DB_PREFIX . "plans SET image = '" . $this->db->escape($data['image']) . "' WHERE plans_id = '" . (int)$plans_id . "'");


		}





		foreach ($data['plans_description'] as $language_id => $value) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "plans_description SET plans_id = '" . (int)$plans_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");


		}





		


		if (isset($data['keyword'])) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'plans_id=" . (int)$plans_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");


		}


		


		if (isset($data['plans_variation'])) {


			foreach ($data['plans_variation'] as $plans_variations) {


				if ($plans_variations['variation_id']) {


						$this->db->query("INSERT INTO " . DB_PREFIX . "plans_variation SET plans_id = '" . (int)$plans_id . "', variation_id = '" . (int)$plans_variations['variation_id'] . "'");


					


				}


			}


		}


		


		if (isset($data['plans_options'])) {


			foreach ($data['plans_options'] as $plans_options) {


				$this->db->query("INSERT INTO " . DB_PREFIX . "plans_options SET plans_id = '" . (int)$plans_id . "', title = '" . $this->db->escape($plans_options['title']) . "', price = '" . $this->db->escape($plans_options['price']) . "', sort_order = '" . (int)$plans_options['sort_order'] . "'");


			}


		}


		


		$this->cache->delete('plans');





		return $plans_id;


	}





	public function editPlans($plans_id, $data) {


	//	print_r($data); die();


		$this->db->query("UPDATE " . DB_PREFIX . "plans SET  price = '" . (float)$data['price']. "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "',number = '" . (int)$data['number'] . "', type = '" . (int)$data['type'] . "', date_modified = NOW() WHERE plans_id = '" . (int)$plans_id . "'");





		if (isset($data['image'])) {


			$this->db->query("UPDATE " . DB_PREFIX . "plans SET image = '" . $this->db->escape($data['image']) . "' WHERE plans_id = '" . (int)$plans_id . "'");


		}





		$this->db->query("DELETE FROM " . DB_PREFIX . "plans_description WHERE plans_id = '" . (int)$plans_id . "'");





		foreach ($data['plans_description'] as $language_id => $value) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "plans_description SET plans_id = '" . (int)$plans_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");


		}	





		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'plans_id=" . (int)$plans_id . "'");





		if ($data['keyword']) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'plans_id=" . (int)$plans_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");


		}


		


		$this->db->query("DELETE FROM " . DB_PREFIX . "plans_variation WHERE plans_id = '" . (int)$plans_id . "'");


		


		if (!empty($data['plans_variation'])) {


			foreach ($data['plans_variation'] as $plans_variation) {


				if ($plans_variation['variation_id']) {


					


						$this->db->query("INSERT INTO " . DB_PREFIX . "plans_variation SET plans_id = '" . (int)$plans_id . "', variation_id = '" . (int)$plans_variation['variation_id'] . "'");


					


				}


			}


		}


		


		$this->db->query("DELETE FROM " . DB_PREFIX . "plans_options WHERE plans_id = '" . (int)$plans_id . "'");


		


		if (isset($data['plans_options'])) {


			foreach ($data['plans_options'] as $plans_options) {


				$this->db->query("INSERT INTO " . DB_PREFIX . "plans_options SET plans_id = '" . (int)$plans_id . "', title = '" . $this->db->escape($plans_options['title']) . "', price = '" . $this->db->escape($plans_options['price']) . "', sort_order = '" . (int)$plans_options['sort_order'] . "'");


			}


		}


		


		$this->cache->delete('plans');


	}





	public function deletePlans($plans_id) {


	


		$this->db->query("DELETE FROM " . DB_PREFIX . "plans WHERE plans_id = '" . (int)$plans_id . "'");


		


		$this->db->query("DELETE FROM " . DB_PREFIX . "plans_description WHERE plans_id = '" . (int)$plans_id . "'");


		


		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'plans_id=" . (int)$plans_id . "'");


		$this->cache->delete('plans');


	}





	public function getPlans($plans_id) {


		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'plans_id=" . (int)$plans_id . "') AS keyword FROM " . DB_PREFIX . "plans WHERE plans_id = '" . (int)$plans_id . "'");





		return $query->row;


	}


	


	public function getPlansiesedit($plans_id) {


				$sql = "SELECT * FROM " . DB_PREFIX . "plans p LEFT JOIN " . DB_PREFIX . "plans_description pd ON (p.plans_id = pd.plans_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";


				


		


					$query=$this->db->query($sql);


					return $query->row;











				}


	public function getPlan($plans_id) {


		$sql = "SELECT * FROM " . DB_PREFIX . "plans p LEFT JOIN " . DB_PREFIX . "plans_description pd ON (p.plans_id = pd.plans_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' and p.plans_id='".$plans_id."' ";





		$query=$this->db->query($sql);


		return $query->row;











				}





	public function getPlansies($data = array()) {


		


			$sql = "SELECT * FROM " . DB_PREFIX . "plans p LEFT JOIN " . DB_PREFIX . "plans_description pd ON (p.plans_id = pd.plans_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";





			$sort_data = array(


				'pd.name',


				'p.sort_order'


			);





			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {


				$sql .= " ORDER BY " . $data['sort'];


			} else {


				$sql .= " ORDER BY pd.name";


			}





			if (isset($data['order']) && ($data['order'] == 'DESC')) {


				$sql .= " DESC";


			} else {


				$sql .= " ASC";


			}





			if (isset($data['start']) || isset($data['limit'])) {


				if ($data['start'] < 0) {


					$data['start'] = 0;


				}





				if ($data['limit'] < 1) {


					$data['limit'] = 20;


				}





				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];


			}





			$query = $this->db->query($sql);





			return $query->rows;


		


	}


	





	public function getPlansDescriptions($plans_id) {


		$plans_description_data = array();





		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "plans_description WHERE plans_id = '" . (int)$plans_id . "'");





		foreach ($query->rows as $result) {


			$plans_description_data[$result['language_id']] = array(


				'name'             => $result['name'],


				'description'      => $result['description']


			);


		}





		return $plans_description_data;


	}


	


	public function getTotalPlansies() {


		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "plans");





		return $query->row['total'];


	}	


	


	public function getPlansVariations($plans_id) {


		$plans_variation_data = array();





		$plans_variation_query = $this->db->query("SELECT variation_id FROM " . DB_PREFIX . "plans_variation WHERE plans_id = '" . (int)$plans_id . "' GROUP BY variation_id");





		foreach ($plans_variation_query->rows as $plans_variation) {


			$plans_variation_description_data = array();





			$plans_variation_description_data = $this->db->query("SELECT * FROM " . DB_PREFIX . "plans_variation WHERE plans_id = '" . (int)$plans_id . "' AND variation_id = '" . (int)$plans_variation['variation_id'] . "'");





			$plans_variation_data[] = array(


				'variation_id'                  => $plans_variation['variation_id'],


				'plans_variation_description' => $plans_variation_description_data


			);


		}





		return $plans_variation_data;


	}


	


	public function getPlansOptions($plans_id) {


		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "plans_options WHERE plans_id = '" . (int)$plans_id . "' ORDER BY sort_order ASC");





		return $query->rows;


	}


	


	


	


}


