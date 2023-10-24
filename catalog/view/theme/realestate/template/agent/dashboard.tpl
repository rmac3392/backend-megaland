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
    <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="tile">
				<div class="tile-body">
					<i class="fa fa-building"></i>
					<h2 class="pull-right"><?php if(isset($agentproperty)){ echo $agentproperty;} ?> <br><span class="heading-text">

						<?php echo $dashboard_properties;?></span></h2>
				</div>
			</div>
		</div>	
		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="tile">
				<div class="tile-body">
					<i class="fa fa-envelope"></i>
					<h2 class="pull-right"><?php if(isset($enquerytotal)){ echo $enquerytotal;} ?><br><span class="heading-text"><?php echo $dashboard_enquiries;?></span></h2>
				</div>
			</div>
		</div>
		
		<div class="col-sm-12">
		<div class="recent">
			<div class="panel panel-default">
			  <div class="panel-heading hide">
				<h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $text_listing; ?></h3>
			  </div>
			  <div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
						  <td class="text-left"><?php echo $column_name?></td>
						  <td class="text-left"><?php echo $column_email?></td>
						  <td class="text-left"><?php echo $column_descriptions?></td>
						</tr>
					</thead>
				 	<tbody>
						 <?php if(isset($enquery)){?>
							<?php foreach ($enquery as $enquerys){ ?>
						<tr>
							<td class="text-left"><?php echo  $enquerys['name'] ?></td>
							<td class="text-left"><?php echo $enquerys['email'] ?></td>
							<td class="text-left"><?php  echo $enquerys['description'] ?></td>
												
						</tr>
							<?php } ?>
							<?php } ?>
					</tbody>
				</table>
			  </div>
			</div>
		</div>
		<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
			<div class="col-sm-6 text-right"><?php echo $results; ?></div>
		</div>
	</div>
	</div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<?php echo $footer; ?>
