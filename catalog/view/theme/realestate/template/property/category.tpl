<?php echo $header; ?>
<div class="listing">
	<div class="breadmain">
		<div class="container">
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
			<h3><?php echo $heading_title1; ?></h3>
		</div>
	</div>
<div class="property-category">
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <!--1st design start-->
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
		<div class="latest_product_heading row">
			<div class="col-sm-6 col-md-6 cate_inner">
				<h3><?php echo $heading_title1; ?></h3><span class="triangle"></span><span class="single"></span>
			</div>
			<div class="cate_heading">
				<div class="col-sm-3 col-md-3 cate_inner text-right">
					<label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
					<select id="input-limit" class="selectpicker form-control" onchange="location = this.value;">
					  <?php foreach ($limits as $limits) { ?>
					  <?php if ($limits['value'] == $limit) { ?>
					  <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
				</div>
				<div class="col-sm-3 col-md-3 cate_inner text-right">
					<label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
					<select id="input-sort" class="selectpicker form-control" onchange="location = this.value;">
					  <?php foreach ($sorts as $sorts) { ?>
					  <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
					  <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
				</div>
			</div>
		</div>
		<?php if(!empty($propertys)){ ?>
		<div class="row">
			<?php foreach ($propertys as $property) { ?>
				<div class="product-layout latest_main">
					<div class="product-thumb transition">
						<div class="image">
							<?php if(!empty($property)==$property['propertyrent']){?>
							<div class="sale">
								<span><?php echo $property['propertyrent']; ?></span>
							</div>
							<?php } ?>
							<a href="<?php echo $property['href']; ?>"><img src="<?php echo $property['thumb']; ?>" alt="<?php echo $property['name']; ?>" title="<?php echo $property['name']; ?>" class="img-responsive" /></a>
						</div>
						<div class="caption">
							<div class="featured_product">
								<h4><a href="<?php echo $property['href']; ?>"><?php echo $property['name']; ?></a></h4>
								<p class="price"><span class="text"><?php echo $text_price;?></span><?php echo $property['price']; ?></p>
								<div class="">
								
									<ul class="list-inline">
										<li><span class="sqtt"></span> <?php echo $property['area']; ?> <?php echo $property['area_type']; ?></li>
										<li><span class="bedrooms"></span><?php echo $property['bedrooms']; ?></li>
										<li><span class="bathrooms"></span><?php echo $property['bathrooms']; ?></li>
									</ul>
								</div>
								<?php if(!empty($property['features'])) {?>
								<div class="amenities">
									<span class="text"><?php echo $text_amenities;?></span>
									<ul class="list-inline">
									<?php foreach($property['features'] as $feature) {?>
										<li><span><img src="<?php echo $feature;?>"></span></li>
									<?php } ?>	
									</ul>
								</div>	
								<?php } ?>			
								<?php if(!empty($property['nearestplaces'])) {?>
								<div class="nearest">
									<span class="text"><?php echo $text_NearestPlace;?></span>
									<ul class="list-inline">
									<?php foreach($property['nearestplaces'] as $nearestplace) {?>
										<li><span><img src="<?php echo $nearestplace;?>"></span></li>
									<?php } ?>	
									</ul>
								</div>	
								<?php } ?>
							</div>
							<i class="fa fa-share-alt-square" aria-hidden="true"></i>
							<span><button class="product_button" onclick="top.location.href=('<?php echo $property['href']; ?>');"><i class="fa fa-file-text"></i> <?php echo $text_details; ?></button></span>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php }  else {?>
		<div class="col-sm-12">
		       <div class="not-foundimg">
				<img src="catalog/view/theme/realestate/image/notfoundimages.jpg" class="img-responsive">
				</div>
			</div>
		<?php } ?>
		</div>
		<!--1st design end here-->
		<div class="row">
			<div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
			<div class="col-sm-6 text-right hide"><?php echo $results; ?></div>
		</div>

		<?php echo $content_bottom; ?>
		<?php echo $column_right; ?></div>
	</div>
</div>
</div>
<?php echo $footer; ?>
<script>
var cols = $('#column-right, #column-left').length;

		if (cols == 2) {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12 latest_main');
		} else if (cols == 1) {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-6 col-xs-12 latest_main');
		} else {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12 latest_main');
		}
</script>
