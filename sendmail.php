<script>
function clearForms()
{
  var i;
  for (i = 0; (i < document.forms.length); i++) {
    document.forms[i].reset();
  }
  $('.alert-box.success').fadeOut(200);
}
</script>
<?php
	
	$name = trim($_POST['name']);
	$email = $_POST['email'];
	$comments = $_POST['comments'];
	
	$site_owners_email = 'support@easyliker.com'; // Replace this with your own email address
	$site_owners_name = 'Easyliker'; // replace with your name
	
	if (strlen($name) < 2) {
		$error['name'] = "Please enter your name";	
	}
	
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address";	
	}
	
	if (strlen($comments) < 3) {
		$error['comments'] = "Please leave a message.";
	}
	
	if (!$error) {
		
		require_once('phpMailer/class.phpmailer.php');
		$mail = new PHPMailer();
		
		$mail->From = $email;
		$mail->FromName = $name;
		$mail->Subject = "Contact Form";
		$mail->AddAddress($site_owners_email, $site_owners_name);
		$mail->Body = $comments;
		
		$mail->Send();
		
		echo "<div data-alert class='alert-box success'>Thanks " . $name . ". Your message has been sent.<a href='#' class='close' onclick='clearForms()'>&times;</a></div>";
		
	} # end if no error
	else {

		$response = (isset($error['name'])) ? "<div class='alert-box alert'>" . $error['name'] . "</div> \n" : null;
		$response .= (isset($error['email'])) ? "<div class='alert-box alert'>" . $error['email'] . "</div> \n" : null;
		$response .= (isset($error['comments'])) ? "<div class='alert-box alert'>" . $error['comments'] . "</div>" : null;
		
		echo $response;
	} # end if there was an error sending

?>