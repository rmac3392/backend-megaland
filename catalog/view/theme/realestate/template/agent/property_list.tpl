<?php echo $header; ?>
<div class="breadmain">
	<div class="container">
		<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
		</ul>
		<h3><?php echo $heading_list; ?></h3>
	</div>
</div>
<div class="container">
	<?php if ($success) { ?>
	<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
	<?php } ?>
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
		<div class="row">
			<div class="pull-right">
				<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
				<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $message_confirm; ?>') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></button>
			</div>
			
		</div>
		<br/>
		<div class="box">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label" for="input-name"><?php echo $column_name; ?></label>
						<input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $column_name; ?>" id="input-name" class="form-control" />
					</div>
				</div> 
				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label" for="input-sort_order">
						<?php echo $text_pricefrom; ?></label>
						<input type="text" name="filter_price_from" value="<?php echo $filter_price_from; ?>" placeholder="<?php echo $filter_price_range; ?>" id="input-sort_order" class="form-control" />
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label" for="input-sort_order">
						<?php echo $text_pricerange; ?></label>
						<input type="text" name="filter_price_to" value="<?php echo $filter_price_to; ?>" placeholder="price range" id="input-sort_order" class="form-control" />
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label" for="input-status"><?php echo $column_status; ?></label>
						<select name="filter_status" id="input-filter_payment_mode" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enable; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enable; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disable; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disable; ?></option>
                  <?php } ?>
                </select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label" for="input-name"><?php echo $column_property_status; ?></label>
						<input type="text" name="filter_propertystatus" value="<?php echo $statusname; ?>" placeholder="<?php echo $column_property_status; ?>" id="input-name" class="form-control" />
						<input type="hidden" value="" name="property_status_id">
					</div>
				</div>
				<div class="col-sm-4">
					<label class="control-label"></label>
					<button type="button" id="button-filter" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
				</div>
			</div>
				
		</div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-information">
		<div class="table-responsive">
            <table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<td width="1" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="text-left"><?php echo $column_image;?></td>
					<td class="text-left"><?php if ($sort == 'name') { ?>
					<a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
					<?php } else { ?>
					<a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
					<?php } ?></td>
					<td class="text-left"><?php if ($sort == 'property_status_id') { ?>
					<a href="<?php echo $sort_propertystatus; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_property_status; ?></a>
					<?php } else { ?>
					<a href="<?php echo $sort_propertystatus; ?>"><?php echo $column_property_status; ?></a>
					<?php } ?></td>
					<td class="text-left"><?php if ($sort == 'price') { ?>
					<a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
					<?php } else { ?>
					<a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
					<?php } ?></td>
					<td class="text-left"><?php if ($sort == 'status') { ?>
					<a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
					<?php } else { ?>
					<a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
					<?php } ?></td>
					<td class="text-right"><?php echo $column_action; ?></td>
				   </tr>
				</thead>
				<tbody>
					<?php if (isset($property)) { ?>
						<?php foreach ($property as $result) { ?>
					<tr>
						<td style="width: 1px;" class="text-center"><input type="checkbox"  name="selected[]" value="<?php echo $result['property_id']; ?>" /></td>
						<td class="text-center"><?php if ($result['image']) { ?>
							<img src="<?php echo $result['image']; ?>" alt="<?php echo $result['image']; ?>" class="img-thumbnail" />
							<?php } else { ?>
								<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
							<?php } ?>
						</td>
						<td class="text-left"><?php echo $result['name']; ?></td>
						<td class="text-left"><?php echo $result['property_status']; ?></td>
						<td class="text-left"><?php echo $result['price']; ?></td>
						<td class="text-left"><?php echo $result['status']; ?></td>
						<td class="text-right">
						<a href="<?php echo $result['hreffull']; ?>" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
						
						<a href="<?php echo $result['edit']; ?>" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
					</tr>
					<?php } ?> 
					<?php } else { ?>
					<tr>
						<td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		</form>
		<div class="row">
		 <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">
<!--
$('#button-filter').on('click', function() {
		var url = 'index.php?route=agent/property/view';
		var filter_name = $('input[name=\'filter_name\']').val();
		if (filter_name) {
			url += '&filter_name=' + encodeURIComponent(filter_name);
		}
		var filter_sort_order = $('input[name=\'filter_sort_order\']').val();
		if (filter_sort_order) {
			url += '&filter_sort_order=' + encodeURIComponent(filter_sort_order);
		}
		var filter_price_from = $('input[name=\'filter_price_from\']').val();

		if (filter_price_from != '') {
			url += '&filter_price_from=' + encodeURIComponent(filter_price_from);
		}
		var filter_price_to = $('input[name=\'filter_price_to\']').val();

		if (filter_price_to != '') {
			url += '&filter_price_to=' + encodeURIComponent(filter_price_to);
		}
		var filter_propertystatus = $('input[name=\'property_status_id\']').val();
		if (filter_propertystatus) {
			url += '&filter_propertystatus=' + encodeURIComponent(filter_propertystatus);
		}
	
 var filter_status = $('select[name=\'filter_status\']').val();
  if (filter_status != '*') {
    url += '&filter_status=' + encodeURIComponent(filter_status); 
  } 
		location = url;

});

</script>
	<script>
		$('input[name=\'filter_propertystatus\']').autocomplete({
			'source': function(request, response) {
				$.ajax({
					url: 'index.php?route=agent/property/autocomplete=&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success: function(json) {
					json.unshift({
					property_status_id: 0,
					name: '<?php echo $text_none; ?>'
					});

					response($.map(json, function(item) {
					return {
					label: item['name'],
					value: item['property_status_id']
					}
					}));
					}
				});
			},
			'select': function(item) {
			$('input[name=\'filter_propertystatus\']').val(item['label']);
			$('input[name=\'property_status_id\']').val(item['value']);
			}
		});
	</script>

<?php echo $footer; ?>
