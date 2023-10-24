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
    <div class='col-md-12 text-center'>
	<h3 class="entry-title"><?php echo $heading_title; ?></h3>

    </div>
  </div>
  <div class="testminial-view">
    <div class="col-md-12">
    
        <div class="testimonial-inner">
    
		  <?php
          if(isset($testimoniainfos)){  
 		  foreach($testimoniainfos as $testimoniainfos){?>
		   <div class="item ">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-responsive" src="<?php echo $testimoniainfos['testimoniaimage']?>" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p><?php echo $testimoniainfos['testimoniainfo']?></p>
                  <small><?php echo $testimoniainfos['name']?></small>
                </div>
              </div>
            </blockquote>
          </div>
     	  <?php  
		  
	     	  }
   		    }
		  ?>
        </div>
    </div>
	<div class="clearfix"></div>
  </div>
<?php echo $content_bottom; ?></div>
<?php echo $column_right; ?></div>
</div>
<script>
	$('button[id^=\'button-upload\']').on('click', function() {
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
				url: 'index.php?route=tool/imageupload',
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
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
</script>
<?php echo $footer; ?>
