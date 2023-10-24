<?php
class ControllerExtensionModuleTmdfilterProduct extends Controller {

		public function index($setting) {
		
		$this->load->language('extension/module/tmdfilterproduct');
		
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
		
		///settings
		$data['recentpoststatus']= $setting['recentpoststatus'];
		$data['popularstatus']= $setting['popularstatus'];
		$data['commentstatus']= $setting['commentstatus'];
		$data['moduletitle']= $setting['moduletitle'];
		$data['recentposttitle']= $setting['module_title'][$this->config->get('config_language_id')]['recentposttitle'];
		$data['populartitle']= $setting['module_title'][$this->config->get('config_language_id')]['populartitle'];
		$data['commenttitle']= $setting['module_title'][$this->config->get('config_language_id')]['commenttitle'];
		///settings
		
		// New code 
		$data['text_search'] = $this->language->get('text_search');
		
		
		if(isset($this->request->get['search']))
		{
			$data['search']=$this->request->get['search'];
		}
		else
		{
			$data['search']='';
		}	
		// New code 
		
		///recentpost
		
		if($setting['recentpoststatus']){
		
		$this->load->model('tmdblog/blog');
		
		$this->load->model('tool/image');

		$data['recentposts'] = array();

		$filter_data = array(	
			'sort'  => 'a.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['recentpostlimit']
		);

		
		$results = $this->model_tmdblog_blog->getBlogs($filter_data);

			foreach ($results as $result) {
			
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['recentpostwidth'], $setting['recentpostheight']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['recentpostwidth'], $setting['recentpostheight']);
				}

				
				$data['recentposts'][] = array(
					'blog_id'  => $result['blog_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'date_added'  => date($this->language->get('fulldate_format_added'), strtotime($result['date_modified'])),
					
					'description' => utf8_substr(strip_tags(html_entity_decode($result[
					'description'], ENT_QUOTES, 'UTF-8')), 0, 75).'...',
					
					'href'        => $this->url->link('tmdblog/blog', 'blog_id=' . $result['blog_id']),
				);
			}
		}
		///recentpost
		
		///popular
		
		$data['popularpost'] = array();
		$popularposts= $this->model_tmdblog_blog->getPopularBlog(5);
		
		foreach($popularposts as $post){
		if ($post['image']) {
					$image = $this->model_tool_image->resize($post['image'], $setting['recentpostwidth'], $setting['recentpostheight']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['recentpostwidth'], $setting['recentpostheight']);
				}

		$data['popularpost'][] = array(
		'blog_id'  => $post['blog_id'],
		'thumb'       => $image,
		'name'        => $post['name'],
		'date_added'  => date($this->language->get('fulldate_format_added'), strtotime($post['date_modified'])),
		
		'description' => utf8_substr(strip_tags(html_entity_decode($post[
		'description'], ENT_QUOTES, 'UTF-8')), 0, 75).' ',
		
		'href'        => $this->url->link('tmdblog/blog', 'blog_id=' . $post['blog_id']),
		
		);
		
		}
		
		
		
		
		if($setting['popularstatus']){
			$this->document->addstyle('catalog/view/theme/default/stylesheet/tmdlatestblog.css');
		
		$this->load->model('tmdblog/blog');
		
		$this->load->model('tool/image');

		$data['recentposts'] = array();

		$filter_data = array(	
			'sort'  => 'a.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['recentpostlimit']
		);

		$results = $this->model_tmdblog_blog->getBlogs($filter_data);

			foreach ($results as $result) {
			
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['recentpostwidth'], $setting['recentpostheight']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['recentpostwidth'], $setting['recentpostheight']);
				}

				
				$data['recentposts'][] = array(
					'blog_id'  => $result['blog_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'date_added'  => date($this->language->get('fulldate_format_added'), strtotime($result['date_modified'])),
					'description' => utf8_substr(strip_tags(html_entity_decode($result[
					'description'], ENT_QUOTES, 'UTF-8')), 0, 75).'&nbsp; ' .' <a href="'.$this->url->link('tmdblog/blog', 'blog_id=' . $result['blog_id']).'">'.$this->language->get('text_readmore').'</a>',
					
					'href'        => $this->url->link('tmdblog/blog', 'blog_id=' . $result['blog_id']),
				);
			}
		}
		///popular
		
		///comment
		
		$data['comments'] = array();
		$data['limit'] = $this->config->get('tmdblogsetting_commentlimit');
		
		$commentss= $this->model_tmdblog_blog->getLatestcomments($data['limit']);
	//	print_r($commentss); 
		foreach($commentss as $posts){
			$data['comments'][] = array(
			'comment'  => utf8_substr(strip_tags(html_entity_decode($posts['comment'], ENT_QUOTES, 'UTF-8')), 0, 20),
			
			'customer_name'  => $posts['firstname'].' '. $posts['lastname'],
			'href'  => $this->url->link('tmdblog/blog', 'blog_id=' . $posts['blog_id'])
			
			
			);
		} 
		
		///comment
		
		///Blog Tags
		
		$data['tags'] = array();
		$data['limit'] = $this->config->get('tmdblogsetting_commentlimit');
		
		$tagss= $this->model_tmdblog_blog->getLatesttags();
		 
		foreach($tagss as $tag){
			$data['tags'][] = array(
			'blog_id'  => $tag['blog_id'],			
			'tag'  => $tag['tag'],			
			'href'  => $this->url->link('tmdblog/allblogcategory', 'tag=' . $tag['tag'])
			);
		} 
		
		///comment
		
			$data['heading_title'] = $this->language->get('heading_title');
			$data['text_readmore'] = $this->language->get('text_readmore');
			$data['text_tags'] = $this->language->get('text_tags');

			$data['text_tax'] = $this->language->get('text_tax');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/tmdfilterproduct/tmdfilterproduct_tab')) {
				return $this->load->view($this->config->get('config_template') . '/template/extension/module/tmdfilterproduct/tmdfilterproduct_tab', $data);
			} else {
				return $this->load->view('extension/module/tmdfilterproduct/tmdfilterproduct_tab', $data);
			}
	}
}
