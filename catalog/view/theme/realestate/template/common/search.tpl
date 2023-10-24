<!--search code start here-->
<div class="col-sm-offset-7 col-md-4 col-sm-6 main-form">
	<div class="slider_search ">
		<h4><?php echo $text_findproperty; ?></h4>
		<form method="post" id="fronm" class="">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<select class="form-control" name="category_id">
					<?php foreach($propertylist as $property){?>
						<option value="<?php echo $property['category_id']?>"><?php echo $property['name']?></option>
							 <?php }?>
					</select>
				</div>	
				<div class="form-group">
					<input type="text" class="form-control" name="location" placeholder="<?php echo $text_location; ?>" required="">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="city" placeholder="<?php echo $text_city; ?>" required="">
							</div>	
				</div>
				<div class="col-sm-6 col-xs-12 width95">
					<div class="form-group">
						<input type="text" class="form-control" name="min_price" placeholder="<?php echo $text_minprice; ?>" required="">
					</div>
				</div>
				<div class="col-sm-6 col-xs-12 width95">
					<div class="form-group">
						<input type="text" class="form-control pull-right" name="max_price" placeholder="<?php echo $text_maxprice; ?>" required="">
					</div>
				</div>
				<button  class="btn button_search " type="button" id="findsearch" ><i class="fa fa-search"></i> <?php echo $button_search; ?></button>
		</form>
	</div>
</div>

<!--2nd design start-->
<div class="col-md-offset-5 col-md-6 col-sm-6 main-form hide">
	<div class="slidersrch3">
		<div class="slider_search">
			<h4><?php echo $text_findproperty; ?></h4>
			<form method="post" id="fronm" >
				<div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<select class="form-control" name="category_id">
							<?php foreach($propertylist as $property){?>
								<option value="<?php echo $property['category_id']?>"><?php echo $property['name']?></option>
							<?php }?>
						</select>
					</div>
					<div class="col-sm-6 col-xs-12">
						<select class="form-control" name="country">
							<option value="">country</option>
						</select>
					</div>
				</div>	
				<div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<select class="form-control" name="state">
							<option value="">state</option>
						</select>
					</div>
					<div class="col-sm-6 col-xs-12">
						<select class="form-control" name="city">
							<option value="">city</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<select class="form-control" name="zipcode">
							<option value="">zipcode</option>
						</select>
					</div>
					<div class="col-sm-6 col-xs-12">
						<select class="form-control" name="status">
							<option value="">status</option>
						</select>
					</div>
				</div>	
				<div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<label>Price</label>
						<div class="attribute price-filter">
							<span class="min">$15,000</span>
							<a href="#" class="one slider-handle"></a>
							<div class="price-range"><div class="bg"></div></div>
							<span class="max">$25,000</span>
							<a href="#" class="two slider-handle"></a>	
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">	
						<label>Area(<span class="sub">Sq Ft</span>)</label>
						<div class="attribute price-filter">
							<span class="min">1,000 Sq Ft</span>
							<a href="#" class="one slider-handle"></a>
							<div class="price-range"><div class="bg"></div></div>
							<span class="max">15,000 Sq Ft</span>
							<a href="#" class="two slider-handle"></a>
						</div>
					</div>
				</div>		
				<button  class="btn button_search " type="button" id="findsearch" ><i class="fa fa-search"></i> <?php echo $button_search; ?></button>
			</form>
		</div>
	</div>
</div>
<!--2nd design start end-->
 <script>
$('#findsearch').click(function(){
	$.ajax({
		url: 'index.php?route=common/search/searchauto',
		type: 'post',
		data: $('select[name=\'\category_id\'],input[name=\'city\'],input[name=\'location\'],input[name=\'min_price\'],input[name=\'max_price\']'),
		dataType: 'json',
		success: function(json) {
			
			if (json['success']) {
				$("#fronm")[0].reset();
			}
		}
	});
	
	
});
</script>
<!--search code start here-->
