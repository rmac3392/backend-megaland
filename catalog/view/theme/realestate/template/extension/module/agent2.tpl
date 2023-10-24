<!--our agents-->
<div class="agentss">
	<div class="container">
		<div class="row">
			<div class="latest_product_heading">
				<h3 class="post4"><?php echo $heading_title; ?></h3>
				<a href="<?php echo $viewmore; ?>"><?php echo $text_viewmore; ?></a>
			</div>	
			<div class="owl-carousel" id="agents">
				<?php foreach ($agentdetails as $agent) { ?>
				<div class="col-sm-12 col-xs-12 box post">
					<div class="image">
						<a href="<?php echo $agent['href']; ?>"><img src="<?php echo $agent['image']; ?>" alt="<?php echo $agent['agentname']; ?>" title="<?php echo $agent['agentname']; ?>" class="img-responsive" />
						<div class="hoverbox">
							<i class="fa fa-plus" aria-hidden="true"></i>
						</div></a>
					</div>
					<?php if(!empty($agent)==$agent['facebook'].$agent['twitter'].$agent['googleplus'].$agent['pinterest'].$agent['instagram']){?>
					<ul class="list-inline socialicon">
						<?php if($agent['facebook']){?>
							<li class="fb"><a href="<?php echo $agent['facebook']?>" target="new"><i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
						<?php } ?>
						<?php if($agent['twitter']){?>
							<li class="twitter"><a href="<?php echo $agent['twitter'];?>" target="new" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
						<?php }?>
						<?php if($agent['googleplus']){?>
							<li class="google"><a href="<?php echo $agent['googleplus'];?>" target="new" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i> </a></li>
						<?php } ?>
						<?php if($agent['pinterest']){?>
							<li class="pinterest"><a href="<?php echo $agent['pinterest'];?>" target="new" class="pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i> </a></li>
						<?php }?>
						<?php if($agent['instagram']){?>
							<li class="instagram"><a href="<?php echo $agent['instagram'];?>" target="new" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i> </a></li>
						<?php } ?>
					</ul>
					<?php } ?>
					<div class="deatil">
						<div class="name"><?php echo $agent['agentname']?></div>
						<div class="property"><?php echo $agent['propertyagent']?> <?php echo $text_property;?></div>
					</div>
				</div>
				<?php } ?>
			</div>				
		</div>				
	</div>				
</div>				
<!--our agents code end-->
<script type="text/javascript"><!--
$('#agents').owlCarousel({
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
