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
 * Main website's homepage.
 *
 */
 
session_start(); 
include('config.php');
include('includes/functions.php');
connect();

if(file_exists("./install.php") & !stristr($sitename, 'localhost')){
	die("Please open 'install.php' in your browser to install SnipsManager.<br />" . 
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
      <div class='extra'>   
		Assign Password? <input id="password" type="password" class="password" name="password" /><br />
		<label style="text-align:left;margin:5px 13px 0 0;">
			<input type="checkbox" id="captcha" name="captcha" />Ask for CAPTCHA verification
		</label>
      </div>

	<div class='bot'>   
		<select name="drop" class='drop'>
			<option value="1">PHP</option>
			<option value="2">Javascript</option>
			<option value="3">Text</option>
            <option value="5">C++</option>
            <option value="6">ActionScript</option>
            <option value="7">Apache</option>
            <option value="8">AppleScript</option>
            <option value="9">AWK</option>
            <option value="10">Bash</option>
            <option value="11">C</option>
            <option value="12">C#</option>
            <option value="13">CSS</option>
            <option value="14">Delphi</option>
            <option value="15">Fortran</option>
            <option value="16">Haskell</option>
            <option value="17">Java</option>
            <option value="18">jQuery</option>
            <option value="19">Modula-2</option>
            <option value="20">MySQL</option>
            <option value="21">Perl</option>
            <option value="22">Python</option>
            <option value="23">Ruby on Rails</option>
            <option value="24">Scheme</option>
            <option value="25">SQL</option>
            <option value="26">Visual Basic</option>
            <option value="27">Visual Basic .NET</option>
            <option value="28">Vim</option>
            <option value="29">XML</option>
			<option value="4">Other</option>
		</select>

		<a href="javascript:void(0);" onClick="submit_it();">
			<img alt="Share your source code now!" src="images/submit.png"/></a>      
	</div>	
</form>

<?php include("footer.php"); ?>