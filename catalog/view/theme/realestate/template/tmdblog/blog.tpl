<?php echo $header; ?>
<div class="container">
<div id="latestpost">
<ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
<?php if($tmdblogsetting_blogarticleimg){ ?>
    <div class="image listimg">
	<a href="<?php echo $href?>">
		<img src="<?php echo $thumb?>" alt="<?php echo $thumb?>" title="<?php echo $thumb?>" class="img-responsive" />
	</a>
   <div class="col-sm-12 padd">
	<div class=" headtitle">
		<div class="col-sm-2 inner pull-left col-xs-12">
			<img src="catalog/view/theme/realestate/image/userimg.png"/>
			<?php if($tmdblogsetting_blogfeedbackrow){ ?>
			<div class="feedback">
				<ul class="list-unstyled">
					<?php if($username) { ?>
					<li><span class="user"><?php echo $username; ?></span></li>
					<?php } ?>
					<?php if(!$username) { ?>
					<li><i></i></li>
					<?php } ?>
					<li><?php echo $viewed; ?></li>
				</ul>
			</div>
			<?php } ?>
		</div>
		<div class="col-sm-10 innerheader col-xs-12">
			<h1><?php echo $heading_title; ?></h1>
			<?php if($tmdblogsetting_blogfeedbackrow){ ?>
			<div class="col-sm-12 feedbackrow padd">
				<ul class="list-inline">
				<li><i><?php echo $date_added?></i></li>
				<li class="commentadta">|&nbsp;&nbsp; <span class="commentcount"><?php echo $comments;?> </span> <?php echo $text_coments; ?></li>
					
					<?php if($username) { ?>
					<?php } ?>
					<?php if(!$username) { ?>
					<li><i></i></li>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
		</div>	
	</div>
  </div>
</div> 
 <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-8 col-md-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	  <div class="row all">
		<div class="product-layout product-list col-xs-12">
			<div class="product-thumb">
				<?php if($tmdblogsetting_blogdescp){ ?><div class="description1 pull-left"><?php echo $description ?></div><?php } ?>
					
				<div class="row">
					<!--tags work static-->
						<?php if(!empty($tags)) {?>
					<div class="col-sm-12 tagbox">
					<h2><?php echo $text_tages; ?></h2>
						<ul class="list-inline">
							<?php foreach($tags as $tag) {?>
							<li><a href="<?php echo $tag['href']?>" class="tag"><?php echo $tag['tag']?></a></li>
							<?php } ?>
						</ul>
					</div>	
					<?php } ?>
					<!--tags work static-->
				</div>	
			
					<div class="col-sm-12 padd">
						<div class="social-icons">
							<ul class="list-inline">
							
							<?php if($tmdblogsetting_blogfacebook){ ?>
							<li><a  href="https://www.facebook.com/sharer/sharer.php?&u=<?php echo $href; ?>&display=popup&ref=plugin&src=share_button" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=580')" class="addthis_button_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if($tmdblogsetting_bloggoogle){ ?>
							<li><a href="https://plus.google.com/share?url=<?php echo $href; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="addthis_button_email"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if($tmdblogsetting_blogpinterest){ ?>
							<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo $href; ?>&media=<?php echo $thumb; ?>&description=<?php echo $heading_title; ?>" target="_blank"  class="addthis_button_pinterest_pinit"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li> 
							<?php } ?>
							<?php if($tmdblogsetting_blogtwitter){ ?>
							<li><a href="https://twitter.com/intent/tweet?text=<?php echo $heading_title; ?>&url=<?php echo $href; ?>" class="addthis_button_twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>  
							<?php } ?>
							</ul>
						</div>
					</div>
			
			
			</div>
        </div>
		
		<?php
		
		if($globalblogcoment) {
		
		?>
		
		
		<div class="product-layout product-list col-xs-11" id="postfeedback">
			<div class="commentheadr">
				<div class="pull-left"><span class="commentcount"><?php echo $comments?></span><?php echo $text_coments; ?></div>
				
			</div>
			
			<hr/>
			<?php if($logged){?>
		<div class="commentbox2 adddata">
				<div class="userpic">
					<img src="catalog/view/theme/realestate/image/userimg.png"/>
				</div>
				<div class="inputbox">
				<input type="hidden" name="blog_id" value="<?php  echo $blog_id?>"/>
				<input type="hidden" name="image" id="image" value=""/>
				
				<input type="text" name="comment" class="form-control commenttextbox"/><br/>
				
				<a class="fileimage" data-toggle="tooltip" title="Add Image"><i class="fa fa-image"></i></a>
				
				<input type="button" value="Add Comment" id="add-filetype" class="addbuton  btn btn-primary pull-right" data-toggle="tooltip" title="Add Comment"/>
				
				<img style="display:none" src="" id="imagesrc">
				</div>
		</div>
			<?php } else {?>
				<div class="col-sm-12">
		<div class="logoutbox"><?php echo $text_forcomment; ?><a href="#" data-toggle="modal" data-target=".bs-example-modal-md"><?php echo $text_login; ?></a> </div>
		</div>
		
		<div id="loginpop" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-md">
			<div class='solid'></div>
			<div class="modal-content col-sm-12">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="logmain">
			
			 <div class="lognhead"><?php echo $text_belogin; ?> </div>
			 
				<div class="form-group col-sm-12">
					<input type="text" name="email" value="" id="email1" class="form-control emailerror" placeholder="<?php echo $text_email; ?>"/>
						<span class="name-icon fui-mail gray"></span>
			    </div>
				<div class="form-group col-sm-12">
					 <input type="password" name="password" value="" id="password1" class="form-control" placeholder="<?php echo $text_password; ?>"/>
						<span class="name-icon fui-lock gray"></span>
					
			    </div>	
				 <div class="form-group col-sm-12">
					<div class="pull-right margin-email btn-block">
						<a><input class="btn-primary form-control" type="button" value="<?php echo $button_signin; ?>" id="loginpage"/></a>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="pull-left forgot">
						<?php echo $text_register; ?>
					</div>
					<div class="pull-right forgot">
						<a href="index.php?route=agent/forgotten"><?php echo $text_forgot; ?></a>
					</div>
				</div>
			</div>
			</div>
			
		  </div>
		 
		</div>
		<?php } ?>
		
			<div class="loadcomment" style="clear:both">
			<br/><br/>
			
			<?php foreach($comment_info as $info) {?>
			
			<div class="commentbox pull-left col-sm-12 post">
				<div class="col-sm-1 userbox">
				<div id="button-upload"><img src="catalog/view/theme/realestate/image/userimg.png"/></div>
				</div>
				<div class="comment col-sm-10">
					<span class="name"><?php echo $info['username']?></span> <span class="time"><i><?php echo $info['date_added'] ?></i></span>
					
					<p><?php echo $info['comment']; ?> </p>
					<?php if($info['image']){?>
					<div class="image-responsice"> <img src="<?php echo $info['image']; ?>" title="<?php echo $info['comment']; ?>" alt="<?php echo $info['comment']; ?>" /> </div>
					<?php } ?>
				</div>
			</div>
				<?php }   ?>
				
				
			</div>
		</div>
		<?php } ?>
	  </div>
		<?php echo $content_bottom; ?>
	</div>
		<?php echo $column_right; ?>
	</div>
  </div>
 </div>
<style>
.modal-backdrop {
	position: relative!important;
}
</style>
<script>

$('.fileimage').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tmdblog/blog/uploadcommentimage',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$('#image').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$('#image').attr('value', json['file']);
						$('#imagesrc').attr('src', json['file1'] );
						$('#imagesrc').css({ display: "block", padding: "10px" }); 
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});


$('.addbuton').bind('click', function() {
	$.ajax({
	url: 'index.php?route=tmdblog/blog/addblogcomments',
	type: 'post',
	data: $('.adddata input[type=\'text\'],.adddata input[type=\'hidden\']'),
	dataType: 'json',
	success: function(json) {
	$('.alert, .text-danger').remove();

		
		if (json['error']) {
			
			if(json['error']){
			$('.product-thumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle" style="margin-right:5px;"></i>' + json['error']+'</div>');
			}
			
						
			$('.warning').fadeIn('slow');
		}

		if (json['success']) {
				$('.product-thumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('.success').fadeIn('slow');
				$('input[name=comment]').val('');
				$('input[name=image]').val('');
				$('#imagesrc').attr('src', '');
				$('#imagesrc').css({'display':'none'});
				$('.loadcomment').load('index.php?route=tmdblog/blog/loadblogcomment&blog_id=<?php echo $blog_id?>'); 
				$('.commentcount').html(json['comments']);

		}
		}
		});
	});

	
	
$(function(){
 $(".commenttextbox").keyup(function (e) {
  if (e.which == 13) {
    $('.addbuton').trigger('click');
  }
 });
});

$('.loadcomment').load('index.php?route=tmdblog/blog/loadblogcomment&blog_id=<?php echo $blog_id?>'); 


$('#loginpage').bind('click', function() {
	$.ajax({
	url: 'index.php?route=tmdblog/blog/addlogin',
	type: 'post',
	data: $('.modal-content input[type=\'text\'],.modal-content input[type=\'password\'], .modal-content input[type=\'hidden\'], .modal-content input[type=\'radio\']:checked, .modal-content input[type=\'checkbox\']:checked, .modal-content select, .modal-content textarea'),
	dataType: 'json',
	success: function(json) {
	$('.alert, .text-danger').remove();

		
		if (json['error']) {
			
			if(typeof (json['error']['email'])!='undefined'){
			$('.emailerror').parent('div').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle" style="margin-right:5px;"></i>' + json['error']['email'] + '</div>');
			}
			if(typeof (json['error']['password'])!='undefined'){
			$('.emailerror').parent('div').before('<div class="alert alert-danger"> <i class="fa fa-exclamation-circle"></i>' + json['error']['password'] + '</div>');
			}
						
			$('.warning').fadeIn('slow');
		}

		if (json['success']) {
				$('.modal-content').before('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('.success').fadeIn('slow');
				window.location='index.php?route=tmdblog/blog&blog_id=<?php echo $blog_id ?>';

		}
		}
		});
	});

</script>
<style>
.pin_it_iframe_widget{
	display:none;
}</style>
    
<?php echo $footer; ?>


