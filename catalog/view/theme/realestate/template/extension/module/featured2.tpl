<!--properties code start here-->
<div class="latest_product_heading post2">
	<h3><?php echo $heading_title; ?></h3>
	<span class="triangle"></span>
	<span class="single"></span>
</div>
<div class="row">
	<?php foreach ($propertys as $property) { ?>
		<div class="cate2">
		<div class="cate3">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 latest_main post1">
				<div class="product-thumb transition">
					<div class="image">
						<?php if(!empty($property) == $property['propertyrent']) { ?>
							<div class="sale">
							<span><?php echo $property['propertyrent'];?></span>
							</div>
						<?php } ?>
						<a href="<?php echo $property['href']; ?>"><img src="<?php echo $property['thumb']; ?>" alt="<?php echo $property['name']; ?>" title="<?php echo $property['name']; ?>" class="img-responsive" /></a>
					</div>
					<!--static-->
					<ul class="list-inline lastpart">
						<li><i class="fa fa-calendar-o" aria-hidden="true"></i>  <?php echo $property['date_added'];?></li>
						<li>
							<button onclick="top.location.href=('<?php echo $property['href']; ?>');"><i class="fa fa-share-alt" aria-hidden="true"></i></button>
						</li>
						<li>
							<button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('<?php echo $property['property_id']?>');"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
						</li>
						<li><a href="<?php echo $property['href']; ?>"><i class="fa fa-map-marker" aria-hidden="true"></i></a></li>
					</ul>
					<!--static-->
					<div class="caption">
						<div class="featured_product">
							<h4><a href="<?php echo $property['href']; ?>"><?php echo $property['name']; ?></a></h4>
							<div class="options">
								<p class="price"><span class="text"><?php echo $featured_price;?></span>
								<?php echo $property['price']; ?></p>
							</div>
							<ul class="list-unstyled features">
								<li><span class="bedrooms"></span><?php echo $property['area']; ?> <?php echo $property['area_type']; ?></span></li>
								<li><span class="bedrooms"></span><?php echo $featured_bedrooms;?> <span class="pull-right"><?php echo $property['bedrooms']; ?></span></li>
								<li><span class="bathrooms"></span><?php echo $featured_bathrooms;?> <span class="pull-right"><?php echo $property['bathrooms']; ?></span></li>
								<li>
									<span class="internet"></span> <?php echo $featured_garge; ?>
									<span class="pull-right">
										<ul class="list-inline">
											<?php foreach($property['features'] as $feature) {?>
												<li><span><img src="<?php echo $feature;?>"></span></li>
											<?php } ?>
										</ul>
									</span>
								</li>
								<li><span class="garge"></span> <?php echo $featured_nearest;?> 
									<span class="pull-right">
										<ul class="list-inline">
											<?php foreach($property['nearestplaces'] as $nearestplace) {?>
												<li><span><img src="<?php echo $nearestplace;?>"></span></li>
											<?php } ?>
										</ul>
									</span>
								</li>
							</ul>
							<ul class="list-unstyled apart">
								<li><i class="fa fa-star" aria-hidden="true"></i>  <?php echo $property['category']; ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<!--properties code end here-->
