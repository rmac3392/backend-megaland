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
    <div id="content" class="<?php echo $class; ?> ouragent_detail"><?php echo $content_top; ?>
		<?php foreach ($agentdetails as $agent) { ?>
			<div class="col-sm-6 col-md-3 col-lg-3 col-xs-12 boxs">
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
		<div class="col-sm-12"><?php echo $pagination; ?></div>
    </div>
      <?php echo $content_bottom; ?>
    <?php echo $column_right; ?></div>
    </div>
<?php echo $footer; ?>
