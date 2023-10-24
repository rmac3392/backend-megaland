<?php
class ControllerTmdblogAllblogCategory extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('tmdblog/allblogcategory');
		
		$this->load->model('tmdblog/blog');
		
		$this->load->model('tool/image');
		
		$this->document->addStyle('catalog/view/theme/realestate/stylesheet/tmdlatestblog.css');
		/*setting*/
			$data['tmdblogsetting_article'] = $this->config->get('tmdblogsetting_article');
			$data['tmdblogsetting_descp'] = $this->config->get('tmdblogsetting_descp');
			$data['tmdblogsetting_feedbackrow'] = $this->config->get('tmdblogsetting_feedbackrow');
			$data['tmdblogsetting_facebook'] = $this->config->get('tmdblogsetting_facebook');
			$data['tmdblogsetting_twitter'] = $this->config->get('tmdblogsetting_twitter');
			$data['tmdblogsetting_pinterest'] = $this->config->get('tmdblogsetting_pinterest');
			$data['tmdblogsetting_google'] = $this->config->get('tmdblogsetting_google');
			$data['tmdblogsetting_articleimg'] = $this->config->get('tmdblogsetting_articleimg');
			
		/*setting*/
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		// New code 
		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} else {
			$tag = false;
		}
		if (isset($this->request->get['search'])) {
			$search = $this->request->get['search'];
		} else {
			$search = false;
		}
		
		// New code 
		
		if (isset($this->request->get['tmdblogcategory_id'])) {
			$path = $this->request->get['tmdblogcategory_id'];
		} else {
			$path = 0;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		}
		

		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_blogs'),
			'href' => $this->url->link('tmdblog/allblogcategory')
		);
			
			
			$filter_data = array(
			'filter_category_id'=>$path,
			// New code 
			'filter_tag'=>$tag,
			'filter_name'=>$search,
			// New code 
			'start'=>($page - 1) * $limit,
			'limit'=>$limit
				
			);
			
			$allblogcategory_total = $this->model_tmdblog_blog->getTotalblogs($filter_data);
			$data['allblogcategorys'] = array();
			$results = $this->model_tmdblog_blog->getBlogs($filter_data);
			//	print_r($results); die();
				
			foreach ($results as $result) {
			
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'],768 ,460);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png' ,768 ,460);
				}
				$comments = $this->model_tmdblog_blog->Updatecomment($result['blog_id']);
				
				$data['allblogcategorys'][] = array(
				
					'blog_id'  => $result['blog_id'],
					'comment'     => $comments,
					'thumb'       => $image,
					'name'        => $result['name'],
					'username'        => $result['username'],
					'viewed'        => $result['viewed'].' ' . $this->language->get('text_views'),
					'date_added'  => date($this->language->get('date_format_added'), strtotime($result['date_modified'])),
					'month_added'  => date($this->language->get('month_format_added'), strtotime($result['date_modified'])),
					
					'description' => utf8_substr(strip_tags(html_entity_decode($result[
					'description'], ENT_QUOTES, 'UTF-8')), 0, 200).'...',
					
					'href'        => strip_tags(html_entity_decode($this->url->link('tmdblog/blog', 'blog_id=' . $result['blog_id']), ENT_QUOTES, 'UTF-8'))
				);
			}
			
			$url = '';
			// New code 
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}
			// New code 
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
			$pagination = new Pagination();
			$pagination->total = $allblogcategory_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('tmdblog/allblogcategory'. $url . '&page={page}');
			

			$data['pagination'] = $pagination->render();
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($allblogcategory_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($allblogcategory_total - $limit)) ? $allblogcategory_total : ((($page - 1) * $limit) + $limit), $allblogcategory_total, ceil($allblogcategory_total / $limit));
			
			
			$data['heading_title'] = $this->language->get('heading_title');
			//new code start here
			$data['text_posted'] = $this->language->get('text_posted');
			$data['text_readmore'] = $this->language->get('text_readmore');
			$data['text_tweet'] = $this->language->get('text_tweet');
			//new code end here
			
			$tmdblogsetting_description = $this->config->get('tmdblogsetting_description');
			
			$this->document->setTitle($tmdblogsetting_description[$this->config->get('config_language_id')]['name']);
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');
			
			$data['column_left'] = $this->load->controller('common/column_left');
			 $data['column_right'] = $this->load->controller('common/column_right');
		
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/tmdblog/allblogcategory')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/tmdblog/allblogcategory', $data));
			} else {
				$this->response->setOutput($this->load->view('tmdblog/allblogcategory', $data));
			}
	
}
}