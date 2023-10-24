<!--header code start here-->
<?php echo $header; ?>
<!--header code end here-->
<?php echo $column_slider; ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<?php echo $content_top; ?>
		</div>
	</div>
</div>
	<div class="latest_product">
		<div class="container">
			<div class="row"><?php echo $column_left; ?>
				<?php if ($column_left && $column_right) { ?>
				<?php $class = 'col-sm-6'; ?>
				<?php } elseif ($column_left || $column_right) { ?>
				<?php $class = 'col-sm-8'; ?>
				<?php } else { ?>
				<?php $class = 'col-sm-12'; ?>
				<?php } ?>
				<div id="content" class="<?php echo $class; ?>">
				<?php echo $content_propty; ?>
				</div>
				<?php echo $column_right; ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $content_bottom; ?>
			</div>
		</div>
	</div>
<!--footer code start here-->
<?php echo $footer; ?>
<!--footer code end here-->
