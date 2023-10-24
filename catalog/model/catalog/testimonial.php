<?php


class ModelCatalogtestimonial extends Model {


	public function addtestimonial($data){


	$query = $this->db->query("INSERT INTO " . DB_PREFIX . "testimonial set name = '".$data['name']."'  , country = '".$data['country']."', enquiry = '".$data['enquiry']."', image = '".$data['image']."', date = now()");


	}


	


	public function gettestimonial($data = array()){


	$query = $this->db->query("Select * FROM " . DB_PREFIX . "testimonial WHERE status = 1 LIMIT  " . (int)$data['start'] . "," . (int)$data['limit']."");


	


	return $query-> rows;


	


	}


	


	public function gettestimonials($data = array()){


	$query = $this->db->query("Select * FROM " . DB_PREFIX . "testimonial WHERE testimonial_id<>0");


	


	return $query-> rows;


	


	}


}


?>