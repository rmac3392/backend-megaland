<?php

class ControllerCommonMegaHeader  extends Controller {

	public function index() {

			$this->load->language('common/header');

			

			$this->load->model('catalog/tmd_megaheader');

			$this->load->model('catalog/information');

			$this->load->model('catalog/manufacturer');

			$this->load->model('catalog/category');

			$this->load->model('catalog/product');
			$this->load->model('property/property');
			$this->load->model('property/category');

			$this->load->model('tool/image');

			

			///setting////

			$data['headercontainer']=$this->config->get('megaheader_bg_color');

			$data['headertitlecolor']=$this->config->get('megaheader_title');

			$data['headertitlehovcolor'] = $this->config->get('megaheader_hovtitle');

			$data['headersublink']=$this->config->get('megaheader_link');

			$data['headerhlink']=$this->config->get('megaheader_link_hover');

			$data['headerlinksize'] = $this->config->get('megaheader_sub_link');

			$data['headertitlesize'] = $this->config->get('megaheader_title_font');

			$data['menubgtitle'] = $this->config->get('megaheader_bgtitle');

			$data['menubghovtitle'] = $this->config->get('megaheader_bghovtitle');

			$data['dropdownbg'] = $this->config->get('megaheader_drpmebg');

			$data['dropdownbgtitle'] = $this->config->get('megaheader_powered');

			$data['menuexpend'] = $this->config->get('megaheader_menuexpend');

			

			///setting////

			$data['text_category'] = $this->language->get('text_category');

			$data['megaheaders'] = array();



			

				

			$results=$this->model_catalog_tmd_megaheader->getmegaheaders();

			//print_r($results);

				foreach($results as $result)

				{

					

				if(!empty($result['title'])) {

					$products=array();	

					$submenu=array();

					$informations = unserialize($result['informations']);

					$productsetting = unserialize($result['productsetting']);

					

					if($informations){	

					

					foreach($informations as $information)

					{

					  

						$information =$this->model_catalog_information->getInformation($information);

						

						$submenu[]=array(

							'name'=> $information['title'],

							'description'     => html_entity_decode($information['description']),

							'href'=> $this->url->link('information/information', 'information_id=' . $information['information_id']),

							'main' => $result['enable']

						);

					}

					}

					

				

				

				if(!empty($result['manufactures'])){

					

					$manufactures = unserialize($result['manufactures']);

					

					if($manufactures){	

						

					foreach($manufactures as $manufacture)

					{

						$image='';

						$manufacture = $this->model_catalog_manufacturer->getManufacturer($manufacture);

						

						if(isset($productsetting['manufacture']['manufacturerimage']))

						{

						if ($manufacture['image']) {

						$image = $this->model_tool_image->resize($manufacture['image'], $this->config->get('megaheader_manufacture_width'), $this->config->get('megaheader_manufacture_height'));

						}

						else

						{

						$image = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_manufacture_width'), $this->config->get('megaheader_manufacture_height'));		

						}

						}

						

						$manufacture_product=array();

						$filter_data = array(

						'filter_manufacturer_id' => $manufacture['manufacturer_id'],

						'start'                  => '0',

						'limit'                  => '10'

						);



					if(isset($productsetting['manufacture']['product']))

						{



					$manufactureproduct = $this->model_property_property->getPropertys($filter_data);
					
						if(!empty($manufactureproduct)){	

							foreach($manufactureproduct as $product)

											{

												$image='';

						if(isset($productsetting['manufacture']['image']))

						{

						if ($product['image']) {

						$image = $this->model_tool_image->resize($product['image'], $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));

						}

						else

						{

						$image = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));		

						}

						}

						if(isset($productsetting['manufacture']['price']))

						{

						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {

						$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));

						} else {

						$price = false;

						}



					if ((float)$product['special']) {

						$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')));

					} else {

						$special = false;

					}

						}

						else

						{

							$price = false;

							$special = false;

						}

					

					

					

						

						if(isset($this->request->get['path'])){

						$path = $this->request->get['path'];

						}else{

						$path='';

						}

						$manufacture_product[]=array(

							'name'     =>isset($productsetting['manufacture']['name']) ? $product['name'] : '',

							'model'     =>isset($productsetting['manufacture']['model']) ? $product['model'] : '',

							'image'     =>$image,

							'sku'     =>isset($productsetting['manufacture']['sku']) ? $product['sku'] : '',

							'upc'     =>isset($productsetting['manufacture']['upc']) ? $product['upc'] : '',

							'description'     => isset($productsetting['manufacture']['description']) ? utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..' : ' ',

							'price'=>$price,

							'special'=>$special,

							'href'     => $this->url->link('product/product', 'path=' . $path . '&product_id=' . $product['product_id']),

						);

												

											}

											}	

						}				

						$submenu[]=array(

							'name'=> $manufacture['name'],

							'main'=>$result['enable'],

							'product'=> $manufacture_product,

							'image'=> $image,

							'href'=> $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacture['manufacturer_id'])

						);

					}

					

					}

					}

				

				if(isset($result['categories'])){

					

					

					$categories = unserialize($result['categories']);

					if($categories){	

					foreach($categories as $categorie)

					{	

						

						$subcategory=array();

						$image='';

						$categorie = $this->model_catalog_category->getCategory($categorie);
						

						if(isset($productsetting['category']['categoryimage']))

						{

						if ($categorie['image']) {

						$image = $this->model_tool_image->resize($categorie['image'], $this->config->get('megaheader_category_width'), $this->config->get('megaheader_category_height'));

						}

						else{

						$image = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_category_width'), $this->config->get('megaheader_category_height'));

						}

						

						}

						

						if(isset($productsetting['category']['subcategory']))

						{

						$subcategorys = $this->model_catalog_category->getCategories($categorie['category_id']);
						//print_r($subcategorys); die();

					foreach ($subcategorys as $sub_category) {

						$filter_data = array(

							'filter_category_id'  => $sub_category['category_id'],

							'filter_sub_category' => true

						);

							

								

						if(isset($productsetting['category']['categoryimage']))

						{

						if (isset($sub_category['image'])) {

						$image = $this->model_tool_image->resize($sub_category['image'], $this->config->get('megaheader_category_width'), $this->config->get('megaheader_category_height'));

						}

						else{

						$image = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_category_width'), $this->config->get('megaheader_category_height'));

						}

						

						}

						

						

						

						$subcategory[] = array(

							'name' => $sub_category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_property_property->getTotalProductsall($filter_data) . ')': ''),

							'image'=>$image,

							'description'     => isset($productsetting['category']['categorydescription'])? utf8_substr(strip_tags(html_entity_decode($sub_category['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..':'',

							'href' => $this->url->link('property/category', 'filter_propertycategory=' . $sub_category['category_id'])

						);

						}

						}

						

						

						//// category product ///

						$category_product='';

						

						if(isset($productsetting['category']['product']))

						{

						

						$filter_data = array(

							'filter_category_id' =>  $categorie['category_id'],
							'start'              => '0',
							'limit'              => '10'

						);



						

						$categoryproducts = $this->model_property_property->getPropertys($filter_data);
						

						if($categoryproducts){	

					foreach($categoryproducts as $product)

					{

						$image='';

						if(isset($productsetting['category']['image']))

						{

						if ($product['image']) {

						$image = $this->model_tool_image->resize($product['image'], $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));

						}

						else

						{

						$image = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));		

						}

						}

						if(isset($productsetting['category']['price']))

						{

						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {

						$price = $product['price'];

						} else {

						$price = false;

						}



					/*if ((float)$product['special']) {

						$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')));

					} else {

						$special = false;

					}*/

						}

						else

						{

							$price = false;

							$special = false;

						}

					

					

					

						

						if(isset($this->request->get['path'])){

						$path = $this->request->get['path'];

						}else{

						$path='';

						}

						$category_product[]=array(

							'name'     =>isset($productsetting['category']['name']) ? $product['name'] : '',

							'model'     =>isset($productsetting['category']['model']) ? $product['model'] : '',

							'image'     =>$image,

							'sku'     =>isset($productsetting['category']['sku']) ? $product['sku'] : '',

							'upc'     =>isset($productsetting['category']['upc']) ? $product['upc'] : '',

							'description'     => isset($productsetting['category']['description']) ? utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..' : ' ',

							'price'=>$price,

							
							'href'     => $this->url->link('product/product', 'path=' . $path . '&property_id=' . $product['property_id']),

							'main' => $result['enable']

						);

						

							}

							}

						}

						//// category product ///

						
						if(!empty($categorie['category_id'])){

						$filter_data = array(

							'filter_category_id'  => $categorie['category_id'],

							'filter_sub_category' => true

						);
						                      
                      	//$this->load->model('property/category');

						$submenu[]=array(

							'name'     => $categorie['name'].($this->config->get('config_product_count') ? ' (' . $this->model_property_property->getTotalProductsall($filter_data) . ')' : ''),

							'image'     => $image,

							'product'     => $category_product,

							'sublink'     => $subcategory,

							'description'     => isset($productsetting['category']['categorydescription'])? utf8_substr(strip_tags(html_entity_decode($categorie['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..':'',

							'href'     => $this->url->link('property/category', 'filter_propertycategory=' . $categorie['category_id']),

							'main'=>$result['enable']

							

						);
						}
						

					}

					}

					

				}

				if(isset($result['products'])){

					

					$products = unserialize($result['products']);

					if($products){	

					foreach($products as $product)

					{

						$categoryproducts = $this->model_property_property->getPropertys($product);

						

						$image='';

						if(isset($productsetting['product']['name']))

						{

						if ($product['image']) {

						$image = $this->model_tool_image->resize($product['image'], $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));

						}

						else

						{

						$image = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));		

						}

						}

						if(isset($productsetting['product']['price']))

						{

						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {

						$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));

						} else {

						$price = false;

						}



					if ((float)$product['special']) {

						$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')));

					} else {

						$special = false;

					}

						}

						else

						{

							$price = false;

							$special = false;

						}

					

					

					

						

						if(isset($this->request->get['path'])){

						$path = $this->request->get['path'];

						}else{

						$path='';

						}

						$submenu[]=array(

							'name'     =>isset($productsetting['product']['name']) ? $product['name'] : '',

							'model'     =>isset($productsetting['product']['model']) ? $product['model'] : '',

							'image'     =>$image,

							'sku'     =>isset($productsetting['product']['sku']) ? $product['sku'] : '',

							'upc'     =>isset($productsetting['product']['upc']) ? $product['upc'] : '',

							'description'     => isset($productsetting['product']['description']) ? utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..' : ' ',

							'price'=>$price,

							'special'=>$special,

							'href'     => $this->url->link('product/product', 'path=' . $path . '&product_id=' . $product['product_id']),

							'main' => $result['enable']

						);

						

					}

					}

					

				}

				$editor='';

				if($result['type']=='customtype')

				{

					$customlinks=$this->model_catalog_tmd_megaheader->getmegacustomlinks($result['megaheader_id']);

					

					if($customlinks)

					{

						foreach($customlinks as $customlink)

						{

								

							$submenu[]=array(

								'name'     => $customlink['custname'],

								'href'     => $customlink['custurl'],

								'main'     => $result['enable']

							);

						}

				}

				}

				elseif($result['type']=='editor')

				{

					

					$editor=$this->model_catalog_tmd_megaheader->getmegaheadereditoer($result['megaheader_id']);

					$editor= '<span class="editorss">'.html_entity_decode($editor['customcode'], ENT_QUOTES, 'UTF-8') . "\n".'</span>';

				}

				

					$background='';

					if ($result['image']) {

						$background = $this->model_tool_image->resize($result['image'],479,493);

						}

					

					$ptrnbackground='';

					$patternimages = $result['patternimage'];

					$ptrnbackground  =  HTTP_SERVER.'image/catalog/pattern/'.$patternimages.'.png';				

						

					$data['megaheaders'][]=array(

											'title'=>$result['title'],

											'bgimagetype'=>$result['bgimagetype'],

											'href'=>$result['url'],

											'openew'=>$result['open'],

											'background'=>$background,

											'ptrnbackground'=> $ptrnbackground,

											'sublink'=>$submenu,

											'editor'=>$editor,

											'icon'=>$result['title_icon'],

											'showicon'=>$result['showicon'],

											'row'   => $result['row'] ? $result['row'] : 1,

											'col'   => $result['col'] ? $result['col'] : 1,

											

										);

				

				}}

				

			//echo "<pre>";

			//print_r($data['megaheaders']);die();

			

			

			

		return $this->load->view('common/megaheader', $data);	

		

		

		}

}



