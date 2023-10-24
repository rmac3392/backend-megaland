<?php


class Controllergalleryphotos extends Controller {





	public function index() {


	


		$this->load->language('gallery/photos');





		$this->document->setTitle($this->language->get('heading_title'));


		


		$this->document->addStyle('catalog/view/theme/realestate/stylesheet/tmdphotogallery.css');


		


		$this->load->model('catalog/gallery');


		$this->load->model('tool/image'); 


	   $data['text_no_results']      		= $this->language->get('text_no_results');


		


		


		$url = '';


		$path = '';


			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}	





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}	





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			if (isset($this->request->get['limit'])) {


				$url .= '&limit=' . $this->request->get['limit'];


			}


			


			$data['albumna']= array();


			


			$album_id = $this->request->get['album_id'];


			$albumname = $this->model_catalog_gallery->getgallery($album_id);


			


			$data['album_name'] = $albumname[0]['name']; 


			$data['album_description'] = html_entity_decode($albumname[0]['description']);


			


			


			foreach($albumname as $gallerys){


			


				$data['albumna'][]=array(


				'album_id' => $gallerys['album_id'],


				'album'	   => $gallerys['name'],


				


				);


			}


		


		


		$this->load->model('tool/image');





		if(isset ($this->request->get['album_id']) && !empty($this->request->get['album_id'])){


		


		


			if(isset($this->request->get['page'])) {


				$page = $this->request->get['page'];


			} else {


				$page = 1;


			}


			


			if (isset($this->request->get['limit'])) {


			$limit = $this->request->get['limit'];


		} else {


			$limit = $this->config->get('gallerysetting_limtofgallery');


			


			


		}


		


			$url = '';


			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}


			if (isset($this->request->get['limit'])) {


				$url .= '&limit=' . $this->request->get['limit'];


			}


			$filter_data = array(


				'start' => ($page - 1) * $this->config->get('gallerysetting_limtofgallery'),


				'limit' => $this->config->get('gallerysetting_limtofgallery'),


				'album_id' => $this->request->get['album_id']


			);


			


		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text'      => $this->language->get('text_home'),


			'href'      => $this->url->link('common/home'),


			'separator' => false


		);


		$data['breadcrumbs'][] = array(


			'text'      => 'Gallery',


			'href'      => $this->url->link('gallery/gallery')


		);


		


		$data['breadcrumbs'][] = array(


			'text'      => $gallerys['name'],


			'href'      => $this->url->link('gallery/photos' .'&album_id='. $gallerys['album_id'])


		);


			/*new code*/


			$gallery_info = $this->model_catalog_gallery->getgallerys();


		    	foreach($gallery_info as $gallerys){


				$data['gallerys'][]=array(


				'album_id' => $gallerys['album_id'],


				'album' => $gallerys['name'],


				);


			}


			/*new code*/


			


			$data['heading_title']=$gallerys['name'];


			$data['images']=array();


			


			$photo_count = $this->model_catalog_gallery->countImage($this->request->get['album_id']);


			$photo_info = $this->model_catalog_gallery->getphotos($filter_data);


			


			foreach($photo_info as $info){


			


				if($this->config->get('gallerysetting_thumb_width')){


					$thumb_width = $this->config->get('gallerysetting_thumb_width'); 


				}else{


					$thumb_width = 180;					


				}


				


				if($this->config->get('gallerysetting_thumb_height')){


					$thumb_height = $this->config->get('gallerysetting_thumb_height'); 


				}else{


					$thumb_height = 240;


				}


				


				if($this->config->get('gallerysetting_popup_width')){


					$popup_width = $this->config->get('gallerysetting_popup_width'); 


				}else{


					$popup_width = 900;


				}


				


				if($this->config->get('gallerysetting_popup_height')){


					$popup_height = $this->config->get('gallerysetting_popup_height'); 


				}else{


					$popup_height = 1200;


				}


				


				$multiples_images = $this->model_catalog_gallery->getMultipleImages($info['album_photos_id']);





    			$multiples_images_data = array();


				$popup = '';


				$images = '';	


				foreach($multiples_images as $key => $multiples_image) {


					if($key == '0') { 


						if($multiples_image['image']) {


							$images= $this->model_tool_image->resize($multiples_image['image'],$thumb_width,$thumb_height);


						}else{


							$images = $this->model_tool_image->resize('placeholder.png',$thumb_width,$thumb_height);


						}


						if ($multiples_image['image']){


							$popup = $this->model_tool_image->resize($multiples_image['image'], $popup_width, $popup_height);


						}else{


							$popup = '';


						}


					}else{


						$multiples_image_popup = $this->model_tool_image->resize($multiples_image['image'], $popup_width, $popup_height);


						$multiples_images_data[] = array(


							'popup'         => $multiples_image_popup,


						);


					}


				}


		


				$data['images'][]= array(


					'album_photos_id'	=> $info['album_photos_id'],


					'album_id'			=> $info['album_id'],


					'images'			=> $images,


					'name'				=> html_entity_decode($info['name']),


					'description'		=> html_entity_decode($info['description']),


					'popup'     		=> $popup,


					'multiples_images'  => $multiples_images_data


				);


			


			}


			$link= $this->request->get['album_id'];


			$pagination = new Pagination();


			$pagination->total = $photo_count;


			$pagination->page = $page;


			$pagination->limit = $this->config->get('gallerysetting_limtofgallery');


			$pagination->text = $this->language->get('text_pagination');


			$pagination->url = $this->url->link('gallery/photos'.'&album_id='. $link.'&page={page}');


			$data['pagination'] = $pagination->render();


			$data['continue'] = $this->url->link('common/home');


			$data['results'] = sprintf($this->language->get('text_pagination'), ($photo_count) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($photo_count - $limit)) ? $photo_count : ((($page - 1) * $limit) + $limit), $photo_count, ceil($photo_count / $limit));


			


		}


		else


		{


			


			$data['gallerys']=array();


			$gallery_info = $this->model_catalog_gallery->getgallery();


			foreach($gallery_info as $gallerys){


				if($gallerys['image']){


					$image = $this->model_tool_image->resize($gallerys['image'],$this->config->get('config_image_album_width'),$this->config->get('config_image_album_height'));


				}else{


					$image = $this->model_tool_image->resize('placeholder.png',128,148);


				}


				$data['gallerys'][]=array(


				'album_id' => $gallerys['album_id'],


				'album'	   => $gallerys['name'],


				'image'		=>$image,


				'href'	   => $this->url->link('gallery/photos' .'&album_id='. $gallerys['album_id'])


				);


			}


		}


		


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['column_right'] = $this->load->controller('common/column_right');


		$data['content_top'] = $this->load->controller('common/content_top');


		$data['content_bottom'] = $this->load->controller('common/content_bottom');


		$data['footer'] = $this->load->controller('common/footer');


		$data['header'] = $this->load->controller('common/header');





		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/gallery/photos')) {


			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/gallery/photos', $data));


		} else {


			$this->response->setOutput($this->load->view('gallery/photos', $data));


		}


	}


}


