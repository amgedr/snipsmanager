<?php 
/**
 * Copyright (c) 2010-2011 CodeHave (http://www.codehave.com/), All Rights Reserved
 * A CodeHill Creation (http://codehill.com/)
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
 * @copyright   2010-2011 CodeHill LLC (http://codehill.com/)
 * @license     http://www.codehave.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 * The moderation page (delete or modify listings).
 *
 */

session_start();
include('../config.php');
include('../includes/functions.php');
connect();

include('header.php');

require('../includes/login.class.php');
$loginSys = new LoginSystem();

// if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}?>

	<div class='sub'>
	    <span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
    	Moderate</div>

	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center>
<div class='textbox2'>

<script type="text/javascript" language="javascript" >
	function deleterow(id){
		if (confirm('Are you sure you want to delete this snippet?')) {
			$.post('../includes/delete.php', {id: +id},
				function(){
					$("#grid").load("moderategrid.php<?php if(!empty($_GET['page'])) echo "?page=" . $_GET['page']; ?>").fadeIn('slow');
				}
			);
		}
	}
	
	
	//display the code in a jQuery dialog
	function showCode(codeTitle, codeId, codeType) {
		var txt = '<h2>ID: ' + codeId + '</h2><br /><input type="text" id="codetitle" name="codetitle" value="' + 
			codeTitle + '" /><br /><textarea id="codeview" name="codeview"></textarea>';

		$.prompt(txt, { buttons: {Change:true, Cancel:false}, opacity: 0, 
			callback: function(v,m,f){ if(v){     
				$.post('moderatemodify.php', {id:codeId, codetitle:f.codetitle, code:f.codeview});
				$("#grid").load("moderategrid.php<?php if(!empty($_GET['page'])) echo "?page=" . $_GET['page']; ?>").fadeIn('slow');
			}}});
		$.get("moderatecode.php?id=" + codeId, function(data){ $('textarea#codeview').val(data); });
		
	}
</script>

<div id="grid">
	<?php include("moderategrid.php"); ?>
</div>

</div></center>
<div class='bottom'></div>

<?php include("footer.php"); ?>