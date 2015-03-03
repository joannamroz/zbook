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
		echo $this->Html->script('script');
		echo $this->Html->script('jquery.rateit');
		echo $this->Html->script('/../libraries/select2/select2');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('style');
		echo $this->Html->css('rateit');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('/../libraries/select2/select2.css');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
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
	    </div>
	    <div id="navbar" class="navbar-collapse collapse">
	      <ul class="nav navbar-nav">
	        <li class=""><a href="/">Strona główna</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<li class=""> <?php echo $this->Html->link('<i class="fa fa-envelope fa-2x"></i>', array('controller'=>'messages', 'action'=>'index'),
	       array('escape'=>false)); ?> </li>
	      	<li><?php echo $this->Html->link( 
	      		$this->Html->image(AuthComponent::user('avatar'), array('class'=>'avatar_img ')).'&nbsp'.AuthComponent::user('username'),
	      		array('controller'=>'users', 'action'=>'profile'),
	      		array('class'=>'link_photo',
	      			'escape'=>false)

	      		); ?></li>

	      	<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bars fa-2x"></i> <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><?php echo $this->Html->link("User's books", array('controller'=>'users', 'action'=>'user_book'));?></a></li>
	            <li><?php echo $this->Html->link('Edit', array('controller'=>'users', 'action'=>'edit'));?></a></li>
	           <!--  <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li class="divider"></li>
	            <li><a href="#">Separated link</a></li> -->
	          </ul>
	        </li>

	        
	       <li class=""> <?php echo $this->Html->link('<i class="fa fa-power-off fa-2x"></i>', array('controller'=>'users', 'action'=>'logout'),
	       array('escape'=>false)); ?> </li>
	      </ul>
	    </div><!--/.nav-collapse -->
	  </div>
	</nav>

	<div id="content" class="container"> 
		<?php ?>
		
		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>
	<footer class="footer" >
	  <div class="container" >
	    <p class="text-muted">Place sticky footer content here.</p>
	    
	    <?php //echo $this->element('sql_dump'); ?>
	  </div>
	</footer>
</body>
</html>
