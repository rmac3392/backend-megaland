<?php echo $column_footer;?>
<footer class="footer3">
	<div class="container">
		<div class="row footer4">
			<div class="col-sm-3 post4">
				<div class="footer-logo">
					<div class="logo">
						<?php if ($footericon) { ?>
							<a href="<?php echo $home; ?>"><img src="<?php echo $footericon; ?>"  class="img-responsive" alt="logo" title="logo"/></a>
						<?php } ?>
					</div>
				<p><?php echo $aboutusdescrption;?><br/><br/><a href="index.php?route=information/information&information_id=8"><i class="fa fa-circle" aria-hidden="true"></i><?php echo $text_read; ?></a></p>
				</div>
			</div>
			<div class="col-sm-3 news post3">
				<h5><?php echo $text_latestnews; ?> </h5>
				<hr></hr>
				<!--static code start here-->
				<ul class="list-unstyled">
						<li><i class="fa fa-twitter" aria-hidden="true"></i> <?php echo $twittercode; ?>
					</li>		
				</ul>
				<!--static code end here-->
			</div>
			<div class="col-sm-3 links post">
				<h5><?php echo $text_links; ?></h5>
				<hr></hr>
				<ul class="list-unstyled">
					<?php foreach ($informations as $information) { ?>
						<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
					<?php } ?>
					<li><a href="<?php echo $faq; ?>"><?php echo $text_faq; ?> </a></li>
				</ul>
			</div>
			<div class="col-sm-3 post2">
				<h5><?php echo $text_fgallery; ?></h5>
				<hr></hr>
				<?php if(isset($resultsinfos)){?>
				<?php foreach($resultsinfos as $resultsinfo){?>
				<img src="<?php echo $resultsinfo['image'];?>">
				<?php } } ?>
				<?php echo $column_footer4;?>
			</div>
		</div>
	</div>
</footer>
<div class="powered3">
	<div class="container">
		<p class="pull-left"><?php echo $powered; ?></p>
		
	</div>
</div>
<script type="text/javascript" src="catalog/view/theme/realestate/js/realestate.js"></script>
</body></html>
