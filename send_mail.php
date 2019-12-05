<?php
echo "UFF";
$to_email = 'manker1@grg21oe.at';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: noreply @ grumpf . com';
mail($to_email,$subject,$message,$headers);
echo "OOF";
?>
