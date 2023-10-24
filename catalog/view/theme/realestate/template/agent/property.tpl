<?php echo $header; ?>
<script type="text/javascript" src="catalog/view/javascript/summernote/summernote.js"></script>
  <link href="catalog/view/javascript/summernote/summernote.css" rel="stylesheet" type="text/css" />
<div class="breadmain">
	<div class="container">
		<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
		</ul>
		<h3><?php echo $heading_title; ?></h3>
	</div>
</div>
<div class="container">
	<?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
    <?php } ?>
	<div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_add; ?></h3>
			</div>
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
					<legend><?php echo $tab_general; ?></legend>
					<ul class="nav nav-tabs" id="language">
						<?php foreach ($languages as $language) { ?>
							<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="catalog/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
						<?php foreach ($languages as $language) { ?>
							<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">

								<div class="form-group required">
									<label class="col-sm-2 control-label" for="input-package-title">
									<?php echo $text_name;?>
									</label> 
									<div class="col-sm-10">
										<input type="text" name="Property_description[<?php echo $language['language_id']; ?>][name]" value="<?php if(isset($Property_description[$language['language_id']]['name'])){echo $Property_description[$language['language_id']]['name']; }?>" placeholder="<?php echo $entry_name;?>" id="input-package-titl" class="form-control" />
										<?php if(isset($error_name[$language['language_id']])) { ?>
											<div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>">
										<?php echo $text_description;?>
									</label>
									<div class="col-sm-10">
										<textarea name="Property_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote">
											<?php if(isset($Property_description[$language['language_id']]['description'])) { echo $Property_description[$language['language_id']]['description']; }?>
										</textarea>

									     <script type="text/javascript">
											$("#input-description<?php echo $language['language_id']?>").summernote({
											height: 300
											});
									</script>


									</div>
								</div>
							<div class="form-group required">
									<label class="col-sm-2 control-label" for="input-package-title"><?php echo $text_meta_title; ?></label>
									<div class="col-sm-10">
										<input type="text" name="Property_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php if(isset($Property_description[$language['language_id']]['meta_title'])){echo $Property_description[$language['language_id']]['meta_title']; }?>" placeholder="<?php echo $entry_meta_title;?>" id="input-package-titl" class="form-control"/>
										<?php if(isset($error_meta_title[$language['language_id']])) { ?>
										<div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-package-title"><?php echo $text_meta_descriptions; ?></label>
									<div class="col-sm-10">
										<textarea name="Property_description[<?php echo $language['language_id']; ?>][meta_description]" placeholder="<?php echo $entry_meta_descriptions; ?>" id="input-meta_description" class="form-control"><?php if(isset($Property_description[$language['language_id']]['meta_description'])) { echo $Property_description[$language['language_id']]['meta_description']; }?>
										</textarea>
										<?php if(isset($meta_title[$language['language_id']])) { ?>
										<div class="text-danger"><?php echo $meta_title[$language['language_id']]; ?></div>
										<?php } ?>
									</div>
								</div>
						<div class="form-group">
									<label class="col-sm-2 control-label" for="input-package-title"><?php echo $text_meta_keyword; ?></label>
									<div class="col-sm-10">
										<textarea name="Property_description[<?php echo $language['language_id']; ?>][meta_keyword]" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta_keyword" class="form-control"><?php if(isset($Property_description[$language['language_id']]['meta_keyword'])) { echo $Property_description[$language['language_id']]['meta_keyword']; }?></textarea>
									</div>
								</div>							
								
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-tag"><?php echo $text_tag; ?></label>
									<div class="col-sm-10">
										<textarea name="Property_description[<?php echo $language['language_id']; ?>][tag]" placeholder="<?php echo $entry_tag; ?>" id="input-tag" class="form-control"><?php if(isset($Property_description[$language['language_id']]['tag'])) { echo $Property_description[$language['language_id']]['tag']; }?>
										</textarea>
									</div>
								</div>
								<div class="form-group hide">
									<label class="col-sm-2 control-label" for="input-package-title"><?php echo $text_SEO_URL; ?></label>
									<div class="col-sm-10">
										<input type="text" name="seo_url" value="" placeholder="<?php echo $entry_SEO_URL;?>" id="seo_url" class="form-control"/>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<legend><?php echo $tab_data; ?></legend>			
						<div class="form-group hide">
							<label class="col-sm-2 control-label" for="input-package-title">
							<?php echo $text_sort_order;?></label>
							<div class="col-sm-10">
								<input type="text" name="sort_order" value="<?php echo $sort_order;?>" placeholder="<?php echo $entry_sort_order;?>" id="input-package-titl" class="form-control" />
							</div>
						</div>
						<input type="hidden" name="property_agent_id" value="<?php echo $property_agent_id;?>" />
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-vendor-image"><?php echo $text_image;?></label>
							<div class="col-md-3 col-sm-12 col-xs-12 file text-center ">
								<div class="imagebox">
									<span id="thumb-image"><img src="<?php echo $thumb;?>" data-placeholder="<?php echo $placeholder; ?>" class="thumb"></span>
								</div>
								<button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
								<input type="hidden" name="image_thumb" value="<?php echo $image; ?>" id="input-image" />
							</div>	
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="status"><?php echo $text_status;?></label>
							<div class="col-sm-10">
								<select class="form-control" id="status" name="status">
									<option value="1" <?php if(isset($status) && $status=1) { echo "selected"; }?>><?php echo $entry_enable?></option>
									<option value="0" <?php if(isset($status) && $status=0) { echo "selected"; }?>><?php echo $entry_disable?></option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-video"><?php echo $text_video; ?></label>
							<div class="col-sm-10">
								<input type="url" name="video" value="<?php echo $video;?>" placeholder="<?php echo $entry_video;?>" id="input-video" class="form-control"/>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-property-status"><?php echo $text_property_status; ?></label>
							<div class="col-sm-10">
								<input type="text" name="property_status" value="<?php echo $property_status;?>" placeholder="<?php echo $entry_property_status; ?>" id="input-property-status" class="form-control" />
								<input type="hidden" name="property_status_id" value="<?php echo $property_status_id; ?>" />
								<?php if ($error_property_status_id) { ?>
									<div class="text-danger"><?php echo $error_property_status_id; ?></div>
                			  <?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-price"><?php echo $text_Price; ?></label>
							<div class="col-sm-10">
								<input type="text" name="price" value="<?php echo $price;?>" placeholder="<?php echo $entry_Price;?>" id="iinput-price" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-category"><?php echo $text_category; ?></label>
							<div class="col-sm-10">
								<input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
								<div id="property_category" class="well well-sm" style="height: 150px; overflow: auto;">
								<?php if(isset($categories)) {
									foreach($categories as $category){?>
										<div id="property_category<?php echo $category['category_id']?>">
										<i class="fa fa-minus-circle"></i>
										<?php echo $category['name']?>
											<input type="hidden" name="category_id[]" value="<?php echo $category['category_id']?>">
										</div>
									<?php }
								}?>
								</div>
								
							</div>
						</div>
						
						<legend><?php echo $tab_Address_Map; ?></legend>			
							<!--select options -->						
							<div class="getmap">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-country"><?php echo $text_country; ?></label>
								<div class="col-sm-10">
									<select name="country_id" id="input-country" class="form-control">
										<option value=""><?php echo $entry_select; ?></option>
										<?php foreach ($countrys as $country) { ?>
											<?php if ($country['country_id'] == $country_id) { ?>
												<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
									<?php if ($error_country) { ?>
										<div class="text-danger"><?php echo $error_country; ?></div>
									<?php } ?>
									
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-zone"><?php echo $text_Zone_region; ?></label>
								<div class="col-sm-10">
									<select name="zone_id" id="input-zone" class="form-control"></select>
									 <?php if ($error_zone) { ?>
										<div class="text-danger"><?php echo $error_zone; ?></div>
										<?php } ?>
								</div>
							</div>
							<!--select options -->
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-city"><?php echo $text_city; ?></label>
								<div class="col-sm-10">
									<input type="text" name="city" value="<?php echo $city;?>" placeholder="<?php echo $entry_city;?>" id="input-city" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-local_area"><?php echo $text_local_area; ?></label>
								<div class="col-sm-10">
									<textarea name="local_area" placeholder="<?php echo $entry_local_area; ?>" id="input-local_area" class="form-control"><?php echo $local_area; ?></textarea>
								</div>
							</div>
								
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pincode"><?php echo $text_pincode; ?></label>
								<div class="col-sm-10">
									<input type="text" name="pincode" value="<?php echo $pincode;?>" placeholder="<?php echo $entry_pincode;?>" id="input-pincode" class="form-control"/>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-10">
									<button type="button"  id="addmap" class="btn btn-info"><?php echo $text_map; ?></button>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-latitude"><?php echo $text_latitude; ?></label>
										<div class="col-sm-10">
										<input type="text" name="latitude" value="<?php echo $latitude;?>"placeholder="<?php echo $entry_latitude;?>" id="input-latitude" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-longitude"><?php echo $text_longitude; ?></label>
										<div class="col-sm-10">
										<input type="text" name="longitude" value="<?php echo $longitude;?>" placeholder="<?php echo $entry_longitude;?>" id="input-longitude" class="form-control"/>
										</div>
									</div>
								</div>
								<div class="col-md-6" id="map">
								</div>
							</div>
							</div>
							<!---map-->
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-neighborhood"><?php echo $text_neighborhood; ?></label>
								<div class="col-sm-10">
									<input type="text" name="neighborhood" value="<?php echo $neighborhood;?>" placeholder="<?php echo $entry_neighborhood;?>" id="input-neighborhood" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-area"><?php echo $text_area; ?>
								</label>
								
							<div class="col-sm-3">
							  <input type="text" name="area" value="<?php echo $area;?>" placeholder="<?php echo $entry_area;?>" id="input-area" class="form-control"/>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<select name="area_type" class="form-control" id="sel1">
											<?php foreach ($areatypes as $areatype){ ?>
											<?php if ($area_type == $areatype['name']){ ?>
												<option value="<?php echo $areatype['name']; ?>" selected="selected">
													<?php echo $areatype['name']; ?>
												</option> 
											<?php } else { ?>
												<option value="<?php echo $areatype['name']; ?>"><?php echo $areatype['name']; ?>
												</option> 
											<?php } ?>
											<?php } ?>
										</select>
					
								</div> 
							</div> 
							</div> 
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-bedrooms"><?php echo $text_bedrooms; ?></label>
								<div class="col-sm-10">
									<span class="form-group-btn">
										<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="bedrooms">
										<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
									<input type="text" name="bedrooms" value="<?php echo$bedrooms?>" placeholder="<?php echo $entry_bedrooms;?>" id="input-bedrooms" class="input-small" size="12"  min="1" max="10000" size=""/>
									<span class="form-group-btn">
										<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="bedrooms">
										<span class="glyphicon glyphicon-minus"></span>
										</button>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-bathrooms"><?php echo $text_bathrooms; ?></label>
								<div class="col-sm-10">
									<span class="form-group-btn">
										<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="bathrooms">
										<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
									<input type="text" name="bathrooms" value="<?php echo$bathrooms?>" placeholder="<?php echo $entry_bathrooms;?>" id="ex2" class="" min="1" max="10000" size="12"/>
									<span class="form-group-btn">
										<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="bathrooms">
										<span class="glyphicon glyphicon-minus"></span>
										</button>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-roomcount"><?php echo $text_roomcount; ?></label>
								<div class="col-sm-10">
									<input type="text" name="roomcount" value="<?php echo$roomcount?>" placeholder="<?php echo $entry_roomcount;?>" id="input-roomcount" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-parkingspaces"><?php echo $text_Parkingspaces; ?>	</label>
								<div class="col-sm-10">
									<input type="text" name="Parkingspaces" value="<?php echo $Parkingspaces;?>" placeholder="<?php echo $entry_Parkingspaces;?>" id="input-parkingspaces" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-builtin"><?php echo $text_builtin; ?></label>
								<div class="col-sm-10">
									<input type="text" name="builtin" value="<?php echo $builtin;?>" placeholder="<?php echo $entry_builtin;?>" id="input-builtin" class="form-control"/>
								</div>
							</div>
						 
						 <legend><?php echo $tab_image; ?></legend>			
					
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-uploader"><?php echo $text_images; ?></label>
								<div class="col-sm-10">
									<div id="uploader"></div>
									<?php if(!empty($error_images)) { ?>
									<div class="text-danger"><?php echo $error_images; ?></div>
									<?php } ?>
								</div>
							</div>
							<?php if($image_tabs) { ?>
							<div class="table-responsive">
							<table id="images" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<td class="text-left"><?php echo $entry_image; ?></td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php $image_row = 0; ?>
									<?php foreach ($image_tabs as $image_tab) { ?>
									<tr id="image-row<?php echo $image_tab['property_images_id']; ?>">
										<td class="text-left"><img src="<?php echo $image_tab['prothumb']; ?>" /><input type="hidden" name="image_tab[<?php echo $image_row; ?>][image]" value="<?php echo $image_tab['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
										
										<td class="text-left"><button type="button" onclick="deleteimage(<?php echo $image_tab['property_images_id']; ?>);" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
									</tr>
									<?php $image_row++; ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<?php } ?>
						
						<legend><?php echo $tab_feature; ?></legend>			
						<div class="table-responsive">
							<table id="feature" class="table table-striped table-bordered table-hover">
								<tbody>	
									<tr>
										<?php if (isset($feature)) { ?>
											<?php foreach ($feature as $featureresult) {
											
											?>	
											<?php 
												$check='';
												if(in_array($featureresult['feature_id'],$feature_c))									
												{
													$check="checked";
												}
												?>
												<td style="width: 1px;" class="text-center">
												<input <?php echo $check;?> type="checkbox"  name="features[]" value="<?php echo $featureresult['feature_id']; ?>" />
												</td>
												<td class="text-center"><?php if ($featureresult['image']) { ?>
												<img src="<?php echo $featureresult['image']; ?>" alt="<?php echo $featureresult['image']; ?>" class="img-thumbnail" />
												<?php } else { ?>
												<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
												<?php } ?>
												</td>
												<td class="text-left"><?php echo $featureresult['name']; ?></td>
										</tr>
											<?php } ?> 
										<?php }?>
									</tbody>
							</table>
						</div>
						
						<legend><?php echo $tab_neareast_place; ?></legend>			
					
						<div class="table-responsive">
							<table id="nearestplace" class="table table-striped table-bordered table-hover">
								<tbody>
									<?php if ($nearestplace) { ?>
										<?php foreach($nearestplace as $nearestplaceid) { ?>	
										<tr>
											<td>
											<div class="form-group">
												<div class="col-sm-10">
													<input type="text" name="nearestplace[<?php echo $nearestplaceid['nearest_place_id']; ?>]" value="<?php echo $nearestplaceid['destinies']?>" placeholder="<?php echo $entry_destinies;?>" id="input-package-titl" class="form-control"/>
												</div>
											</div>
											</td>
											<td class="text-center"><?php if ($nearestplaceid['image']) { ?>
												<img src="<?php echo $nearestplaceid['image']; ?>" alt="<?php echo $nearestplaceid['image']; ?>" class="img-thumbnail" />
												<?php } else { ?>
												<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
												<?php } ?>
											</td>
											<td class="text-left"><?php echo $nearestplaceid['name']; ?></td>
										</tr>
										<?php } ?> 
									<?php }?>
								</tbody>
							</table>			
						</div>
						
						<legend><?php echo $tab_customfield; ?></legend>
						
						<?php foreach ($custom_fields as $custom_field) { ?>
						  <?php if ($custom_field['type'] == 'select') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
							  <select name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
								<option value=""><?php echo $text_select; ?></option>
								<?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
								<?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $custom_field[$custom_field['custom_field_id']]) { ?>
								<option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
								<?php } ?>
								<?php } ?>
							  </select>
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						  <?php if ($custom_field['type'] == 'radio') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
							  <div>
								<?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
								<div class="radio">
								  <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['name'] == $account_custom_field[$custom_field['custom_field_id']]) { ?>
								  <label>
									<input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['name']; ?>" checked="checked" />
									<?php echo $custom_field_value['name']; ?></label>
								  <?php } else { ?>
								  <label>
									<input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['name']; ?>" />
									<?php echo $custom_field_value['name']; ?></label>
								  <?php } ?>
								</div>
								<?php } ?>
							  </div>
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						  <?php if ($custom_field['type'] == 'checkbox') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
							  <div>
								<?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
								<div class="checkbox">
								  <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['name'], $account_custom_field[$custom_field['custom_field_id']])) { ?>
								  <label>
									<input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['name']; ?>" checked="checked" />
									<?php echo $custom_field_value['name']; ?></label>
								  <?php } else { ?>
								  <label>
									<input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['name']; ?>" />
									<?php echo $custom_field_value['name']; ?></label>
								  <?php } ?>
								</div>
								<?php } ?>
							  </div>
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						  <?php if ($custom_field['type'] == 'text') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
							  <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						  <?php if ($custom_field['type'] == 'textarea') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
							  <textarea name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						  <?php if ($custom_field['type'] == 'file') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
								<div class="imagebox">
									<span id="thumb-img"><img src="<?php echo $thumb_image; ?>" data-toggle="<?php echo $placeholder1;?>"/></span>
								</div>
							  <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
							  <input type="hidden" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : ''); ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						  <?php if ($custom_field['type'] == 'date') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
							  <div class="input-group date">
								<input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
								<span class="input-group-btn">
								<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
								</span></div>
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						  <?php if ($custom_field['type'] == 'time') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
							  <div class="input-group time">
								<input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
								<span class="input-group-btn">
								<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
								</span></div>
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						  <?php if ($custom_field['type'] == 'datetime') { ?>
						  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
							<label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
							<div class="col-sm-10">
							  <div class="input-group datetime">
								<input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
								<span class="input-group-btn">
								<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
								</span></div>
							  <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
							  <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
							  <?php } ?>
							</div>
						  </div>
						  <?php } ?>
						 
						  <?php } ?>
					
					
						<div class="pull-right">
							&nbsp;
							<input type="submit" value="<?php echo $button_save; ?>" class="btn btn-primary btnus"/>
							<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply">
							</i></a>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
		
		<script type="text/javascript"><!--
		$('#language a:first').tab('show');
		//--></script>	

	<script type="text/javascript"><!--
		$('input[name=\'category\']').autocomplete({
			'source': function(request, response) {
				$.ajax({
					url: 'index.php?route=agent/category/autocomplete&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success: function(json) {
						json.unshift({
						category_id: 0,
						name: '<?php echo $text_none; ?>'
						});
					response($.map(json, function(item) {
					return {
					label: item['name'],
					value: item['category_id']
					}
					}));
					}
				});
			},
			'select': function(item) {
			$('input[name=\'category\']').val();

			$('#property_category' + item['value']).remove();

			$('#property_category').append('<div id="property_category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_id[]" value="' + item['value'] + '" /></div>');
			}
		});
		$('#property_category').delegate('.fa-minus-circle', 'click', function() {
		$(this).parent().remove();
		});
		//-->
	</script>

	<script>
		$('input[name=\'agent\']').autocomplete({
			'source': function(request, response) {
				$.ajax({
					url: 'index.php?route=agent/agentsignup/autocomplete&token=&filter_name=' +  encodeURIComponent(request),
					dataType: 'json',
					success: function(json) {
						json.unshift({
						property_agent_id: 0,
						agentname: '<?php echo $text_none; ?>'
						});
						response($.map(json, function(item) {
						return {
							label: item['agentname'],
							value: item['property_agent_id']
						}
						}));
					}
				});
			},
			'select': function(item) {
			$('input[name=\'agent\']').val(item['label']);
			$('input[name=\'property_agent_id\']').val(item['value']);
			}
		});
