<?php
class ControllerExtensionModuleTmdCategorySearch extends Controller {
	public function index() {
		$this->load->language('extension/module/tmdcategorysearch');
		$this->document->addStyle('catalog/view/theme/realestate/stylesheet/tmdlatestblog.css');
		$data['heading_title'] = $this->language->get('heading_title');
				
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['tmdblogcategory_id'] = $parts[0];
		} else {
			$data['tmdblogcategory_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('tmdblog/allblogcategory');

		$data['categories'] = array();

		$categories = $this->model_tmdblog_allblogcategory->getblogCategories(0);
		//print_r($categories); die();
		foreach ($categories as $tmdblogcategory) {
			$children_data = array();

				if ($tmdblogcategory['tmdblogcategory_id'] == $data['tmdblogcategory_id']) {
					
				$children = $this->model_tmdblog_allblogcategory->getblogCategories($tmdblogcategory['tmdblogcategory_id']);

				foreach($children as $child) {
					$filter_data = array('filter_tmdblogcategory_id' => $child['tmdblogcategory_id'], 'filter_sub_tmdblogcategory' => true);

					$children_data[] = array(
						'tmdblogcategory_id' => $child['tmdblogcategory_id'],
						'name' => $child['name'],
						'href' => $this->url->link('tmdblog/allblogcategory', 'tmdblogcategory_id=' . $tmdblogcategory['tmdblogcategory_id'] . '_' . $child['tmdblogcategory_id'])
					);
				}
			}

			$filter_data = array(
				'filter_tmdblogcategory_id'  => $tmdblogcategory['tmdblogcategory_id'],
				'filter_sub_tmdblogcategory' => true
			);

			$data['categories'][] = array(
				'tmdblogcategory_id' => $tmdblogcategory['tmdblogcategory_id'],
				'name'        => $tmdblogcategory['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('tmdblog/allblogcategory', 'tmdblogcategory_id=' . $tmdblogcategory['tmdblogcategory_id'])
			);
		}
		return $this->load->view('extension/module/tmdcategorysearch', $data);
		
		
	}
}
