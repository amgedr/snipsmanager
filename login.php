<?php
/**
 * Copyright (c) 2010-2011 CodeHave (http://www.codehave.com/), All Rights Reserved
 * A CodeHill Creation (http://www.codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of CodeHave's owners. Please contact the author for more information.
 * 
 * - Link to codehave.com may not be removed from the software pages without permission of CodeHave's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.codehave.com/license/
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
 * @link        http://www.codehave.com/
 * @copyright   2010-2011 CodeHill LLC (http://www.codehill.com/)
 * @license     http://www.codehave.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 */

session_start();
include('config.php');
include('includes/functions.php');
include('includes/cryptor.php');
connect();

include('header.php');

if(empty($_GET['id'])) {
	//die('Error: Please enter an ID!');
	?>
<div class="work">
<div class='sub'></div>

<div class='body'>
<div id='error' style="display:block;">Please enter an ID</div>
    
    <?php
}
else {	
	$id = mysql_real_escape_string(htmlspecialchars(strip_tags($_GET['id'])));
	
	if(isset($_POST['submit']))	{
		$password = mysql_real_escape_string(htmlspecialchars(strip_tags($_POST['password'])));
		
		if(empty($password)) {
			$error = 'Please enter a password!';
		}
		else {
			$result = mysql_query("SELECT * FROM codes WHERE id = '".$id."'");
            $row = mysql_fetch_array($result);
			
			$cryptor = new Cryptor;
			$password = $cryptor->encrypt($password);
			
			if($row['password']!=$password)	{
				$error = 'Wrong password!';
			}
			else {
				$_SESSION['pages'] = $id;
				die("<html><head><script>window.location='show.php?id=$id';</script></head></html>");
			}
		}
	}
?>

<div class="work">
<div class='sub'>
      Viewing #<?php echo $id;?> (PASSWORD PROTECTED !)
</div>

<div class='body'>
<div id='error'></div>
   <div class='top'></div>   
   <center><div class='textbox2' name="gottaload">
   
	<form method="post">   
        <span style="color:#FF0000; font-weight:bold;"><?php if(isset($error)){ echo "$error<br />"; } ?></span>
       
        Please enter the correct password to access the file : <br />
        <input type="password" class="password" name="password" />        
        <input type="submit" name="submit" value="Submit!" />
	</form>
   
   </div></center>   
   <div class='bottom'></div>

<?php }
include('footer.php');
?>