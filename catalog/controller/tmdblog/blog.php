<?php
class ControllerTmdblogBlog extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('tmdblog/blog');
		
		$this->load->model('tool/image');
		
		$this->load->model('tmdblog/blog');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$this->document->addStyle('catalog/view/theme/realestate/stylesheet/tmdlatestblog.css');
			$data['uploadimges'] = $this->url->link('tmdblog/blog/uploadimage') ;
			/*setting*/
				$data['tmdblogsetting_blogarticle'] = $this->config->get('tmdblogsetting_blogarticle');
				$data['tmdblogsetting_blogdescp'] = $this->config->get('tmdblogsetting_blogdescp');
				$data['tmdblogsetting_blogfeedbackrow'] = $this->config->get('tmdblogsetting_blogfeedbackrow');
				$data['tmdblogsetting_blogfacebook'] = $this->config->get('tmdblogsetting_blogfacebook');
				$data['tmdblogsetting_blogtwitter'] = $this->config->get('tmdblogsetting_blogtwitter');
				$data['tmdblogsetting_blogpinterest'] = $this->config->get('tmdblogsetting_blogpinterest');
				$data['tmdblogsetting_bloggoogle'] = $this->config->get('tmdblogsetting_bloggoogle');
				$data['tmdblogsetting_blogarticleimg'] = $this->config->get('tmdblogsetting_blogarticleimg');
				/*setting*/
		
			
			if(isset($this->request->get['blog_id'])){
				$blog_id = $this->request->get['blog_id'];
			}else{
				$blog_id = '';
			}
			
			
			$data['blog_id']=$blog_id ;
			
			
		
			$data['latestblogs'] = array();
		
			$blog_info = $this->model_tmdblog_blog->getBlog($blog_id);
		
			if ($blog_info) {
		
			
				$url='';
				
				$data['breadcrumbs'][] = array(
				'text' => 'BlogCategory',
				'href' => $this->url->link('tmdblog/allblogcategory')
				);
				
				$data['breadcrumbs'][] = array(
				'text' => $blog_info['name'],
				'href' => $this->url->link('tmdblog/blog', $url . '&blog_id=' . $this->request->get['blog_id'])
				);
				
				
				$data['heading_title'] = $blog_info['name'];
				$this->document->setTitle($this->language->get('heading_title'));
				$data['button_list'] = $this->language->get('button_list');
				$data['button_grid'] = $this->language->get('button_grid');
				
				//new code start here
				$data['text_coments'] = $this->language->get('text_coments');
				$data['text_coments'] = $this->language->get('text_coments');
				$data['text_forcomment'] = $this->language->get('text_forcomment');
				$data['text_login'] = $this->language->get('text_login');
				$data['text_belogin'] = $this->language->get('text_belogin');
				$data['text_register'] = $this->language->get('text_register');
				$data['text_forgot'] = $this->language->get('text_forgot');
				$data['text_password'] = $this->language->get('text_password');
				$data['button_signin'] = $this->language->get('button_signin');
				$data['text_email'] = $this->language->get('text_email');
				$data['text_tages'] = $this->language->get('text_tages');
				//new code end here
				
				
				
				
				$this->document->setTitle($blog_info['meta_title']);
				$this->document->setDescription($blog_info['meta_description']);
				$this->document->setKeywords($blog_info['meta_keyword']);
				$this->document->addLink($this->url->link('tmdblog/blog', 'blog_id=' . $this->request->get['blog_id']), 'canonical');
				
				$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
				$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
				$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
				$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
				$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

				$data['name'] = $blog_info['name'];
				$data['blogcoment'] = $blog_info['blogcoment'];
				
				$data['globalblogcoment'] = $this->config->get('tmdblogsetting_globalcoment');
				if($data['globalblogcoment'])
				{
				$data['globalblogcoment']=$data['blogcoment'];
				}
				$this->load->model('tool/image');
				if ($blog_info['image']) {
					$data['thumb'] = $this->model_tool_image->resize($blog_info['image'], 1170, 700);
				} else {
					$data['thumb'] = '';
				}
				
				// New code  
				$data['tags']=array();
				$tagss = explode(',',$blog_info['tag']);
					if(!empty($tagss))
					{
						foreach($tagss as $tag){
							$data['tags'][] = array(
							'tag'  => $tag,			
							'href'  => $this->url->link('tmdblog/allblogcategory', 'tag=' . $tag)
							);
						} 
					}
				// New code 
				
				$data['date_added'] = date($this->language->get('fulldate_format_added'), strtotime($blog_info['date_modified']));
				
				$data['description'] = html_entity_decode($blog_info['description'], ENT_QUOTES, 'UTF-8');
				$data['href'] = $this->url->link('tmdblog/blog', '&blog_id=' . $this->request->get['blog_id']);
				$data['viewed'] = $blog_info['viewed'].' ' . $this->language->get('text_views');
				$data['username'] = $blog_info['username'];
				
				$data['logged'] = $this->agent->isLogged();
				
				
				$data['comments'] = $this->model_tmdblog_blog->Updatecomment($blog_id);
				$data['comment_info'] =array();
				$comment_infos = $this->model_tmdblog_blog->getcomments($blog_id);
				
				foreach($comment_infos as $info){
				
				if ($info['commimage']) {
					$image = $this->model_tool_image->resize($info['commimage'], 333,250);
				} else {
					$image = '';
				}
		
				
				$data['comment_info'][] =array(
				'comment_id' => $info['comment_id'],
				'blogcoment' => $info['blogcoment'],
				'username'   => $info['agentname'],
				
				'image' => $image,
				'date_added' => $this->time_ago($info['date_modified']),
				
				'comment' => strip_tags(html_entity_decode($info['comment'], ENT_QUOTES, 'UTF-8'))
				
				);	
				}

				 $this->model_tmdblog_blog->updateViewed($blog_id);
				 
				
				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				//$data['column_right'] = $this->load->controller('common/blog_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');
				
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/tmdblog/blog')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/tmdblog/blog', $data));
				} else {
					$this->response->setOutput($this->load->view('tmdblog/blog', $data));
				}
		
			}else{
			
				$url = '';

				if (isset($this->request->get['path'])) {
					$url .= '&path=' . $this->request->get['path'];
				}

				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}

				if (isset($this->request->get['manufacturer_id'])) {
					$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
				}

				if (isset($this->request->get['search'])) {
					$url .= '&search=' . $this->request->get['search'];
				}

				if (isset($this->request->get['tag'])) {
					$url .= '&tag=' . $this->request->get['tag'];
				}

				if (isset($this->request->get['description'])) {
					$url .= '&description=' . $this->request->get['description'];
				}

				if (isset($this->request->get['category_id'])) {
					$url .= '&category_id=' . $this->request->get['category_id'];
				}

				if (isset($this->request->get['sub_category'])) {
					$url .= '&sub_category=' . $this->request->get['sub_category'];
				}

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
				
				if(isset($this->request->get['blog_id'])){
					$blog_id = $this->request->get['blog_id'];
				}else{
					$blog_id = '';
				}

				$data['breadcrumbs'][] = array(
					'text' => $this->language->get('text_error'),
					'href' => $this->url->link('tmdblog/blog', $url . '&blog_id=' . $blog_id)
				);
				
				
				$this->document->setTitle($this->language->get('text_error'));

				$data['heading_title'] = $this->language->get('text_error');

				$data['text_error'] = $this->language->get('text_error');

				$data['button_continue'] = $this->language->get('button_continue');

				$data['continue'] = $this->url->link('common/home');

				$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['blog_right'] = $this->load->controller('common/blog_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found', $data));
				} else {
					$this->response->setOutput($this->load->view('error/not_found', $data));
				}	
			
			}
	
}

		public function addblogcomments() {	
			
		
			$json=array();
			$this->load->model('tmdblog/blog');
			
			if($this->request->post){
			if(empty($this->request->post['comment']))
			{
				$json['error']='Please add Comment';
			} else
			{
			$this->model_tmdblog_blog->Addblogcomment($this->request->post);
			$json['success']='Comment Added';
			
			if(isset($this->request->post['blog_id'])){
				$blog_id = $this->request->post['blog_id'];
			}else{
				$blog_id = '';
			}
			$json['comments'] = $this->model_tmdblog_blog->Updatecomment($blog_id);
			}
			}
			$this->response->setOutput(json_encode($json));
			
		}
		
		public function loadblogcomment() {
		
		$this->load->model('tool/image');
		
		$url= '';
		$data['logged'] = $this->agent->isLogged();
		$data['globalblogcoment'] = $this->config->get('tmdblogsetting_globalcoment');
		
		$this->load->model('tmdblog/blog');
			$data['comment_info']= array();
		
			if(isset($this->request->get['blog_id'])){
				$blog_id = $this->request->get['blog_id'];
			}else{
				$blog_id = '';
			}
		$data['blog_id'] = $blog_id ;
		
		$comment_infos = $this->model_tmdblog_blog->getcomments($blog_id);
			//print_r($comment_infos); die();
			
		$data['uploadimges'] = $this->url->link('tmdblog/blog/uploadimage') ;
		foreach($comment_infos as $info){
		
		if ($info['commimage']) {
		$image = $this->model_tool_image->resize($info['commimage'], $this->config->get('tmdblogsetting_image_comntbanner_width'), $this->config->get('tmdblogsetting_image_comntbanner_height'));
		} else {
		$image = '';
		}
		
		$data['comment_info'][] =array(
		'comment_id' => $info['comment_id'],
		'blogcoment' => $info['blogcoment'],
		'image' => $image,
		'date_added' => $this->time_ago($info['date_modified']),
		'username'   => $info['agentname'],
		'comment' => strip_tags(html_entity_decode($info['comment'], ENT_QUOTES, 'UTF-8'))
	
		);	
		}
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['blog_right'] = $this->load->controller('common/blog_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/tmdblog/comments/loadblogcomment')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/tmdblog/comments/loadblogcomment', $data));
		} else {
			$this->response->setOutput($this->load->view('tmdblog/comments/loadblogcomment', $data));
		}
		
		}
		
		

		public function time_ago($date) {
			date_default_timezone_set("Asia/Kolkata"); 
			if(empty($date)){
				return "No date provided";
			}

			$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

			$lengths = array("60","60","24","7","4.35","12","10");

			$now = time();

			$unix_date = strtotime($date);

			// check validity of date

			if(empty($unix_date)) {

			return "Bad date";

			}

			// is it future date or past date

		if($now > $unix_date) {

			$difference = $now - $unix_date;

			$tense = "ago";
		} else {

		$difference = $unix_date - $now;
		$tense = "from now";}

		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {

		$difference /= $lengths[$j];

		}

		$difference = round($difference);

		if($difference != 1) {

		$periods[$j].= "s";

		}

		return "$difference $periods[$j] {$tense}";
	}
	
	
		public function addlogin() {	
				
		$json=array();
				//$this->load->model('catalog/login');
				
				
				if (empty($this->request->post['email']) || (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])))
				{
					$json['error']['email']='Enter valid email';
				}
					
				elseif (empty($this->request->post['password']))
				{
					$json['error']['password']='Password must enter';
				}
					
				else
				{
				
				if (!$this->agent->login($this->request->post['email'], $this->request->post['password'])) {
				$json['error']['email'] = 'Email and Password not match ';
				} else {
				$json['success']='Success';
				}
				}
				
				
				$this->response->setOutput(json_encode($json));
		}
		
		
		
		public function uploadcommentimage() {
		$this->load->language('tool/upload');
			$this->load->model('tool/image');
				
					
		$json = array();

		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));

			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
				$json['error'] = $this->language->get('error_filename');
			}

			// Allowed file extension types
			$allowed = array();

			$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

			$filetypes = explode("\n", $extension_allowed);

			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}

			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			// Allowed file mime types
			$allowed = array();

			$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

			$filetypes = explode("\n", $mime_allowed);

			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}

			if (!in_array($this->request->files['file']['type'], $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			// Check to see if any PHP files are trying to be uploaded
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			// Return any upload error
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}

		if (!$json) {
			$file = md5(mt_rand()).$filename ;

			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE.'commentmage/' . $file);

			// Hide the uploaded file name so people can not link to it directly.
			$this->load->model('tool/upload');

			$json['success'] = $this->language->get('text_upload');
			$json['file'] ='commentmage/'.$file;
			$file1=$this->model_tool_image->resize('commentmage/'.$file, $this->config->get('tmdblogsetting_image_comntthumb_width'), $this->config->get('tmdblogsetting_image_comntthumb_height'));
			$json['file1'] = $file1;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}
