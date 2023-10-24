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
							<td><?php echo $text_membership;?></td>
							<td><?php if(isset($agentname)){ echo $agentname; }?></td>
						</tr>
						<tr>
							<td><?php echo $text_current;?></td>
							<td><?php echo $text_name; ?> : <?php if(isset($name)){ echo $name; }?></td><td> <?php echo $text_price; ?> : <?php if(isset($price)){ echo $price; }?></td><td> <?php echo $text_type; ?> : <?php if(isset($type)){ echo $type; }?> / <?php if(isset($number)){ echo $number; }?> </td>
						</tr>
						<tr>
							<td><?php echo $text_update;?></td>
							<td><?php if(isset($date_added)){ echo $date_added; }?></td>
						</tr>
																					
				 </tbody>
            </table>
        </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
