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

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('style');
		echo $this->Html->css('rateit');
		echo $this->Html->css('font-awesome');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="nav">
		<div id="header">
			<h1><?php echo $this->Html->link('zBook', '/'); ?>
			<div style="float:right"><?php echo $this->Html->link('Logout', array('controller'=>'users','action'=>'logout')); ?>
			<?php echo $this->Html->link(AuthComponent::user('username'), array('controller'=>'users', 'action'=>'user_book'))?></div></h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php 
			?>
			<h3>
				<strong style="color:red"><?php //echo 'Asia sie uczy :) '; //echo $cakeVersion; ?></strong>
			</h3>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
