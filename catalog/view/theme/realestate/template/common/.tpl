<?php echo $column_footer;?>
<footer>
	<span class="caret"></span>
	<div id="footer" class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div id="social_media">
					<div class="links1">
						<div class="address">
							<h5><?php echo $title;?></h5>
							<ul class="list-unstyled">
								<?php if($address2) { ?>
								<li class="address"><i class="fa fa-map-marker"></i> <?php echo $address2; ?></li>
								<?php }?>
								<?php if($phoneno) { ?>
								<li><i class="fa fa-phone"></i> <?php echo $phoneno;?></li>
								<?php }?>
								<?php if($mobile) { ?>
								<li class="phone hide"><?php echo $mobile;?></li>
								<?php }?>
								<?php if($email) { ?>
								<li class="mail"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $email?>"><?php echo $email?></a></li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
		<p class="powered"><?php echo $powered; ?></p>
	</div>
</footer>
</body></html>