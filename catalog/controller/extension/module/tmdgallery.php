<?php
class ControllerExtensionModuleTmdgallery extends Controller {
	public function index($setting) {
		if(!empty($setting)){
		$this->language->load('extension/module/tmdgallery');
		$this->load->model('catalog/gallery');
		$this->load->model('tool/image');
		$this->document->addStyle('catalog/view/theme/realestate/stylesheet/tmdphotogallery.css');
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['gallerys'] = array();

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_viewall'] = $this->language->get('text_viewall');

		$data['button_cart'] = $this->language->get('button_cart');
		if(isset ($this->request->get ['album_id']) && !empty($this->request->get ['album_id'])){

			if(isset($this->request->get['page'])) {



				$page = $this->request->get['page'];



			} else {



				$page = 1;



			}



		



			$url = '';



			if (isset($this->request->get['page'])) {



				$url .= '&page=' . $this->request->get['page'];



			}



		



			$data = array(



				'start' => ($page - 1) * $this->config->get('config_admin_limit'),



				'limit' => $setting['limit'],



				'album_id' => $this->request->get['album_id']



			);



		



			$data['images']=array();



			$photo_count = $this->model_catalog_gallery->countImage($data);



			$photo_info = $this->model_catalog_gallery->getphotos($data);



		



			foreach($photo_info as $info){



				if($info['images']){



					$images= $this->model_tool_image->resize($info['images'],128,148);



				}else{



					$images = false;



				}



				if ($info['images']){



					$popup = $this->model_tool_image->resize($info['images'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));



				}else{



					$popup = '';



				}



			



				$data['images'][]= array(



					'album_id'	=> $info['album_id'],



					'images'	=>$images,



					'popup'     =>$popup



				);



			}



			$link= $this->request->get['album_id'];



			$pagination = new Pagination();



			$pagination->total = $photo_count;



			$pagination->page = $page;



			$pagination->limit = $this->config->get('config_admin_limit');



			$pagination->text = $this->language->get('text_pagination');



			$pagination->url = $this->url->link('gallery/gallery'.'&album_id='. $link.'&page={page}');



			$data['pagination'] = $pagination->render();



			$data['continue'] = $this->url->link('common/home');



			



		}



		else



		{



				



				if(isset($this->request->get['page'])) {



				$page = $this->request->get['page'];



				} else {



				$page = 1;



				}



			



				$filter_data = array(



					'order' => 'DESC',



					'start' => 0,



					'limit' => $setting['limit']



				);



				



				$gallery_info = $this->model_catalog_gallery->getgallerys($filter_data);



				



			    foreach($gallery_info as $gallerys){



				if($gallerys['image']){



					$image = $this->model_tool_image->resize($gallerys['image'],$this->config->get('gallerysetting_thumb_width'), $this->config->get('gallerysetting_thumb_height'),$this->config->get('gallerysetting_thumb_width'), $this->config->get('gallerysetting_thumb_height'));



				}else{



					$image = false;



				}



				$totalphoto = $this->model_catalog_gallery->countImage($gallerys['album_id']);



				//print_r($totalphoto);die();



				$data['gallerys'][]=array(



				'album_id' => $gallerys['album_id'],



				'album'	   => $gallerys['name'],				



				'description' => utf8_substr(strip_tags(html_entity_decode($gallerys['description'], ENT_QUOTES, 'UTF-8')), 0, 125) . '..',



				'image'		 =>$image,



				'totalphoto' =>$totalphoto,



				'href'	     => $this->url->link('gallery/photos' .'&album_id='. $gallerys['album_id'])



				);



			}



		}





		  return $this->load->view('extension/module/tmdgallery', $data);



	}



	}



}
