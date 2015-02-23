<h2>Add Author</h2>
<?php

echo $this->Form->create('Author', array(
										'div'=>array('class'=>'form-group')));
echo $this->Form->input('fullname', array(
										'div'=>array('class'=>'form-group'),
										'label'=>array('text'=>'Fullname: ',
											'class'=>'add_author_input'),
										'input'=>array(
												'class'=>'form-control'
											)
										
										
));
echo $this->Form->input('date_of_birth', array(
										'div'=>array('class'=>'form-group'),
										'label'=>array('text'=>'Date of birth: ',
											'class'=>'add_author_input'),
										'input'=>array(
											'class'=>'form-control'
										)
));
echo $this->Form->button('Save author', array('type' => 'submit',
										'class'=>'btn btn-default'));

?>
