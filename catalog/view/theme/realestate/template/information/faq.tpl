<?php echo $header; ?>
<div class="bread_crumb hide">
	<div class="container">
		<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
		</ul>
	</div>
</div>
<div class="container">
	<div class="wrap">
		<div class="inner-wrap">
			<div class="row"><?php echo $column_left; ?>
			<?php if ($column_left && $column_right) { ?>
			<?php $class = 'col-sm-6'; ?>
			<?php } elseif ($column_left || $column_right) { ?>
			<?php $class = 'col-sm-9'; ?>
			<?php } else { ?>
			<?php $class = 'col-sm-12'; ?>
			<?php } ?>
			<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
				<h1 class="entry-title"><?php echo $heading_title; ?></h1>
				<div class="entry-content"></div>
				<div class="col-sm-12 hide">
					<div class="col-sm-6 input-group pull-right">
						<input class="form-control" type="text" name="filtername" value=""/> <span class="input-group-btn"><button onclick="faqfilter();" class="btn btn-default"><i class="fa fa-search"></i></button></span>
					</div>
				</div>
				<?php foreach($results as $keys => $result){ ?>
				<h3 class="faq_title hide"><?php echo $result['name']; ?></h3>
				<div class="panel-group accordion">
				 <?php foreach($result['subfaqs'] as $key => $sub){ ?>
					<div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion" href="#collapse<?php echo $key ?>-<?php echo $result['fcategory_id'];  ?>">
							<?php if($keys==0 && $key==0){ ?>
							  <span class="glyphicon glyphicon-minus"></span>
							<?php }else{ ?>
							 <span class="glyphicon glyphicon-plus"></span>
							<?php } ?>
							  <?php echo $sub['name']; ?>
							</a>
						  </h4>
						</div>
						
						<div id="collapse<?php echo $key ?>-<?php echo $result['fcategory_id'];  ?>" class="panel-collapse collapse <?php if($keys==0 && $key==0){ echo 'in'; } ?> ">
						  <div class="panel-body">
							<?php echo $sub['description']; ?>
						  </div>
						</div>
					  </div>
				  <?php } ?>
				</div>
				<?php } ?>
			<?php echo $content_bottom; ?>
			</div>
			<?php echo $column_right; ?>
			</div>
		</div>
	</div>
</div>
<script>
function faqfilter(){
  var search = $('input[name="filtername"]').val();
  url = 'index.php?route=information/faq/search';
  url += '&fsearch='+encodeURI(search);
  location =url; 
}
</script>
<script type="text/javascript"><!--
$('input[name="filtername"]').keydown(function(e) {
	if (e.keyCode == 13) {
		faqfilter();
	}
});
//--></script> 
<script>
$('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});
</script>
<?php echo $footer; ?>