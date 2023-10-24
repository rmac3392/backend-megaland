<?php
class ModelTmdblogBlog extends Model {
	
	public function updateViewed($blog_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "blog SET viewed = (viewed + 1) WHERE blog_id = '" . (int)$blog_id . "'");
	}	
	public function getBlog($blog_id) {		
		
		$query = $this->db->query("SELECT DISTINCT *, ad.name AS name, a.image, a.viewed, a.sort_order FROM " . DB_PREFIX . "blog a LEFT JOIN " . DB_PREFIX . "blog_description ad ON (a.blog_id = ad.blog_id) LEFT JOIN " . DB_PREFIX . "user u ON (a.user_id = u.user_id)  WHERE a.blog_id = '" . (int)$blog_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND a.status = '1'");

		if ($query->num_rows) {
			return array(
				'blog_id'       => $query->row['blog_id'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'meta_title'       => $query->row['meta_title'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'image'            => $query->row['image'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed'],
				'username'         => $query->row['username'],
				'user_id'          => $query->row['user_id'],
				'blogcoment'       => $query->row['blogcoment']
			);
		} else {
			return false;
		}		
		
	}
	
	public function getPopularBlog($limit) {		
		$post_data = array();
		$query = $this->db->query("SELECT blog_id FROM " . DB_PREFIX . "blog WHERE  date_added <= NOW() ORDER BY viewed DESC, date_added DESC LIMIT " . (int)$limit);
		
		foreach ($query->rows as $result) {
			$post_data[$result['blog_id']] = $this->getblog($result['blog_id']);
		}		
		return $post_data;		
	}	
	
	// New code 
	public function getBlogs($data = array()) {

	
	$sql = "SELECT * FROM " . DB_PREFIX . "blog a";

	$sql .= " LEFT JOIN " . DB_PREFIX . "blog_description ad ON (a.blog_id = ad.blog_id)";
		
		$sql .= " LEFT JOIN " . DB_PREFIX . "user u ON (a.user_id = u.user_id)";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " LEFT JOIN" . DB_PREFIX . "tmdblogcategory_path tp LEFT JOIN " . DB_PREFIX . "blog_to_tmdblogcategory a2t ON (ta.tmdblogcategory_id = a2t.tmdblogcategory_id)";
			} else {
				$sql .= "  LEFT JOIN " . DB_PREFIX . "blog_to_tmdblogcategory a2t ON (a.blog_id = a2t.blog_id)";
			}

			
		}
		$sql .="  WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND a.status = '1'";	
		
		
		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND tp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND a2t.tmdblogcategory_id = '" . (int)$data['filter_category_id'] . "'";
			}

		}
		
		

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "ad.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR ad.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "ad.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			$sql .= ")";
		}
		

		$sql .= " GROUP BY a.blog_id";

		$sort_data = array(
			'a.name',
			'a.sort_order',
			'a.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'td.name') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY a.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(ad.name) DESC";
		} else {
			$sql .= " ASC, LCASE(ad.name) ASC";
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

		$blog_data = array();
		
		$query = $this->db->query($sql);
		
		foreach ($query->rows as $result) {
			$blog_data[$result['blog_id']] = $this->getblog($result['blog_id']);
		}

		return $blog_data;
	
	
	}
	
	public function getTotalblogs($data = array()) {

	
	$sql = "SELECT COUNT(DISTINCT a.blog_id) AS total FROM " . DB_PREFIX . "blog a";

		

		$sql .= " LEFT JOIN " . DB_PREFIX . "blog_description ad ON (a.blog_id = ad.blog_id)";
		
		//$sql .= " LEFT JOIN " . DB_PREFIX . "user u ON (a.user_id = u.user_id)";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " LEFT JOIN" . DB_PREFIX . "tmdblogcategory_path tp LEFT JOIN " . DB_PREFIX . "blog_to_tmdblogcategory a2t ON (ta.tmdblogcategory_id = a2t.tmdblogcategory_id)";
			} else {
				$sql .= "  LEFT JOIN " . DB_PREFIX . "blog_to_tmdblogcategory a2t ON (a.blog_id = a2t.blog_id)";
			}
		}
		
		$sql .="  WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND a.status = '1'";	
		
		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND tp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND a2t.tmdblogcategory_id = '" . (int)$data['filter_category_id'] . "'";
			}

		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "ad.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR ad.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "ad.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			$sql .= ")";
		}

		$sort_data = array(
			'a.name',
			'a.sort_order',
			'a.date_added'
		);
	
		$query = $this->db->query($sql);
		return $query->row['total'];	

		
	}
	// New code 
	public function getcomments($blog_id){
	
	$query = $this->db->query("SELECT *,b.image as commimage, c.agentname FROM ". DB_PREFIX ."blogcomment as b left join " . DB_PREFIX . "blog as a on(b.blog_id = a.blog_id)  left join " . DB_PREFIX . "user as u on(a.user_id = u.user_id) Left Join ". DB_PREFIX ."property_agent as c on (b.property_agent_id = c.property_agent_id) WHERE a.blog_id = '". $blog_id. "'  ORDER BY b.date_added   DESC");	
	 
	return $query ->rows;
	}
	
	public function Addblogcomment($data){
	$property_agent_id=$this->agent->getId();
	
	$this->db->query("INSERT INTO " . DB_PREFIX . "blogcomment set comment = '". $this->db->escape($data['comment']). "', blog_id = '". (int)($data['blog_id']). "', image = '". ($data['image']). "', property_agent_id = '". $property_agent_id. "', status = '1', date_added = NOW()");		
	}
	
	public function Updatecomment($blog_id) {
	
	$query = $this->db->query("SELECT COUNT(*) as total FROM ". DB_PREFIX ."blogcomment  WHERE blog_id = '". $blog_id. "'");	
	
	return $query ->row['total'];
		
	}
	
	public function getcommentid($blog_id) {
	$comment_id = $this->db->getLastId();
	
	$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."blogcomment where blog_id = '".$blog_id."'");	
	//print_r($query ->row); die();
	return $query ->row;
	
	
	}
	
	public function getLatestcomments($limit) {		
		
	$sql = "SELECT b.comment, a.blog_id, a.viewed,a.date_added,b.property_agent_id, c.agentname FROM ". DB_PREFIX ."blogcomment b left Join ".DB_PREFIX."blog as a on(b.blog_id = a.blog_id) LEFT JOIN ". DB_PREFIX ."property_agent as c ON(b.property_agent_id = c.property_agent_id) WHERE a.date_added <= NOW() ORDER BY a.viewed DESC, a.date_added DESC LIMIT " . (int)$limit;	
	$query = $this->db->query($sql);	
	return $query->rows;
	
	}
	
	public function getLatesttags() {		
	$sql = "SELECT * FROM ". DB_PREFIX ."blog b left Join ".DB_PREFIX."blog_description as bd on(b.blog_id = bd.blog_id) WHERE b.date_added <= NOW() AND bd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY b.viewed DESC, b.date_added DESC LIMIT 0,10";	
	$query = $this->db->query($sql);	
	return $query->rows;
	
	}
	
	
	
	
}