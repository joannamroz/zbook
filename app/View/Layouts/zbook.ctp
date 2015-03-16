<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset('utf-8'); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->script('jquery');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('jquery-ui');
		echo $this->Html->script('jquery.rateit');
		echo $this->Html->script('jquery.pulse');

		echo $this->Html->script('script');
		
		echo $this->Html->script('/../libraries/select2/select2');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('style');
		echo $this->Html->css('rateit');
		// 	echo $this->Html->css('font-awesome');
		echo $this->Html->css('/../libraries/select2/select2.css');


		echo $this->fetch('meta');?>
		<meta http-equiv="refresh" content="300">
		<?php echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="/">zBook</a>
	    </div> <!-- navbar-header -->
	    <div id="navbar" class="navbar-collapse collapse">
	      <ul class="nav navbar-nav">
	        <li class=""><a href="/"><strong>Strona główna</strong></a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
		      <?php 
		      if($count_msg!=0) {
		      	$badgeMsg='<span class="badge">'.$count_msg.'</span>';
		      } else {
		      	$badgeMsg='';
		      }
		      
		      ?>
	      	<li class=""> <?php echo $this->Html->link('<i class="fa fa-envelope fa-lg">'.$badgeMsg.'</i>', array('controller'=>'messages', 'action'=>'index'), array('escape'=>false)); ?> </li>
	      		<?php 
		      if(count($new_friends)!=0) {
		      	$badgeFriend='<span class="badge">'.count($new_friends).'</span>';
		      } else {
		      	$badgeFriend='';
		      }
		      
		      ?>
	      	<li class=""> <?php echo $this->Html->link('<i class="fa fa-users fa-lg" id="badgeFriend">'.$badgeFriend.'</i>', array('controller'=>'friends', 'action'=>'friend_list'), array('escape'=>false,'class'=>'removeBadge')); ?> </li>
	      	<li></li>

	      	<li class="dropdown">

	          <?php $caret='<span class="caret"></span>';?>
	       		 <?php echo $this->Html->link( 
	      		$this->Html->image(AuthComponent::user('avatar'), array('class'=>'avatar_img ')).'&nbsp'.ucfirst(AuthComponent::user('fullname')).$caret,
	      		array('controller'=>'users', 'action'=>'profile'),
	      		array('class'=>'dropdown-toggle',
	      			'data-toggle'=>'dropdown',
	      			'role'=>'button',
	      			'aria-expanded'=>false,
	      			'escape'=>false)

	      		); ?>
	          <ul class="dropdown-menu" role="menu">
	          	<li><?php echo $this->Html->link("Profile", array('controller'=>'users', 'action'=>'profile'));?></a></li>
	            <li><?php echo $this->Html->link("Library", array('controller'=>'users', 'action'=>'user_book'));?></a></li>
	            <li><?php echo $this->Html->link('Edit Profile', array('controller'=>'users', 'action'=>'edit'));?></a></li>
	            <li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'), array('escape'=>false));?></a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!--/.nav-collapse -->
	  </div>  <!-- container -->
	</nav> <!-- navbar navbar-default navbar-fixed-top -->

	<div id="content" class="container"> 
		<?php ?>
		
		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>
	<footer class="footer" >
	  <div class="container" >
	    <p class="text-muted">

	    	<span ><?php echo 'zBook';?> | <?php echo $this->Html->link(' add book ',array('controller'=>'books','action'=>'add'),array('class' => 'footerLinks')
					);?> | <?php echo $this->Html->link(' add author ', array('controller'=>'authors', 'action'=>'add'),array('class' => 'footerLinks'));?> | <?php echo $this->Html->link(' add category ', array('controller'=>'categories', 'action'=>'add'),array('class' => 'footerLinks'));?> | <?php echo $this->Html->link(' all users ',array('controller'=>'users','action'=>'index'),array('class' => 'footerLinks')
					);?></span>

	    </p>
	    
	    <?php //echo $this->element('sql_dump'); ?>
	  </div>
	</footer>
</body>
</html>
