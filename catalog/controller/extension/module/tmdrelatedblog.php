<?php
class ControllerExtensionModuletmdrelatedblog extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/tmdrelatedblog');
		
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
			$this->document->addStyle('catalog/view/theme/realestate/stylesheet/tmdlatestblog.css');
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['blogss'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}
		
		if (!empty($setting['blogs'])) {
			$blogss = array_slice($setting['blogs'], 0, (int)$setting['limit']);

			foreach ($blogss as $blog_id) {
				$blog_info = $this->model_tmdblog_blog->getBlog($blog_id);
					
				if ($blog_info) {
					if ($blog_info['image']) {
						$image = $this->model_tool_image->resize($blog_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}
					
					$comments = $this->model_tmdblog_blog->Updatecomment($blog_info['blog_id']);
					
					$data['blogss'][] = array(
						'blog_id'  => $blog_info['blog_id'],
						'thumb'       => $image,
						'name'        => $blog_info['name'],
						'comment'     => $comments,
						'date_added'  => date($this->language->get('fulldate_format_added'), strtotime($blog_info['date_modified'])),
						'viewed'   => $blog_info['viewed'],
						'description' => utf8_substr(strip_tags(html_entity_decode($blog_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
						'href'        => $this->url->link('tmdblog/blog', 'blog_id=' . $blog_info['blog_id'])
					);
				}
			}
		}

		if ($data['blogss']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/tmdrelatedblog')) {
				return $this->load->view($this->config->get('config_template') . '/template/extension/module/tmdrelatedblog', $data);
			} else {
				return $this->load->view('extension/module/tmdrelatedblog', $data);
			}
		}
	}
}