<!-- <div class="form"> -->

<?php echo $this->Form->create('User', array(
	'class'=>'form-signin',
	'inputDefaults'=>array(
	'class' => array('form-control'),
	'div'=>false
	))); ?>
	<h2 class='form-signin-heading'>Please Login</h2>

    <?php echo $this->Form->input('username', array(
        		'type'=>'username',
        		'placeholder'=>'Username',
	        	'label' => array('class' => 'sr-only','text' => 'Your username'
	        	)));
	        echo $this->Form->input('password', array(
	        	'type'=>'password',
	        	'placeholder'=>'Password',
	        	'label' => array('class' => 'sr-only','text' => 'Your password'
	        	)));
   
echo $this->Form->end(array('label'=>'Submit', 'class'=>'btn btn-lg btn-primary btn-block')); 
echo $this->Html->image("fb-signin.gif", array(
    "alt" => "Login with Facebook",
    'url' => $fbLoginUrl,
    'class' => 'signin_link'));

echo '<br>';
echo $this->Html->link('Register ', array('controller'=>'users', 'action'=>'add'), array('class' => 'signin_link fbLogin'));?>


