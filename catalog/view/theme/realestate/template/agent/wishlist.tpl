<?php echo $header; ?>
<!-- breadcrumb start here -->
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
<!-- breadcrumb end here -->
<div class="container">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row  add-property"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <?php if ($propertys) { ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td class="text-left"><?php echo $column_image; ?></td>
            <td class="text-left"><?php echo $column_name; ?></td>
            <td class="text-left"><?php echo $column_propertyname; ?></td>
            <td class="text-left"><?php echo $column_price; ?></td>
            <td class="text-left"><?php echo $column_view; ?></td>
            <td class="text-left"><?php echo $column_remove; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($propertys as $property) { ?>
          <tr>
            <td class="text-left">
				<?php if ($property['image']) { ?>
             	 	<img src="<?php echo $property['image']; ?>" alt="<?php echo $property['name']; ?>" title="<?php echo $property['name']; ?>" />
              	<?php } ?></td>
				<td class="text-left"><?php echo $property['agent']; ?></td>
				<td class="text-left"><?php echo $property['name']; ?></td>
				<td class="text-left"><?php echo $property['price']; ?></td>
				<td class="text-left"><a href="<?php echo $property['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>      
				<td class="text-left"><a href="<?php echo $property['remove']; ?>" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a></td>      
		</tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
