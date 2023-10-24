<link rel="stylesheet" href="catalog/view/theme/realestate/stylesheet/jquery.fancybox.min.css" media="screen">
<div class="ourgallery post2">
	<h3><span><?php echo $heading_title; ?></span></h3><hr>
		<!--1st design start-->
		<div id="gallery" class="owl-carousel">
			<?php if(isset($gallerys)){ ?>
				<?php foreach($gallerys as $gallery) { ?>
					<div class="item">
						<div class="images">
							<a class="fancybox" rel="ligthbox" href="<?php echo $gallery['image']; ?>">
								<?php if($gallery['image']){ ?>
									<img class="img-responsive" src="<?php echo $gallery['image']; ?>"/>
								<?php } ?>
								
							</a>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
		<!--1st design end-->
		
		<!--2nd design start-->
		<div id="gallery1" class="owl-carousel hide">
			<?php if(($gallerys)){ ?>
				<?php foreach($gallerys as $gallery) { ?>
					<div class="item boxs">
						<div class="image">
							<a href="<?php echo $gallery['href']; ?>">
								<?php if($gallery['image']){ ?>
									<img class="img-responsive" src="<?php echo $gallery['image']; ?>"/>
								<?php } ?>
								<div class="hoverbox">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</div>
							</a>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
		<!--2nd design end-->
		
		<!--3rd design start-->
		<div class="gallery3 hide">
			<?php if(($gallerys)){ ?>
				<ul class="list-inline">
				<?php foreach($gallerys as $gallery) { ?>
						<li class="image">
							<a href="<?php echo $gallery['href']; ?>">
								<?php if($gallery['image']){ ?>
									<img class="img-responsive" src="<?php echo $gallery['image']; ?>"/>
								<?php } ?>
							</a>
						</li>
				<?php } ?>
				</ul>
			<?php } ?>
		</div>
		<!--3rd design end-->
</div>
<script type="text/javascript"><!--
$('#gallery').owlCarousel({
	items : 5,
    itemsDesktop : [1199, 5],
    itemsDesktopSmall : [979, 3],
    itemsTablet : [768, 2],	
    itemsMobile : [479, 1],
	autoPlay: false,
	navigation: true,
	navigationText: ['<i class="fa fa-caret-left" aria-hidden="true"></i>','<i class="fa fa-caret-right" aria-hidden="true"></i>'],
	pagination: false
});
$('#gallery1').owlCarousel({
	items : 10,
    itemsDesktop : [1199, 10],
    itemsDesktopSmall : [979, 5],
    itemsTablet : [768, 2],	
    itemsMobile : [479, 1],
	autoPlay: false,
	navigation: true,
	navigationText: ['<i class="fa fa-caret-left" aria-hidden="true"></i>','<i class="fa fa-caret-right" aria-hidden="true"></i>'],
	pagination: false
});
--></script>
<script>
$(document).ready(function(){
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
   
</script>
<script src="catalog/view/theme/realestate/js/jquery.fancybox.min.js"></script>
