<h1>Edit Book</h1>
<?php
echo $this->Form->create('Book');
echo $this->Form->input('title', array('rows' => '3'));
echo $this->Form->input('author_id', array(
            'options' => $authors
        ));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Book');
?>