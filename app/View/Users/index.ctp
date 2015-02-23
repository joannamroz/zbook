<div>
<?php
echo '<table class="table table-bordered">
		<tr>
			<th>Nr </th>
			<th><strong>Users: </strong></th>
			
		</tr>';
		?>
<?php $lp=1; ?>
<?php  foreach ($users as $user ) :  ?>
		 <tr>
		 	<td><?php echo $lp ?></td>
		 	<td><?php echo $user['User']['username'] ?></td>
		 </tr>
 
<?php $lp++; 
 endforeach; 
echo '</table>';?>
<?php //pr($users); ?>

</div>
