<?php


 class ModelCatalogSearch extends Model {


  public function getCategories($data = array()) {


		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, cdp.property_id, c1.sort_order FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) LEFT JOIN " . DB_PREFIX . "property_to_category cdp ON(c1.category_id = cdp.category_id)WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";





		if (!empty($data['filter_name'])) {


			$sql .= " AND cd2.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";


		}


		


		if (!empty($data['parent_id'])){


			$sql .= " AND c1.parent_id='" . $this->db->escape($data['parent_id']) . "'";


		}





		$sql .= " GROUP BY cp.category_id";





		$sort_data = array(


			'name',


			'sort_order'


		);





		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {


			$sql .= " ORDER BY " . $data['sort'];


		} else {


			$sql .= " ORDER BY sort_order";


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


	


	 


	


}


	


	?>