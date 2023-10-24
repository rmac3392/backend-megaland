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
  
	<div id="content" class="<?php echo $class; ?> cate2"><?php echo $content_top; ?>
		<h2 class="headcenter hide"><?php echo $heading_title1; ?></h2>
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
					<ul class="list-inline options">
						<li><span class="sqft"></span><?php echo $property['area']; ?> <?php echo $property['area_type']; ?></li>
						<li><span class="bedrooms"></span><?php echo $property['bedrooms']; ?></li>
						<li><span class="bathrooms"></span><?php echo $property['bathrooms']; ?></li>
						<!--static start-->
					
						<!--static end-->
					</ul>
					<div class="caption">
						<div class="featured_product">
							<h4><a href="<?php echo $property['href']; ?>"><?php echo $property['name']; ?></a></h4>
							<p class="price"><span class="text"><?php echo $text_price;?></span><?php echo $property['price']; ?></p>
						
						<!--static-->
						<ul class="list-unstyled features">
							<li><i class="fa fa-star" aria-hidden="true"></i>  <?php echo $property['category']; ?></li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $property['local_area']; ?></li>
						</ul>
						<!--static-->		
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
				</div>
				<!--static-->
					<ul class="list-inline lastpart">
					
						<li><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $property['date_added'];?></li>
						<li>
							<button onclick="top.location.href=('<?php echo $property['href']; ?>');"><i class="fa fa-share-alt" aria-hidden="true"></i></button>
						</li>
						<li>
							<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $property['property_id']?>');"><i class="fa fa-heart-o" aria-hidden="true"> </i></button>
						</li>
					</ul>
				<!--static-->
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } else {?>
		<div class="col-sm-12">
		       <div class="not-foundimg">
				<img src="catalog/view/theme/realestate/image/notfoundimages.jpg" class="img-responsive">
				</div>
			</div>
		<?php } ?>
     </div>
	<!--2nd design end here-->
	
	
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
