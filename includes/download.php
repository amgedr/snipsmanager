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
 * Downloads a code snippet in file with the extension of it's type.
 *
 */
 

//download a text file containing the string passed and using the file name and extension passed

header("Content-type: application/octet-stream");

session_start(); 
include('../config.php');
include('functions.php');
connect();

if($_POST['passwd'] != '')
	$result = mysql_query("SELECT * FROM codes WHERE id = '" . $_POST['id'] . "' AND password = '" . $_POST['passwd'] . "'");
else
	$result = mysql_query("SELECT * FROM codes WHERE id = '" . $_POST['id'] . "'");
	
$row = mysql_fetch_array($result);
		
if(mysql_num_rows($result)) { 
	if($row['type']=='1') { 
		$extension="php";
	}
	elseif($row['type']=='2') {
		$extension="js";
	}
	elseif($row['type']=='3') {
		$extension="txt";
	}
	elseif($row['type']=='4') {
		$extension="cpp";
	}
	elseif($row['type']=='5') {
		$extension="";
	}
}

header("Content-Disposition: attachment; filename=\"sourcefile." . $extension . "\"");
		
if(mysql_num_rows($result)) {
	echo html_entity_decode($row['code'], ENT_QUOTES); 
}
?>