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
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
    	<form method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-agentname"><?php echo $text_agent; ?></label>
				<div class="col-sm-10">
					<input type="text" name="agentname" value="<?php echo $agentname;?>" placeholder="<?php echo $entry_agent; ?>" id="input-agentname" class="form-control" />
					<?php if ($error_agentname) { ?>
					<div class="text-danger"><?php echo $error_agentname; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-lastname"><?php echo $text_image; ?></label>
				<div class="imagebox col-sm-2">
					<span id="thumb-image"><img src="<?php echo $thumb; ?>" alt="" title="" height="120" width="120"/></span>
				</div>
				<button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" 
				class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
				<input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
				<?php if ($error_image) { ?>
				<div class="text-danger"><?php echo $error_image; ?></div>
				<?php } ?>		
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-description"><?php echo $text_descriptions; ?></label>
				<div class="col-sm-10">
					<textarea name="description" placeholder="<?php echo $entry_descriptions;?>"
					id="input-description" class="form-control summernote"><?php echo $description?></textarea>
					<?php if ($error_description) { ?>
					<div class="text-danger"><?php echo $error_description; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-positions"><?php echo $text_positions; ?></label>
				<div class="col-sm-10">
					<input type="text" name="positions" value="<?php echo $positions;?>" 
					placeholder="<?php echo $entry_positions; ?>" id="input-positions" class="form-control" />
					<?php if ($error_positions) { ?>
					<div class="text-danger"><?php echo $error_positions; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-email"><?php echo $text_email; ?></label>
				<div class="col-sm-10">
					<input type="email" name="email" value="<?php echo $email;?>" 
					placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
					<?php if ($error_email) { ?>
					<div class="text-danger"><?php echo $error_email; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-address"><?php echo $text_address; ?></label>
				<div class="col-sm-10">
					<input type="text" name="address" value="<?php echo $address;?>" 
					placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" />
					<?php if ($error_address) { ?>
					<div class="text-danger"><?php echo $error_address; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-contact"><?php echo $text_contact; ?></label>
				<div class="col-sm-10">
					<input type="text" name="contact" value="<?php echo $contact;?>" 
					placeholder="<?php echo $entry_contact; ?>" id="input-contact" class="form-control" />
					<?php if ($error_contact) { ?>
					<div class="text-danger"><?php echo $error_contact; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-city"><?php echo $text_city; ?></label>
				<div class="col-sm-10">
					<input type="text" name="city" value="<?php echo $city;?>" 
					placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
					<?php if ($error_city) { ?>
					<div class="text-danger"><?php echo $error_city; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-pincode"><?php echo $text_postcode; ?></label>
				<div class="col-sm-10">
					<input type="text" name="pincode" value="<?php echo $pincode;?>" 
					placeholder="<?php echo $entry_postcode; ?>" id="input-pincode" class="form-control" />
					<?php if ($error_postcode) { ?>
					<div class="text-danger"><?php echo $error_postcode; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-country"><?php echo $text_country; ?></label>
				<div class="col-sm-10">
					<select name="country_id" id="input-country" class="form-control">
						<option value=""><?php echo $entry_select; ?></option>
						<?php foreach ($countries as $country) { ?>
						<?php if ($country['country_id'] == $country_id) { ?>
						<option value="<?php echo $country['country_id']; ?>" 
							selected="selected"><?php echo $country['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
					<?php if ($error_country) { ?>
					<div class="text-danger"><?php echo $error_country; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-zone"><?php echo $text_zone; ?></label>
				<div class="col-sm-10">
					<select name="zone_id" id="input-zone" class="form-control">
					</select>
					<?php if ($error_zone) { ?>
					<div class="text-danger"><?php echo $error_zone; ?></div>
					<?php } ?>
				</div>
			</div>
		   	<div class="form-group hide">
				<label class="col-sm-2 control-label" for="input-plans"><?php echo $text_plans; ?></label>
				<div class="col-sm-10">
					<select name="plans_id" id="input-plans" class="form-control">
						<option value=""><?php echo $entry_selectplans; ?></option>
						<?php foreach ($memberships as $membership) { ?>
						<?php if ($membership['plans_id'] == $plans_id) { ?>
						<option value="<?php echo $membership['plans_id']; ?>"selected="selected"><tr><td><?php echo $text_name; ?>:<?php echo $membership['name']?></td> .<td><?php echo $text_price; ?>: <?php echo $membership['price']?></td>.<td><?php echo $text_month; ?>: <?php echo $membership['number'].$membership['type']?></td></tr></option>
						<?php } else { ?>
						<option value="<?php echo $membership['plans_id']; ?>"><tr><td><?php echo $text_name; ?>:<?php echo $membership['name']?></td> .<td><?php echo $text_price; ?>: <?php echo $membership['price']?></td>.<td><?php echo $text_month; ?>: <?php echo $membership['number'].$membership['type']?></td></tr></option>
						<?php } ?>
						<?php } ?>
					</select>
			
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-password"><?php echo $text_password; ?></label>
				<div class="col-sm-10">
					<input type="password" name="password" value="" placeholder="<?php echo $entry_password; ?>" 
					id="input-password" class="form-control" />
					<?php if ($error_password) { ?>
					<div class="text-danger"><?php echo $error_password; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-confirm"><?php echo $text_confirm; ?></label>
				<div class="col-sm-10">
					<input type="password" name="confirm" value="" placeholder="<?php echo $entry_confirm; ?>" 
					id="input-confirm" class="form-control" />
					<?php if ($error_confirm) { ?>
					<div class="text-danger"><?php echo $error_confirm; ?></div>
					<?php } ?>
				</div>
			</div>
		    <h1><label class="control-label" for="input-confirm"><?php echo $text_social; ?></label></h1>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-facebook"><?php echo $text_facebook; ?></label>
				<div class="col-sm-10">
					<input type="text" name="facebook" value="" placeholder="<?php echo $entry_facebook; ?>" 
					id="input-facebook" class="form-control" />
				</div>
			</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label" for="input-twitter"><?php echo $text_twitter; ?></label>
				<div class="col-sm-10">
					<input type="text" name="twitter" value="" placeholder="<?php echo $entry_twitter; ?>" 
					id="input-twitter" class="form-control" />
				</div>
			</div>
		   	<div class="form-group">
				<label class="col-sm-2 control-label" for="input-instagram"><?php echo $text_instagram; ?></label>
				<div class="col-sm-10">
					<input type="text" name="instagram" value="" placeholder="<?php echo $entry_instagram; ?>" 
					id="input-instagram" class="form-control" />
				</div>
			</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label" for="input-pinterest"><?php echo $text_pinterest; ?></label>
				<div class="col-sm-10">
					<input type="text" name="pinterest" value="" placeholder="<?php echo $entry_pinterest; ?>" 
					id="input-pinterest" class="form-control" />
				</div>
			</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label" for="input-googleplus"><?php echo $text_googleplus; ?></label>
				<div class="col-sm-10">
					<input type="text" name="googleplus" value="" placeholder="<?php echo $entry_googleplus; ?>" 
					id="input-googleplus" class="form-control" />
				</div>
			</div>
			<div class="buttons">
				<div class="pull-right">
					<input type="submit"  value="<?php echo $button_submit; ?>" class="btn btn-primary" />
				</div>
			</div>
      </form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<script type="text/javascript" src="catalog/view/javascript/summernote/summernote.js"></script>
<link href="catalog/view/javascript/summernote/summernote.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript">
$("#input-description").summernote({
height: 300
});
</script>

<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=agent/agentedit/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $entry_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');

</script>

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
				url: 'index.php?route=agent/agentsignup/upload',
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
						var imageurl="<?php echo str_replace('http:','',HTTP_SERVER)?>";
						$("#thumb-image").html('<img src="'+imageurl+"image/"+json['location1']+'" alt="" title="" width="100"/>');
						$("#input-image").val(json['location1']);
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