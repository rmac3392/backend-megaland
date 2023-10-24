<?php if ($modules) { ?>
<column id="blog-right" class="col-md-3 col-sm-4 paddleft hidden-xs">
<div class="backcolor">
  <?php foreach ($modules as $module) { ?>
  <?php echo $module; ?>
  <?php } ?>
  </div>
</column>
<?php } ?>
