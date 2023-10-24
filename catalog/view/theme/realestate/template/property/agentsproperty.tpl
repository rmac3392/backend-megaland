<?php echo $header; ?>
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
		<div class="row agentview">
				<div class="image col-sm-2">
					<a href="#"><img class="img-responsive" src="<?php echo $agentimage; ?>" alt="agent" title="agent" class="img-responsive" /></a>
				</div>
				<div class="agentdetail col-sm-10">
					<div class="name"><?php echo $agentname;?></div>
					<div class="name"><?php echo $email;?></div>
					<div class="name"><?php echo $positions;?></div>
					<div class="name"><?php echo $contact;?></div>
					<div class="name"><?php echo $address;?></div>
					<div class="name"><?php echo $country;?></div>
					<div class="name"><?php echo $city;?></div>
					<div class="name"><?php echo $pincode;?></div>
					<div class="name"><?php echo $description;?></div>
					
				</div>
			</div>
				<h3><?php echo $text_agentproperty; ?></h3>
				<div class="row agentview related-listing cate2">
			<?php foreach ($agentpropertys as $result) { ?>
               
					<div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12 latest_main">
					<div class="product-thumb transition">
						<div class="image">
							<a href="<?php echo $result['href']; ?>">
								<img src="<?php echo $result['image'];?>" class="img-responsive">		
								
							</a>
						</div>
						<ul class="list-inline options">
							<li><span class="sqft"></span><?php echo $result['area'];?> <?php echo $result['area_type'];?></li>
							<li><span class="bedrooms"></span><?php echo $result['bedrooms'];?></li>
							<li><span class="bathrooms"></span><?php echo $result['bathrooms'];?></li>
						</ul>
						<div class="caption">
							<div class="featured_product">
								<a href="<?php echo $result['href']; ?>">
						
								<h4><?php echo $result['name'];?></h4>
								</a>
								<p class="price"><span class="text">Price:</span><?php echo $result['price'];?></p>
								<ul class="list-unstyled features">
									<li><i class="fa fa-star" aria-hidden="true"></i>  <?php echo $result['category_name'];?> </li>
									<li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $result['local_area'];?></li>
									<li><span><i class="fa fa-bookmark-o" aria-hidden="true"><?php echo $result['neighborhood'];?></i>
									</span> </li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				    <?php } ?>

			</div>



		</div>
        </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
