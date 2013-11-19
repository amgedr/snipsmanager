<?php
session_start();
include('../config.php');
include('functions.php');
connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(empty($_POST['email']) || empty($_POST['name']) || empty($_POST['message'])) {
		echo 'Complete the forms correctly.';
	} else {
		$send_date = date('d-m-Y H:i:s');
		$message = '<html><head><title>Contact</title></head><body><p>Send Date: ' . $send_date .
			'</p><table><tr><td> Name: ' . $_POST['name'] . ' </td></tr><tr>' .
			'<td> Email: <a href="mailto:' . $_POST['email'] . '" mce_href="mailto:' .
			$_POST['email'] . '">' . $_POST['email'] . '</a> </td></tr><tr><td> Message: ' .
			'<br><br> ' . $_POST['message'] . ' </td></tr></table></body></html>';

		include('phpmailer/class.phpmailer.php');

		$mail = new PHPMailer();
		$mail->SetFrom($_POST['email'], $_POST['name']);
		$mail->AddAddress(ch_getsetting('owneremail'), ch_getsetting('ownername'));

		$mail->Subject    = "[SnipsManager] Feedback from Contact Page";
		$mail->AltBody    = "Name: " . $_POST['name'] . "\nEmail: " . $_POST['email'] .
			"\nMessage:\n" . $_POST['message'];
		$mail->MsgHTML($message);
?>
<center><strong>

<?php
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Contact message sent.";
		}
?>

</strong></center>

<?php
	}
}
?>