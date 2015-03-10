<?php 
echo $this->Form->create('Author', array('type'=>'file'));
echo $this->Form->input('photo', array(
	'type'=>'file',
	'label' => 'Please upload a photo for this author'));
echo $this->Form->end(__('Submit'));
