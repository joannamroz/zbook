
<table class="table table-bordered">
    <tr>
        <th>Nr</th>
        <th>Title</th>
        <th>Author</th>
        <th>Rating</th>
        <th>Favourited</th>
    </tr>

    <!-- Here is where we loop through our $books array, printing out book info -->
    <?php //pr($user_books);die(); ?>
    
    <?php $lp=1; ?>
    <?php  foreach ($user_books as $book): ?>
    
    <tr>
        <td><?php echo $lp; ?></td>
        <td><em>
            <?php echo $this->Html->link($book['Book']['title'],
array('controller' => 'books', 'action' => 'view', $book['Book']['id'])); ?></em>
        </td>
        <td><?php echo $this->Html->link($book['Book']['Author']['fullname'], array('controller' => 'authors', 'action' =>'view', $book['Book']['Author']['id'])); ?></td>
        <td> <?php echo h($book['Rating']['note']);?></td>
        <td><?php if($book['Rating']['favourited']==1){ echo '<i  id="heart" class="fa fa-heart highlight"></i>';} else { echo '<i  id="heart" class="fa fa-heart"></i>'; } ?></td>
    </tr>
    <?php $lp++;?>
    <?php endforeach; ?>
    <?php unset($book); ?>
</table>