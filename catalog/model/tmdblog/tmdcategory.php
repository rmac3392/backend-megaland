<?php
class ModelTmdblogTmdcategory extends Model {
	

	public function getTmdlogcategory($tmdblogcategory_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "tmdblogcategory t LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description td ON (t.tmdblogcategory_id = td.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory_to_store t2s ON (t.tmdblogcategory_id = t2s.tmdblogcategory_id) WHERE t.tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "' AND td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND t.status = '1'");

		return $query->row;
	}

	
	public function getTmdlogcategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdblogcategory t LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description td ON (t.tmdblogcategory_id = td.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory_to_store t2s ON (t.tmdblogcategory_id = t2s.tmdblogcategory_id) WHERE t.parent_id = '" . (int)$parent_id . "' AND td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND t.status = '1' ORDER BY t.sort_order, LCASE(td.name)");

		return $query->rows;
	}
	
	
	
}
