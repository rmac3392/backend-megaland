<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="responsive" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700" rel="stylesheet">
<link href="catalog/view/theme/construction/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/construction/stylesheet/animate.css" rel="stylesheet">
<link href="catalog/view/theme/construction/stylesheet/pluton.css" rel="stylesheet">
<link href="catalog/view/theme/construction/stylesheet/responsive.css" rel="stylesheet">
<!--bootstrap select-->
<link href="catalog/view/theme/construction/js/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<script src="catalog/view/theme/construction/js/dist/js/bootstrap-select.js" type="text/javascript"></script>
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/theme/construction/js/common.js" type="text/javascript"></script>
<script src="catalog/view/theme/construction/js/app.js" type="text/javascript"></script>
<link href="index.php?route=gallery/themecss" rel="stylesheet"/>
<!--mega menu file-->
	<link href="catalog/view/theme/default/stylesheet/megaheader.css" rel="stylesheet">			
	<script type="text/javascript" src="catalog/view/theme/default/megamenu/megamenu.js"></script>
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/megamenu/menu.css">
	<script type="text/javascript">
		var responsive_design = 'yes';
	</script>
<!--mega menu file-->
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
</head>
<body class="<?php echo $class; ?>">
<header>
 <div class="container">			
    <div class="row">
      <div class="col-sm-2">
        <div id="logo">
          <?php if ($logo) { ?>
          <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
          <?php } else { ?>
          <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
      <div class="col-sm-6">
		<?php echo $megaheaders;?>
		<?php if ($categories) { ?>
		<nav id="menu" class="navbar">
			<div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
				<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<?php foreach ($categories as $category) { ?>
				<?php if ($category['children']) { ?>
				<li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
					<div class="dropdown-menu">
						<div class="dropdown-inner">
						<?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
						<ul class="list-unstyled">
							<?php foreach ($children as $child) { ?>
							<li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
							<?php } ?>
						</ul>
						<?php } ?>
					</div>
					<a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a> </div>
				</li>
				<?php } else { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
				<?php } ?>
				<?php } ?>
			</ul>
			</div>
		</nav>
		<?php } ?>
      </div>
	  <div class="col-sm-4">
		<div class="mylogout">
		<?php if($logged) 
			{  
			?>
			<a href="index.php?route=account/logout"> 
			   <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>Logout
			</a>
			<a href="index.php?route=dashboard/dashboard"> 
			   <i class="fa fa-user" aria-hidden="true"></i>Account
			</a>
		    <?php 
            } else { ?>		
			<a href="index.php?route=account/login"> 
			   <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>Login
			</a>
		   <?php 
		     } 
			?>
			 <?php echo $cart; ?>
		</div>
	  </div>
    </div>
  </div>
</header>