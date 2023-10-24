<h3><?php echo $heading_title; ?></h3>
<div class="row">
	<div id="latestblog">
	<?php foreach ($latestblogs as $blog) { ?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="product-thumb">
				<div class="image">
					<a href="<?php echo $blog['href']; ?>"><img src="<?php echo $blog['thumb']; ?>" alt="<?php echo $blog['name']; ?>" title="<?php echo $blog['name']; ?>" class="img-responsive" /></a>
				</div>
				<div class="caption">
					<h4><a href="<?php echo $blog['href']; ?>"><?php echo $blog['name']; ?></a></h4>
					<div class="description"><p><?php echo $blog['description']; ?></p></div>
					<div class="icons1">
						<div class="share">
							<ul class="list-inline">
								<li><i class="fa fa-comment"></i><span class="commentcount"><?php echo $blog['comment'];?> </span></li>
								<li><i class="fa fa-eye"></i><?php echo $blog['viewed']?></li>
							</ul>
						</div>
						<div class="dateadded"><i><?php echo $blog['date_added']; ?></i></div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
</div>
<script type="text/javascript"><!--
$('#latestblog').owlCarousel({
	items: 4,
	autoPlay: 3000,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination:false,
	itemsDesktop : [1199, 4],
    itemsDesktopSmall : [979, 2],
    itemsTablet : [768, 1]
});
--></script>
