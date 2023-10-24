<!--our agents-->
	<div class="heading-search">
		<h1>Our Agents</h1>
		<div class="radius"> </div>
	</div>
	<div class="row margin0">
		<?php foreach ($agentdetails as $agent) { ?>
            <div class="col-sm-12 col-xs-12 agentinfo">
				<div class="image">
                    <a href="<?php echo $agent['href']; ?>"><img src="<?php echo $agent['image']; ?>" alt="<?php echo $agent['agentname']; ?>" title="<?php echo $agent['agentname']; ?>" class="img-responsive" /></a>
                </div>
                <div class="detail">
					<div class="name"><?php echo $agent['agentname']?></div>
					<div class="desg"><?php echo $agent['positions']?></div>
					<div class="comment"><?php echo $agent['description']?></div>
                </div>
			</div>
		<?php } ?>
	 </div>