</script>
	<script>
		$('input[name=\'property_status\']').autocomplete({
			'source': function(request, response) {
				$.ajax({
					url: 'index.php?route=agent/property/autocomplete=&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success: function(json) {

					response($.map(json, function(item) {
					return {
					label: item['name'],
					value: item['property_status_id']
					}
					}));
					}
				});
			},
			'select': function(item) {
			$('input[name=\'property_status\']').val(item['label']);
			$('input[name=\'property_status_id\']').val(item['value']);
			}
		});
	</script>
	<script>
		$('.btn-number').click(function(e){
			e.preventDefault();
			fieldName = $(this).attr('data-field');
			type      = $(this).attr('data-type');
			var input = $("input[name='"+fieldName+"']");
			var currentVal = parseInt(input.val());
			if (!isNaN(currentVal)) {
			if(type == 'minus') {

			if(currentVal > input.attr('min')) {
			input.val(currentVal -1).change();
			} 
			if(parseInt(input.val()) == input.attr('min')) {
			$(this).attr('disabled', true);
			}
			} else if(type == 'plus') {

			if(currentVal < input.attr('max')) {
			input.val(currentVal +1).change();
			}
			if(parseInt(input.val()) == input.attr('max')) {
			$(this).attr('disabled', true);
			}

			}
			} else {
			input.val(0);
			}
		});
		$('.input-number').focusin(function(){
		$(this).data('oldValue', $(this).val());
		});
		$('.input-number').change(function() {

		minValue =  parseInt($(this).attr('min'));
		maxValue =  parseInt($(this).attr('max'));
		valueCurrent = parseInt($(this).val());

		name = $(this).attr('name');
		if(valueCurrent >= minValue) {
		$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
		} else {
		alert('Sorry, the minimum value was reached');
		$(this).val($(this).data('oldValue'));
		}
		if(valueCurrent <= maxValue) {
		$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
		} else {
		alert('Sorry, the maximum value was reached');
		$(this).val($(this).data('oldValue'));
		}
		});
	</script>
	
	
