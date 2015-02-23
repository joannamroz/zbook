<div style="float:left">
<?php //pr($haveNote);die(); ?>
<?php //pr($book);//die(); ?>

<h1><strong><?php echo '"'.h($book['Book']['title']).'"'; ?></strong><i  id="heart" class="fa fa-heart
<?php 

if( count($haveNote)>0) {
	if($haveNote[0]['Rating']['favourited']==1) { 
		echo 'highlight'; 
	} 
} 

?>" ></i></h1>

<?php echo $this->Html->link(
    'Add cover',
    array('controller' => 'books', 'action' => 'set_cover', $book['Book']['id']),
    array('class'=>'btn btn-default add-author')
    ); 

?>

<?php //pr($id_book); ?>
<h1><?php echo  $this->Html->link($book['Author']['fullname'], array('controller'=>'authors', 'action'=>'view', $book['Author']['id']));?></h1>
<?php
if (!empty($book['BookCategory'])) { ?>

  		<?php echo 'Category: ';
  		$book_categories=$book['BookCategory'];
  		//pr($book_categories);
  		foreach ($book_categories as $key => $category) {
  			echo '<span class="label label-warning">'.$category['Category']['name'].' </span>&nbsp; '  ;
  		}
  		?>
  		<?php
}  else  { ?>
    <h3><?php echo 'Category: -' ?></h3>    

<?php } ?>

<p><small style="color:lightgrey">Created: <?php echo $book['Book']['created']; ?></small></p>


<?php 
//jeśli otworzysz książkę która ma juz oceny      
if( count($haveNote)>0) { ?>

	<h3><strong><?php echo 'Twoja ocena: '.$haveNote[0]['Rating']['note']?></strong></h3>

	<div class="rateit" id="ratedBook" data-rateit-resetable="false"  data-rateit-step="1"  
		data-rateit-ispreset="true" 
		data-rateit-readonly="true"
		data-rateit-min="0" data-rateit-max="10" data-rateit-value="<?php echo $haveNote[0]['Rating']['note']; ?>">
	</div>

<?php 
//jesli otworzysz ksiazke ktora nie ma oceny
} else { ?>

	<div class="rateit" id="rateBook" data-rateit-resetable="false" data-rateit-step="1"  data-rateit-ispreset="true" 
	    data-rateit-min="0" data-rateit-max="10" >
	</div>

<?php } ?>


<?php
if (count($haveNote)>0) {?>
	<h3><strong><?php echo 'Średnia użytkowników: '.$haveNote[0]['Book']['avg_rating']?></strong></h3>
	<div class="rateit" id="ratedBook" data-rateit-resetable="false"  data-rateit-step="1"  
			data-rateit-ispreset="true" 
			data-rateit-readonly="true"
			data-rateit-min="0" data-rateit-max="10" data-rateit-value="<?php echo $haveNote[0]['Book']['avg_rating']; ?>">
	</div>
<?php }  ?>

<p><?php echo ''.$this->Html->link("<button class='btn btn-primary btn-lg ' style='margin-top:100px'>Back to all books</button>", array('action' => 'index'),array ('escape'=>false)).''; ?></p>
</div>
<div class="comments form" style="float:right;width:40%;border:2px solid grey">
<?php echo $this->Form->create('Comment'); ?>
	<fieldset style="margin-left:15px">
		<legend><?php echo __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->input('body', array('id'=>'komcio','label'=>false, 'placeholder'=>'Comment: '));
		
	?>
	 <?php echo $this->Form->end(array('label'=>__('Submit'),'class'=>'btn btn-default')); ?>
	</fieldset>
	
		<br>
		<br>
	<div id='zbiornik_komciow' style="margin-left:15px">
		<?php  foreach ($comments as $comment):
		//pr($comment);die();
		?> 
		<div><em><?php echo '" '.h($comment['Comment']['body']).' "' ;?></em></div>
		<p><?php echo h($comment['User']['fullname']) ?> <small><em><?php echo $comment['Comment']['created']?></em></small></p>
	<?php endforeach; ?>

	</div>
</div>
<script> 

var book_id=<?php echo $id_book; ?>;

</script>
