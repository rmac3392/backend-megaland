<?php
class ModelCatalogGallery extends Model{
	public function getgallerys($data=array()){
		$sql = "SELECT * FROM " . DB_PREFIX . "album a LEFT JOIN " . DB_PREFIX . "album_description ad ON(a.album_id = ad.album_id) WHERE ad.language_id = '" .(int)$this->config->get('config_language_id')."' AND a.status=1";	

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

	public function getgallerysfooter($data){
		$sql = "SELECT * FROM " . DB_PREFIX . "album where album_id<>0";	
		$sort_data = array(
			'date_added',

		);


		$sql .= " ORDER BY  date_added DESC";


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


	


	public function getalbumname($data){


		$sql = "SELECT * FROM " . DB_PREFIX . "album  WHERE album_id<>0";	


		$query = $this->db->query($sql);


		return $query->rows;


	


	}


	


	public function getaldescription($album_id){


		$sql = "SELECT * FROM " . DB_PREFIX . "album_description  WHERE album_id='".$album_id."'";	


		$query = $this->db->query($sql);


		return $query->row;


	}


	


		


	public function getgallery($album_id){


		$sql = "SELECT * FROM " . DB_PREFIX . "album a LEFT JOIN " . DB_PREFIX . "album_description ad ON(a.album_id = ad.album_id) WHERE a.album_id = '" . (int)$album_id . "' AND ad.language_id = ".(int)$this->config->get('config_language_id')." AND a.status=1";	



		$query = $this->db->query($sql);


	


		return $query->rows;


	}


	


	public function getphotos($data){


		$sql = "SELECT * FROM " . DB_PREFIX . "album_photos a LEFT JOIN " . DB_PREFIX . "album_photo_description ad ON(a.album_photos_id = ad.album_photos_id) WHERE a.album_id = '".(int)$data['album_id']."' AND ad.language_id = '".(int)$this->config->get('config_language_id')."'  AND ad.language_id = '".(int)$this->config->get('config_language_id')."'";


		


		if(isset($data['start']) || isset($data['limit'])){


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


	


	public function getMultipleImages($album_photos_id){


		$sql = "SELECT * FROM " . DB_PREFIX . "album_photos WHERE album_photos_id = '". (int)$album_photos_id ."' ORDER BY sort_order ASC";


		


		$query = $this->db->query($sql);


			


		return $query->rows;


	}


	


	public function countImage($album_id){


		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "album_photos WHERE album_id = '".(int)$album_id."'");


		return $query->row['total'];


		


	}


	


	


	


	public function countalbumtotal(){


		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "album WHERE album_id<>0");


		return $query->row['total'];


	}


	


	


	public function getMainImage($album_photos_id){


		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "album_photos_image WHERE album_photos_id = '". (int)$album_photos_id ."' ORDER BY sort_order ASC LIMIT 0,1");


		return $query->row;


	}


}


?>