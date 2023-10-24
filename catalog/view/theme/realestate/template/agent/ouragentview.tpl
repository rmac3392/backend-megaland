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
      <div class="table-responsive">
            <table class="table table-bordered table-hover table-user-information">
                <tbody> 
						<tr>
							<td><?php echo $text_agentname;?></td>
							<td><?php echo $agentname;?></td>
						</tr>
						<tr>
							<td><?php echo $text_email;?></td>
							<td><?php echo $email;?></td>
						</tr>
						<tr>
							<td><?php echo $text_positions;?></td>
							<td><?php echo $positions;?></td>
						</tr>
						<tr>
							<td><?php echo $text_contact;?></td>
							<td><?php echo $contact;?></td>
						</tr>
						<tr>
							<td><?php echo $text_address;?></td>
							<td><?php echo $address;?></td>
						</tr>
						<tr>
							<td><?php echo $text_country;?></td>
							<td><?php echo $country;?></td>
						</tr>
						<tr>
							<td><?php echo $text_zone;?></td>
							<td><?php echo $zone;?></td>
						</tr>
						<tr>
							<td><?php echo $text_city;?></td>
							<td><?php echo $city;?></td>
						</tr>
						<tr>
							<td><?php echo $text_postcode;?></td>
							<td><?php echo $pincode;?></td>
						</tr>
						<tr>
							<td><?php echo $text_descriptions;?></td>
							<td><?php echo $description;?></td>
						</tr>
					
					<!---<tr>
							<td><?php echo $text_plans;?></td>
							<td><?php echo $plans;?></td>
						</tr>---->
						<tr>
							<td><?php echo $text_image;?></td>
							<td><img src="<?php echo $agentimage; ?>"></td>
						</tr>
				 </tbody>
            </table>
        </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
