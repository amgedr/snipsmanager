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
connect();

if(file_exists("./install.php")){
	die("Please open 'install.php' in your browser to install CodeHave.<br />" . 
		"When you finish installing the script delete the file 'install.php'!");
}

include('header.php');
?>


	<div class='sub'>
		<span><a href="javascript:void(0);" onClick="extra();">Extra settings</a></span>
		Add your code
	</div>

	<div class='body'>
		<div id='error'></div>

<form method="post">
	<div class='top3'></div>
    <center><input type="text" name="codetitle" id="codetitle" maxlength="200" /></center>
    <div class='bottom3'></div>
    <br />    
    
	<div class='top'></div>
	<center><textarea name="code" class="resizable" id="code"></textarea></center>   
	<!--<div class='bottom'></div>-->
      <div class='extra'>   
          Assign Password? <input id="password" type="password" class="password" name="password" />
      </div>

	<div class='bot'>   
		<select name="drop" class='drop'>
			<option value="1">PHP</option>
			<option value="2">Javascript</option>
			<option value="3">Text</option>
			<option value="4">Other</option>
		</select>
		<a href="javascript:void(0);" onClick="submit_it();">
			<img alt="Share your source code now!" src="images/submit.png"/></a>      
	</div>      
</form>

<?php include("footer.php"); ?>