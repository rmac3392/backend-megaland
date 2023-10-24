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
		  <h1 class="faq"><?php echo $heading_title; ?></h1>
		  <div class="col-sm-12">
			<div class="col-sm-6 input-group pull-right">
			  <input class="form-control" type="text" name="filtername" value="<?php echo $search; ?>"/> <span class="input-group-btn"><button onclick="faqfilter();" class="btn btn-default"><i class="fa fa-search"></i></button></span>
			</div>
		  </div>
		  <div class="col-sm-12">
		  <h3 class="faq_title"><?php echo $text_search; ?> <?php echo $search; ?></h3>
		  <?php foreach($results as $key => $result){ ?>
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key ?>-<?php echo $result['faq_id'];  ?>">
							<?php if($key==0){ ?>
							  <span class="glyphicon glyphicon-minus"></span>
							<?php }else{ ?>
							 <span class="glyphicon glyphicon-plus"></span>
							<?php } ?>
							  <?php echo $result['name']; ?>
							</a>
						  </h4>
						</div>
						<div id="collapse<?php echo $key ?>-<?php echo $result['faq_id'];  ?>" class="panel-collapse collapse <?php if($key==0){ echo 'in'; } ?> ">
						  <div class="panel-body">
							<?php echo $result['description']; ?>
						  </div>
						</div>
					  </div>
				</div>
			<?php } ?>
		   </div>	
		<?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div></div></div>
</div>
<script type="text/javascript"><!--
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
<script type="text/javascript"><!--
$('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});
</script>
<?php echo $footer; ?>
