<!--properties code start here-->
<div class="latest_product_heading post4">
	<h3><?php echo $heading_title; ?></h3>
	<span class="triangle"></span>
	<span class="single"></span>
</div>

<div class="row">
	<?php foreach ($propertys as $property) { ?>
		<div class="cate2">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 latest_main post2">
				<div class="product-thumb transition">
					<div class="image">
					<?php if(!empty($property) == $property['propertyrent']) { ?>
					<div class="sale">
					<span><?php echo $property['propertyrent'];?></span>
					</div>
					<?php } ?>
					<a href="<?php echo $property['href']; ?>"><img src="<?php echo $property['thumb']; ?>" alt="<?php echo $property['name']; ?>" title="<?php echo $property['name']; ?>" class="img-responsive" /></a>
				</div>
				<ul class="list-inline options">
					<li><span class="bedrooms"></span><?php echo $property['area']; ?> <?php echo $property['area_type']; ?></li>
					<li><span class="bedrooms"></span> <?php echo $property['bedrooms']; ?></li>
					<li><span class="bathrooms"></span> <?php echo $property['bathrooms']; ?></li>
					
					<!--static end-->
				</ul>
				<div class="caption">
					<div class="featured_product">
							<h4><a href="<?php echo $property['href']; ?>"> <?php echo $property['name']; ?></a></h4>
							<p class="price"><span class="text"> <?php echo $featured_price;?></span>
								
							<?php echo $property['price']; ?></p>
						
						<!--static-->
						<ul class="list-unstyled features">
							<li><i class="fa fa-star" aria-hidden="true"></i>  <?php echo $property['category']; ?></li>
							<li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $property['local_area']; ?></li>
							
						</ul>
						<!--static-->		
						<?php if(!empty($property['nearestplaces'])) {?>
							<div class="nearest">
								<span class="text"><?php echo $featured_NearestPlace;?></span>
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
							<button type="button" data-toggle="tooltip"  onclick="wishlist.add('<?php echo $property['property_id']?>');"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
						</li>
					</ul>
				<!--static-->
				</div>
			</div>
		
			</div>
	<?php } ?>
</div>
<!--properties code end here-->
