<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="responsive js no-touch" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
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
<!--jquery -->
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<!--bootstrap js-->
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--bootstrap css-->
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<!--font-awesome css-->

<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--- google fonts
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
--->
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<!--theme stylesheet-->
<?php if ($themecolor=='green') { ?>
<link href="catalog/view/theme/realestate/stylesheet/green-stylesheet.css" rel="stylesheet">
<?php } elseif($themecolor=='blue') { ?>
<link href="catalog/view/theme/realestate/stylesheet/blue-stylesheet.css" rel="stylesheet">
<?php } elseif($themecolor=='sky') { ?>
<link href="catalog/view/theme/realestate/stylesheet/sky-stylesheet.css" rel="stylesheet">
<?php } elseif($themecolor=='orange') { ?>
<link href="catalog/view/theme/realestate/stylesheet/orange-stylesheet.css" rel="stylesheet">
<?php } elseif($themecolor=='purple') { ?>
<link href="catalog/view/theme/realestate/stylesheet/purple-stylesheet.css" rel="stylesheet">
<?php } elseif($themecolor=='pink') { ?>
<link href="catalog/view/theme/realestate/stylesheet/pink-stylesheet.css" rel="stylesheet">
<?php } elseif($themecolor=='default') { ?>
<link href="catalog/view/theme/realestate/stylesheet/stylesheet.css" rel="stylesheet">
<?php } else { ?>
<link href="catalog/view/theme/realestate/stylesheet/stylesheet.css" rel="stylesheet">
<?php } ?>
<!--mega menu css -->
<link href="catalog/view/theme/realestate/stylesheet/megaheader.css" rel="stylesheet">
<link href="catalog/view/theme/realestate/stylesheet/menu.css" rel="stylesheet" type="text/css">
<link href="catalog/view/theme/realestate/stylesheet/tmdlatestblog.css" rel="stylesheet" type="text/css">
<!--mega menu js -->
<script type="text/javascript" src="catalog/view/theme/realestate/megamenu/megamenu.js"></script>
<script type="text/javascript">
	var responsive_design = 'yes';
</script>
<!-- gallery css -->
<link href="index.php?route=gallery/themecss" rel="stylesheet"/>
<link href="index.php?route=common/themecss" rel="stylesheet"/>
<link href="catalog/view/theme/realestate/stylesheet/animate.css" rel="stylesheet"/>
<script type="text/javascript" src="catalog/view/theme/realestate/js/viewportchecker.js"></script>
<script type="text/javascript" src="catalog/view/theme/realestate/js/landing.js"></script>

<!--share links code start-->
<meta property="og:title" content="<?php echo $seotitle; ?>" />
<meta property="og:url" content="<?php echo $seoshare; ?>" />
<meta property="og:description" content="<?php echo $seodescription; ?>" />
<meta property="og:image" content="<?php echo $seoimage; ?>" />
<!--share links code end-->

<!-- blog css 

<link href="catalog/view/theme/realestate/stylesheet/tmdlatestblog.css" rel="stylesheet">
end blog css -->
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet"/>
<script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
<?php if($lang=='ar') { ?>
	<link href="catalog/view/theme/realestate/stylesheet/bootstrap-rtl.css" rel="stylesheet">
	<link href="catalog/view/theme/realestate/stylesheet/bootstrap-rtl.min.css" rel="stylesheet">
	<link href="catalog/view/theme/realestate/stylesheet/rtl.css" rel="stylesheet">
<?php } ?>
</head>
<body class="<?php echo $class; ?>">
<!--top bar code start here-->
<nav id="top">
	<div class="container">
		<div id="top-links" class="nav">
			<ul class="signin list-inline pull-left">
				<?php if ($logged) { ?>
				<li><i class="fa fa-user"></i> <a href="<?php echo $account; ?>"><?php echo $text_logged; ?></a></li>
				<li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
				<?php } else { ?>
				<li><i class="fa fa-user"></i> <a href="<?php echo $login; ?>"><?php echo $text_login; ?></a> </li>
				<li><a href="<?php echo $agentsignup; ?>"><?php echo $text_register; ?></a></li>
				<?php } ?>
			</ul>
			<ul class="list-inline pull-right">
				<li>
					<a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i> <?php echo $text_call; ?> <?php echo $telephone; ?></a>
				</li>
				<li><?php echo $language; ?></li>
			</ul>
		</div>
	</div>
</nav>
<!-- top bar code end here-->

<!-- header code start here-->
<header>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div id="logo">
					<?php if ($logo) { ?>
						<a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
					<?php } else { ?>
						<h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
					<?php } ?>
				</div>
			</div>
			<div class="col-sm-8 header_right text-right">
				<ul class="list-inline">
					<?php if($fburl){?>
					<li class="fb"><a href="<?php echo $fburl;?>" target="new"></a></li>
					<?php } ?>
					<?php if($twet){?>
					<li class="twitter"><a href="<?php echo $twet;?>" target="new" class="twitter"></a></li>
					<?php }?>
					<?php if($google){?>
					<li class="google"><a href="<?php echo $google;?>" target="new" class="google"></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</header>
<!--header code end here-->

<!--menu code start here-->
<div id="menu-wrap">
	<div class="container">
		<?php echo $megaheaders;?>
	</div>
</div>
<!--menu code end here-->

<!--search code start here-->
<?php // echo $search; ?>
<!--search code end here-->
