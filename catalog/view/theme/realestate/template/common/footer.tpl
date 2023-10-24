<?php echo $column_footer;?>
<footer class="footer3">
	<div class="container">
		<div class="row">
			<div class="col-sm-3 post1">
				<div class="footer-logo">
					<div class="logo">
					<?php if ($footericon) { ?>
						<a href="<?php echo $home; ?>"><img src="<?php echo $footericon; ?>"  class="img-responsive" alt="logo" title="logo"/></a>
					<?php } ?>
					
					</div>
				<p><?php echo $aboutusdescrption;?><br/><br/><a href="index.php?route=information/information&information_id=4"><i class="fa fa-circle" aria-hidden="true"></i><?php echo $text_read; ?></a></p>
				</div>
			</div>
			<div class="col-sm-3 links post2">
				<h5><?php echo $text_links; ?></h5>
				<ul class="list-unstyled">
					 <?php foreach ($informations as $information) { ?>
						<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
					  <?php } ?>
					<li><a href="<?php echo $faq; ?>"><?php echo $text_faq; ?></a></li>
				</ul>
			</div>
			<div class="col-sm-3 tags post3">
				<h5><?php echo $powered; ?></h5>
				<?php echo $column_footer5; ?>
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
	</div>
</footer>
<div class="powered3">
	<div class="container">
		<p><?php echo $powered; ?></p>
	</div>
</div>

</body></html>
