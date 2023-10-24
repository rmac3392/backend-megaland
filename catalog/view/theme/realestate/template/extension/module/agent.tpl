<!--our agents-->
<div class="agent row">
	<h3 class="post2"><span><?php echo $heading_title; ?></span></h3><hr>
	<div class="agents owl-carousel">
	<?php foreach ($agentdetails as $agent) { ?>
		<!--1st design start-->
		<div class="col-sm-12 post1">
			<div class="item">
				<a href="<?php echo $agent['href']; ?>"><img src="<?php echo $agent['image']; ?>" alt="<?php echo $agent['agentname']; ?>" title="<?php echo $agent['agentname']; ?>" class="img-responsive" /></a>
				<div class="name"><?php echo $agent['agentname']?></div>
				<div class="desg"><?php echo $agent['positions']?></div>
				<div class="comment"><?php echo $agent['description']?></div>
				<a href="<?php echo $agent['href']?>"><?php echo $text_view?></a>
			</div>
		</div>
		<!--1st design end-->
		<?php } ?>
	</div>
	<div class="view"><a href="<?php echo $viewmore; ?>"><?php echo $text_viewmore; ?></a></div>
</div>

<!--our agents code end-->
<script type="text/javascript"><!--
$('.agents').owlCarousel({
	items :4,
  itemsDesktop : [1000,3],
  itemsDesktopSmall : [900,2],
  itemsTablet: [600,1], 
  itemsMobile : false, 
	autoPlay:3000,
	navigation: true,
	navigationText: ['<i class="fa fa-caret-left" aria-hidden="true"></i>','<i class="fa fa-caret-right" aria-hidden="true"></i>'],
	pagination:false
});
--></script>
