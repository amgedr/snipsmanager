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

function ch_getsetting($settingname) {
	$result = mysql_query("SELECT * FROM settings WHERE settingname='" . $settingname . "'");
	$setting = mysql_fetch_array($result);
	
	if(mysql_num_rows($result)) {
		return $setting['settingvalue'];
	}
	else {
		return null;
	}
}

function ch_savesetting($settingname, $settingvalue) {
	mysql_query("UPDATE settings SET settingvalue='$settingvalue' WHERE settingname='$settingname'");
}

function ch_getsocialbookmarksfolders() {
	if ($handle = opendir('../images/sb')) {
		$selectedValue = ch_getsetting('iconset');		
		$filesList = '<select id="sbfolders" name="sbfolders" style="width: 100px;" onchange="refreshsbicons();">';
		
		while (false !== ($file = readdir($handle))) {
			if($file != "." & $file != "..") {				
				$filesList .= '<option ';
				
				if($file == $selectedValue)
					$filesList .= 'selected="selected" ';			
				
				$filesList .= 'value="'. $file . '">Group ' . $file . '</option>';
			}
		}
		
		$filesList .= '</select>';
		return $filesList;
	}
	else {
		return null;
	}
}

function ch_displaysocialbookmarks($currentTitle) {
	$iconSet = 	ch_getsetting('iconset');
	$currentUrl = urlencode($_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"]);
	
	$html = '<a href="http://digg.com/submit?phase=2&url=' . $currentUrl . '"><img src="images/sb/' . 
	$iconSet . '/digg.png" alt="Digg" title="Digg it!" /></a>' . 
	
	'<a href="http://del.icio.us/post?url=' . $currentUrl . '&title=' . $currentTitle . '"><img src="images/sb/' 
	. $iconSet . '/delicious.png" alt="Delicious" title="Bookmark in del.icio.us" /></a>'
	
	. '<a href="http://reddit.com/submit?url=' . $currentUrl . '&title=' . $currentTitle . 
	'"><img src="images/sb/' . $iconSet . '/reddit.png" alt="Reddit" title="Bookmark in Reddit" /></a>'
	
	. '<a href="http://technorati.com/cosmos/search.html?url=' . $currentUrl . '"><img src="images/sb/' . 
	$iconSet . '/technorati.png" alt="Technorati" title="Bookmark in Technorati" /></a>';
	
	echo $html;
}

function ch_displaysocialbookmarksonly() {
	$iconSet = ch_getsetting('iconset');
	
	$html = '<img src="../images/sb/' . $iconSet . '/digg.png" alt="Digg" title="Digg it!" />' . 	
	'<img src="../images/sb/' . $iconSet . '/delicious.png" alt="Delicious" title="Bookmark in del.icio.us" />' .
	'<img src="../images/sb/' . $iconSet . '/reddit.png" alt="Reddit" title="Bookmark in Reddit" />' .	
	'<img src="../images/sb/' . $iconSet . '/technorati.png" alt="Technorati" title="Bookmark in Technorati" />';
	
	return $html;
}

function ch_displaytopmenu() {
	$top1text = ch_getsetting('topmenu1text');
	$top1url = ch_getsetting('topmenu1url');
	$top2text = ch_getsetting('topmenu2text');
	$top2url = ch_getsetting('topmenu2url');
	$top3text = ch_getsetting('topmenu3text');
	$top3url = ch_getsetting('topmenu3url');
	$top4text = ch_getsetting('topmenu4text');
	$top4url = ch_getsetting('topmenu4url');

	$html = 
	'<ul>' .
    '<li><a href="' . ch_getsetting('topmenu1text') . '">' . ch_getsetting('topmenu1url') . '</a></li>' .
    '<li><a href="#">Contact</a></li>' .
    '</ul>';
	
	$html = '<ul>';
	
	if(!empty($top1text) & !empty($top1url))
		$html .= '<li><a href="' . $top1url . '">' . $top1text . '</a></li>';

	if(!empty($top2text) & !empty($top2url))
		$html .= '<li><a href="' . $top2url . '">' . $top2text . '</a></li>';
	
	if(!empty($top3text) & !empty($top3url))
		$html .= '<li><a href="' . $top3url . '">' . $top3text . '</a></li>';
	
	if(!empty($top4text) & !empty($top4url))
		$html .= '<li><a href="' . $top4url . '">' . $top4text . '</a></li>';
	
	$html .='</ul>';
	
	echo $html;
}

function ch_displaylogo() {
	$imageurl = ch_getsetting('logourl');
	$title = ch_getsetting('title');
	
	if(!empty($imageurl)) {
		$logo = '<img src="' . $imageurl . '" title="' . $title . '" alt="' . $title . '"/>';
		return $logo;
	}
	else {
		$heading = '<h1>' . $title . '</h1>';
		return $heading;
	}
}

// clean an input
function clean($value)
{  
  $value = strip_tags($value);   // strip html tags
  $value = stripslashes($value);  // strip slashes  
  $value = mysql_real_escape_string($value);  // strip mysql hacks  
  return $value;  // return clean string
}

//Get the total number of snippets in the codes table
function ch_gettotalsnippets() {
	$result = mysql_query("SELECT COUNT(*) FROM `codes`");
	list($total) = mysql_fetch_row($result);
	return $total;
}

//Get a snippet by its ID
function ch_getcode($id) {
	if(empty($id))
		return null;
		
	$result = mysql_query("SELECT `code` FROM `codes` WHERE `id`=" . $id);
	$row = mysql_fetch_array($result);
	
	if(mysql_num_rows($result)) {
		return $row['code'];
	}
	else {
		return null;
	}
}

//Get the code type by its ID
function ch_gettype($id) {
	$id = (int)$id;
	switch($id) {
		case 1:
			return 'PHP';
			break;
		case 2:
			return 'JavaScript';
			break;
		case 3:
			return 'Text';
			break;
		case 4:
			return 'C++';
			break;
		case 5:
			return 'Other';
			break;
		default:
			return 'Unknown';
			break;
	}
}
?>