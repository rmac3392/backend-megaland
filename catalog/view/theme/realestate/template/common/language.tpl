<!--Languages code start here-->
<?php 
 if (count($languages) > 1) { ?>
<div>
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language">
		<div class="btn-group">
		<button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
		<span><?php foreach ($languages as $language) { ?>
		<?php if ($language['code'] == $code) { ?>
		<span><i class="fa fa-globe" aria-hidden="true"></i>  <?php echo $text_language; ?>:</span> <img src="catalog/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>"> <?php echo $language['name']; ?> <i class="fa fa-angle-down"></i> </button>
		<?php } ?>
		<?php } ?></span>
		
		<ul class="dropdown-menu">
		  <?php foreach ($languages as $language) { ?>
			<li>
				<button class="btn btn-link btn-block language-select" type="button" name="<?php echo $language['code']; ?>"><img src="catalog/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?>
				</button>
			</li>
		  <?php } ?>
		</ul>
	  </div>
	  <input type="hidden" name="code" value="" />
	  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
	</form>
</div>
<?php } ?>
<!--Languages code end here-->
