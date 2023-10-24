<?php


class ControllerStartupSeoUrl extends Controller {


	public function index() {


		// Add rewrite to url class


		if ($this->config->get('config_seo_url')) {


			$this->url->addRewrite($this);


		}





		// Decode URL


		if (isset($this->request->get['_route_'])) {


			$parts = explode('/', $this->request->get['_route_']);





			// remove any empty arrays from trailing


			if (utf8_strlen(end($parts)) == 0) {


				array_pop($parts);


			}





			foreach ($parts as $part) {


				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");





				if ($query->num_rows) {


					$url = explode('=', $query->row['query']);





					


					if ($url[0] == 'property_id') {


						$this->request->get['property_id'] = $url[1];


					}


					if ($url[0] == 'album_id') {


						$this->request->get['album_id'] = $url[1];


					}





					if ($url[0] == 'filter_propertycategory') {


						$this->request->get['filter_propertycategory'] = $url[1];


						


					}





				


					if ($url[0] == 'information_id') {


						$this->request->get['information_id'] = $url[1];


					}





					if ($query->row['query'] && $url[0] != 'information_id' && $url[0] != 'album_id' && $url[0] != 'manufacturer_id' && $url[0] != 'filter_propertycategory' && $url[0] != 'property_id') {


						$this->request->get['route'] = $query->row['query'];


					}


				} else {


					$query1 = $this->db->query("SELECT * FROM " . DB_PREFIX . "property WHERE `property_id`='" .(int)$part . "'");


					if ($query1->num_rows)


					{


						$this->request->get['property_id'] =(int)$part;


					}


					else


					{


					$this->request->get['route'] = 'error/not_found';


					}


					break;


				}


			}


/////////////// TMD blog SEO work 
			$query1 = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdblog_url_alias WHERE keyword = '" . $this->db->escape($part) . "'");
			
			if($query1->num_rows) {
			$url = explode('=', $query1->row['query']);
				unset($this->request->get['route']);
					if ($url[0] == 'blog_id') {
						$this->request->get['blog_id'] = $url[1];
						$this->request->get['route'] = 'tmdblog/blog';
					}
					if ($url[0] == 'tmdblogcategory_id') {
						$this->request->get['tmdblogcategory_id'] = $url[1];
						$this->request->get['route'] = 'tmdblog/tmdblog';
					}
			}
			/////////////// TMD blog SEO work 


			if (!isset($this->request->get['route'])) {


				if (isset($this->request->get['property_id'])) {


					$this->request->get['route'] = 'property/property_detail';


				} elseif (isset($this->request->get['filter_propertycategory'])) {


					$this->request->get['route'] = 'property/category';


				}elseif (isset($this->request->get['information_id'])) {


					$this->request->get['route'] = 'information/information';


				}elseif (isset($this->request->get['album_id'])) {


					$this->request->get['route'] = 'gallery/photos';


				}


			}


		}


	}


	public function rewrite($link) {


		$url_info = parse_url(str_replace('&amp;', '&', $link));





		$url = '';





		$data = array();





		parse_str($url_info['query'], $data);


		


		foreach ($data as $key => $value) {


			


			if (isset($data['route'])) {


					if (($data['route'] == 'gallery/photos' && $key == 'album_id') || ($data['route'] == 'information/information' && $key == 'information_id') || ($data['route'] == 'property/category' && $key == 'filter_propertycategory')) {


						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");


						if ($query->num_rows && $query->row['keyword']) {


							$url .= '/' . $query->row['keyword'];





							unset($data[$key]);


						}


					}


						


				}


						


		}


		if(empty($url))


		{


			foreach ($data as $key => $value) {


				if (($data['route'] == 'property/property_detail' && $key=='property_id'))


				{


					


					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_description WHERE `property_id`='" .$value . "' and language_id = '" . (int)$this->config->get('config_language_id') . "'");


					


							if ($query->num_rows && $query->row['name']) {


								$url .= '/'.$value.'/'.$this->clean($query->row['name']);


							} else {


								$url = '';





								break;


							}


						





						unset($data[$key]);


						


				


					


				


				}


				}


		}


		


		


		


		if(empty($url))


		{


			foreach ($data as $key => $value) {


			if (isset($data['route'])) {


				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" .$data['route'] . "'");


						if ($query->num_rows && $query->row['keyword']) {


							$url .= '/' . $query->row['keyword'];


						} else {


							$url = '';





							break;


						}


					





					unset($data[$key]);


				}


			}


		 }


		


		if ($url) {


			unset($data['route']);





			$query = '';





			if ($data) {


				foreach ($data as $key => $value) {


					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((is_array($value) ? http_build_query($value) : (string)$value));


				}





				if ($query) {


					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));


				}


			}





			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;


		} else {


			return $link;


		}


	}


	


	


	private function clean($string){


	$string = str_replace(array('[\', \']'), '', $string);


    $string = preg_replace('/\[.*\]/U', '', $string);


    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);


    $string = htmlentities($string, ENT_COMPAT, 'utf-8');


    $string = preg_replace('/&([a-z])(amp|acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );


	$string = str_replace('amp', '', $string);


	$string = str_replace(',', '', $string);


	$string = str_replace(':', '', $string);


	$string = str_replace('%', '', $string);


	$string = str_replace(';', '', $string);


	$string = str_replace('(', '', $string);


	$string = str_replace(')', '', $string);


	$string = str_replace('*', '', $string);


	$string = str_replace('.', '', $string);


	$string = str_replace('', '-', $string);


	$string= str_replace(' ', '-', $string);


	$string= str_replace('--', '-', $string);


	$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);


    return strtolower(trim($string, '-'));


		}


}


