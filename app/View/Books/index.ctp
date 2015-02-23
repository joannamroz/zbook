<!-- File: /app/View/Books/index.ctp -->
<?php

//pr($books);die(); ?>
<h2>Last added:<div style="margin-bottom:10px; width:100%">
    <div style="float:right">


<?php echo $this->Html->link(
    'Add Book',
    array('controller' => 'books', 'action' => 'add'),
    array('class'=>'btn btn-default')
    ); $nbsp;

?>
<?php echo $this->Html->link(
    'Add Author',
    array('controller' => 'authors', 'action' => 'add'),
    array('class'=>'btn btn-default add-author')
    ); 

?>
    </div>
</div></h2>

<?php  foreach ($books as $book): ?>
    <div class='div_books_container'>
        <div class='div_book_cover'>
            <div class='book_cover'><?php echo $this->Html->image($book['Book']['cover'], array('class'=>'book_img')); ?></div>

        </div>
        <div class='div_book_info'>
            <h3><?php echo $this->Html->link($book['Book']['title'],
array('controller' => 'books', 'action' => 'view', $book['Book']['id'])); ?></h3>
    Autor: <span><?php echo $this->Html->link($book['Author']['fullname'], array('controller' => 'authors', 'action' =>'view', $book['Author']['id'])); ?></span>
    <br>
    Rating: <strong><?php echo $book['Book']['avg_rating'];?></strong><small><?php echo ' (Głosy:'.$book['Book']['rating_amount'].')';?></small>
    <br>
    Category:<?php if (!empty($book['BookCategory'])){ 
            //pr($book['BookCategory']);
                        foreach ($book['BookCategory'] as $key => $category) {
                             echo $category['Category']['name'].' ';
                        }

                    } else { 
                        echo '-';
                    }  ?>
    <br>
    Edytuj:
            <?php
            
                echo $this->Html->link(
                    '<i class="fa fa-pencil-square-o" style="color:orange"></i>',
                    array('action' => 'edit',$book['Book']['id']),
                    array('escape' => false)
                );
            ?>
    
    <br>
    Usuń: <?php
                echo $this->Form->postLink(
                    '<i class="fa fa-times" style="color:red"></i>',
                    array('action' => 'delete', $book['Book']['id']),
                    // array('confirm' => 'Are you sure?'),
                    array('escape'=> false)
                    // array('confirm' => 'Are you sure?')

                );
            ?>


        </div>
        
    </div>
<?php endforeach; ?>

