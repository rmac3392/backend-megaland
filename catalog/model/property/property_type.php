<?php

class Modelpropertypropertytype extends Model {



			public function addpropertytype($data) 

			{ 



				$sql="INSERT INTO " . DB_PREFIX . "property_type set

					sort_order='".(int) $data['sort_order']."',

						status='".(int)$data['status']."', date_added=now()";

							$this->db->query($sql);



						$property_type_id=$this->db->getLastId();





			foreach ($data['Property_description'] as $language_id => $value) {

					$this->db->query("INSERT INTO " . DB_PREFIX . "property_type_description SET property_type_id ='" . (int)$property_type_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name'])."',description='". $this->db->escape($value['description'])."'"); 



			}





			return $property_type_id;



			}





			public function getpropertytypeselect($data)

			{

						$sql="select * from " . DB_PREFIX . "property_type p left join " . DB_PREFIX . "property_type_description pd on p.property_type_id=pd.property_type_id where pd.language_id='".$this->config->get('config_language_id')."'";

							$query=$this->db->query($sql);

								return $query->rows;		

			}	

			

				public function propertytypeDelete($property_type_id) {

					$this->db->query("DELETE FROM " . DB_PREFIX . "property_type WHERE property_type_id = '" . (int)$property_type_id . "'");



					$this->db->query("DELETE FROM " . DB_PREFIX . "property_type_description WHERE property_type_id = '" . (int)$property_type_id . "'");



					$this->cache->delete('property_type_id');

					}

		

			

			

			public function getpropertytypeedit($property_type_id)

					{

					$sql="select * from " . DB_PREFIX . "property_type where property_type_id='".$property_type_id."'";

					$query=$this->db->query($sql);

					return $query->row;

				}



					

					public function propertytypedescription($property_type_id) {

						$property_descriptio_data = array();

             $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."property_type_description WHERE property_type_id = '" .(int)$property_type_id . "'");



					foreach ($query->rows as $result) {

						$property_descriptio_data[$result['language_id']] = array(

						'name'            => $result['name'],

						'description'      => $result['description'],



						);

					}



					return $property_descriptio_data;

					}

					

					

					

									

	public function propertytypeupdate($property_type_id,$data) {

		$sql="update " . DB_PREFIX . "property_type set

										sort_order='".(int)$data['sort_order']."',

										status='".(int)$data['status']."',date_modified=now() where property_type_id='".$property_type_id."'";

		               $this->db->query($sql);

	



		

		$this->db->query("delete from " . DB_PREFIX . "property_type_description where  property_type_id = '" . (int)$property_type_id . "'");

		

		

		foreach ($data['Property_description'] as $language_id => $value) {

			$this->db->query("INSERT INTO " . DB_PREFIX . "property_type_description SET property_type_id = '" . (int)$property_type_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',description  = '" . $this->db->escape($value['description']) . "'");

		}

		

		

	}

	

	

				

	}