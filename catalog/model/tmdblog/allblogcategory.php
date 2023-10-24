<?php
	class ModelTmdblogAllblogCategory extends Model {
		
		public function Allcategory($data=array()) {
			$sql = ("SELECT * FROM " . DB_PREFIX . "tmdblogcategory t LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description td ON (t.tmdblogcategory_id = td.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory_to_store t2s ON (t.tmdblogcategory_id = t2s.tmdblogcategory_id) WHERE td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND t.status = '1' ORDER BY t.sort_order, LCASE(td.name)");
			$query =$this->db->query($sql);
			
			return $query->rows;
		}
		
		public function getblogCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdblogcategory t LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description td ON (t.tmdblogcategory_id = td.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory_to_store t2s ON (t.tmdblogcategory_id = t2s.tmdblogcategory_id) WHERE t.parent_id = '" . (int)$parent_id . "' AND td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND t.status = '1' ORDER BY t.sort_order, LCASE(td.name)");

		return $query->rows;
	}
	
	
		
		public function getTotalblog($data=array()) {
			
			$sql = ("SELECT COUNT(DISTINCT a.blog_id) AS total FROM " . DB_PREFIX . "tmdblogcategory_path tp LEFT JOIN " . DB_PREFIX . "blog_to_tmdblogcategory  a2t ON (tp.tmdblogcategory_id = a2t.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "blog a ON (a2t.blog_id = a.blog_id) LEFT JOIN " . DB_PREFIX . "blog_description ad ON (a.blog_id = ad.blog_id) WHERE ad.language_id = '1' AND a.status = '1'");
			
			if (!empty($data['filter_tmdblogcategory_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND tp.path_id = '" . (int)$data['filter_tmdblogcategory_id'] . "'";
			} else {
				$sql .= " AND a2t.tmdblogcategory_id = '" . (int)$data['filter_tmdblogcategory_id'] . "'";
			}
			
		

		}
			
			$query =$this->db->query($sql);
			
			return $query->row['total'];
		}
		
		public function Blogcategories($tmdblogcategory_id) {
			$query = $this->db->query("SELECT * FROM  " . DB_PREFIX . "tmdblogcategory t LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description td ON (t.tmdblogcategory_id = td.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory_to_store t2s ON (t.tmdblogcategory_id = t2s.tmdblogcategory_id) WHERE t.tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "' ");
			
				
			return $query->row;
		}
		
		public function getblogcategory($tmdblogcategory_id) {
			$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "tmdblogcategory t LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description td ON (t.tmdblogcategory_id = td.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory_to_store t2s ON (t.tmdblogcategory_id = t2s.tmdblogcategory_id) WHERE t.tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "' AND td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND t.status = '1'");

			return $query->row;
		
		}
		
		public function getReatedpost($tmdblogcategory_id) {
			
			$sql = "SELECT * FROM " . DB_PREFIX . "blog_to_tmdblogcategory  a2s LEFT JOIN ". DB_PREFIX ."blog a ON (a2s.blog_id = a.blog_id) LEFT JOIN " . DB_PREFIX . "blog_description as ad on (a2s.blog_id = ad.blog_id)WHERE a.tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'";
			
			$query = $this->db->query($sql);	
			return $query->rows;
		}
		
	}
