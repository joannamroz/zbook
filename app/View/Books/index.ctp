<!-- File: /app/View/Books/index.ctp -->
<?php

//pr($haveNote);die(); ?>
<h2>Lista książek</h2>
<div style="float:right; margin-bottom:10px">


<?php echo $this->Html->link(
    'Add Book',
    array('controller' => 'books', 'action' => 'add'),
    array('class'=>'btn btn-primary')
    ); 

?>
</div>
<table class="table table-bordered">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Average</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $books array, printing out book info -->

    <?php 
    //pr($books);die();
    foreach ($books as $book): ?>
    <tr>
        <td><?php echo $book['Book']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($book['Book']['title'],
array('controller' => 'books', 'action' => 'view', $book['Book']['id'])); ?>
        </td>

        <td><?php echo $this->Html->link($book['Author']['fullname'], array('controller' => 'authors', 'action' =>'view', $book['Author']['id'])); ?></td>
        <td><?php echo $book['Book']['avg_rating']?></td>
        <td>
            <?php
                echo $this->Form->postLink(
                    '<i class="fa fa-times" style="color:red"></i>',
                    array('action' => 'delete', $book['Book']['id']),
                    //array('confirm' => 'Are you sure?'),
                    array('escape'=> false)
                    //array('confirm' => 'Are you sure?')

                );
            ?>
            <?php
            
                echo $this->Html->link(
                    '<i class="fa fa-pencil-square-o" style="color:orange"></i>',
                    array('action' => 'edit',$book['Book']['id']),
                    array('escape' => false)
                );
            ?>

        </td>
        <td><?php echo $book['Book']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($book); ?>
</table>