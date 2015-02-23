<h1>Edit Book</h1>
<?php

echo $this->Form->create('Book');
echo $this->Form->input('title', array('rows' => '3'));
echo $this->Form->input('author_id', array(
            'options' => $authors,
            'class'=>'use_select2'
        ));
echo $this->Form->input(
     'BookCategories.category_id',
     array(
     	'type' => 'select',
     	'options'=> $categories,
      'multiple' => true,
      'selected' => $selected,
      'class'=>'use_select2 categories_select'
      	)
 );
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Book');
?>