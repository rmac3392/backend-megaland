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
<h1><?php echo $heading_title; ?></h1>
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
			<fieldset>
				<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-name"><?php echo $text_name; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" />
				  <?php if ($error_name) { ?>
				  <div class="text-danger"><?php echo $error_name; ?></div>
				  <?php } ?>
				</div>
				</div>
				<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-country"><?php echo $text_country; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="country" value="<?php echo $country; ?>" id="input-country" class="form-control" />
				  <?php if ($error_country) { ?>
				  <div class="text-danger"><?php echo $error_country; ?></div>
				  <?php } ?>
				</div>
				</div>
				<div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_image; ?></label>
                <div class="col-sm-10">
					<button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
					<input type="hidden" name="image" value="" id="input-image" />
                </div>
              </div>
				<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-message"><?php echo $text_message2; ?></label>
				<div class="col-sm-10">
				  <textarea name="enquiry" rows="10" id="input-message" class="form-control"><?php echo $enquiry; ?></textarea>
				  <?php if ($error_enquiry) { ?>
				  <div class="text-danger"><?php echo $error_enquiry; ?></div>
				  <?php } ?>
				</div>
				</div>
				<?php echo $captcha; ?>
			</fieldset>
			<div class="buttons">
			  <div class="pull-right">
				<input class="btn btn-primary" type="submit" value="<?php echo $button_send; ?>" />
			  </div>
			</div>
		    </form>
			
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
