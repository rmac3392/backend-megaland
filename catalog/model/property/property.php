<?php
class ModelPropertyProperty extends Model{
 public function addProperty($data){
		///input
		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

	    $this->load->model('customer/custom_field');
		$customer_group_info = $this->model_customer_custom_field->getCustomField($customer_group_id);

		$sql= $this->db->query("INSERT INTO " . DB_PREFIX . "property set  area_type='" . $data['area_type'] . "',image='" . $data['image_thumb'] . "',video='" . $data['video'] . "',country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',city='" . $data['city'] . "',pincode='" . $data['pincode'] ."',local_area='" . $data['local_area'] ."',latitude='" . $data['latitude'] . "',longitude='" . $data['longitude'] . "',neighborhood='" . $data['neighborhood'] . "',area='" .(int) $data['area'] . "',bedrooms='" .(int) $data['bedrooms'] ."',bathrooms='" .(int) $data['bathrooms'] ."',roomcount='" .(int) $data['roomcount'] ."',Parkingspaces='" .(int) $data['Parkingspaces'] ."',builtin='" .(int) $data['builtin'] ."',price='" . (int) $data['price'] ."',property_status_id='" . (int) $data['property_status_id'] . "',property_agent_id='" . $this->agent->getId() . "',sort_order='" . (int) $data['sort_order'] . "',custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "',status='" . (int) $data['status'] . "',date_added=now()");

		$property_id = $this->db->getLastId();

		foreach ($data['Property_description'] as $language_id => $value){

			$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_description SET property_id ='" . (int) $property_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',description='" . $this->db->escape($value['description']) . "',meta_title='" . $this->db->escape($value['meta_title']) . "',meta_description='" . $this->db->escape($value['meta_description']) . "',meta_keyword='" . $this->db->escape($value['meta_keyword']) . "',tag='" . $this->db->escape($value['tag']) . "'");

		}

		

		if($data['uploader_count']) {

				$uploader_count = $data['uploader_count']-1;

				for($i = 0; $i<=$uploader_count; $i++){

					if(isset($data['uploader_'.$i.'_tmpname']) && trim($data['uploader_'.$i.'_status'])== 'done') {

						$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_images SET property_id = '" . (int) $property_id . "', image = '" . $this->db->escape('upload/'.$data['uploader_'.$i.'_tmpname']) . "'");

					}

				}

		}

		

		if (isset($data['images_tab'])){

			foreach ($data['images_tab'] as $images_tab){

				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_images SET property_id = '" . (int) $property_id . "',image = '" . $this->db->escape($images_tab['image']) . "', title = '" . $this->db->escape($images_tab['title']) . "', alt = '" . $this->db->escape($images_tab['alt']) . "'");

			}

		}

		if (isset($data['features'])){

			foreach ($data['features'] as $feature_id){

				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_feature SET property_id = '" . (int) $property_id . "',feature_id = '" . (int)$feature_id . "'");

			}

		}

		if (!empty($data['nearestplace'])){

			foreach ($data['nearestplace'] as $key=>$value){

				if(!empty($value)){

					$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_neareast_place SET property_id = '" . (int) $property_id . "',nearest_place_id='" . $this->db->escape($key) . "',destinies='" . $this->db->escape($value) ."'");

				}

			}

		}

	

		if (isset($data['category_id'])){
			foreach ($data['category_id'] as $category_id){
				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_to_category SET property_id = '" . (int) $property_id . "',category_id='" . $category_id . "'");

			}

		}

	/* Mail For Admin code Start getAgentemail */			
		$this->load->model('agent/mail');
		$this->load->model('property/property');
		$this->load->model('agent/agent');

		 $propertyname=$data['Property_description'];

		 $namepropert=$propertyname[$this->config->get('config_language_id')]['name'];

	
		$agentname_info = $this->agent->getId();

		$agentinfo=$this->model_property_property->getAgentemail($agentname_info);
		
		if(isset($agentinfo['agentname'])) {
				$agentname = $agentinfo['agentname'];
			} else {
				$agentname='';
			}

		

			if(isset($agentinfo['email'])) {
				$emails = $agentinfo['email'];
			} else {
				$emails='';
			}

			if(isset($agentinfo['contact'])) {
				$contact = $agentinfo['contact'];
			} else {
				$contact='';
			}

			$this->load->model('localisation/country');
			$country_info = $this->model_localisation_country->getCountry($data['country_id']);
			if(isset($country_info['name'])) {
				$countryname = $country_info['name'];
			} else {
				$countryname='';
			}

			$this->load->model('localisation/zone');
			$zone_info = $this->model_localisation_zone->getZone($data['zone_id']);
			if(isset($zone_info['name'])) {
				$zonename = $zone_info['name'];
			} else {
				$zonename='';
			}

		
		$type = 'agent_add_property_admin_mail';
		$mailinfo = $this->model_agent_mail->getMailInfo($type);
		
		if(!empty($mailinfo['message'])){
		if(isset($mailinfo['type'])){
			$find = array(
				'{agentname}',
				'{emails}',		
				'{contact}',									
				'{country_id}',									
				'{zone_id}',									
				'{propertyname}',									
			);
			
			 $replace = array(
				'agentname'	=> $agentname,
				'emails'	=> $emails,
				'contact'	=> $contact,
				'country_id'=> $countryname,
				'zone_id'	    => $zonename,
				'propertyname'	=>$namepropert
			);
			$subject = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['subject']))));
			$message = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['message']))));
			
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
		}
	}

		// Send to additional alert emails
			$emails = explode(',', $this->config->get('config_mail_alert_email'));

			foreach ($emails as $email) {
				if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
			
		/* Mail For Admin code End */

		return $property_id;

	}

	public function getAgent(){

		$sql = "select * from " . DB_PREFIX . "property_agent where property_agent_id='" . $this->agent->getId() . "'";

		$query = $this->db->query($sql);

		return $query->rows;

	}

	public function addEnquiry($data,$property_agent_id){

		$sql="INSERT INTO " . DB_PREFIX . "property_enquiry  set description='".$this->db->escape($data['description'])."',name='".$this->db->escape($data['nameagent'])."',

		email='".$this->db->escape($data['emailagent'])."',property_id='".(int) $data['property_id']."',property_agent_id='".(int) $property_agent_id."',date_added=now()";

		$this->db->query($sql);

	}

	

	public function addContact($data){

		$sql="INSERT INTO " . DB_PREFIX . "property_contact  set name='".$this->db->escape($data['name'])."',email='".$this->db->escape($data['email'])."', description='".$this->db->escape($data['description'])."',date_added=now()";

		$this->db->query($sql);

	}

		

	public function getNearestplaceid($property_id,$nearest_place_id){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_neareast_place  WHERE property_id = '" .$property_id . "'and nearest_place_id='".$nearest_place_id."'");

		if(isset($query->row['destinies'])){

			return $query->row['destinies'];

		}else{

			return '';

		}

	}

	

	

	public function getPropertyName($property_id){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_description WHERE property_id = '" . (int) $property_id . "'");

		return $query->row;

	}

