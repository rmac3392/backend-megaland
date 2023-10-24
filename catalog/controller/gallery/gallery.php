<?php 
class ControllerGallerygallery extends Controller{  
	public function index(){ 


		$this->language->load('gallery/gallery');


		


		$data['heading_title']= $this->language->get('heading_title');


		$data['error']= $this->language->get('error');


		$this->load->model('catalog/gallery');


		$this->document->addStyle('catalog/view/theme/realestate/stylesheet/tmdphotogallery.css');


		$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');


		$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');


		$this->load->model('tool/image'); 


		$this->document->setTitle($this->language->get('heading_title'));  


		


		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/home')


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('gallery/gallery', '', 'SSL')


		);


		$data['gallerys']=array();


		if(isset ($this->request->get['album_id']) && !empty($this->request->get['album_id'])){


		


			if(isset($this->request->get['page'])) {


				$page = $this->request->get['page'];


			} else {


				$page = 1;


			}


		


			$url = '';


			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			


			$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('gallery/gallery', '&album_id='.$this->request->get['album_id'], 'SSL')


		);





		


			$data = array(


				'start' => ($page - 1) * $this->config->get('config_admin_limit'),


				'limit' => $this->config->get('config_admin_limit'),


				'album_id' => $this->request->get['album_id']


			);


		


			$data['images']=array();


			$photo_count = $this->model_catalog_gallery->countImage($data);


			


			$photo_info = $this->model_catalog_gallery->getphotos($data);


		


			foreach($photo_info as $info){


				if(!empty($info['images'])){


					$images= $this->model_tool_image->resize($info['images'],128,148);


				}else{


					$images = false;


				}


				if (!empty($info['images'])){


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





		$url = '';


		if (isset($this->request->get['page'])) {


		$url .= '&page=' . $this->request->get['page'];


		}


		if (isset($this->request->get['limit'])) {


			$limit = $this->request->get['limit'];


		} else {


			$limit = $this->config->get('gallerysetting_limtofgallery');


			


		}


	

		$data_filter = array(


				'start' => ($page - 1) * $this->config->get('gallerysetting_limtofgallery'),


				'limit' => $limit,


			);


		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/home')


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('gallery/gallery', '', 'SSL')


		);


             $gallery_count = $this->model_catalog_gallery->countalbumtotal($data_filter);


			$gallery_info = $this->model_catalog_gallery->getgallerys($data_filter);


			foreach($gallery_info as $gallerys){


				if($gallerys['image']){


					$image = $this->model_tool_image->resize($gallerys['image'],1000,600);


				}


			


			if(!empty($gallerys['description'])){


				$description=utf8_substr(strip_tags(html_entity_decode($gallerys['description'], ENT_QUOTES, 'UTF-8')), 0,100);


			}

			$totalphoto = $this->model_catalog_gallery->countImage($gallerys['album_id']);


				


				$data['gallerys'][]=array(


				'album_id' => $gallerys['album_id'],


				'album' => $gallerys['name'],


				'description' =>$description,


				'image'		=>$image,


				'totalphoto' =>$totalphoto,


				'href'	   => $this->url->link('gallery/photos' .'&album_id='. $gallerys['album_id'])


				);


			}


			$link='';

			$pagination = new Pagination();

			$pagination->total = $gallery_count;


			$pagination->page = $page;


			$pagination->limit = $this->config->get('config_admin_limit');


			$pagination->text = $this->language->get('text_pagination');


			$pagination->url = $this->url->link('gallery/gallery'.'&album_id='. $link.'&page={page}');


			$data['pagination'] = $pagination->render();


			$data['continue'] = $this->url->link('common/home');

			$data['results'] = sprintf($this->language->get('text_pagination'), ($gallery_count) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($gallery_count - $limit)) ? $gallery_count : ((($page - 1) * $limit) + $limit), $gallery_count, ceil($gallery_count / $limit));
      

			


			


		}


			


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['column_right'] = $this->load->controller('common/column_right');


		$data['content_top'] = $this->load->controller('common/content_top');


		$data['content_bottom'] = $this->load->controller('common/content_bottom');


		$data['footer'] = $this->load->controller('common/footer');


		$data['header'] = $this->load->controller('common/header');





		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/gallery/gallery')) {


			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/gallery/gallery', $data));


		} else {


			$this->response->setOutput($this->load->view('gallery/gallery', $data));


		}									


    	 


  	}


}


?>


