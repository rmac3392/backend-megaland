<!--testimonial code start here-->
<div id="testimonial" class="post2">
<h5><?php echo $heading_title; ?><i class="fa fa-home"></i></h5>
	<div id="testimonial1" class="owl-carousel testimonial">
	<?php foreach ($testimonial as $test) { ?>
		<div class="col-sm-12 col-xs-12 padd0">
			<p class="item">
				<?php echo $test['enquiry'];  ?>
			</p>
			<span class="pull-left">- <?php echo $test['name']; ?></span>
			<span class="pull-right"> 
				<img src="<?php echo $test['image']; ?>" alt="<?php echo $test['name']; ?>" title="<?php echo $test['name']; ?>" class="img-responsive" />
			</span>
		</div>
	 <?php } ?>
	</div>
</div>
<script type="text/javascript"><!--
$('#testimonial1').owlCarousel({
	items : 1,
        itemsCustom : false,
        itemsDesktop : [1199, 1],
        itemsDesktopSmall : [979, 1],
        itemsTablet : [768, 1],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
	autoPlay: 5000,
	navigation: false,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: false
});
--></script>
<!--testimonial code end here-->
