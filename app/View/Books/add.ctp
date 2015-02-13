<!-- File: /app/View/Posts/add.ctp -->

<h2>Add Book</h2>
<?php
echo $this->Form->create('Book');
echo $this->Form->input('title', array('rows' => '1'));
echo $this->Form->input('author_id', array(
            'options' => $authors
        ));
echo $this->Form->end('Save Book');

?>
 <?php
// echo $this->element('klocek', array(
//     "helptext" => "Oh, this text is very helpful."
// ));
// echo $this->element('klocek', array(
//     "helptext" => "sia dupa."
// ));