//related properties start
	public function getrelatedPropertyName($property_id){

		$sql= "SELECT * FROM " . DB_PREFIX . "property p LEFT JOIN " . DB_PREFIX . "property_description ppd on (p.property_id=ppd.property_id) WHERE p.property_id = '" . (int) $property_id . "' AND ppd.language_id='" . $this->config->get('config_language_id') . "'";	
		$query = $this->db->query($sql);
		return $query->row;

	}
	public function getrelatedcategory($property_id){

		$query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "property_to_category WHERE property_id = '" . (int) $property_id . "'");

		return $query->row;

	}
	public function getrelatedproperties($category_id, $property_id){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_to_category WHERE category_id = '" . (int) $category_id . "' AND property_id != '" . (int) $property_id . "' limit 3");

		return $query->rows;

	}	

		
//related properties end
	public function getPropertys($data){
		
		$sql= "SELECT *, ppd.name as propetyname FROM " . DB_PREFIX . "property p LEFT JOIN " . DB_PREFIX . "property_description ppd on (p.property_id=ppd.property_id) ";
		
		$sql .=" LEFT JOIN " . DB_PREFIX . "property_status ps on (p.property_status_id = ps.property_status_id) ";

       
	
		if(isset($data['filter_features'])){
			$sql .=" LEFT JOIN " . DB_PREFIX ."property_feature pf on(p.property_id = pf.property_id) ";
		}

		if(!empty($data['filter_propertycategory'])){
			$sql .="LEFT JOIN " . DB_PREFIX ."property_to_category pc on(p.property_id = pc.property_id)  LEFT JOIN " . DB_PREFIX ."category_description pcd on(pc.category_id = pcd.category_id) ";
		}

		if (!empty($data['filter_propertystatus'])) {
			$sql .= " AND p.property_status_id='" . $this->db->escape($data['filter_propertystatus']) . "'";
		}

		$sql .="WHERE p.property_id<>0 and ppd.language_id = '" . (int)$this->config->get('config_language_id') . "' and ps.language_id = '" . (int)$this->config->get('config_language_id') . "' and p.approved='1'";							
	
		if (!empty($data['filter_propertycategory'])) {
			$sql .= " AND pc.category_id='" . $this->db->escape($data['filter_propertycategory']) . "' and pcd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		} 

		if (!empty($data['filter_city'])) {
			$sql .= " AND p.city LIKE '" . $this->db->escape($data['filter_city']) . "%'";
		} 

		if (!empty($data['filter_address'])) {
			$sql .= " AND p.local_area LIKE '" . $this->db->escape($data['filter_address']) . "%'";
		} 


		if (!empty($data['filter_neighborhood'])) {
			$sql .= " AND p.neighborhood LIKE '" . $this->db->escape($data['filter_neighborhood']) . "%'";
		} 

		if (!empty($data['filter_zipcode'])){
			$sql .= "AND p.pincode like '" .$this->db->escape($data['filter_zipcode']) . "%'";
		}

		if (!empty($data['filter_country_id'])){
			$sql .= "AND p.country_id like '" .$this->db->escape($data['filter_country_id']) . "%'";
		}

		
		if (!empty($data['filter_zone_id'])){
			$sql .= "AND p.zone_id like '" .$this->db->escape($data['filter_zone_id']) . "%'";
		}

		
		if (!empty($data['agent_id'])){
			$sql .= " and p.property_agent_id='".$data['agent_id']."'";
		}

		if (!empty($data['filter_name'])){
			$sql .= " and ppd.name like '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_status'])){
			$sql .= " and p.status like '" . $this->db->escape($data['filter_status']) . "%'";
		}

		if (!empty($data['filter_price_from'])){
			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_from']) . "%'";
		}

		if (!empty($data['filter_price_to'])){
			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_to']) . "%'";
		}

		if(isset($data['range_from']) && !empty($data['range_to'])){
			$sql .= " and p.price>='".$data['range_from']."' and  p.price<='".$data['range_to']."'";
		}

		if(isset($data['area_from']) && !empty($data['area_to'])){
			$sql .= " and p.area>='".$data['area_from']."' and  p.area<='".$data['area_to']."'";
		}

		
		if (!empty($data['filter_bed_rooms'])){
			$sql .= "AND p.bedrooms like '" .$this->db->escape($data['filter_bed_rooms']) . "%'";
		}

		
		if (!empty($data['filter_bath_rooms'])){
			$sql .= "AND p.bathrooms like '" .$this->db->escape($data['filter_bath_rooms']) . "%'";
		}

		$sort_data = array( 

			'ppd.name',
			'p.status',
			'p.date_added',
			'p.property_status_id',
			'p.price',

		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){
			$sql .= " ORDER BY " . $data['sort'];
		}else{
			$sql .= " ORDER BY p.date_added";}
		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		}else {
			$sql .= " DESC";
		}

		if (isset($data['start']) || isset($data['limit'])){

			if ($data['start'] < 0){
				$data['start'] = 0;
			}

			if ($data['limit'] < 1){
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];

		}

		//echo $sql;
	   $query = $this->db->query($sql);
		return $query->rows;

	}

	

	public function getProperty($property_id){

		$sql="select * from " . DB_PREFIX . "property p left join " . DB_PREFIX . "property_description ppd on p.property_id=ppd.property_id where ppd.language_id='" . $this->config->get('config_language_id') . "' and p.property_id = '" .$property_id ."' and p.approved=1";

		$query = $this->db->query($sql);

		return $query->row;

	}

		

	public function deleteProperty($property_id){

		$this->db->query("DELETE FROM " . DB_PREFIX . "property WHERE property_id = '" . (int)$property_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "property_description WHERE property_id = '" . (int)$property_id . "'");

		$this->cache->delete('property');

	}

	public function getPropertyEdit($property_id){

		$sql = "select * from " . DB_PREFIX . "property where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->row;

	}

	public function getpropertyunits(){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_unit WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' and property_unit_id<>0");
		return $query->rows;

	}


	public function getPropertyDescription($property_id){

		$property_descriptio_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_description WHERE property_id = '" . (int) $property_id . "'");

		foreach ($query->rows as $result){

			$property_descriptio_data[$result['language_id']] = array(

				'name' => $result['name'],

				'description' => $result['description'],

				'meta_title' => $result['meta_title'],

				'meta_description' => $result['meta_description'],

				'meta_keyword' => $result['meta_keyword'],

				'tag' => $result['tag']

			);

		}

		return $property_descriptio_data;

	}



	public function getPropertyImages($property_id){

		$sql = "select * from " . DB_PREFIX . "property_images where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->rows;

	}

	
