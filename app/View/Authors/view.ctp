<div style="float:right; width:183px; height:236px;margin:5px;padding:5px"><?php echo $this->Html->image($author['Author']['photo']);?>
	<div>
		<p><?php echo $this->Html->link('Change photo',array(
						'controller' => 'authors', 'action' => 'add_photo', $author['Author']['id']),
					    array(
					    	'class'=>'btn btn-default addCover')
					    ); ?></p>
	</div>
</div>

<h2><?php echo h($author['Author']['fullname']); ?></h2>
<h5>Born: <?php echo h($author['Author']['born']);?></h5>
<!-- <h4>Died: <?php //echo h($author['Author']['died']);?></h4> -->
<h5>Description:<br></h5><p><?php echo h($author['Author']['description']);?><span id="showMore">[...More]</span><span id="author_more"><?php echo '[...'.$this->Html->link($author['Author']['more_link']).']';?></span> </p>
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
			<td><?php echo '<cite>'.$this->Html->link($book['Book']['title'], array('controller'=>'books', 'action'=>'view', $book['Book']['id'])).'</cite>'; ?></td>
			
		</tr>
		<?php $lp++;?>
		<?php endforeach; ?>
	</table>
	<?php
}  ?>
<div style="width:10%; float:left; margin-right:30px">
	<p><?php echo '<button class="btn " role="button">'.$this->Html->link("Back to all books", array('controller'=>'books', 'action'=>'index')).'</button>'; ?></p>
</div>
<div style="width:10%; float:left; margin-right:30px">
	<p><?php echo '<button class="btn " role="button">'.$this->Html->link("Other authors", array('controller'=>'authors', 'action'=>'index')).'</button>'; ?></p>
</div>
<div style="width:10%; float:left">
	<p><?php echo '<button class="btn" role="button">'.$this->Html->link("Edit Author", array('controller'=>'authors', 'action'=>'edit', $author['Author']['id'])).'</button>'; ?></p>
</div>