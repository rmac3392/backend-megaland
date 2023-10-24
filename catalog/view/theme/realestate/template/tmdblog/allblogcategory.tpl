<?php echo $header; ?>
<div class="container">
<div id="latestpost">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-8 col-md-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
    <div class="row">
		<?php foreach ($allblogcategorys as $allblogcat) { ?>
		<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
			<div class="product-layout product-list">
				<div class="product-thumb">
					<div class="datebox"><i><?php echo $allblogcat['date_added']; ?> <hr><?php echo $allblogcat['month_added']; ?></i></div>
					<?php if($tmdblogsetting_articleimg){ ?><div class="image listimg" style="width:100%;" height="100%;"><a href="<?php echo $allblogcat['href']; ?>"><img src="<?php echo $allblogcat['thumb']; ?>"   alt="<?php echo $allblogcat['name']; ?>" title="<?php echo $allblogcat['name']; ?>" class="img-responsive" /></a></div>
					<?php } ?>	
					<?php if($tmdblogsetting_article){ ?><h4><?php echo $allblogcat['name']; ?></h4><?php } ?>
					<?php if($tmdblogsetting_feedbackrow){ ?>
					<div class="feedback">
						<ul class="list-inline">
							<?php if ($allblogcat['username']) { ?>
							<li><?php echo $text_posted; ?> <span class="user"><?php echo $allblogcat['username']?></span></li>
							<?php } ?>
						</ul>
					</div>
					<?php } ?>
					<?php if($tmdblogsetting_feedbackrow){ ?>
						<div class="pull-right feedbackrow padd">
							<ul class="list-inline">
								<li><i class="fa fa-comment"></i><?php echo $allblogcat['comment'];?>  </li>
								<li><i class="fa fa-eye"></i><?php echo $allblogcat['viewed']?> </li>
							</ul>
						</div>
						<?php } ?>
			
					<div class="detail">
						<?php if($tmdblogsetting_descp){ ?><div class="description1 pull-left"><?php echo $allblogcat['description']; ?></div><?php } ?>
					</div>
					<br/><br/>
			
					<div class="col-sm-12 padd">
						<div class="social-icons">
						
							<ul class="list-inline">
							
							<?php if($tmdblogsetting_facebook){ ?>
							<li><a  href="https://www.facebook.com/sharer/sharer.php?&u=<?php echo $allblogcat['href']; ?>&display=popup&ref=plugin&src=share_button" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=580')" class="addthis_button_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if($tmdblogsetting_google){ ?>
							<li><a href="https://plus.google.com/share?url=<?php echo $allblogcat['href']; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="addthis_button_email"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if($tmdblogsetting_pinterest){ ?>
							<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo $allblogcat['href']; ?>&media=<?php echo $allblogcat['thumb']; ?>&description=<?php echo $allblogcat['name']; ?>" target="_blank"  class="addthis_button_pinterest_pinit"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li> 
							<?php } ?>
							<?php if($tmdblogsetting_twitter){ ?>
							<li><a href="https://twitter.com/intent/tweet?text=<?php echo $allblogcat['name']; ?>&url=<?php echo $allblogcat['href']; ?>" class="addthis_button_twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>  
							<?php } ?>
							</ul>
						</div>
					<div class="pull-right btnread"><a href="<?php echo $allblogcat['href']; ?>"><?php echo $text_readmore; ?></a></div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
		
		<div class="clearfix"></div>
	   <div class="row clearfix hidden-xs">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
    <?php echo $content_bottom; ?>
	
	</div>
	<?php echo $column_right; ?> 
	</div>
	</div>
</div>
<?php echo $footer; ?>
<style>
.pin_it_iframe_widget{
	display:none;
}</style>
