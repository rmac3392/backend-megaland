<!--propert detail code start here-->
<?php echo $header; ?>
<br>
<div class="listing">
	
	<div class="container">
	  <?php if ($error_warning) { ?>
	  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
	  <?php } ?>
	  <div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_footer5) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_footer5) { ?>
		<?php $class = 'col-sm-8'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
          <div class="thumb">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="property-title"><a href="javascript:void(0)"><?php echo $name;?></a></h1>
                </div>	
                <div class="col-sm-6">
                    <ul class="list-unstyled pull-right">
                        <li><b><?php echo $propertydetails_price;?></b> <span class="price-amount"><?php echo $price;?></span></li>
                              
                    </ul>
                </div>	
            </div>
			<div id="property-banner" class="property-banner">	
			<?php if(!empty($image)){?>
			<img src="<?php echo $image; ?>" alt="<?php echo $name;?>" title="<?php echo $name;?>" class="img-responsive"/>
			<?php } else {?>
				<div class="item">
						<img src="catalog/view/theme/realestate/image/demo.png" class="img-responsive"/>
					</div>
			 <?php } ?>		
			</div>
			<!--additional image code start here-->
			<div id="additional" class="owl-carousel">
			<?php if(!empty($propertyimagesbanners)){ ?>
				<?php foreach ($propertyimagesbanners as $propertyimagesbanner){?>
					<div class="item">
						<img src="<?php echo $propertyimagesbanner['imagesbanner'];?>" alt="<?php echo $propertyimagesbanner['title']?>" title="<?php echo  $propertyimagesbanner['title']?>" class="img-responsive"/>
					</div>
				<?php } ?>
			<?php } ?>
			</div>
			<!--additional image code start here-->
		</div>
		<?php if (!empty($description)) { ?> 
			<div id="description" class="listing-caption">
				<h3><?php echo $propertydetails_description;?></h3>
				<p><?php echo $description;?></p>
			</div>
	    <?php } ?>
		<div id="propertydetails_address" class="listing-caption2">
		<h3><?php echo $propertydetails_address;?></h3>
			<ul class="list-inline bed_area">
				<li><?php echo $entry_address;?>:<span> <?php echo $local_area ?> </span></li>
				<li><?php echo $entry_zip;?>: <span>    <?php echo $pincode ?> </span></li>
				<li> <?php echo $entry_city;?>: <span>  <?php echo $city ?> </span></li>
				<li><?php echo $entry_neighborhood;?>:<span><?php echo $neighborhood ?> </span></li>
				<li> <?php echo $entry_state_county;?>:<span><?php echo $zone ?></span></li>
			</ul>
		</div>
		<div id="propertydetails_details" class="listing-caption1">
		<h3><?php echo $propertydetails_details;?></h3>
			<ul class="list-inline bed_area">
			<li><span class="bedrooms"></span> <?php echo $bedrooms;?> <?php echo $text_bedroom; ?></li>
			<li><span class="bathrooms"></span> <?php echo $bathrooms; ?> <?php echo $text_bathroom; ?></li>
			<li><strong><?php echo $text_areatype;?>:</strong> &nbsp; <?php echo $area?><?php echo $area_type?></li>
			<li> <strong> <?php echo $text_parking; ?> :</strong>&nbsp; <?php echo $Parkingspaces ?> </li>
			<li> <strong> <?php echo $text_built; ?> :</strong> &nbsp; <?php echo $builtin ?></li>
			<li> <strong> <?php echo $text_propertystatus;?> :</strong> &nbsp; <?php echo $property_status ?></li>
			</ul>
		</div>
		<?php if (!empty($featuress)) { ?> 
		<div id="propertydetails_feature"  class="listing-caption">
			<h3><?php echo $propertydetails_amenities;?></h3>
			<ul class="list-inline feat"> 
				<?php if (!empty($featuress)) { ?>  	
					<?php foreach($featuress as $feature) {?>
						<li><img src="<?php echo $feature['features'] ?>" alt="<?php echo $feature['name'] ?>" title="<?php echo $feature['name'] ?>" class="img-responsive"/> <?php echo $feature['name'];?></li>
					<?php } ?>	
				<?php } ?>	
			</ul>
		</div>
		<?php } ?>
		<?php if (!empty($nearest)) { ?> 
			<div id="nearplace_area" class="listing-caption">
				<h3><?php echo $propertydetails_nearestplace;?></h3>
				<ul class="list-inline feat">
					<?php if (!empty($nearest)) { ?>  
						<?php foreach($nearest as $near) {?>
							<li><img src="<?php echo $near['nearplace'] ?>" alt="<?php echo $near['name'] ?>" title="<?php echo $near['name'] ?>" class="img-responsive"/> <?php echo $near['destiny'] ?></li>
						<?php }  ?>
					<?php }?>
				</ul>
			</div>
			<?php } ?>
		<?php if(!empty($video)){ ?>
			<div id="property-video" class="listing-caption">
				<h3><?php echo $propertydetails_video;?></h3>
				<iframe width="100%" height="400px" src="<?php echo $video;?>" frameborder="0" 
					allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
		<?php } ?>
               <?php if(!empty($customfieldsdetail)) { ?>
				<div id="custome_details" class="listing-caption">
				 <table class="table">
				    <tbody>
     					<?php foreach($customfieldsdetail  as $showdata){ ?>
						<tr>
						<td> 
							<?php if(!empty($showdata['custom_field'])){?>
							<?php foreach($showdata['custom_field']  as $custom_fieldname){ ?>  
							<?php echo $custom_fieldname['name']?> 
                          <?php  }  } ?>
						</td>   
						 <td> 
						 	<?php if (is_array($showdata['val'])) { ?>
						 		<?php foreach($showdata['val']  as $showdataval){ ?>  
							<?php echo $showdataval; ?> 
                          <?php  }   ?>

                        	<?php } else {  ?>
                        
							<?php echo $showdata['val']?> 
						 
						 </td>
                        	<?php }  ?>
                        </tr>
						<?php }  ?>
					</tbody>
				</table>
    		</div>
		<?php } ?>
        <?php echo $content_bottom; ?></div>
		<div class="col-sm-4 hidden-xs">
		<!--agent code start here-->
     	<?php if(!empty($propertycontactagent)){?>
		<div class="ouragents">
		  <h2><?php echo $propertydetails_contact; ?></h2>
		  <div class="row">
		    <div class="ouragent_detail">
		<div class="col-sm-12 col-xs-12 boxs">
		 <div class="agentprofile">
			<?php if(isset($propertycontactagent)) { ?>
			<?php foreach ($propertycontactagent as $agent) { ?>
				<div class="image">
				<a href="<?php echo $agent['href'];?>"><img src="<?php echo $agent['agentimage'];?>" alt="Alena due" title="<?php echo $agent['agentname'];?>" class="img-responsive"></a>
				</div>
				<?php if(!empty($agent)==$agent['facebook'].$agent['twitter'].$agent['googleplus'].$agent['pinterest'].$agent['instagram']){?>
				<ul class="list-inline socialicon">
				<?php if($agent['facebook']){?>
				<li class="fb"><a href="<?php echo $agent['facebook']?>" target="new"><i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
				<?php } ?>
				<?php if($agent['twitter']){?>
				<li class="twitter"><a href="<?php echo $agent['twitter'];?>" target="new" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
				<?php }?>
				<?php if($agent['googleplus']){?>
				<li class="google"><a href="<?php echo $agent['googleplus'];?>" target="new" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i> </a></li>
				<?php } ?>
				<?php if($agent['pinterest']){?>
				<li class="pinterest"><a href="<?php echo $agent['pinterest'];?>" target="new" class="pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i> </a></li>
				<?php }?>
				<?php if($agent['instagram']){?>
				<li class="instagram"><a href="<?php echo $agent['instagram'];?>" target="new" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i> </a></li>
				<?php } ?>
				</ul>
				<?php } ?>
				<div class="deatil">
				  <div class="name"><?php echo $agent['agentname'];?></div>
				  <div class="property"><div class="property"><?php echo $agent['propertyagent']?> <?php echo $propertydetails_property;?></div></div>
				</div>
				</div>
				<?php } ?>
				<?php } ?>
				<div class="contactnow" data-toggle="modal" data-target="#contactnow">
				<?php echo $propertydetails_contactnow; ?>
				</div>
				<!--modal code start here-->
				<div class="enquerydiv">
				<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="contactnow">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">
						<span class="close1"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></span>
						<div  class="boxmodal">
				        <form class="form" method="post"  id="formproperty">
						  <fieldset>
						  <h4><?php echo $popupmessage_sendmsg; ?></h4>
						  <div class="form-group required">
						      <input type="text" name="nameagent" id="name" class="form-control" placeholder="<?php echo $entry_name; ?>">
							  <div id="val-c"></div>
				          </div>
				  		  <input type="hidden" name="property_id" value="<?php echo $property_id;?>" id="property_id">
						  <input type="hidden" name="property_agent_id" value="<?php echo $property_agent_id;?>" id="property_id">
						 <div class="form-group required">
							<input type="text" name="emailagent" value="" class="form-control" placeholder="<?php echo $entry_email; ?>" id="emailagent">
							<div id="val-e"></div>
				        </div>
						<div class="form-group required">
							<textarea name="description" rows="10" id="description"  class="form-control" placeholder="<?php echo $entry_msg; ?>"></textarea>
							<div id="val-d"></div>
				        </div>
						<div class="buttons">
						   <div class="pull-right">
				               <button class="btn btn-primary" rel="<?php echo $property_agent_id;?>"  value="" type="button" id="enquerybutton"><?php echo $button_submit; ?></button>
							</div>
						  </div>
					    </fieldset>
					   </form>
				      </div>
				    </div>
				   </div>
				</div>
				<!--modal code end here-->
				<div id="msgs"></div>
				</div>
              </div>
			 </div>
			<!--agent code end here-->
			</div>
			</div>
           <?php } ?>
         <div class="right-sidebar-main">
          <?php echo $column_footer5; ?>
         </div>
     <hr>
		<!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style" data-url=""><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
        <!-- AddThis Button END -->
			</div>
		</div>
    </div>
    
    <div class="listing-map">
		<!--Map iframe starts here-->
			<div class="map" id="map" style="width: 100%; height: 650px;">
			</div>
		<!--Map iframe end here-->
	</div>
	
 <div class="clearfix"></div>
 <?php if(!empty($relatedproperties)) { ?>
	<div class="related-listing cate2">  
        <div class="container">
		    <div class="related-title">
		      <h2> <?php echo $entry_relatedproperty;?> </h2>
			  <div class="border-title"></div>
		    </div>
		   
			
<!--related properties start-->  
	        
			<?php foreach ($relatedproperties as $relatedproperty) { ?>
  			<div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12 latest_main">
				<div class="product-thumb transition">
					<div class="image">
						<a href="<?php echo $relatedproperty['href']; ?>">
						<?php if(!empty($relatedproperty['image'])){?>
						<img src="<?php echo $relatedproperty['image']; ?>" alt="my new Property " title="<?php echo $relatedproperty['relatedname']; ?>" class="img-responsive">
						<?php } else { ?>
							<img src="catalog/view/theme/realestate/image/demo.png" class="img-responsive2"/>		
						<?php } ?>	
						</a>
					</div>
					<ul class="list-inline options">
						<li><span class="sqft"></span><?php echo $relatedproperty['area']; ?> <?php echo $relatedproperty['area_type']; ?></li>
						<li><span class="bedrooms"></span><?php echo $relatedproperty['bedrooms']; ?></li>
						<li><span class="bathrooms"></span><?php echo $relatedproperty['bathrooms']; ?></li>
					</ul>
					<div class="caption">
						<div class="featured_product">
							<h4><?php echo $relatedproperty['relatedname']; ?></h4>
							<p class="price"><span class="text"><?php echo $propertydetails_price;?></span><?php echo $relatedproperty['price']; ?></p>
							<ul class="list-unstyled features">
								<li><i class="fa fa-star" aria-hidden="true"></i>  <?php echo $relatedproperty['category']; ?> </li>
								<li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $relatedproperty['local_area']; ?></li>
								<li><span><i class="fa fa-bookmark-o" aria-hidden="true"></i>
								</span><?php echo $relatedproperty['neighborhood']; ?> </li>
							</ul>
						</div>
					</div>
				</div>
			</div> 
		<?php } ?>
	 
  <!--related properties end-->        
	</div>	
  </div>
   <?php } ?>
</div>
<script>
	$('#enquerybutton').click(function(){
	
		var property_agent_id = $(this).attr('rel');
		var c = $("#name").val();
		var e = $("#emailagent").val();
		var d = $("#description").val();
		/*if(c.length<2){
			$("#val-c").html("Name must be of 3 characters");
			$("#val-c").css("color", "red");
		}
		if(e.length<3){
			$("#val-e").html("E-Mail Address does not appear to be valid!");
			$("#val-e").css("color", "red");
		}
		if(d.length>200){
			$("#val-d").html("Description must be less than 200 characters");
			$("#val-d").css("color", "red");
		}*/
		
			$.ajax({
				url: 'index.php?route=property/property_detail/Sendenquery&property_agent_id='+property_agent_id,
				type: 'post',
				data: $('.enquerydiv input,enquerydiv hidden,.enquerydiv textarea'),
				dataType: 'json',
				beforeSend: function() {
				},
				success: function(json) {


			        if(json['error']){

				        if(json['error']['nameagent']){
				        $("#val-c").html(json['error']['nameagent']);
							$("#val-c").css("color", "red");	
			        
						}
						if(json['error']['emailagent']){
							$("#val-e").html(json['error']['emailagent']);
							$("#val-e").css("color", "red");			        
						}
						if(json['error']['description']){
							$("#val-d").html(json['error']['description']);
							$("#val-d").css("color", "red");			        
						}
					}

					if (json['success']) {
					$('#msgs').html("<div class='alert alert-success'>"+json['success']+"</div>");
						$("#val-c").html("");
						$("#val-d").html("");
						$("#val-e").html("");
						$("#description").val('');
						$("#emailagent").val('');
						$("#name").val('');
						$(".close").trigger("click");
					}
				}
			});
		
	});
</script>
<script type="text/javascript">
$('#additional').owlCarousel({
	items : 5,
    itemsDesktop : [1199, 5],
    itemsDesktopSmall : [979, 3],
    itemsTablet : [768, 2],	
    itemsMobile : [479, 1],
	autoPlay: false,
	navigation: true,
	navigationText: ['<i class="fa fa-caret-left" aria-hidden="true"></i>','<i class="fa fa-caret-right" aria-hidden="true"></i>'],
	pagination: false
});
</script>
<script>
	 function initMap() {
	 var myLatlng = new google.maps.LatLng('<?php echo $latitude?>' , '<?php echo $longitude?>');
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: myLatlng
        });
       var contentString = '<div id="contentss">'+
            '<h2 id="firstHeading"><?php echo $name?></h2>'+
            '<div id="bodyContent">'+
            '<p>Address: <?php echo $local_area?>' +
            '<p>Area code: <?php echo $pincode?>' +
            '<p>State : <?php echo $zone?>' +
            '<p>Country : <?php echo $country?>' +
            '</div>'+
            '</div>';
		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});

		var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,

		});
       marker.setMap(map);
		 google.maps.event.addListener(marker, 'click', function() {
				 infowindow.open(map,marker);
		 });
		infowindow.open(map,marker)
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $mapkey;?>callback=initMap">
    </script>
<script type="text/JavaScript">
jQuery(document).ready(function() {
	jQuery(".owl-item .item img").click(function(){
		jQuery('.property-banner  img').attr('src',jQuery(this).attr('src'));
	});
	var imgSwap = [];
	 jQuery(".owl-item .item img").each(function(){
		imgUrl = this.src.replace();
		imgSwap.push(imgUrl);
	});
	jQuery(imgSwap).preload();
});
jQuery.fn.preload = function() {
    this.each(function(){
        jQuery('<img/>')[0].src = this;
    });
}
</script>	 
<?php echo $footer; ?>
<!--propert detail code end here-->





