<?php echo $header; ?>
<div class="breadmain">
	<div class="container">
		<ul class="breadcrumb">
			<?php 
			 if(!empty($breadcrumbs)){
			foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } } ?>
		</ul>
		<?php 
		  if(!empty($heading_title)){
			  ?>
			<h3><?php echo $heading_title; ?></h3>
		  <?php 
		    } 
		  ?>
	</div>
</div>
<div class="container">
	<div id="gallery">
		<div class="photo ">
		<?php if(isset($gallerys)){ ?>
			<?php foreach($gallerys as $gallery) { ?>
			<div class=" col-sm-4 col-md-4 col-lg-3 col-xs-12">
				<div class="gallary">
					<div class="images">
						<a href="<?php echo $gallery['href']; ?>">
						<?php if($gallery['image']){ ?>
							<img class="img-responsive" src="<?php echo $gallery['image']; ?>"/>
						<?php } ?>
						</a>
						<div class="texthover" onclick="top.location.href='<?php echo $gallery['href']; ?>'">	
							<a class="name" href="<?php echo $gallery['href']; ?>"><span><?php echo $gallery['album']; ?></span></a>
							<span class="description"><p><?php echo $gallery['description'] ?></p></p></span>
							<span class="totalphoto"><?php echo $gallery['totalphoto']?> Photos</span>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
			<div class="col-sm-6 text-right"><?php echo $results; ?></div>
		</div>
		<?php } ?>
		<?php echo $content_bottom; ?>
		</div>
		<?php echo $column_right; ?>
	</div>
</div>
<?php echo $footer; ?>