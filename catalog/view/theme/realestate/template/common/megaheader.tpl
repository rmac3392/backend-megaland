<?php if(!empty($megaheaders)) {?>
<div id="mega_menu">
	<nav id="menu">
		<div class="container-megamenu horizontal padd0">
			<div class="megaMenuToggle visible-xs">
				<span id="category"><?php echo $text_category; ?></span>
				<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
			</div>
			<div class="megamenu-wrapper" style="display:none">
				<?php if($menuexpend==1){ ?>
					<div class="container">
				<?php } ?>
	<ul class="megamenu slide">
		<?php foreach($megaheaders as $megaheader) {
		if ($megaheader['sublink'] || !empty($megaheader['editor'])) { ?>
			<li class="with-sub-menu hover">
				<p class="close-menu"></p>
				<p class="open-menu"></p>
				<?php if($megaheader['showicon']==1){?>
					<a href="<?php echo $megaheader['href']; ?>"> <i class="<?php echo $megaheader['icon']?> fonticon" aria-hidden="true"></i></a>
				<?php } else {?>
					<a class="menutitle clearfix" href="<?php echo $megaheader['href']; ?>" <?php if($megaheader['openew']) {?>target="_blank" <?php }?>><i class="<?php echo $megaheader['icon']?> fonticon" aria-hidden="true"></i> <?php echo $megaheader['title']; ?></a>
				<?php } ?>
				<div class="sub-menu">
				<?php if($megaheader['bgimagetype']=='uploadimage'){?>
					<div class="content bgcontent" <?php if(!empty($megaheader['background'])) {?>style="background:url('<?php echo $megaheader['background']?>') <?php echo $dropdownbg;?>; background-repeat:no-repeat;background-position:right top;" <?php } else{ ?>
						style="background:<?php echo $dropdownbg;?>"
							<?php } ?>> 
					<?php } elseif($megaheader['bgimagetype']=='selectpattern') { ?>
						<div class="content" <?php if(!empty($megaheader['ptrnbackground'])) {?>style="background:url('<?php echo $megaheader['ptrnbackground']?>') <?php echo $dropdownbg;?>;"<?php } else{ ?>
							style="background:<?php echo $dropdownbg;?>"
									<?php } ?> >
					<?php } else { ?>
						<div class="content"  style="background:<?php echo $dropdownbg;?>" >  
					<?php } ?>
						
    <div>
	<div class="row">
		<div class="col-sm-12  mobile-enabled">
			<div class="row">
				<div class="col-sm-12 hover-menu">
					<div class="menu">
						<?php if(!empty($megaheader['sublink'])) { ?>
						<?php foreach (array_chunk($megaheader['sublink'], ceil(count($megaheader['sublink']) / $megaheader['col'])) as $children) { ?>
						<ul class="list-unstyled main_li">
							<?php foreach ($children as $child) {	?>
								<li>
								<?php if($child['main']) { ?>
								<a href="<?php echo $child['href']; ?>" class="main_link">
								<h3 class="subtitle"><?php echo $child['name']; ?></h3>
								<?php if(!empty($child['image'])) { ?>
									<div class="thumb"><img alt="" class="img-responsive" src="<?php echo $child['image']?>" /></div>
								<?php } ?>
								<?php if(!empty($child['model'])) { ?>
								<ul class="list-unstyled product-detail">
									<li><?php echo !empty($child['model']) ? $child['model']:'' ; ?></li>
									<li><?php echo !empty($child['sku']) ? $child['sku']:'' ; ?></li>
									<li><?php echo !empty($child['upc']) ? $child['upc']:'' ; ?></li>
									<li><?php echo !empty($child['price']) ? $child['price']:'' ; ?></li>
									<li><?php echo !empty($child['special']) ? $child['special']:'' ; ?></li>
									<li><p><?php echo !empty($child['description']) ? $child['description']:'' ; ?></p></li>
								</ul>
								<?php } ?>
								</a>
							<?php } ?>
							<!-- extra subcategory -->
							<?php if(!empty($child['sublink'])) { ?>
							<ul class="list-unstyled subcategory">
								<?php foreach($child['sublink'] as $subcategory) { ?>
								<li>
									<a href="<?php echo $subcategory['href']; ?>">
									<?php if(!empty($subcategory['image'])) {?>
									<img src="<?php echo $subcategory['image']?>" />
									<?php } ?>
									<?php echo $subcategory['name']; ?>
									<?php if($subcategory['description']) { ?>
									<p><?php echo !empty($subcategory['description']) ? $subcategory['description']:'' ; ?></p>
									<?php } ?>
									</a>
								</li>
								<?php } ?>
							</ul>
							<?php } ?>
							<!-- extra subcategory -->
							<!-- extra products -->
							<?php if(!empty($child['product'])) { ?>
								<ul class="list-unstyled extra_products">
									<?php foreach($child['product'] as $product) { ?>
									<li>
										<a href="<?php echo $product['href']; ?>">
										<h3><?php echo $product['name']; ?></h3>
										<?php if(!empty($product['image'])) { ?>
										<div class="thumb"><img class="img-responsive" src="<?php echo $product['image']?>" /></div>
										<?php } ?>
										<ul class="list-unstyled product-detail">
										<li><?php echo !empty($product['model']) ? $product['model']:'' ; ?></li>
										<li><?php echo !empty($product['sku']) ? $product['sku']:'' ; ?></li>
										<li><?php echo !empty($product['upc']) ? $product['upc']:'' ; ?></li>
										<li><?php echo !empty($product['price']) ? $product['price']:'' ; ?></li>
										<li><?php echo !empty($product['special']) ? $product['special']:'' ; ?></li>
										<li><p><?php echo !empty($product['description']) ? $product['description']:'' ; ?></p></li>
										</ul>
										</a>
									</li>
									<?php } ?>
								</ul>
							<?php } ?>
							<!-- extra products -->
							</li>
										<?php } ?>
									</ul>
									<?php } } ?>
									<?php if(!empty($megaheader['editor'])) {?>
									<?php if(!empty($megaheader['background'])) {?>
									<div style="width:60%"> <?php echo $megaheader['editor']?></div>
									<?php } else{?>
									<div style="width:99%"> <?php echo $megaheader['editor']?></div>
									<?php } }?>
								</div>
								</div>
							</div>
						</div>
					</div>
					<?php if($megaheader['bgimagetype']=='uploadimage'){?>
					</div>
					<?php } elseif($megaheader['bgimagetype']=='selectpattern') { ?>
					</div>
					<?php } else { ?>
					</div>
					<?php } ?>
				
					</li>
					<?php } else { ?>
						<li class="with-sub-menu hover" >
						<?php if($megaheader['showicon']==1){?>
						<a href="<?php echo $megaheader['href']; ?>"> <i class="<?php echo $megaheader['icon']?> fonticon" aria-hidden="true"></i></a>
						<?php } else {?>
						<a class="menutitle" href="<?php echo $megaheader['href']; ?>" <?php if($megaheader['openew']) {?>target="_blank"<?php }?> ><i class="<?php echo $megaheader['icon']?> fonticon" aria-hidden="true"></i> <?php echo $megaheader['title']; ?></a>
						<?php } ?>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</div>
	</div>
	</nav>
	</div>
<?php } ?>
<style>
li .menutitle a:active,
li .menutitle a:hover{color:<?php echo $headertitlehovcolor;?>!important;}
#menu{background:<?php echo $headercontainer;?>!important;}
.with-sub-menu{background:<?php echo $menubgtitle;?>!important;}
.menutitle{color:<?php echo $headertitlecolor;?>;!important;font-size:<?php echo $headertitlesize;?>px!important}
ul.megamenu > li > a{color:<?php echo $headertitlecolor;?>;!important;}
.with-sub-menu:hover{background:<?php echo $menubghovtitle;?>!important;}
.subtitle{color:<?php echo $dropdownbgtitle;?>!important;}
.subtitle:hover{color:<?php echo $headertitlehovcolor;?>!important;}
.product-detail li{color:<?php echo $headersublink;?>!important;font-size:<?php echo $headerlinksize;?>px!important}
.subcategory li a{color:<?php echo $headersublink;?>!important;font-size:<?php echo $headerlinksize;?>px!important}
.product-detail li:hover{color:<?php echo $headerhlink;?>!important;}
.subcategory li a:hover{color:<?php echo $headerhlink;?>!important;}
#mega_menu{}
.fonticon{color:<?php echo $headertitlecolor;?>}
.dropdown-menu p{color:<?php echo $headertitlecolor;?>!important;}
.navbar-header{background:<?php echo $headercontainer;?>!important;border-color:<?php echo $headercontainer;?>!important;}
#mega_menu #category{color:<?php echo $headertitlecolor;?>;!important;}
#mega_menu .btn-navbar{background:<?php echo $dropdownbgtitle;?>!important; border-color:<?php echo $dropdownbgtitle;?>!important; color:<?php echo $dropdownbg;?>!important;}
</style>
<script type="text/javascript">
  $(window).load(function(){
      var css_tpl = '<style type="text/css">';
      css_tpl += 'ul.megamenu > li > .sub-menu > .content {';
      css_tpl += '-webkit-transition: all 500ms ease-out !important;';
      css_tpl += '-moz-transition: all 500ms ease-out !important;';
      css_tpl += '-o-transition: all 500ms ease-out !important;';
      css_tpl += '-ms-transition: all 500ms ease-out !important;';
      css_tpl += 'transition: all 500ms ease-out !important;';
      css_tpl += '}</style>'
    $("head").append(css_tpl);
  });
</script>
