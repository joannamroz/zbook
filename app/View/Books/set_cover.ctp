<?php 
echo $this->Form->create('Book', array('type'=>'file'));
echo $this->Form->input('cover', array(
	'type'=>'file',
	'label' => 'Please upload a cover for this book'));
echo $this->Form->end(__('Submit'));
