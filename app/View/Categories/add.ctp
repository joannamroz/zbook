<h2>Add Category</h2>
<?php
echo $this->Form->create('Category'); 
?>

<div>
	<?php
		echo $this->Form->input('name', array(
			'div' => false,
			'label' =>false,
			'placeholder'=>'Add category'
		));
?>
</div>
<?php
echo $this->Form->end(array(
	'label'=>'Save',
	'class'=>'btn btn-default'));
//echo $this->Form->end('Save Category');

?>
 