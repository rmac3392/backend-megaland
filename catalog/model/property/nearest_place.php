<?php

class ModelPropertyNearestPlace extends Model{

	public function addnNearestPlace($data){

		echo $sql="INSERT INTO " . DB_PREFIX . "nearest_place set sort_order='".(int) $data['sort_order']."',image='". $data['image']."',status='".(int)$data['status']."', date_added=now()";

		$this->db->query($sql);

		$nearest_place_id=$this->db->getLastId();

		

	foreach ($data['nearest_placename'] as $language_id => $value){

			$this->db->query("INSERT INTO " . DB_PREFIX . "nearest_place_description SET nearest_place_id ='" . (int)$nearest_place_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name'])."'"); 

		}

		return $nearest_place_id;

	}



	



	public function getNearestPlaces($data){

		$sql="select * from " . DB_PREFIX . "nearest_place n left join " . DB_PREFIX . "nearest_place_description np on n.nearest_place_id=np.nearest_place_id where np.language_id='".$this->config->get('config_language_id')."'";

		 

		

		

		$sort_data = array(

				'name',

				'image',

		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data))

		{

			$sql .= " ORDER BY " . $data['sort'];

		} 

		else 

		{

			$sql .= " ORDER BY name";

		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) 

		{

			$sql .= " DESC";

		} 

		else 

		{

			$sql .= " ASC";

		}

		if (isset($data['start']) || isset($data['limit'])) 

		{

		if ($data['start'] < 0) 

		{

		$data['start'] = 0;

		}

		if ($data['limit'] < 1) 

		{

		$data['limit'] = 20;

		}

		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];

		}

		 $query=$this->db->query($sql);

		return $query->rows;		

	}	

	public function nearestplacedelete($nearest_place_id){

		$this->db->query("DELETE FROM " . DB_PREFIX . "nearest_place WHERE nearest_place_id = '" . (int)$nearest_place_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "nearest_place_description WHERE nearest_place_id = '" . (int)$nearest_place_id . "'");

		$this->cache->delete('nearest_place_id');

	}



	public function getNearestPlace($nearest_place_id){

		$sql="select * from " . DB_PREFIX . "nearest_place where nearest_place_id='".$nearest_place_id."'";

		$query=$this->db->query($sql);

		return $query->row;

	}

	

	public function getNearestPlaceName($nearest_place_id){

		$property_Nearest_place= array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."nearest_place_description WHERE nearest_place_id = '" .(int)$nearest_place_id . "'");

		foreach ($query->rows as $result){

			$property_Nearest_place[$result['language_id']] = array(

			'name'            => $result['name'],

			);

		}

	return $property_Nearest_place;

}



	public function editNearestPlace($nearest_place_id,$data){

		$sql="update " . DB_PREFIX . "nearest_place set sort_order='".(int)$data['sort_order']."',image='".$data['image']."',status='".(int)$data['status']."',date_modified=now() where nearest_place_id='".$nearest_place_id."'";

		$this->db->query($sql);

		$this->db->query("delete from " . DB_PREFIX . "nearest_place_description where  nearest_place_id = '" . (int)$nearest_place_id . "'");

		

	foreach ($data['nearest_placename'] as $language_id => $value){

		$this->db->query("INSERT INTO " . DB_PREFIX . "nearest_place_description SET nearest_place_id = '" . (int)$nearest_place_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

		}

	} 

	

	public function deleteNearestPlace($nearest_place_id){

		$this->db->query("DELETE FROM " . DB_PREFIX . "nearest_place WHERE nearest_place_id = '" . (int)$nearest_place_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "nearest_place_description WHERE nearest_place_id = '" . (int)$nearest_place_id . "'");

		$this->cache->delete('nearest_place_id');

	}

	

	 public function getTotalNearestplace() {

		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "nearest_place");



		return $query->row['total'];

	}	

	

}