<div>
<?php
echo '<table>
		<tr><td>Uzytkownicy</td></tr>';
 foreach ($users as $user ) {

  ?>
 <tr>
 	<td><?php echo $user['User']['username'] ?></td>
 </tr>

 <?php	
 }
 echo '</table>';
//pr($users);
?>
</div>