<script type="text/javascript">
	$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
			clearInterval(timer);
	}
	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=agent/property/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						var imageurl="<?php echo str_replace('http:','',HTTP_SERVER)?>";
						$("#thumb-image").html('<img src="'+imageurl+"image/"+json['location1']+'" alt="" title="" width="100"/>');
						$("#input-image").val(json['location1']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
	});
</script>

<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=agent/property/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $entry_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>

<script>
$('#addmap').click(function(){
	$.ajax({
		url: 'index.php?route=agent/property/getmapproperty',
		type: 'post',
		data: $('select[name=\'country_id\'],select[name=\'zone_id\'],input[name=\'city\'],textarea[name=\'local_area\'],input[name=\'pincode\']'),
		dataType: 'json',
		beforeSend: function() {
		$('#addmap').after('<i class="loading">loadding</i>');
		},
		success: function(json) {
		$('.loading').remove();
			if (json['success']) {
				$('#input-latitude').val(json['lat']);
				$('#input-longitude').val(json['lng']);
				
			}
		}
	 });					
	});					
</script>

<link rel="stylesheet" href="catalog/view/javascript/uploader/jquery.ui.plupload.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/javascript/uploader/jquery.plupload.queue.css" type="text/css" />
<script type="text/javascript" src="catalog/view/javascript/uploader/browserplus-min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.gears.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.silverlight.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader//plupload.flash.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.browserplus.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/jquery.ui.plupload.js"></script>
<script type="text/javascript" src="catalog/view/javascript/uploader/jquery.plupload.queue.js"></script>

 <script type="text/javascript"><!--


