<h1>Edit Author</h1>
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
echo $this->Form->input('born', array(
										'div'=>array('class'=>'form-group'),
										'label'=>array('text'=>'Born: ',
											'class'=>'add_author_input'),
										'input'=>array(
											'class'=>'form-control'),
										'dateFormat' => 'DMY',
									    'minYear' => date('Y') - 300,
									    'maxYear' => date('Y') - 0
));

echo $this->Form->input('died', array(
										'div'=>array('class'=>'form-group'),
										'label'=>array('text'=>'Died: ',
											'class'=>'add_author_input'),
										'input'=>array(
											'class'=>'form-control'),
										'dateFormat' => 'DMY',
									    'minYear' => date('Y') -300,
									    'maxYear' => date('Y') - 0
));
echo $this->Form->input('description', array(
										'div'=>array('class'=>'form-group'),
										'label'=>array('text'=>'Description: ',
											'class'=>'add_author_input'),
										'input'=>array(
												'class'=>'form-control'
											)
										
										
));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->button('Save author', array('type' => 'submit',
										'class'=>'btn btn-default'));

?>