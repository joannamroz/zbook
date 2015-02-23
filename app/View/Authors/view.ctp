<h1><?php echo h($author['Author']['fullname']); ?></h1>
<h4>Date of birth: <?php echo h($author['Author']['date_of_birth']);?></h4>
<p><small>Created: <?php echo $author['Author']['created']; ?></small></p>
<?php 
if(!empty($books))  { ?>
	<h4 style="margin-top:20px"><?php echo h($author['Author']['fullname'])."'s Books:";?></h4>
	<table class="table table-bordered" style="margin-top:10px; width:40%">
		
		<tr>
			<th style="width:5%">Nr</th>
			<th>Title</th>
		</tr>
		<?php $lp=1; ?>
		<?php foreach ($books as $book):?>
		<tr>		
			<td><?php  echo $lp ;?></td>
			<td><?php echo '"'.$this->Html->link($book['Book']['title'], array('controller'=>'books', 'action'=>'view', $book['Book']['id'])).'"'; ?></td>
			
		</tr>
		<?php $lp++;?>
		<?php endforeach; ?>
	</table>
	<?php
}  ?>
<div style="width:10%; float:left; margin-right:30px">
	<p><?php echo '<button class="btn " role="button">'.$this->Html->link("Back to all books", array('controller'=>'books', 'action'=>'index')).'</button>'; ?></p>
</div>
<div style="width:10%; float:left">
	<p><?php echo '<button class="btn" role="button">'.$this->Html->link("Edit Author", array('controller'=>'authors', 'action'=>'edit', $author['Author']['id'])).'</button>'; ?></p>
</div>