//--></script>
<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	// Setup html5 version
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : 'catalog/controller/agent/upload.php',
		max_file_size : '10mb',
		chunk_size : '1mb',
		unique_names : true,
		multi_selection:true,
		multiple_queues: true,
		filters : [
			{title : "Image files", extensions : "jpg,jpeg,gif,png"},
			/* {title : "Zip files", extensions : "zip"} */
		],
		// Duplicate images Remove
		init: {
			FilesAdded: function (up, files) {
				//Newly loaded Function
				for (var i = 0; i < up.files.length; i++) {
					for (var j = 1; j < up.files.length; j++) {
						if (up.files[i].name == up.files[j].name && i != j) {
							alert('Error File ' + up.files[i].name + ' already exists. !');
							up.splice(i, 1);
							//Here I am to delete duplicate files exists

						}
					}
				}
			}
		},

		// Resize images on clientside if we can
		//resize : {width : 200, height : 200, quality : 90}
	});
	// Client side form validation
	$('form').submit(function(e) {
		var uploader = $('#uploader').pluploadQueue();
        // Files in queue upload them first
        //if (uploader.files.length > 0) {
            // When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    $('form')[0].submit();
                }
            });
			   uploader.start();
		//} else {
		// alert('You must queue at least one file.');
		// }
		
		//return false;
    });
});

function deleteimage(property_images_id){
	if(property_images_id){
		$.ajax({
		url: 'index.php?route=agent/property/deleteimg',
		type: 'post',
		data: 'property_images_id='+property_images_id,
		dataType: 'json',
		success: function(json) {
		$('.alert, .text-danger').remove();
			
		
		if (json['success']) {
			$('#image-row'+property_images_id).remove();
			}
		}
		});
	}
	}
</script>

<script type="text/javascript"><!--
$('button[id^=\'button-custom-field\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);
         	$.ajax({
				url: 'index.php?route=agent/property/uploadfile',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						var imageurl="<?php echo str_replace('http:','',HTTP_SERVER)?>";
						//$("#thumb-file").html(''+json['location1']+'');
						$("#thumb-img").html('<img src="'+imageurl+"image/"+json['location1']+'" alt="" title="" width="100" >');
						$("#input-custom_field").val(json['location1']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});

		
		}
	}, 500);
});
//--></script>

<script>

	$('.date').datetimepicker({
		pickTime: false
	});
	
	$('.time').datetimepicker({
		pickDate: false
	});	
		
	$('.datetime').datetimepicker({
		pickDate: true,
		pickTime: true
	});
<?php echo $footer; ?>
				
</script>