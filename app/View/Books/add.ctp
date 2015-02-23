<!-- File: /app/View/Posts/add.ctp -->

<h2>Add Book</h2>
<?php
echo $this->Form->create('Book');
echo $this->Form->input('title', array('rows' => '1'));
echo $this->Form->input('author_id', array(
							            'options' => $authors,
							            'multiple' => false,
							            'class'=>'use_select2 categories_select'
        ));

// jesli chcesz zrobic swojego selecta super fajnego mozesz podpiac to : http://select2.github.io/
echo $this->Form->input('BookCategories.category_id',array(
												     	'options'=> $categories,
												      	'multiple' => true,
												      	'class'=>'use_select2 categories_select'
      	));

echo $this->Form->end('Save Book');

?>
 <?php
