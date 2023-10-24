<link rel="stylesheet" href="catalog/view/theme/realestate/stylesheet/realfilter/normalize.min.css" />
<link rel="stylesheet" href="catalog/view/theme/realestate/stylesheet/realfilter/ion.rangeSlider.css" />
<link rel="stylesheet" href="catalog/view/theme/realestate/stylesheet/realfilter/ion.rangeSlider.skinFlat.css" />
<script type="text/javascript" src="catalog/view/theme/realestate/realfilter/ion.rangeSlider.min.js"></script>
<div class="container">
	<div class="row srch5 post2">
		<div class="col-md-12 col-sm-12 slider_search1">
			<h4><?php echo $findproperty_findproperty?></h4>
				<form class="form-horizontal" enctype="multipart/form-data" method="post">
					<div class="col-sm-6">
						<div class="form-group">
							<div class="col-sm-6 col-xs-12">
								<select class="form-control" name="filter_propertystatus" >
									<option value=""><?php echo $findproperty_propertyselect?></option>
									<?php foreach($propertystatus as $propertystatu){ ?>
								<option value="<?php echo $propertystatu['property_status_id']; ?>"><?php echo $propertystatu['name']; ?></option> 
							<?php } ?>
								</select>
							</div>
							<div class="col-sm-6 col-xs-12">
								
								<select class=" form-control" name="filter_propertycategory" >
								<option value=""><?php echo $findproperty_propertycatagory?></option>
								<?php foreach($categorys as $category){ ?>
								<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option> 
								<?php } ?>
							</select>
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-xs-12">
								<select name="filter_country_id" id="input-country" class="form-control">
									<option value=""><?php echo $findproperty_select; ?></option>
									<?php foreach ($countrys as $country) { ?>
										<?php if ($country['country_id'] == $filter_country_id) { ?>
											<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
											<?php } else { ?>
											<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
										<?php } ?>
									<?php } ?>
								</select>
								
							</div>
							<div class="col-sm-6 col-xs-12">	
								<select name="filter_zone_id" id="input-zone" class="form-control">
									<option value=""><?php echo $findproperty_select; ?></option>
								</select>
							 
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-xs-12">					
							<input type="text" class="form-control" name="filter_city" placeholder="<?php echo $entry_city;?>">

							</div>
							<div class="col-sm-6 col-xs-12">
								 <input type="text" class="form-control" name="filter_zipcode" placeholder="<?php echo $entry_Zipcode;?>">

							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							<div class="col-sm-6 col-xs-12">
								<label for="input-range_1"><?php echo $findproperty_price;?></label>
								<div class="attribute price-filter">
									<input type="text" class="range_1" id="range_1" name="filter_range"/>	
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">	
								<label for="input-area"><?php echo $findproperty_area?></label>
								<div class="attribute price-filter">
									<input type="text" class="area" id="input-area" name="filter_area" />
								</div>
							</div>
							<button  class="btn button_search" type="button" id="button-filter"><i class="fa fa-search"></i> <?php echo $button_search;?></button>
						</div>
					</div>
				<br/>
				
					</div>
				
			</form>
		</div>
	</div>
</div>
<script type="text/javascript"><!--

        $(".range_1").ionRangeSlider({
            min: 0,
            max: <?php echo $max_price;?>,
            from: <?php echo $range_from;?>,
            to: <?php echo $range_to;?>,
            type: 'double',
            step: 1,
            prefix: "<?php echo $cur_code; ?>",
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

<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
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
		
		
		var filter_features = $('input[name=\'filter_features\']').val();
		if (filter_features) {
			url += '&filter_features=' + encodeURIComponent(filter_features);
		}
		
		var filter_nearest = $('input[name=\'filter_nearest\']').val();
		if (filter_nearest) {
			url += '&filter_nearest=' + encodeURIComponent(filter_nearest);
		}
		
		var filter_range =$('input[name=\'filter_range\']').val();
		
		if (filter_range) {
		url += '&filter_range=' + encodeURIComponent(filter_range);
		}

		var filter_area =$('input[name=\'filter_area\']').val();
		
		if (filter_area) {
		url += '&filter_area=' + encodeURIComponent(filter_area);
		}
		
		location = url;

});

</script>

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

			html = '<option value=""><?php echo $findproperty_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $findproperty_none; ?></option>';
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
	$('.latest_product .list-group.listing').css({"height":'1330px'});
	$('.property-category .list-group.listing').css({"height":'1330px'});
	$('.listing .list-group.listing').css({"height":'1330px'});
	$('.indexmap iframe ').css({"height":'737px'});
	}).on('hidden.bs.collapse', function(){
	$(this).parent().find(".fa-minus-circle").removeClass("fa-minus-circle").addClass("fa-plus-circle");
	$('.latest_product .list-group.listing').css({"height":'940px'});
	$('.listing .list-group.listing').css({"height":'580px'});
	$('.indexmap iframe ').css({"height":'425px'});
	$(this).parent().removeClass("active").addClass("");
	});
//--></script>

<!--checkbox js -->
<script type="text/javascript" src="catalog/view/javascript/jquery/dist/js/bootstrap-select.js"></script>
<link href="catalog/view/javascript/jquery/dist/css/bootstrap-select.css" rel="stylesheet"/>
