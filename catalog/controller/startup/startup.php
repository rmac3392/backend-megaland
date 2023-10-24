<?php
class ControllerStartupStartup extends Controller {
	public function index() {


		// Store


		if ($this->request->server['HTTPS']) {


			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`ssl`, 'www.', '') = '" . $this->db->escape('https://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");


		} else {


			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`url`, 'www.', '') = '" . $this->db->escape('http://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");


		}


		


		if (isset($this->request->get['store_id'])) {


			$this->config->set('config_store_id', (int)$this->request->get['store_id']);


		} else if ($query->num_rows) {


			$this->config->set('config_store_id', $query->row['store_id']);


		} else {


			$this->config->set('config_store_id', 0);


		}


		


		if (!$query->num_rows) {


			$this->config->set('config_url', HTTP_SERVER);


			$this->config->set('config_ssl', HTTPS_SERVER);


		}


		


		// Settings


		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE store_id = '0' OR store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY store_id ASC");


		


		foreach ($query->rows as $result) {


			if (!$result['serialized']) {


				$this->config->set($result['key'], $result['value']);


			} else {


				$this->config->set($result['key'], json_decode($result['value'], true));


			}


		}


		// Url


		$this->registry->set('url', new Url($this->config->get('config_url'), $this->config->get('config_ssl')));


		


		// Language


		$code = '';


		


		$this->load->model('localisation/language');


		


		$languages = $this->model_localisation_language->getLanguages();


		if (isset($this->session->data['language'])) {


			$code = $this->session->data['language'];


		}


				


		if (isset($this->request->cookie['language']) && !array_key_exists($code, $languages)) {


			$code = $this->request->cookie['language'];


		}


		


		// Language Detection


		if (!empty($this->request->server['HTTP_ACCEPT_LANGUAGE']) && !array_key_exists($code, $languages)) {


			$detect = '';


			


			$browser_languages = explode(',', $this->request->server['HTTP_ACCEPT_LANGUAGE']);


			


			// Try using local to detect the language


			foreach ($browser_languages as $browser_language) {


				foreach ($languages as $key => $value) {


					if ($value['status']) {


						$locale = explode(',', $value['locale']);


						


						if (in_array($browser_language, $locale)) {


							$detect = $key;


							break 2;


						}


					}


				}	


			}			


			


			if (!$detect) { 


				// Try using language folder to detect the language


				foreach ($browser_languages as $browser_language) {


					if (array_key_exists(strtolower($browser_language), $languages)) {


						$detect = strtolower($browser_language);


						


						break;


					}


				}


			}


			


			$code = $detect ? $detect : '';


		}


		


		if (!array_key_exists($code, $languages)) {


			$code = $this->config->get('config_language');


		}


		


		if (!isset($this->session->data['language']) || $this->session->data['language'] != $code) {


			$this->session->data['language'] = $code;


		}


				


		if (!isset($this->request->cookie['language']) || $this->request->cookie['language'] != $code) {


			setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);


		}


				


		// Overwrite the default language object


		$language = new Language($code);


		$language->load($code);


		


		$this->registry->set('language', $language);


		


		// Set the config language_id


		$this->config->set('config_language_id', $languages[$code]['language_id']);	


		


		// Agent


		$agent = new Cart\Agent($this->registry);


		$this->registry->set('agent', $agent);


		


		// Customer


		$customer = new Cart\Customer($this->registry);


		$this->registry->set('customer', $customer);


		


		// Customer Group


		if ($this->customer->isLogged()) {


			$this->config->set('config_customer_group_id', $this->customer->getGroupId());


		} elseif (isset($this->session->data['customer']) && isset($this->session->data['customer']['customer_group_id'])) {


			// For API calls


			$this->config->set('config_customer_group_id', $this->session->data['customer']['customer_group_id']);


		} elseif (isset($this->session->data['guest']) && isset($this->session->data['guest']['customer_group_id'])) {


			$this->config->set('config_customer_group_id', $this->session->data['guest']['customer_group_id']);


		}


		


		// Tracking Code


		if (isset($this->request->get['tracking'])) {


			setcookie('tracking', $this->request->get['tracking'], time() + 3600 * 24 * 1000, '/');


		


			$this->db->query("UPDATE `" . DB_PREFIX . "marketing` SET clicks = (clicks + 1) WHERE code = '" . $this->db->escape($this->request->get['tracking']) . "'");


		}		


		


		// Affiliate




		


		// Currency


		$code = '';


		


		$this->load->model('localisation/currency');


		


		$currencies = $this->model_localisation_currency->getCurrencies();


		


		if (isset($this->session->data['currency'])) {


			$code = $this->session->data['currency'];


		}


		


		if (isset($this->request->cookie['currency']) && !array_key_exists($code, $currencies)) {


			$code = $this->request->cookie['currency'];


		}


		


		if (!array_key_exists($code, $currencies)) {


			$code = $this->config->get('config_currency');


		}


		


		if (!isset($this->session->data['currency']) || $this->session->data['currency'] != $code) {


			$this->session->data['currency'] = $code;


		}


		


		if (!isset($this->request->cookie['currency']) || $this->request->cookie['currency'] != $code) {


			setcookie('currency', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);


		}		


		


		$this->registry->set('currency', new Cart\Currency($this->registry));


		



		// Encryption


		$this->registry->set('encryption', new Encryption($this->config->get('config_encryption')));

				


	}


}


