<?php echo $header; ?>
<div class="breadmain">
	<div class="container">
		<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"> <?php echo $breadcrumb['text']; ?> </a></li>
			<?php } ?>
		</ul>
		<h3> <?php echo $breadcrumb['text']; ?> </h3>
	</div>
</div>
<div class="container">
	<div id="gallery" class="photopage">
		<div class="photo hide">
			<div class="description"><p><?php echo $album_description;?></p></div>
			<?php if(isset($images)) { ?>
				<?php foreach($images as $image) { ?>
					<?php if($image['images']) { ?>
					<div class=" col-sm-4 col-md-4 col-lg-3 col-xs-12">
						<div class="gallary">
							<div class="images magnificPopup<?php echo $image['album_photos_id']; ?>">	
								<img class="img-responsive"  title="<?php echo $image['name'];?>" src="<?php echo $image['images']; ?>" />
								<a class="thumbnail" id="<?php echo $image['album_photos_id'] ?>" href="<?php echo $image['popup']; ?>" title="<?php echo $image['name']?>	<?php echo $image['description'];?>" style="text-align:center">	
									<div class="texthover">
										<span class="namephoto"><?php echo $image['name']?></span>
										<img style="display:none" class="img-responsive" alt="<?php echo $image['name'];?>" title="<?php echo $image['name'];?>" src="<?php echo $image['images']; ?>" />
									</div>
								</a>
							</div>
						<?php foreach($image['multiples_images'] as $multiples_image) { ?>
						<div class="image magnificPopup<?php echo $image['album_photos_id']; ?> hide">
							<a class="thumbnail" href="<?php echo $multiples_image['popup']; ?>" title="<?php echo $image['name']?>"></a>
						</div>
						<?php } ?>
						<div class="clearfix">
						</div>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>	
		
		<!--2nd gallery start-->
			<div class="hide"> <ul class="list-inline nav-tabs ">
				<?php foreach($gallerys as $keys => $gallery){ ?> 
					<li class="<?php if($keys==0){ echo 'active'; } ?>"><a href="#tab<?php echo $keys ?>-<?php echo $gallery['album']; ?>" data-toggle="tab"><?php echo $gallery['album']; ?></a></li>
				<?php } ?>
			 </ul>
			 <div class="tab-content">
				<?php foreach($gallerys as $keys => $gallery){ ?> 
					 <div class="tab-pane <?php if($keys==0){ echo 'active'; } ?>" id="tab<?php echo $keys ?>-<?php echo $gallery['album']; ?>">
						<div class="gallary_second">
							<ul class="list-inline">
							<?php if(isset($images)) { ?>
								<?php foreach($images as $image) { ?>
									<?php if($image['images']) { ?>
											<li class="images magnificPopup<?php echo $image['album_photos_id']; ?>">	
												<img  title="<?php echo $image['name'];?>" src="<?php echo $image['images']; ?>" />
												<a id="<?php echo $image['album_photos_id'] ?>" href="<?php echo $image['popup']; ?>" title="<?php echo $image['name']?>	<?php echo $image['description'];?>" style="text-align:center"></a>
											</li>
									<?php } ?>
								<?php } ?>
							<?php } ?>
							</ul>
						</div>
					 </div>
				<?php } ?>
             </div></div>
            <!--2nd gallery end-->
<link rel="stylesheet" href="catalog/view/theme/realestate/stylesheet/jquery.fancybox.min.css" media="screen">

<div class="container">
	<div class="row">
		<?php if(isset($images)) { ?>
		<?php foreach($images as $image) { ?>
		<div class='list-group gallery '>
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3 myphotoimg'>
                <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo $image['popup']; ?>">
                    <img class="img-responsive" alt="" src="<?php echo $image['popup']; ?>" />
                    <div class='text-right'>
                        <small class='text-muted'><?php echo $image['name']?></small>
                    </div> <!-- text-right / end -->
                </a>
            </div> <!-- col-6 / end -->
			
        </div> <!-- list-group / end -->
		<?php } }?>	
		<div class="clearfix"></div>
	</div> <!-- row / end -->
</div> <!-- container / end -->
			
            <!--2nd gallery end-->
		
		<?php echo $content_bottom; ?>
		<?php echo $column_right; ?>
	</div>
	<div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
    </div>
</div>
<?php echo $footer; ?>
<script>
$(document).ready(function(){

    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
   
</script>
<script src="catalog/view/theme/realestate/js/jquery.fancybox.min.js"></script>
<script type="text/javascript">
$('document').ready(function() {
	<?php foreach($images as $image) { ?>
	$('.magnificPopup<?php echo $image['album_photos_id']; ?>').magnificPopup({
		type:'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		delegate: 'a',
		gallery: {
			enabled:true
		}
	});
	<?php } ?>
});
</script> 
<style>
#cboxTitle{position:absolute; bottom:0; left:0; text-align:center; width:100%; font-weight:bold;}
</style>
