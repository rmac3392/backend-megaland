<?php


class ModelMembershipVariation extends Model {


	public function addVariation($data) {


		$this->db->query("INSERT INTO " . DB_PREFIX . "variation SET  sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");





		$variation_id = $this->db->getLastId();





		if (isset($data['image'])) {


			$this->db->query("UPDATE " . DB_PREFIX . "variation SET image = '" . $this->db->escape($data['image']) . "' WHERE variation_id = '" . (int)$variation_id . "'");


		}





		foreach ($data['variation_description'] as $language_id => $value) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "variation_description SET variation_id = '" . (int)$variation_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");


		}





		


		if (isset($data['keyword'])) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'variation_id=" . (int)$variation_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");


		}





		$this->cache->delete('variation');





		return $variation_id;


	}





	public function editVariation($variation_id, $data) {


		$this->db->query("UPDATE " . DB_PREFIX . "variation SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE variation_id = '" . (int)$variation_id . "'");





		if (isset($data['image'])) {


			$this->db->query("UPDATE " . DB_PREFIX . "variation SET image = '" . $this->db->escape($data['image']) . "' WHERE variation_id = '" . (int)$variation_id . "'");


		}





		$this->db->query("DELETE FROM " . DB_PREFIX . "variation_description WHERE variation_id = '" . (int)$variation_id . "'");





		foreach ($data['variation_description'] as $language_id => $value) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "variation_description SET variation_id = '" . (int)$variation_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");


		}	





		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'variation_id=" . (int)$variation_id . "'");





		if ($data['keyword']) {


			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'variation_id=" . (int)$variation_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");


		}





		$this->cache->delete('variation');


	}





	public function deleteVariation($variation_id) {


	


		$this->db->query("DELETE FROM " . DB_PREFIX . "variation WHERE variation_id = '" . (int)$variation_id . "'");


		


		$this->db->query("DELETE FROM " . DB_PREFIX . "variation_description WHERE variation_id = '" . (int)$variation_id . "'");


		


		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'variation_id=" . (int)$variation_id . "'");


		$this->cache->delete('variation');


	}





	public function getVariation($variation_id) {


		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'variation_id=" . (int)$variation_id . "') AS keyword FROM " . DB_PREFIX . "variation v left join " . DB_PREFIX . "variation_description vd on(v.variation_id = vd.variation_id) WHERE v.variation_id = '" . (int)$variation_id . "'");





		return $query->row;


	}





	public function getVariationies($data = array()) {


		


			$sql = "SELECT * FROM " . DB_PREFIX . "variation v LEFT JOIN " . DB_PREFIX . "variation_description vd ON (v.variation_id = vd.variation_id) WHERE vd.language_id = '" . (int)$this->config->get('config_language_id') . "'";





			$sort_data = array(


				'vd.name',


				'v.sort_order'


			);





			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {


				$sql .= " ORDER BY " . $data['sort'];


			} else {


				$sql .= " ORDER BY vd.name";


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





	public function getVariationDescriptions($variation_id) {


		$variation_description_data = array();





		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "variation_description WHERE variation_id = '" . (int)$variation_id . "'");





		foreach ($query->rows as $result) {


			$variation_description_data[$result['language_id']] = array(


				'name'             => $result['name'],


				'description'      => $result['description']


			);


		}





		return $variation_description_data;


	}


	


	public function getTotalVariationies() {


		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "variation");





		return $query->row['total'];


	}	


}


