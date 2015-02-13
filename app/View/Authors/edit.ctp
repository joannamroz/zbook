<h1>Edit Author</h1>
<?php
echo $this->Form->create('Author');
echo $this->Form->input('fullname');
echo $this->Form->text('date_of_birth', array('type' => 'date'));;
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Author');
?>