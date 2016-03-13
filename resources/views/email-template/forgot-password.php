<?php
	include_once('mail-header.php');
?>

You recently requested a password reset.<br>
 
To change your ServEaseMe password, 
click <a href="<?php  echo $reset_link; ?>"> here</a> or paste the following link
 into your browser: 
 <?php
 	echo $reset_link;

  ?>
 
The link will expire in 24 hours, so be sure to use it right away.
 




<?php
	include_once('mail-footer.php');
?>
