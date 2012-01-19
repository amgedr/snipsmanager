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
 * Displays a snippet with code highlighting.
 *
 */


session_start(); 
include('config.php');
include('includes/functions.php');
connect();

if(!empty($_GET['id'])) {
	$id = mysql_real_escape_string(htmlspecialchars(strip_tags($_GET['id'])));
} else {
	$id = 0;	
}
		
if(ch_codeexists($id)) { 
	if(ch_getcodepassword($id) != NULL) {
		if($_SESSION['pages']!=$id)	{
			echo '<script type="text/javascript">window.location="login.php?id='.$id.'";</script>';
		}
	}
	elseif(ch_getcodecaptcha($id)) {
		if($_SESSION['pages']!=$id) {
			header('location:captcha.php?id=' . $id);			
		}
	}	

	$type = ch_gettype(ch_getcodetype($id), false);
	
	include_once 'includes/geshi.php';
	$source = ch_formatCodeForDisplaying(ch_getcode($id));
	
	$geshi = new GeSHi($source, $type);
	$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
	$geshi->set_line_style('background: #fcfcfc;', 'background: #f0f0f0;');
	$geshi->set_header_type(GESHI_HEADER_DIV);
	$geshi->set_tab_width(5);
	$geshi->enable_classes();
	$geshi->set_overall_id('mycode');

	$found=true;
	
	$additional_script_tags = '<style type="text/css">' . $geshi->get_stylesheet() . '</style>';
} 
else { 
    $found=false;
}

include('header.php');
?>


<div class='work'>
    <div class='sub'>    
	<?php if($found) { ?>
        <span>Type: <?php echo ch_gettype(ch_getcodetype($id), true);?></span>
           Viewing #<?php echo $id;?>
	<?php } ?>
    </div>
<div class='body'>
	
	<?php 
		if(!$found) {
			echo "<div id='error' style='display:block;'>Error! That code ID does not exist!</div>"; 
		} 
		else {
	?>
			
	<div id='error'></div>
	<div class='top3'></div>
    <center><div class="textbox1"><?php echo ch_getcodetitle($id); // $row['codetitle']; ?></div></center>
    <div class='bottom3'></div>

	<br />

	<div class='top'></div>   
	<center><div class='textbox2' id="snippet"><?php if($found) { echo $geshi->parse_code(); } ?></div></center>   
	<div class='bottom'></div>
  
    <div class='bot2'>
<script type="text/javascript">
	function fnSelect(objId) {
		fnDeSelect();
		if (document.selection) {
		var range = document.body.createTextRange();
 	        range.moveToElementText(document.getElementById(objId));
		range.select();
		}
		else if (window.getSelection) {
		var range = document.createRange();
		range.selectNode(document.getElementById(objId));
		window.getSelection().addRange(range);
		}
	}
		
	function fnDeSelect() {
		if (document.selection) document.selection.empty(); 
		else if (window.getSelection)
                window.getSelection().removeAllRanges();
	}
</script>	
        <form method="post" name="download" action="includes/download.php">
            <input type="hidden" value="<?=$id;?>" name="id"  />
            <input type="hidden" value="<?= ch_getcodepassword($id)?>" name="passwd"  />
            <input type="image" style="padding-left:10px;" src="images/source.png" alt="Download Source" title="Download snippet in a text file" />
			<a href="javascript:fnSelect('snippet');">
				<img src="images/selectall.png" alt="Select Snippet" title="Select the snippet" />
			</a>
	        <div style="float:right; padding-right:10px; text-align:right; width:185px;">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				</div>
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
				<!-- AddThis Button END -->
			</div>
        </form>        
    </div>

<?php 
	}
include("footer.php"); ?>