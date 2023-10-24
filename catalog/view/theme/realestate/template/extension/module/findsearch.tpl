<link rel="stylesheet" href="catalog/view/theme/realestate/stylesheet/realfilter/normalize.min.css" />
<link rel="stylesheet" href="catalog/view/theme/realestate/stylesheet/realfilter/ion.rangeSlider.css" />
<link rel="stylesheet" href="catalog/view/theme/realestate/stylesheet/realfilter/ion.rangeSlider.skinFlat.css" />
<script type="text/javascript" src="catalog/view/theme/realestate/realfilter/ion.rangeSlider.min.js"></script>

<!--Advanced search starts here-->
<form method="POST" id="fronm">
	<div class="latest_product_heading post4">
		<h3><?php echo $heading_findproperty; ?> <i class="fa fa-search"></i></h3>
		<span class="triangle"></span><span class="single"></span>
	</div>
	<div class="list-group listing">
		<select type="text" class="form-control selectpicker" name="filter_propertystatus">
				<option value=""></option>
				<?php foreach ($propertyinfo as $searchfind) { ?>
						<?php if ($searchfind['property_status_id'] == $filter_propertystatus) { ?>
						<option value="<?php echo $searchfind['property_status_id']; ?>" selected="selected"><?php echo $searchfind['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $searchfind['property_status_id']; ?>"><?php echo $searchfind['name']; ?></option>
						<?php } ?>
					<?php } ?>
			
		</select>
		
		<select type="text" class="form-control selectpicker" name="filter_propertycategory">
			<option value=""><?php echo $text_select; ?></option>
			<?php foreach ($categorys as $category) { ?>
						<?php if ($category['category_id'] == $filter_propertycategory) { ?>
						<option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
						<?php } ?>
					<?php } ?>
			
		</select>
		<input type="text" class="form-control" placeholder="<?php echo $entry_city; ?>" value="<?php echo $filter_city;?>"  name="filter_city">
		<input type="text" class="form-control" placeholder="<?php echo $entry_address; ?>"  value="<?php echo $filter_address;?>" name="filter_address">
		<input type="text" class="form-control" placeholder="<?php echo $entry_Neighborhood; ?>" name="filter_neighborhood" value="<?php echo $filter_neighborhood;?>">
		<input type="text" class="form-control" placeholder="<?php echo $entry_Zipcode; ?>" value="<?php echo $filter_zipcode;?>"  name="filter_zipcode">
		
			
				<select type="text" class="form-control" id="input-country" name="filter_country_id">
					<option value=""><?php echo $text_select; ?></option>
					<?php foreach ($countrys as $country) { ?>
						<?php if ($country['country_id'] == $filter_country_id) { ?>
						<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
						<?php } ?>
					<?php } ?>
				</select>
		
				<select name="filter_zone_id" id="input-zone" class="form-control">
				<option value=""><?php echo $text_select; ?></option>
				</select>

		<div class="row form-group">
			<div class="col-sm-12 col-xs-12">
				<label><?php echo $findproperty_Price;?></label>
				<div class="attribute price-filter">
				<input type="hidden" name="route" value="property/category" />
					<input type="text" class="range_1" name="filter_range" />
				</div>
			</div>
			
			<div class="col-sm-12 col-xs-12">	
				<label><?php echo $findproperty_area;?></label>
				<div class="attribute price-filter">
					<input type="hidden" name="route" value="property/category" />
						<input type="text" class="area" name="filter_area" />
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<label><?php echo $findproperty_bedrooms;?></label>
				
				
				<select class="form-control" name="filter_bed_rooms">
					<option value=""><?php echo $findproperty_bed?></option>
					<?php	for ($k =1; $k <=10 ; $k++) { 
						$selected = "";
						if($k == $filter_bed_rooms) {
							$selected = " selected = 'selected'";
						}
					?>
				<option value="<?php echo $k; ?>" <?php echo $selected;?>><?php echo $k; ?></option> 
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-6 col-xs-12">
				<label><?php echo $findproperty_bathrooms;?></label>
				<select class="form-control" name="filter_bath_rooms">
					<option value=""><?php echo $findproperty_bath?></option>
					<?php	for ($i =1; $i <=10 ; $i++) { 
						$selected = "";
						if($i == $filter_bath_rooms) {
							$selected = " selected = 'selected'";
						}
					?>
				<option value="<?php echo $i; ?>" <?php echo $selected;?>><?php echo $i; ?></option> 
					<?php } ?>
				</select>
			</div>
		</div> 
			
		<button type="button" class="btn btn-primary btn-block" id="findsearchbtn"><i class="fa fa-search"></i><?php echo $button_search;?></button>	
	</div>
</form> 
<!--checkbox js -->
<script type="text/javascript"><!--

	$(".range_1").ionRangeSlider({
		min: 0,
		max: <?php echo $max_price;?>,
		from: '<?php echo $range_from;?>',
		to: '<?php echo $range_to;?>',
		type: 'double',
		step: 1,
		prefix: '<?php echo $cur_code; ?>',
		prettify: true,
		hasGrid: true
	});
	
	$(".area").ionRangeSlider({
		min: 0,
		max: <?php echo $max_area;?>,
		from: '<?php echo $area_from;?>',
		to: '<?php echo $area_to;?>',
		type: 'double',
		step: 1,
		prefix: '',
		prettify: true,
		hasGrid: true
	});
</script>


<script type="text/javascript" src="catalog/view/javascript/jquery/dist/js/bootstrap-select.js"></script>
<link href="catalog/view/javascript/jquery/dist/css/bootstrap-select.css" rel="stylesheet"/>

<script type="text/javascript"><!--
$('select[name=\'filter_country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=agent/property/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'filter_country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
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

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value=""><?php echo $text_select; ?></option>';
			}

			$('select[name=\'filter_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'filter_country_id\']').trigger('change');


$('.collapse').on('shown.bs.collapse', function(){
	$(this).parent().removeClass("active").addClass("active");
	$(this).parent().find(".fa-plus-circle").removeClass("fa-plus-circle").addClass("fa-minus-circle");
	$('.latest_product .list-group.listing').css({"height":'1170px'});
	$('.property-category .list-group.listing').css({"height":'1170px'});
	$('.listing .list-group.listing').css({"height":'1170px'});
	$('.indexmap iframe ').css({"height":'737px'});
	}).on('hidden.bs.collapse', function(){
	$(this).parent().find(".fa-minus-circle").removeClass("fa-minus-circle").addClass("fa-plus-circle");
	$('.latest_product .list-group.listing').css({"height":'940px'});
	$('.listing .list-group.listing').css({"height":'580px'});
	$('.indexmap iframe ').css({"height":'425px'});
	$(this).parent().removeClass("active").addClass("");
	});
//--></script>
<!--Advanced search end here-->

<script type="text/javascript"><!--
$('#findsearchbtn').on('click', function() {
		var url = 'index.php?route=property/category';
		
		var filter_propertystatus = $('select[name=\'filter_propertystatus\']').val();
		if (filter_propertystatus) {
			url += '&filter_propertystatus=' + encodeURIComponent(filter_propertystatus);
		}
	
		var filter_propertycategory = $('select[name=\'filter_propertycategory\']').val();
		if (filter_propertycategory) {
			url += '&filter_propertycategory=' + encodeURIComponent(filter_propertycategory);
		}

		var filter_city = $('input[name=\'filter_city\']').val();
		if (filter_city) {
			url += '&filter_city=' + encodeURIComponent(filter_city);
		}
		var filter_Address = $('input[name=\'filter_Address\']').val();
		if (filter_Address) {
			url += '&filter_Address=' + encodeURIComponent(filter_Address);
		}
		
		var filter_neighborhood = $('input[name=\'filter_neighborhood\']').val();
		if (filter_neighborhood) {
			url += '&filter_neighborhood=' + encodeURIComponent(filter_neighborhood);
		}
		
		var filter_zipcode = $('input[name=\'filter_zipcode\']').val();
		if (filter_zipcode) {
			url += '&filter_zipcode=' + encodeURIComponent(filter_zipcode);
		}
	
		var filter_country_id = $('select[name=\'filter_country_id\']').val();
		if (filter_country_id) {
			url += '&filter_country_id=' + encodeURIComponent(filter_country_id);
		}
		
		var filter_zone_id = $('select[name=\'filter_zone_id\']').val();
		if (filter_zone_id) {
			url += '&filter_zone_id=' + encodeURIComponent(filter_zone_id);
		}
		
		var filter_bed_rooms = $('select[name=\'filter_bed_rooms\']').val();
		
		if (filter_bed_rooms != '*') {
			url += '&filter_bed_rooms=' + encodeURIComponent(filter_bed_rooms);
		}
	
		var filter_range =$('input[name=\'filter_range\']').val();
		
		if (filter_range) {
		url += '&filter_range=' + encodeURIComponent(filter_range);
		}

		var filter_area =$('input[name=\'filter_area\']').val();
		
		if (filter_area) {
		url += '&filter_area=' + encodeURIComponent(filter_area);
		}
		var filter_bath_rooms = $('select[name=\'filter_bath_rooms\']').val();
		if (filter_bath_rooms) {
			url += '&filter_bath_rooms=' + encodeURIComponent(filter_bath_rooms);
		}
		var filter_features = $('input[name=\'filter_features\']').val();
		if (filter_features) {
			url += '&filter_features=' + encodeURIComponent(filter_features);
		}
		
		var filter_nearest = $('input[name=\'filter_nearest\']').val();
		if (filter_nearest) {
			url += '&filter_nearest=' + encodeURIComponent(filter_nearest);
		}

		location = url;

});

</script>



