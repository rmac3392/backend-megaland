<?php

class ModelPropertyFeature extends Model{

  public function addFeature($data){ 

		$sql="INSERT INTO " . DB_PREFIX . "feature set sort_order='".(int) $data['sort_order']."',image='". $data['image']."',status='".(int)$data['status']."', date_added=now()";

		$this->db->query($sql);

		$feature_id=$this->db->getLastId();

		foreach ($data['featurename'] as $language_id => $value){

			$this->db->query("INSERT INTO " . DB_PREFIX . "feature_description SET feature_id ='" . (int)$feature_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name'])."'"); 

		}

		return $feature_id;

	}

	public function getFeatures($data){

		$sql="select * from " . DB_PREFIX . "feature n left join " . DB_PREFIX . "feature_description np on n.feature_id=np.feature_id where np.language_id='".$this->config->get('config_language_id')."'";

		

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

	

	public function checkFeatures($property_id){

		$sql="select * from " . DB_PREFIX . "property_feature where property_id='".$property_id."'";

		$query=$this->db->query($sql);

		return $query->rows;

	}

	

	public function getFeature($feature_id){

		$sql="select * from " . DB_PREFIX . "feature where feature_id='".$feature_id."'";

		$query=$this->db->query($sql);

		return $query->row;

	}

	public function getFeatureName($feature_id){

		$property_feature_place= array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."feature_description WHERE feature_id = '" .(int)$feature_id . "'");

		foreach ($query->rows as $result){

		  $property_feature_place[$result['language_id']] = array(

			'name'            => $result['name'],

			);

		}

		return $property_feature_place;

	}	



	public function deleteFeature($feature_id){

		$this->db->query("DELETE FROM " . DB_PREFIX . "feature WHERE feature_id = '" . (int)$feature_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "feature_description WHERE feature_id = '" . (int)$feature_id . "'");

		$this->cache->delete('feature_id');

	}



	public function editFeature($feature_id,$data){

		$sql="update " . DB_PREFIX . "feature set sort_order='".(int)$data['sort_order']."',image='".$data['image']."',status='".(int)$data['status']."',date_modified=now() where feature_id='".$feature_id."'";

		$this->db->query($sql);

		$this->db->query("delete from " . DB_PREFIX . "feature_description where  feature_id = '" . (int)$feature_id . "'");



	foreach ($data['featurename'] as $language_id => $value){

	  $this->db->query("INSERT INTO " . DB_PREFIX . "feature_description SET feature_id = '" . (int)$feature_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

	 }

	}

  public function getTotalFeature() {

	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "feature");

		return $query->row['total'];

	}	



}