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
<div>

<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-8'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> cate2"><?php echo $content_top; ?>
	<h2 class="headcenter"><?php echo $heading_title1; ?></h2>
     <?php if(isset($propertys)){ ?>
      <div class="row">
        <?php foreach ($propertys as $property) { ?>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 product-grid latest_main">
          <div class="product-thumb transition hide">
				<div class="image">
					<div class="sale">
						<span><?php echo $property['propertyrent']; ?></span>
					</div>
					<a href="<?php echo $property['href']; ?>"><img src="<?php echo $property['thumb']; ?>" alt="<?php echo $property['name']; ?>" title="<?php echo $property['name']; ?>" class="img-responsive" /></a>
				</div>
				<ul class="list-inline options">
					<li><span class="bedrooms"></span><?php echo $property['area']; ?><?php echo $text_sqft;?></li>
					<li><span class="bedrooms"></span><?php echo $property['bedrooms']; ?></li>
					<li><span class="bathrooms"></span><?php echo $property['bathrooms']; ?></li>
					<li><span class="garge"></span></i> 1</li>
				</ul>
				<div class="caption">
					<div class="featured_product">
						<h4><a href="<?php echo $property['href']; ?>"><?php echo $property['name']; ?></a></h4>
						<p class="price"><span class="text"><?php echo $text_price;?></span>
						<?php echo $property['price']; ?>
						</p>
						
						<!--static-->
						<ul class="list-unstyled features">
							<li><i class="fa fa-star" aria-hidden="true"></i> Apartment</li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> 104 enclave,Ludhiana</li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> Near bus stand</li>
						</ul>
						<!--static-->
						<div class="hide">
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
					</div>
					<ul class="list-inline lastpart">
						<li><i class="fa fa-calendar-o" aria-hidden="true"></i>  4 Days ago</li>
						<li>
							<button onclick="top.location.href=('<?php echo $property['href']; ?>');"><i class="fa fa-share-alt" aria-hidden="true"></i></button>
						</li>
						<li>
							<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
						</li>
						
					</ul>
				</div>
			</div>
			
		<!--2nd design start-->
			<div class="product-thumb transition cate3">
				<div class="image">
						<?php if(!empty($property) == $property['propertyrent']) { ?>
					<div class="sale">
					<span><?php echo $property['propertyrent'];?></span>
					</div>
					<?php } ?>
					<a href="<?php echo $property['href']; ?>"><img src="<?php echo $property['thumb']; ?>" alt="<?php echo $property['name']; ?>" title="<?php echo $property['name']; ?>" class="img-responsive" /></a>
				</div>
				<ul class="list-inline lastpart">
					<li><i class="fa fa-calendar-o" aria-hidden="true"></i>  4 Days ago</li>
					<li>
						<button onclick="top.location.href=('<?php echo $property['href']; ?>');"><i class="fa fa-share-alt" aria-hidden="true"></i></button>
					</li>
					<li>
						<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
					</li>
					<li><i class="fa fa-map-marker" aria-hidden="true"></i></li>
				</ul>
				<div class="caption">
					<div class="featured_product">
						<h4><a href="<?php echo $property['href']; ?>"><?php echo $property['name']; ?></a></h4>
						<div class="options"><p class="price"><span class="text"><?php echo $text_price;?></span>
						<?php echo $property['price']; ?>
						</p></div>
					
						<ul class="list-unstyled features">
							<li><span class="bedrooms"></span><?php echo $text_sqft;?> <span class="pull-right"><?php echo $property['area']; ?></span></li>
							<li><span class="bedrooms"></span><?php echo $text_bedrooms;?> <span class="pull-right"><?php echo $property['bedrooms']; ?></span></li>
							<li><span class="bathrooms"></span><?php echo $text_bathrooms;?> <span class="pull-right"><?php echo $property['bathrooms']; ?></span></li>
							<li><span class="garge"></span> <?php echo $text_garge;?> <span class="pull-right"><ul class="list-inline"><?php foreach($property['features'] as $feature) {?><li><span><img src="<?php echo $feature;?>"></span></li><?php } ?>
							</ul></span></li><li><span class="garge"></span> <?php echo $text_nearest;?> <span class="pull-right"><ul class="list-inline"><?php foreach($property['nearestplaces'] as $nearestplace) {?><li><span><img src="<?php echo $nearestplace;?>"></span></li>
							<?php } ?></ul></span></li></ul>
						
						<ul class="list-unstyled apart">
							<li><i class="fa fa-star" aria-hidden="true"></i>	<?php echo $text_apartment;?></li>
						</ul>
						
						<div class="hide">
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
					</div>
					
				</div>
			</div>
		<!--2nd design end-->
        </div>
        <?php } ?>
      </div>
      <div class="row">
        <div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right hide"><?php echo $results; ?></div>
      </div>
     <?php } ?>
      <?php if (!$categories && !$products) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
</div>
</div>
<?php echo $footer; ?>
