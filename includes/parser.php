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

include('../config.php');
include('cryptor.php');

$drop = $_POST['drop'];
connect();

//$code = htmlspecialchars($_POST['code']);
$code = htmlentities($_POST['code'], ENT_QUOTES);
$code = str_replace("\\", "&#92;", $code);   //replace backslashes to disable parsing of \n and \t
//$code = str_replace("'", "&#39;", $code);
$password = mysql_real_escape_string(htmlspecialchars(strip_tags($_POST['password'])));
$codetitle = htmlspecialchars($_POST['codetitle']);

$cryptor = new Cryptor();

$sqlInsert = "INSERT INTO codes (code, type, password, codetitle) VALUES ('" .
    $code . "', '" . $drop . "', '" . $cryptor->encrypt($password) . "', '" . $codetitle . "')";

$affected_rows = mysql_query($sqlInsert);

	


// *************** Beginning of debuging code
$f = fopen("debug.txt", 'a+');
fwrite($f, "\n\nBefore-> " . $_POST['code'] . "\nAfter-> " . $code); 
fwrite($f, "\nInsert-> " . $sqlInsert . "\nAffected Rows-> " . $affected_rows);
fclose($f);
// *************** End of debuging code


	
	
function check_values()
{
	global $sitename;	
	$id = mysql_insert_id();	
	$result = mysql_query("SELECT * FROM codes WHERE id='".$id."'") or die(mysql_error());
    $row = mysql_fetch_array($result);	
	echo "<center>Share URL: <input id='share' class='text' type='text' value='" . 
	    $sitename . "show.php?id=".$row['id']."'/></center>";	
}

check_values();
?>