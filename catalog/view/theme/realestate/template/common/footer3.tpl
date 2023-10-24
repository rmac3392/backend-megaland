<?php echo $column_footer;?>
<footer class="footer3">
	<div class="container">
		<div class="row">
			<div class="col-sm-3 post3">
				<div class="footer-logo">
					<div class="logo">
						<?php if ($footericon) { ?>
						<a href="<?php echo $home; ?>"><img src="<?php echo $footericon; ?>"  class="img-responsive" alt="logo" title="logo"/></a>
						<?php } ?>
					</div>
				<p><?php echo $aboutusdescrption;?> <br/><br/><a href="index.php?route=information/information&information_id=4"><i class="fa fa-circle" aria-hidden="true"></i><?php echo $text_read; ?></a></p>
				</div>
			</div>
			<div class="col-sm-3 links post2">
				<h5><?php echo $text_links; ?></h5>
				<ul class="list-unstyled">
					 <?php foreach ($informations as $information) { ?>
						<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
					  <?php } ?>
					<li>
						<a href="<?php echo $faq; ?>">
							<?php echo $text_faq; ?> 
							
						</a>
					</li>
				</ul>
			</div>
			<div class="col-sm-3 tags post3">
				<h5><?php echo $powered; ?></h5>
                <?php echo $column_footer5; ?>
			</div>
				<div class="col-sm-3 conatctform post1">
                
				<h5><?php echo $text_newsletter; ?> </h5>
				<hr></hr>
               <?php echo $column_footer3; ?>
				
			</div>
		</div>
	</div>
</footer>
<div class="powered3">
	<div class="container">
		<p><?php echo $powered; ?></p>
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
