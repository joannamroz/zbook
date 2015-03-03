<?php 
echo $this->Form->create('User', array('type'=>'file'));
echo $this->Form->input('avatar', array(
	'type'=>'file',
	'label' => 'Please add your new avatar'));
echo $this->Form->end(__('Submit'));
