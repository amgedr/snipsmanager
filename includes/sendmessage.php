<?php
/**
 * Copyright (c) 2010-2011 SnipsManager (http://www.snipsmanager.com/), All Rights Reserved
 * A CodeHill Creation (http://codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of SnipsManager's owners. Please contact the author for more information.
 * 
 * - Link to snipsmanager.com may not be removed from the software pages without permission of SnipsManager's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.snipsmanager.com/license/
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR 
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND 
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY
 * WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @link        http://www.snipsmanager.com/
 * @copyright   2010-2011 CodeHill LLC (http://codehill.com/)
 * @license     http://www.snipsmanager.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 * Send the contact form's contents to admin's email using PHPMailer.
 *
 */

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