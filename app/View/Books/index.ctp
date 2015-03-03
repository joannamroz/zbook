<!-- File: /app/View/Books/index.ctp -->
<?php

//pr($books);die(); ?>
<h3>Last added:
<div style="margin-bottom:10px; width:100%">
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
</div></h3>

<?php  foreach ($books as $book): ?>
    <div class='div_books_container'>
        <div class='div_book_cover'>
            <div class='book_cover'><?php echo $this->Html->image($book['Book']['cover'], array('class'=>'book_img')); ?></div>

        </div>
        <div class='div_book_info'>
            <h3><?php echo $this->Html->link($book['Book']['title'],
array('controller' => 'books', 'action' => 'view', $book['Book']['id'])); ?></h3>
    <strong>Autor: </strong>
        <span><?php echo $this->Html->link($book['Author']['fullname'], array('controller' => 'authors', 'action' =>'view', $book['Author']['id'])); ?></span>
    <br>
    <strong>Category: </strong>
        <?php if (!empty($book['BookCategory'])){ 
            //pr($book['BookCategory']);
                        foreach ($book['BookCategory'] as $key => $category) {
                             echo $category['Category']['name'].' ';
                        }

                    } else { 
                        echo '-';
                    }  ?>
    <br><br><br>
    <?php if($book['Book']['avg_rating']!=0) { ?>
        <div clas="rateContainer">
            <div class="rateit" id="ratedBook" data-rateit-resetable="false"  data-rateit-step="1"  
                data-rateit-ispreset="true" 
                data-rateit-readonly="true"
                data-rateit-min="0" data-rateit-max="10" data-rateit-value="<?php echo $book['Book']['avg_rating']; ?>">
            </div>
            <div class="rateRight">
                <strong><?php echo $book['Book']['avg_rating'];?></strong><small><?php echo ' (Głosy:'.$book['Book']['rating_amount'].')';?></small>
            </div>
        </div>
    <?php 
    } else { ?>

        <div class="rateit notrrated" id="rateBook" data-rateit-resetable="false" data-rateit-step="1"  data-rateit-ispreset="true" 
            data-rateit-min="0" data-rateit-readonly="true" data-rateit-max="10" >
        </div>

    <?php } ?> 
    <br>
    <?php if (AuthComponent::user('role')=='admin') {
    ?>
    Edit:
            <?php 
                echo $this->Html->link(
                    '<i class="fa fa-pencil fa-fw " style="color:black"></i>',
                    array('action' => 'edit',$book['Book']['id']),
                    array('escape' => false)
                );
            ?>
    
    <br>
    Delete: <?php
                echo $this->Form->postLink(
                    '<i class="fa fa-trash-o fa-lg" style="color:black"></i>',
                    array('action' => 'delete', $book['Book']['id']),
                    // array('confirm' => 'Are you sure?'),
                    array('escape'=> false)
                    // array('confirm' => 'Are you sure?')

                );

        } ?>
        </div>
        
    </div>
<?php endforeach; ?>

