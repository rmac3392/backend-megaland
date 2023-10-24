<?php


class ControllerCommonFooter extends Controller {


	public function index() {


		$this->load->language('common/footer');





		$data['scripts'] = $this->document->getScripts('footer');





		$data['text_information'] = $this->language->get('text_information');


		$data['text_service'] = $this->language->get('text_service');


		$data['text_extra'] = $this->language->get('text_extra');


		$data['text_contact'] = $this->language->get('text_contact');


		$data['text_return'] = $this->language->get('text_return');


		$data['text_sitemap'] = $this->language->get('text_sitemap');


		$data['text_manufacturer'] = $this->language->get('text_manufacturer');


		$data['text_voucher'] = $this->language->get('text_voucher');


		$data['text_affiliate'] = $this->language->get('text_affiliate');


		$data['text_special'] = $this->language->get('text_special');


		$data['text_account'] = $this->language->get('text_account');


		$data['text_order'] = $this->language->get('text_order');


		$data['text_wishlist'] = $this->language->get('text_wishlist');


		$data['text_newsletter'] = $this->language->get('text_newsletter');


		$data['text_read'] = $this->language->get('text_read');


		$data['text_terms'] = $this->language->get('text_terms');


		$data['text_faq'] = $this->language->get('text_faq');


		$data['text_aboutus'] = $this->language->get('text_aboutus');


		$data['text_links'] = $this->language->get('text_links');


		$data['text_tags'] = $this->language->get('text_tags');


		$data['text_latestnews'] = $this->language->get('text_latestnews');


		$data['text_fgallery'] = $this->language->get('text_fgallery');


		$data['text_home'] = $this->language->get('text_home');


		$data['text_properties'] = $this->language->get('text_properties');


		$data['text_need'] = $this->language->get('text_need');


		$data['button_submit'] = $this->language->get('button_submit');


		


		if (isset($this->request->post['config_aboutdes'])) {


			$data['aboutdes'] = $this->request->post['config_aboutdes'];


			} else {


			$data['aboutdes'] = $this->config->get('config_aboutdes');


			}


			if (isset($this->request->post['config_title'])) {


			$data['title'] = $this->request->post['config_title'];


			} else {


			$data['title'] = $this->config->get('config_title');


			}


			if (isset($this->request->post['config_phoneno'])) {


			$data['phoneno'] = $this->request->post['config_phoneno'];


			} else {


			$data['phoneno'] = $this->config->get('config_phoneno');


			}


			


			if (isset($this->request->post['config_mobile'])) {


			$data['mobile'] = $this->request->post['config_mobile'];


			} else {


			$data['mobile'] = $this->config->get('config_mobile');


			}


			


			if (isset($this->request->post['config_email_soci'])) {


			$data['email'] = $this->request->post['config_email_soci'];


			} else {


			$data['email'] = $this->config->get('config_email_soci');


			}


			


			if (isset($this->request->post['config_address2'])) {


			$data['address2'] = $this->request->post['config_address2'];


			} else {


			$data['address2'] = $this->config->get('config_address2');


			}


			


			if (isset($this->request->post['tmdrealstate_twittercode'])) {


			$data['twittercode'] = $this->request->post['tmdrealstate_twittercode'];


			} else {


			$data['twittercode'] = $this->config->get('tmdrealstate_twittercode');


			}


			


		if ($this->request->server['HTTPS']) {


			$server = $this->config->get('config_ssl');


		} else {


			$server = $this->config->get('config_url');


		}


		/* new code */


		$aboutus_descrption = $this->config->get('tmdrealstate_aboutdes');


		


		if(isset($aboutus_descrption)){


			$data['aboutusdescrption'] = $aboutus_descrption;


		} else {


			$data['aboutusdescrption'] = '';			


		}


		


		if (is_file(DIR_IMAGE . $this->config->get('tmdrealstate_footericon'))) {


			$data['footericon'] = $server . 'image/' . $this->config->get('tmdrealstate_footericon');


		} else {


			$data['footericon'] = '';


		}


		


		/* new code */


		


		$this->load->model('catalog/information');


	





		$data['informations'] = array();





		foreach ($this->model_catalog_information->getInformations() as $result) {

			if (isset($result['bottom'])) {

              
				$data['informations'][] = array(


					'title' => $result['title'],


					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])


				);


			}


		}


		


					


		$this->load->model('catalog/gallery');


		$this->load->model('tool/image');


		///galleryinfo//


		$filter_data = array(


			'start' =>0,


			'limit' =>4,


			'sort' =>'date_added',


			'order' =>'DESC',


		);


		$data['resultsinfos']=array();


		$resultsinfos = $this->model_catalog_gallery->getgallerysfooter($filter_data);


		foreach($resultsinfos as $resultsinfo){


			if ($resultsinfo['image'] && file_exists(DIR_IMAGE . $resultsinfo['image'])) {


				$image = $this->model_tool_image->resize($resultsinfo['image'], 120, 80);


			} else {


				$image = $this->model_tool_image->resize('no_image.png',  120, 80);


			}


			$data['resultsinfos'][]=array(


			  'image'=> $image,


			


			);


	}


		


	


		$data['col_testi'] = $this->load->controller('common/col_testi');


		$data['home'] = $this->url->link('common/home');


		$data['faq'] = $this->url->link('information/faq');


		$data['contact'] = $this->url->link('information/contact');


		$data['return'] = $this->url->link('account/return/add', '', true);


		$data['sitemap'] = $this->url->link('information/sitemap');


		$data['manufacturer'] = $this->url->link('product/manufacturer');


		$data['voucher'] = $this->url->link('account/voucher', '', true);


		$data['affiliate'] = $this->url->link('affiliate/account', '', true);


		$data['special'] = $this->url->link('product/special');


		$data['account'] = $this->url->link('account/account', '', true);


		$data['order'] = $this->url->link('account/order', '', true);


		$data['wishlist'] = $this->url->link('account/wishlist', '', true);


		$data['newsletter'] = $this->url->link('account/newsletter', '', true);





		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));


		


		$data['column_footer'] = $this->load->controller('common/column_footer');


		$data['column_footer4'] = $this->load->controller('common/column_footer4');


		$data['column_footer3'] = $this->load->controller('common/column_footer3');


		$data['column_footer5'] = $this->load->controller('common/column_footer5');


		


		


		// Whos Online


		if ($this->config->get('config_customer_online')) {


			$this->load->model('tool/online');





			if (isset($this->request->server['REMOTE_ADDR'])) {


				$ip = $this->request->server['REMOTE_ADDR'];


			} else {


				$ip = '';


			}





			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {


				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];


			} else {


				$url = '';


			}





			if (isset($this->request->server['HTTP_REFERER'])) {


				$referer = $this->request->server['HTTP_REFERER'];


			} else {


				$referer = '';


			}





			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);


		}





			$footerlayout = $this->config->get('tmdrealstate_footer');


							


				if($footerlayout=='footer1'){


					return $this->load->view('common/footer', $data);				


				} elseif($footerlayout=='footer2'){


					return $this->load->view('common/footer3', $data);


				} elseif($footerlayout=='footer3'){


					return $this->load->view('common/footer4', $data);


				} elseif($footerlayout=='footer4'){


					return $this->load->view('common/footer5', $data);							


				} else {				


					return $this->load->view('common/footer', $data);			


				} 			


	}


	


	public function SendEmailById() {


		$this->load->model('property/property');


		$this->load->language('common/footer');


		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {


			


			$json = array();


			if(empty($this->request->post['name'])) {


				$json['error']['name']= $this->language->get('error_name');


			}





			if(empty($this->request->post['email'])) {


				$json['error']['email']= $this->language->get('error_email');


			}





			if(empty($this->request->post['description'])) {


				$json['error']['description']= $this->language->get('error_description');


			}


			


			if(empty($json['error'])){


				$message='';


				$message .=$this->request->post['name'] . "\r\n";


				$message .= $this->request->post['email'] . "\r\n";


				$message .=$this->request->post['description']. "\r\n";


				$mail = new Mail();


				$mail->protocol = $this->config->get('config_mail_protocol');


				$mail->parameter = $this->config->get('config_mail_parameter');


				$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');


				$mail->smtp_username = $this->config->get('config_mail_smtp_username');


				$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');


				$mail->smtp_port = $this->config->get('config_mail_smtp_port');


				$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');


				$mail->setTo($this->config->get('config_email'));


				$mail->setFrom($this->request->post['email']);


				$mail->setSender(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));


				$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));


				$mail->sethtml($message);


				$mail->send();


				$json['success'] = $this->language->get('text_success');


			}	


		}	


		$this->response->addHeader('Content-Type: application/json');


		$this->response->setOutput(json_encode($json));


	}


	


}


