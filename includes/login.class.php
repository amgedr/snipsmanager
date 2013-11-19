<?php
class LoginSystem
{
	var	$db_host,
		$db_name,
		$db_user,
		$db_password,
		$connection,
		$username,
		$password;

	/**
	 * Constructor
	 */
	function LoginSystem() {

	}

	/**
	 * Check if the user is logged in
	 *
	 * @return true or false
	 */
	function isLoggedIn() {
		if(isset($_SESSION['LoggedIn'])) {
			return true;
		}
		else
			return false;
	}

	/**
	 * Check username and password against DB
	 *
	 * @return true/false
	 */
	function doLogin($username, $password) {
		$this->connectdb();

		$this->username = $username;
		$this->password = $password;

		// check db for user and pass here.
		$sql = sprintf("SELECT * FROM admins WHERE UserName = '%s' and Password = '%s'",
											$this->clean($this->username), md5($this->clean($this->password)));

		$result = mysql_query($sql);

		// If no user/password combo exists return false
		if(mysql_affected_rows() != 1) {
			return false;
		}
		else {  // matching login ok

			$row = mysql_fetch_assoc($result);
			session_regenerate_id();   // more secure to regenerate a new id.

			//set session vars up
			$_SESSION['LoggedIn'] = true;
			$_SESSION['userName'] = $this->username;
		}

		//$this->disconnect();
		return true;
	}

	/**
	 * Destroy session data/Logout.
	 */
	function logout() {
		unset($_SESSION['LoggedIn']);
		unset($_SESSION['userName']);
		session_destroy();
	}

	/**
	 * Connect to the Database
	 *
	 * @return true/false
	 */
	function connectdb()
	{
		if($this->connection) {
			return true;
		}
		else
			return false;
	}

	/**
	 * Disconnect from the db
	 */
	function disconnect()
	{
		mysql_close($this->connection);
	}

	/**
	 * Cleans a string for input into a MySQL Database.
	 * Gets rid of unwanted characters/SQL injection etc.
	 *
	 * @return string
	 */
	function clean($str) {
		// Only remove slashes if it's already been slashed by PHP
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}

		$str = mysql_real_escape_string($str);  // Let MySQL remove nasty characters.

		return $str;
	}

	/**
	 * create a random password
	 *
	 * @param	int $length - length of the returned password
	 * @return	string - password
	 *
	 */
	public static function randomPassword($length = 8) {
		$pass = "";

		// possible password chars.
		$chars = array("a","A","b","B","c","C","d","D","e","E","f","F","g","G","h","H","i","I","j","J",
			   "k","K","l","L","m","M","n","N","o","O","p","P","q","Q","r","R","s","S","t","T",
			   "u","U","v","V","w","W","x","X","y","Y","z","Z","1","2","3","4","5","6","7","8","9");

		for($i=0 ; $i < $length ; $i++)	{
			$pass .= $chars[mt_rand(0, count($chars) -1)];
		}

		return $pass;
	}

	/**
	 * check if password is correct. use after the user has logged in
	 *
	 * @param	$password - the password to compare to the current user's
	 * @return	boolean - true if the password is correct, false otherwise
	 *
	 */
	function checkPassword($password) {
		// check db for user and pass here.
		$sql = sprintf("SELECT * FROM admins WHERE UserName = '%s' and Password = '%s'",
											$_SESSION['userName'], md5($this->clean($password)));

		$result = mysql_query($sql);

		if(mysql_affected_rows() != 1) {   // If no user/password combo exists return false
			return false;
		}
		else {  // matching login ok
			return true;
		}
	}

	/**
	 * Change the user's password. use after the user has logged in
	 *
	 * @param	$newpassword - the new password to change to
	 * @return	boolean - true if the password was changed, false otherwise
	 *
	 */
	function changePassword($newpassword) {
		$sql = sprintf("UPDATE `admins` SET `Password` = '%s' WHERE `admins`.`UserName` = '%s' LIMIT 1",
											md5($this->clean($newpassword)), $_SESSION['userName']);

		$result = mysql_query($sql);

		if(mysql_affected_rows() != 1) {   // If no user/password combo exists return false
			return false;
		}
		else {  // matching login ok
			return true;
		}
	}

	/**
	 * Change the user's password. Static method
	 *
	 * @param	$newpassword - the new password to change to
	 * @return	boolean - true if the password was changed, false otherwise
	 *
	 */
	public static function forgotPassword($username) {
		$newpassword = LoginSystem::randomPassword();

		$sql = sprintf("UPDATE `admins` SET `Password` = '%s' WHERE" .
			" `admins`.`UserName` = '%s' LIMIT 1", md5($newpassword), $username);
		$result = mysql_query($sql);

		if(mysql_affected_rows() != 1) {
			return false;
		}
		else {
			if(LoginSystem::sendPassword($username, $newpassword)) {
				return true;
			}
			else {
				return false;
			}
		}
	}

	/**
	 * Send the user his/her password. use after the user has logged in
	 *
	 * @param	$username - the
	 * @param	$newpassword - the new password to change to
	 * @return	boolean - true if the password was changed, false otherwise
	 *
	 */
	public static function sendPassword($username, $password) {
		$send_date = date('d-m-Y H:i:s');

		$message = '<html><head><title>[SnipsManager] New Password</title></head><body><p><tt>Send Date: ' .
			$send_date .
			'</tt></p><table><tr><td><tt> Username: ' . $username . ' </tt></td></tr><tr>' .
			'<td><tt> Password:' . $password . '</tt></td></tr></table></body></html>';

		include('phpmailer/class.phpmailer.php');

		$mail = new PHPMailer();
		$mail->AddReplyTo(ch_getsetting('owneremail'), ch_getsetting('ownername'));
		$mail->SetFrom(ch_getsetting('owneremail'), ch_getsetting('ownername'));
		$mail->AddReplyTo(ch_getsetting('owneremail'), ch_getsetting('ownername'));
		$mail->AddAddress(ch_getsetting('owneremail'), ch_getsetting('ownername'));

		$mail->Subject    = "[SnipsManager] New password";
		$mail->AltBody    = "Username: " . $username . "\nPassword" . $password;
		$mail->MsgHTML($message);

		if(!$mail->Send()) {
			return false;
		}
		else {
			return true;
		}
	}
}

?>