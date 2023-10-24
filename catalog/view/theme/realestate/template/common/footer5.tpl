<footer class="footer3">
	<div class="container">
		<div class="row footer5">
			<div class="col-sm-3 post3">
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
				<hr></hr>
				<ul class="list-unstyled">
					<?php foreach ($informations as $information) { ?>
						<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
					<?php } ?>
					<li><a href="<?php echo $faq; ?>"><?php echo $text_faq; ?> </a></li>
				</ul>
			</div>
			
			<div class="col-sm-3 news post2">
				<h5><?php echo $text_latestnews; ?></h5>
				<hr></hr>
				<!--static code start here-->
				<ul class="list-unstyled">
					<li><i class="fa fa-twitter" aria-hidden="true"></i> <?php echo $twittercode; ?>
					</li>			
				</ul>
				<!--static code end here-->
			</div>
			<!--test-->
			<div class="col-sm-3 conatctform post1">
				<h5><?php echo $text_contact; ?> </h5>
				<hr></hr>
				<form method="post" id="" enctype="multipart/form-data" class="form-horizontal">
					<div class="serviceiddiv">
					</div>
					<div id="addcontact">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" name="name" value="" id="input-name" class="form-control" placeholder="Name"/>
								<div class="nameerror"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" name="email" value="" id="input-email" class="form-control" placeholder="Email"/>
								<div class="emailerror"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<textarea name="description" rows="5" id="input-description" class="form-control"></textarea>
								<div class="descriptionerror"></div>
							</div>
						</div>
						<div class="buttons">
							<button class="btn btn-primary btn-block" type="button" id="addcomment"><?php echo $button_submit; ?></button>
						</div>
					</div>	
				</form>
			</div>
		</div>
	</div>
</footer>
<div class="powered3">
	<div class="container">
		<p class="pull-left"><?php echo $powered; ?> </p>
		<?php echo $column_footer5; ?>
	</div>
</div>
<script>
$('#addcomment').click(function(){
	$.ajax({
		url: 'index.php?route=common/footer/SendEmailById',
		type: 'post',
		data: $('#addcontact input,#addcontact textarea'),
		dataType: 'json',
		beforeSend: function() {
		},
		success: function(json) {
			 if(json['error']) {
                if(json['error']['name']) {
                	$('.nameerror').html(json['error']['name']);
                }
				
                if(json['error']['email']) {
                	$('.emailerror').html(json['error']['email']);
                }
                
                if(json['error']['description']) {
               		$('.descriptionerror').html(json['error']['description']);
                }
            }
			if (json['success']) {
				 $('.serviceiddiv').before('<div class="alert alert-success"> ' + json['success'] + '</div>');
				$('#input-name').val('');
				$('#input-email').val('');
				$('#input-email').val('');
				$('#input-description').val('');
		
			}
		}
	 });					
	});					
</script>


</body></html>

