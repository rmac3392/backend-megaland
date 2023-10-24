<?php echo $header; ?>
<div class="container">
<div id="tmdblog">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
	
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="row">
	  
	   <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-8'; ?>
        <?php } ?>
		 <div class="row">
			 <div class="<?php echo $class; ?>">
				<ul class="thumbnails">
				<li><a class="thumbnail"><img src="<?php echo $thumb; ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" class="" /></a></li>
				</ul>
			</div>
			<?php if ($column_left && $column_right) { ?>
			<?php $class = 'col-sm-6'; ?>
			<?php } elseif ($column_left || $column_right) { ?>
			<?php $class = 'col-sm-6'; ?>
			<?php } else { ?>
			<?php $class = 'col-sm-4'; ?>
			<?php } ?>
				<div class="<?php echo $class; ?>">	
					<h1><?php echo $heading_title; ?></h1>
					<div class="dateadded"><i><?php echo $date_added; ?></i></div>
					<div class="description"><?php echo $description; ?></div>
				</div>
		 </div>
	  <div class="row">
	  <?php if($post_info){?>
        <div class="col-sm-12"> <h3><?php echo $text_post; ?></h3></div>
        <?php foreach ($post_info as $pos) { ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?>">
          <div class="product-list col-xs-12">
			  <div class="product-thumb">
			 	<div class="image"><a href="<?php echo $pos['href']; ?>"><img src="<?php echo $pos['image']; ?>" alt="<?php echo $pos['name']; ?>" title="<?php echo $pos['name']; ?>" class="img-responsive" /></a></div>
				<div>
				<div class="caption">
				  <h4><a href="<?php echo $pos['href']; ?>"><?php echo $pos['name']; ?></a></h4>
				  <div class="dateadded"><i><?php echo $pos['date_added']; ?></i></div>
				  <div class="description"><?php echo $pos['description']; ?></div>
				</div>
				</div>
				</div>
          </div>
        </div>
      
        <?php } } ?>
      </div>

	  
	 </div>
    
	  </div>
	  </div>
    <?php echo $content_bottom; ?><?php echo $column_right; ?>
	
	</div></div>

<?php echo $footer; ?>