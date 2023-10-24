<?php
class ControllerCommonThemecss extends Controller {

	public function index() {
	
		header("Content-type: text/css", true);
		
		$data['tmdblogsetting_titletextcolor'] = $this->config->get('tmdblogsetting_titletextcolor');
		$data['tmdblogsetting_titlebgcolor'] = $this->config->get('tmdblogsetting_titlebgcolor');
		$data['tmdblogsetting_containerbgcolor'] = $this->config->get('tmdblogsetting_containerbgcolor');
		$data['tmdblogsetting_postboxbgcolor'] = $this->config->get('tmdblogsetting_postboxbgcolor');
		$data['tmdblogsetting_articletextcolor'] = $this->config->get('tmdblogsetting_articletextcolor');
		$data['tmdblogsetting_descptextcolor'] = $this->config->get('tmdblogsetting_descptextcolor');
		$data['tmdblogsetting_feedbacktextcolor'] = $this->config->get('tmdblogsetting_feedbacktextcolor');
		$data['tmdblogsetting_feedbackbgcolor'] = $this->config->get('tmdblogsetting_feedbackbgcolor');
		$data['tmdblogsetting_blogtextcolor'] = $this->config->get('tmdblogsetting_blogtextcolor');
		$data['tmdblogsetting_recntposttextcolor'] = $this->config->get('tmdblogsetting_recntposttextcolor');
		$data['tmdblogsetting_recntpostlinkcolor'] = $this->config->get('tmdblogsetting_recntpostlinkcolor');
		$data['tmdblogsetting_recntposthovercolor'] = $this->config->get('tmdblogsetting_recntposthovercolor');
		$data['tmdblogsetting_commenttimecolor'] = $this->config->get('tmdblogsetting_commenttimecolor');
		$data['tmdblogsetting_commentcolor'] = $this->config->get('tmdblogsetting_commentcolor');
		$data['tmdblogsetting_commentusercolor'] = $this->config->get('tmdblogsetting_commentusercolor');
		$data['tmdblogsetting_themecolor'] = $this->config->get('tmdblogsetting_themecolor');
		$data['tmdblogsetting_themehovercolor'] = $this->config->get('tmdblogsetting_themehovercolor');
		$data['tmdblogsetting_titletextcolor'] = $this->config->get('tmdblogsetting_titletextcolor');
		$data['tmdblogsetting_headinghovercolor'] = $this->config->get('tmdblogsetting_headinghovercolor');
		
	
		echo "#categorysearch .list-group{background:".$data['tmdblogsetting_containerbgcolor']."}";
		
		echo "#latestpost .postrow{background:".$data['tmdblogsetting_containerbgcolor']."}";
		echo "#latestpost .product-thumb{background:".$data['tmdblogsetting_postboxbgcolor']."}";
		
		echo "#categorysearch hr{border-color:".$data['tmdblogsetting_titlebgcolor']." -moz-use-text-color -moz-use-text-color !important;}";
		echo "#blog-right .nav > li > a{background:".$data['tmdblogsetting_titlebgcolor']."; color:".$data['tmdblogsetting_titletextcolor']."}";
		echo "#blog-right .nav .active a{background:".$data['tmdblogsetting_containerbgcolor']."}";	
		echo "#latestpost .feedbackrow ul li{background:".$data['tmdblogsetting_feedbackbgcolor'].";color:".$data['tmdblogsetting_themecolor']."}";	
		echo "#latestpost .feedbackrow ul li a{color:".$data['tmdblogsetting_themecolor']."}";
		echo ".postbox .comment .descp{color:".$data['tmdblogsetting_recntposttextcolor']."}";
		echo ".postbox .comment .date{color:".$data['tmdblogsetting_recntposttextcolor']."}";
		echo ".postbox .comment .readmore a{color:".$data['tmdblogsetting_recntpostlinkcolor']."}";
		echo "#tab-comment .commnettext a{color:".$data['tmdblogsetting_recntpostlinkcolor']."}";
		echo ".postbox:hover{background:".$data['tmdblogsetting_recntposthovercolor']."}";
		echo "#postfeedback .commentbox .comment .time{color:".$data['tmdblogsetting_commenttimecolor']."}";
		echo "#postfeedback .commentbox .comment .name,.commentpage .comment .name{color:".$data['tmdblogsetting_commentusercolor']."}";
		echo "#postfeedback .commentbox .comment p,.commentpage .commnettext{color:".$data['tmdblogsetting_commentcolor']."}";
		echo "#tab-comment .name{color:".$data['tmdblogsetting_commentusercolor']."}";
		echo "#tab-comment .commnettext{color:".$data['tmdblogsetting_commentcolor']."}";
		echo ".postbox .comment a{color:".$data['tmdblogsetting_recntpostlinkcolor']."}";
		
		echo ".datebox{background-color:".$data['tmdblogsetting_themecolor']."!important}";
		echo ".user{color:".$data['tmdblogsetting_themecolor']."!important}";
		echo ".effect{box-shadow: 0 0 0 2px ".$data['tmdblogsetting_themecolor']."!important}";
		echo ".btnread a{color:".$data['tmdblogsetting_themehovercolor']."!important}";
		echo ".effect:hover{background:".$data['tmdblogsetting_themecolor']."!important}";
		echo "#blog-right .nav > li > a{border-color:".$data['tmdblogsetting_themecolor']."!important}";
		echo "#blog-right .nav > li > a{color:".$data['tmdblogsetting_themecolor']."!important}";
		echo ".postright .nav-tabs{border-color:".$data['tmdblogsetting_themecolor']."!important}";		
		echo "#blog-right .nav li.active > a, #blog-right .nav > li.active > a:hover, #blog-right .nav > li.active > a:focus,.commentpage h2, #tmdcategorysearch h2, .tags h2,.tag:hover,.blogssearch h2{color:".$data['tmdblogsetting_themehovercolor']."!important}";		
		echo ".effect:hover a{color:".$data['tmdblogsetting_themehovercolor']."!important}";
		echo ".tag:hover::after{border-left-color:".$data['tmdblogsetting_themecolor']."!important}";
		echo "#blog-right .nav  li.active > a,#blog-right .nav  > li.active > a:hover, #blog-right .nav  > li.active > a:focus,.commentpage h2, #tmdcategorysearch h2,.blogssearch h2, .tags h2,.btnread,.tag:hover{background:".$data['tmdblogsetting_themecolor']."!important}";
		echo "#latestpost .description{color:".$data['tmdblogsetting_themecolor']."}";
		echo "#latestpost h4{color:".$data['tmdblogsetting_blogtextcolor']." }";
		echo "#latestpost .description h3, #latestpost .description h5 {color:".$data['tmdblogsetting_themecolor']." }";
		//echo ".commentpage h2,#tmdcategorysearch h2,.tags h2{border-bottom:4px solid ".$data['tmdblogsetting_themecolor']."!important}";
		echo ".comment .name{color:".$data['tmdblogsetting_themecolor']."!important}";
		echo "#latestpost .all h4{color:".$data['tmdblogsetting_titletextcolor']."!important}";
		//echo "#latestpost h2{color:".$data['tmdblogsetting_titletextcolor']."!important}";
		echo "#latestpost .description h3,#latestpost .description h5{color:".$data['tmdblogsetting_titletextcolor']."!important}";
		echo "#latestpost .all h4:hover{color:".$data['tmdblogsetting_headinghovercolor']."!important}";
		echo "#latestpost .description{color:".$data['tmdblogsetting_descptextcolor']."!important}";
		echo ".backcolor .fa{color:".$data['tmdblogsetting_themecolor']."!important}";
		//echo ".backcolor .fa:hover{color:".$data['tmdblogsetting_themehovercolor']."!important}";
		echo ".fileimage .fa{color:".$data['tmdblogsetting_themecolor']."!important;font-size:26px;}";
		echo ".addbuton{background:".$data['tmdblogsetting_themecolor']."!important;border:".$data['tmdblogsetting_themecolor']."!important;}";
		
		echo ".backcolor {background:".$data['tmdblogsetting_containerbgcolor']."!important;}";
		echo "#latestpost .breadcrumb a{color:".$data['tmdblogsetting_themecolor']."!important;}";
		
		echo "#latestblog a,#relatedblog a{color:".$data['tmdblogsetting_themecolor']."!important;}";
		echo "#latestblog .icons .fa,#relatedblog .icons .fa{color:".$data['tmdblogsetting_themecolor']."!important;}";
		echo "#latestblog li,#relatedblog li{color:".$data['tmdblogsetting_themecolor']."!important;}";
		echo ".inner img{border:2px solid ".$data['tmdblogsetting_themecolor']."!important;}";
		
		
		
	}
}
