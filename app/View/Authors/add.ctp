<h2>Add Author</h2>
<?php
// $element=$this->Form;
// $element->setAttribute('class', 'form-group');
echo $this->Form->create('Author', array(
										'div'=>array('class'=>'form-group')));
echo $this->Form->input('fullname', array(
										'div'=>array(
											'class'=>'form-group',
											'label'=>'Fullname:',
											'input'=>array(
												'class'=>'form-control'
											)
										),
										
));
echo $this->Form->input('date_of_birth',  array(
										'div'=>array('class'=>'form-group'),
										'label'=>'Date of birth:  ',
										'input'=>array(
											'class'=>'form-control'
										)
));
echo $this->Form->button('Save author', array('type' => 'submit',
										'class'=>'btn btn-default'));

?>
