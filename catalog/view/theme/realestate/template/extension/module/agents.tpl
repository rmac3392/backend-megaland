<div class="list-group agentbox">
	<h3><i class="fa fa-list" aria-hidden="true"></i> <?php echo $heading_title; ?></h3>
  <?php if (!$logged) { ?>
  <a href="<?php echo $login; ?>" class="list-group-item"><i class="fa fa-sign-in" aria-hidden="true"></i>
 <?php echo $text_login; ?></a> 
  <a href="<?php echo $signup; ?>" class="list-group-item"><i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo $text_register; ?></a>
  <a href="<?php echo $forgotpassword; ?>" class="list-group-item"><i class="fa fa-unlock-alt" aria-hidden="true"></i> <?php echo $text_forgot; ?></a> 
  <?php } ?>
  
  <?php if ($logged) { ?>
	<a href="<?php echo $dashboard; ?>" class="list-group-item"><i class="fa fa-tachometer" aria-hidden="true"></i> <?php echo $text_dashboard; ?></a>  
	<a href="<?php echo $edit; ?>" class="list-group-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $text_editagent; ?></a> 
  
	<a href="<?php echo $viewagent; ?>" class="list-group-item"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $text_viewagent; ?></a>
	<a class="hide" href="<?php echo $membership; ?>" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $text_membership; ?></a> 
	<a href="<?php echo $property; ?>" class="list-group-item"><i class="fa fa-building" aria-hidden="true"></i>
 <?php echo $text_addproperty; ?></a> 
	<a href="<?php echo $manage; ?>" class="list-group-item"><i class="fa fa-adjust" aria-hidden="true"></i>
 <?php echo $text_manage; ?></a> 
  
	<a href="<?php echo $password; ?>" class="list-group-item"><i class="fa fa-key" aria-hidden="true"></i> <?php echo $text_chagepass; ?></a>
	<a href="<?php echo $logout; ?>" class="list-group-item"><i class="fa fa-lock" aria-hidden="true"></i> <?php echo $text_logout; ?></a>
  <?php } ?>
</div>