public function getPropertyStatus($property_status_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_status WHERE property_status_id = '" . (int) $property_status_id . "' and language_id='" . $this->config->get('config_language_id') . "'");
		return $query->row;
	}
	

	public function getFeaturesImage($data){

		$sql="select * from " . DB_PREFIX . "feature n left join " . DB_PREFIX . "feature_description np on n.feature_id=np.feature_id where np.language_id='".$this->config->get('config_language_id')."'";

		$query=$this->db->query($sql);

		return $query->rows;

	}



	public function getNearestImage($data) {

		$sql="select * from " . DB_PREFIX . "nearest_place n left join " . DB_PREFIX . "nearest_place_description np on n.nearest_place_id=np.nearest_place_id where np.language_id='".$this->config->get('config_language_id')."'";

		$query=$this->db->query($sql);

		return $query->rows;

	}

	

	

	public function getpropertycategory($property_id){

		$sql = "select * from " . DB_PREFIX . "property_to_category where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->rows;

	}

	public function getpropertycategoryid($property_id){

		$category_id = array();

		$sql   = "select * from " . DB_PREFIX . "property_to_category where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		foreach ($query->rows as $result){

			$category_id[] = $result['category_id'];

		}

		return $category_id;

	}

	

	public function getpropertyneareastplace($property_id){

		$sql = "select * from " . DB_PREFIX . "property_neareast_place where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->rows;

	}

	

	

	public function getpropertytocategory($property_id){

		$sql = "select * from " . DB_PREFIX . "property_to_category where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->row;

	} 



	



	public function getproperfeature($property_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "feature f LEFT JOIN " . DB_PREFIX . "feature_description fd ON (f.feature_id = fd.feature_id) LEFT JOIN " . DB_PREFIX . "property_feature pf ON (f.feature_id = pf.feature_id) where property_id='" . $property_id . "' and fd.language_id = '" . (int)$this->config->get('config_language_id') . "' limit 3");

		return $query->rows;

	}
	

	public function getNeareastplace($property_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nearest_place np LEFT JOIN " . DB_PREFIX . "nearest_place_description npd ON (np.nearest_place_id = npd.nearest_place_id) LEFT JOIN " . DB_PREFIX . "property_neareast_place pnp ON (np.nearest_place_id = pnp.nearest_place_id) where property_id='" . $property_id . "' and npd.language_id = '" . (int)$this->config->get('config_language_id') . "' limit 3");

		return $query->rows;

	}	

	public function getproperfeatureAll($property_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "feature f LEFT JOIN " . DB_PREFIX . "feature_description fd ON (f.feature_id = fd.feature_id) LEFT JOIN " . DB_PREFIX . "property_feature pf ON (f.feature_id = pf.feature_id) where property_id='" . $property_id . "' and fd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;

	}
	

	public function getNeareastplaceAll($property_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nearest_place np LEFT JOIN " . DB_PREFIX . "nearest_place_description npd ON (np.nearest_place_id = npd.nearest_place_id) LEFT JOIN " . DB_PREFIX . "property_neareast_place pnp ON (np.nearest_place_id = pnp.nearest_place_id) where property_id='" . $property_id . "' and npd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;

	}

	public function getNeareastdestiny($property_id, $nearest_place_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_neareast_place  where property_id='" . $property_id . "' AND nearest_place_id='" . $nearest_place_id . "'");

		return $query->row;

	}

	

	

	public function getpropertyfeature($property_id){

		$feature_id = array();

		$sql   = "select * from " . DB_PREFIX . "property_feature where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		foreach ($query->rows as $result){

			$feature_id[] = $result['feature_id'];

		}

			return $feature_id;

	}

	

	public function editProperty($property_id,$data){	

		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

	    $this->load->model('customer/custom_field');
		$customer_group_info = $this->model_customer_custom_field->getCustomField($customer_group_id);


		$sql = "update " . DB_PREFIX . "property set area_type='" . $data['area_type'] . "',image='" . $data['image_thumb'] . "',

		video='" . $data['video'] . "',country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',city='" . $data['city'] . "',pincode='" . $data['pincode'] . "',local_area='" . $data['local_area'] . "',latitude='" . $data['latitude'] . "',longitude='" . $data['longitude'] . "',price='" . (int) $data['price'] . "',neighborhood='" . $data['neighborhood'] . "',area='" .(int) $data['area'] . "',bedrooms='" .(int) $data['bedrooms'] . "',bathrooms='" .(int) $data['bathrooms'] . "',roomcount='" .(int) $data['roomcount'] . "',Parkingspaces='" .(int) $data['Parkingspaces'] . "',builtin='" .(int) $data['builtin'] . "',property_status_id='" . (int) $data['property_status_id'] . "',property_agent_id='" . (int) $data['property_agent_id'] . "',sort_order='" . (int) $data['sort_order'] . "',sort_order='" . (int) $data['sort_order'] . "',status='" . (int) $data['status'] . "',custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "',status='" . (int) $data['status'] . "',date_modified=now() where property_id='" . $property_id . "'";

		$this->db->query($sql);$this->db->query("delete from " . DB_PREFIX . "property_description where  property_id = '" . (int) $property_id . "'");

		foreach ($data['Property_description'] as $language_id => $value){

			$this->db->query("INSERT INTO " . DB_PREFIX . "property_description SET property_id = '" . (int) $property_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',	description = '" . $this->db->escape($value['description']) . "',

			meta_title = '" . $this->db->escape($value['meta_title']) . "',meta_description = '" . $this->db->escape($value['meta_description']) . "',meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "',                                  

			tag = '" . $this->db->escape($value['tag']) . "'");

		}

		if($data['uploader_count']) {

				$uploader_count = $data['uploader_count']-1;

				for($i = 0; $i<=$uploader_count; $i++){

					if(isset($data['uploader_'.$i.'_tmpname']) && trim($data['uploader_'.$i.'_status'])== 'done') {

						$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_images SET property_id = '" . (int) $property_id . "', image = '" . $this->db->escape('upload/'.$data['uploader_'.$i.'_tmpname']) . "'");

					}

				}

		}

		

		

		if (isset($data['images_tab'])){

			foreach ($data['images_tab'] as $images_tab){

				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_images SET property_id = '" . (int) $property_id . "', image = '" . $this->db->escape($images_tab['image']) . "', title = '" . $this->db->escape($images_tab['title']) . "', alt = '" . $this->db->escape($images_tab['alt']) . "'");

			}

		}

		

			$this->db->query("delete from " . DB_PREFIX . "property_neareast_place where  property_id = '" .$property_id ."'");

			

			if (!empty($data['nearestplace'])){

			foreach ($data['nearestplace'] as $key=>$value){

				if(!empty($value)){

					$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_neareast_place SET property_id = '" . (int) $property_id . "',nearest_place_id='" . $this->db->escape($key) . "',destinies='" . $this->db->escape($value) ."'");

				}

			}

		}

	

		$this->db->query("delete from " . DB_PREFIX . "property_feature where  property_id = '" . (int) $property_id . "'");

		

		if (isset($data['features'])){

			foreach ($data['features'] as $feature_id){

				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_feature SET property_id = '" . (int) $property_id . "',feature_id = '" . (int)$feature_id . "'");

			}

		}

    

		

		$this->db->query("delete from " . DB_PREFIX . "property_to_category where  property_id = '" . (int) $property_id . "'");

		if (isset($data['category_id'])){

			foreach ($data['category_id'] as $category_id){

				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_to_category SET property_id = '" . (int) $property_id . "',category_id='" . $category_id . "'");

			}

		}

	}

	public function approve($property_id){

		$this->db->query("UPDATE " . DB_PREFIX . "property SET approved = '1' WHERE property_id = '" . (int)$property_id . "'");

	}

	

	public function getTotalProperty($data = array()) {

		$sql= "SELECT count(*) as total FROM " . DB_PREFIX . "property p LEFT JOIN " . DB_PREFIX . "property_description ppd on (p.property_id=ppd.property_id) ";
		
		$sql .=" LEFT JOIN " . DB_PREFIX . "property_status ps on (p.property_status_id = ps.property_status_id) ";

		if(isset($data['filter_features'])){

			$sql .=" LEFT JOIN " . DB_PREFIX ."property_feature pf on(p.property_id = pf.property_id) ";

		}

		if(!empty($data['filter_propertycategory'])){
			$sql .="LEFT JOIN " . DB_PREFIX ."property_to_category pc on(p.property_id = pc.property_id)  LEFT JOIN " . DB_PREFIX ."category_description pcd on(pc.category_id = pcd.category_id) ";
		}


		$sql .="WHERE p.property_id<>0 and ppd.language_id = '" . (int)$this->config->get('config_language_id') . "' and ps.language_id = '" . (int)$this->config->get('config_language_id') . "' and p.approved='1'";							

		if (!empty($data['filter_propertystatus'])) {

			$sql .= " AND p.property_status_id='" . $this->db->escape($data['filter_propertystatus']) . "'";

		}

	

		if (!empty($data['filter_propertycategory'])) {

			$sql .= " AND pc.category_id='" . $this->db->escape($data['filter_propertycategory']) . "' and pcd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		} 

	

		if (!empty($data['filter_city'])) {

			$sql .= " AND p.city LIKE '" . $this->db->escape($data['filter_city']) . "%'";

		} 

	

		if (!empty($data['filter_address'])) {

			$sql .= " AND p.local_area LIKE '" . $this->db->escape($data['filter_address']) . "%'";

		} 

	

		if (!empty($data['filter_neighborhood'])) {

			$sql .= " AND p.neighborhood LIKE '" . $this->db->escape($data['filter_neighborhood']) . "%'";

		} 

	

		if (!empty($data['filter_zipcode'])){

			$sql .= "AND p.pincode like '" .$this->db->escape($data['filter_zipcode']) . "%'";

		}

		

		if (!empty($data['filter_country_id'])){

			$sql .= "AND p.country_id like '" .$this->db->escape($data['filter_country_id']) . "%'";

		}

		

		if (!empty($data['filter_zone_id'])){

			$sql .= "AND p.zone_id like '" .$this->db->escape($data['filter_zone_id']) . "%'";

		}

		

		if (!empty($data['agent_id'])){

			$sql .= " and p.property_agent_id='".$data['agent_id']."'";

		}

		if (!empty($data['filter_name'])){

			$sql .= " and ppd.name like '" . $this->db->escape($data['filter_name']) . "%'";

		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}



		if (!empty($data['filter_price_from'])){

			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_from']) . "%'";

		}

		

		if (!empty($data['filter_price_to'])){

			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_to']) . "%'";

		}

		

		
		if(isset($data['range_from']) && !empty($data['range_to'])){
			$sql .= " and p.price>='".$data['range_from']."' and  p.price<='".$data['range_to']."'";
		}

		if(isset($data['area_from']) && !empty($data['area_to'])){
			$sql .= " and p.area>='".$data['area_from']."' and  p.area<='".$data['area_to']."'";
		}

		

		if (!empty($data['filter_bed_rooms'])){

			$sql .= "AND p.bedrooms like '" .$this->db->escape($data['filter_bed_rooms']) . "%'";

		}

		

		if (!empty($data['filter_bath_rooms'])){

			$sql .= "AND p.bathrooms like '" .$this->db->escape($data['filter_bath_rooms']) . "%'";

		}

				

		$query = $this->db->query($sql);
		
		

		return $query->row['total'];

	}

	

	public function getLatestEnquery($data){

		

		$sql = "select *from " . DB_PREFIX . "property_enquiry where property_agent_id='".$this->agent->getId()."' ";

		

		if(isset($data['agent_id'])){

			$sql .= " and property_agent_id='".$data['agent_id']."'";

		}

	

		$sort_data = array( 

			'name',

		

		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){

			$sql .= " ORDER BY " . $data['sort'];

		}else{

			$sql .= " ORDER BY name";}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {

			$sql .= " DESC";

		}else {

			$sql .= " ASC";

		}

		if (isset($data['start']) || isset($data['limit'])){

			if ($data['start'] < 0){

				$data['start'] = 0;

			}

			if ($data['limit'] < 1){

				$data['limit'] = 20;

			}

			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];

		}

	

		$query = $this->db->query($sql);

		return $query->rows;

	

	}

	



	public function getTotalPhotos($data){

		$sql="select count(*) as total from " . DB_PREFIX . "property where property_agent_id<>0 and approved='1'";

		if(isset($data['property_agent_id'])){

			$sql .= " and property_agent_id='".$data['property_agent_id']."'";

		}

		$query=$this->db->query($sql);

		return $query->row['total'];

	}


	public function propertytotalagent($property_agent_id){

		$sql="select count(*) as total from " . DB_PREFIX . "property where property_agent_id='".$property_agent_id."' and approved='1'";

		
		$query=$this->db->query($sql);

		return $query->row['total'];

	}


	public function getPropertyViews($data){

	    $sql= "SELECT *, ppd.name as propetyname FROM " . DB_PREFIX . "property p LEFT JOIN " . DB_PREFIX . "property_description ppd on (p.property_id=ppd.property_id) ";

		$sql .=" LEFT JOIN " . DB_PREFIX . "property_status ps on (p.property_status_id = ps.property_status_id) ";

		$sql .=" WHERE p.property_id<>0 and ppd.language_id = '" . (int)$this->config->get('config_language_id') . "' and ps.language_id = '" . (int)$this->config->get('config_language_id') . "' and p.approved='1'";

		if(isset($data['filter_features'])){

			$sql .=" LEFT JOIN " . DB_PREFIX ."property_feature pf on(p.property_id = pf.property_id) ";

		}

								

		if (!empty($data['filter_propertystatus'])) {

			$sql .= " AND p.property_status_id='" . $this->db->escape($data['filter_propertystatus']) . "'";

		}

	

		if (!empty($data['filter_propertycategory'])) {

			$sql .= " AND pc.category_id='" . $this->db->escape($data['filter_propertycategory']) . "'";

		} 

	

		if (!empty($data['filter_city'])) {

			$sql .= " AND p.city LIKE '" . $this->db->escape($data['filter_city']) . "%'";

		} 

	

		if (!empty($data['filter_address'])) {

			$sql .= " AND p.local_area LIKE '" . $this->db->escape($data['filter_address']) . "%'";

		} 

	

		if (!empty($data['filter_neighborhood'])) {

			$sql .= " AND p.neighborhood LIKE '" . $this->db->escape($data['filter_neighborhood']) . "%'";

		} 

	

		if (!empty($data['filter_zipcode'])){

			$sql .= "AND p.pincode like '" .$this->db->escape($data['filter_zipcode']) . "%'";

		}

		

		if (!empty($data['filter_country_id'])){

			$sql .= "AND p.country_id like '" .$this->db->escape($data['filter_country_id']) . "%'";

		}

		

		if (!empty($data['filter_zone_id'])){

			$sql .= "AND p.zone_id like '" .$this->db->escape($data['filter_zone_id']) . "%'";

		}

		

		if (!empty($data['agent_id'])){

			$sql .= " and p.property_agent_id='".$data['agent_id']."'";

		}

		if (!empty($data['filter_name'])){

			$sql .= " and ppd.name like '" . $this->db->escape($data['filter_name']) . "%'";

		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}



		if (!empty($data['filter_price_from'])){

			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_from']) . "%'";

		}

		

		if (!empty($data['filter_price_to'])){

			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_to']) . "%'";

		}

		

		if(!empty($data['range_from']) && !empty($data['range_to']))

		{

		$sql .= " and p.price>='".$data['range_from']."' and  p.price<='".$data['range_to']."'";

		}

		

		if (!empty($data['filter_bed_rooms'])){

			$sql .= "AND p.bedrooms like '" .$this->db->escape($data['filter_bed_rooms']) . "%'";

		}

		

		if (!empty($data['filter_bath_rooms'])){

			$sql .= "AND p.bathrooms like '" .$this->db->escape($data['filter_bath_rooms']) . "%'";

		}

			
				


		$sort_data = array( 

			'ppd.name',

			'p.status',

			'p.date_added',

			'p.property_status_id',

			'p.price',

		

		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){

			$sql .= " ORDER BY " . $data['sort'];

		}else{

			$sql .= " ORDER BY p.date_added";}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {

			$sql .= " ASC";

		}else {

			$sql .= " DESC";

		}

		if (isset($data['start']) || isset($data['limit'])){

			if ($data['start'] < 0){

				$data['start'] = 0;

			}

			if ($data['limit'] < 1){

				$data['limit'] = 20;

			}

			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];

		}

		

		//echo $sql;

	

		$query = $this->db->query($sql);

		return $query->rows;



	}

	

	

	public function getTotalenquery($data){

		$sql="select count(*) as total from " . DB_PREFIX . "property_enquiry where property_agent_id<>0";

		if(isset($data['property_agent_id'])){

			$sql .= " and property_agent_id='".$data['property_agent_id']."'";

		}

		$query=$this->db->query($sql);

		return $query->row['total'];

	}


	public function getAgentemail($property_agent_id){

		$sql="select * from " . DB_PREFIX . "property_agent where 

		property_agent_id='".$property_agent_id."'";

		$query=$this->db->query($sql);

		return $query->row;

	}



	public function deleteimage($property_images_id){

		

		$query=$this->db->query("Select image FROM " . DB_PREFIX . "property_images WHERE property_images_id = '" . (int)$property_images_id . "'");

		if(isset($query->row['image']))

		if(isset($query->row['image']))

		{

			@unlink(DIR_IMAGE.'/'.$query->row['image']);

		}

		

		$this->db->query("DELETE FROM " . DB_PREFIX . "property_images WHERE property_images_id = '" . (int)$property_images_id . "'");

		

	}

	

	public function getTotalFeature($data) {

		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "property_enquiry where  property_agent_id='".$this->agent->getId()."'");

		return $query->row['total'];

	}
	public function getProductExtrafieds($property_id,$custom_field_id) {
       $custom_data = array();
       $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_extrafield WHERE property_id = '" . (int)$property_id . "' and custom_id ='".$custom_field_id."'");
		foreach ($query->rows as $result) {
			$custom_data[$result['custom_id']] = array(
				'value' => $result['value']

				);
		}
		return $custom_data;
	}

		public function getTotalProductsall($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.property_id) AS total";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "property_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "property_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "property_filter pf ON (p2c.property_id = pf.property_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.property_id = p.property_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "property p ON (p2c.property_id = p.property_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "property p";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "property_description pd ON (p.property_id = pd.property_id)WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.approved='1' ";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

		}
		
		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

}