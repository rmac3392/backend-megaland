<!--newsletter code start here-->
<div id="newsletter">
	<div class="row post3">
		<div id="frm_subscribe" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<?php if(!$popup==1){?>
			<form class="form-horizontal" name="subscribe" id="subscribe">
				<div class="newsbox">
					<div class="input-group">
						<label class="input-group-addon news-label"><i class="fa fa-envelope"></i><span class="hidden-xs"><?php echo $text_newsletter; ?></span><span class="triangle-img"></span></label>
						<input class="form-control " type="text" value="" name="subscribe_email" id="subscribe_email" placeholder="<?php echo $text_nemail; ?>">
						<div class="input-group-addon btn-gery">
							<button class="btn-news" type="submit" onclick="email_subscribe1();"><?php echo $newslatertext; ?></button>
							<?php if($option_unsubscribe) { ?>
								<a class="btn btn-news1 hide" onclick="email_unsubscribe1();"><span><?php echo $entry_unbutton; ?></span></a>
							<?php } ?>
						</div>
					</div>
				</div>
				
				<span id="subscribe_result"></span>
			</form>
		<?php } else { ?>
			<div class="col-sm-7 col-md-7 col-lg-6 col-xs-12 padd hide">
				<div class="envelope" data-toggle="modal" data-target="#myModal1">
					<div class="letter"><a><i><?php echo $newslatertext; ?></i></a> </div>
				</div>
			</div>
		<?php } ?>
		
		</div> 
	</div> 
</div>  

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="myModal1">
  <div class="modal-dialog modal-lg">
		<div class="modal-content signup" id="signup">
			<span class="close1"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></span>
			<div  class="boxmodal">
				<form class="form" name="subscribe" id="subscribe">
					<fieldset>
					<div class="msg"><i class="fa fa-envelope-o fa-5x"></i></div>
					<div class="text">
						<h4><?php echo $text_sub; ?></h4>
					</div>
						<div class="form-group required email">
					    <div class="input-group">
					      <input type="text" class="form-control input-lg" placeholder="<?php echo $text_nemail; ?>" value=""  id="subscribe_email" name="subscribe_email">
								<span class="input-group-btn">
								<a onclick="email_subscribe2()"><button class="btn btn-default" type="button">
									<span class="meup"><?php echo $entry_button; ?></span></button>
								</a>
								<a onclick="email_unsubscribe2()"><button class="btn btn-default" type="button">
									<span class="meup1"><?php echo $entry_unbutton; ?></span></button>
								</a>
								
								</span>
							</div>
						</div>
						<span id="subscribe_result" class="col-sm-12"></span>
					</fieldset>
					
						<br/>
				</form>
			</div>
		</div>
  </div>
</div><script language="javascript">

function email_subscribe1(){
		$.ajax({
			type: 'post',
			url: 'index.php?route=extension/module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#frm_subscribe input"),
			beforeSend: function() {
			$('.btn-news').button('loading');
			},
			complete: function() {
			$('.btn-news').button('reset');
		},
			success: function (html) {
				eval(html);
				$('input[name=subscribe_email]').val('');
			}}); 
}


function email_subscribe2(){
		$.ajax({
			type: 'post',
			url: 'index.php?route=extension/module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#signup input"),
			beforeSend: function() {
			$('.meup').button('loading');
			},
			complete: function() {
			$('.meup').button('reset');
		},
			success: function (html) {
				eval(html);
				$('input[name=subscribe_email]').val('');
				
			}}); 
}
	
function email_unsubscribe1(){
		$.ajax({
			type: 'post',
			url: 'index.php?route=extension/module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#frm_subscribe input"),
			beforeSend: function() {
			$('.btn-news1').button('loading');
			},
			complete: function() {
			$('.btn-news1').button('reset');
		},
			success: function (html) {
				eval(html);
				$('input[name=subscribe_email]').val('');
			}}); 
}
function email_unsubscribe2(){
		$.ajax({
			type: 'post',
			url: 'index.php?route=extension/module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#signup input"),
			beforeSend: function() {
			$('.meup1').button('loading');
			},
			complete: function() {
			$('.meup1').button('reset');
		},
			success: function (html) {
				eval(html);
				$('input[name=subscribe_email]').val('');
			}}); 
}

   
</script>
<script>
	$( ".close1" ).click(function() {
	  $( "#subscribe_result" ).empty();
		});
</script>

<style>
#newsletter{background: <?php echo $conatnerbg;?>}
#signup .btn-default{background: <?php echo $pupbutoncolor;?>}
#signup .msg .fa{color: <?php echo $pupbutoncolor;?>}
#newsletter .news{color: <?php echo $newstextnopop_color;?>}
#signup .meup{color: <?php echo $butontextcolor;?>}
#signup .meup1{color: <?php echo $butontextcolor;?>}
.close1 button.close{background: <?php echo $pupbutoncolor;?>}
.envelope a{color: <?php echo $newstext_color;?>}
.envelope{background: <?php echo $buttonbg;?>}
.envelope:hover a{color: <?php echo $newsbutonhover;?>}
</style>
<!--newsletter code end here-->
