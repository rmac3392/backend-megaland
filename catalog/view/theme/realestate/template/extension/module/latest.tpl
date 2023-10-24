<!--properties code start here-->
<div class="latest_product_heading">
  <h3><?php echo $heading_title; ?></h3>
  <span class="triangle"></span>
  <span class="single"></span>
</div>
<div class="row post1">
  <?php foreach ($propertys as $property) { ?>
    <div class="cate32">
    <!--1st design start here-->
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 latest_main post">
      <div class="product-thumb transition">
        <div class="image">
          <?php if(!empty($property) == $property['propertyrent']) { ?>
          <div class="sale">
          <span><?php echo $property['propertyrent'];?></span>
          </div>
          <?php } ?>
          <a href="<?php echo $property['href']; ?>">
		  			<?php if(!empty($property['thumb'])){ ?>		
<img src="<?php echo $property['thumb']; ?>" alt="<?php echo $property['name']; ?>" title="<?php echo $property['name']; ?>" class="img-responsive" />
			<?php } else { ?>
		     	<img src="catalog/view/theme/realestate/image/demo.png" class="img-responsive2"/>
			<?php } ?>
		  </a>
        </div>
        <div class="caption">
          <div class="featured_product">
            <h4><a href="<?php echo $property['href']; ?>"><?php echo $property['name']; ?></a></h4>
            <p class="price"><span class="text"><?php echo $featured_price; ?></span>
            <?php echo $property['price']; ?>
            </p>
            <div class="">
              <ul class="list-inline">
                <li><span class="sqtt"></span><?php echo $property['area']; ?> <?php echo $property['area_type']; ?></li>
                <li><span class="bedrooms"></span><?php echo $property['bedrooms']; ?></li>
                <li><span class="bathrooms"></span><?php echo $property['bathrooms']; ?></li>
              </ul>
            </div>
            <?php if(!empty($property['features'])) {?>
            <div class="amenities">
              <span class="text"><?php echo $featured_amenities;?></span>
              <ul class="list-inline">
              <?php foreach($property['features'] as $feature) {?>
                <li><span><img src="<?php echo $feature;?>"></span></li>
              <?php } ?>  
              </ul>
            </div>  
            <?php } ?>

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
          <!-- AddThis Button BEGIN -->
            
            <i class="fa fa-share-alt-square" aria-hidden="true" onclick="top.location.href=('<?php echo $property['href']; ?>');"></i>
            <!-- AddThis Button END -->
          <span><button class="product_button" onclick="top.location.href=('<?php echo $property['href']; ?>');"><i class="fa fa-file-text"></i> <?php echo $featured_details; ?></button> </span>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>
    </div>
    <!--1st design end here-->
  <?php } ?>
  <div class="clearfix"></div>
</div>
<!--properties code end here-->
