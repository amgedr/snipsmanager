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
 * Displays a paginated grid containing a list of all snippets submitted and an edit and delete links.
 *
 */

include_once('../config.php');
include_once('../includes/functions.php');
connect();
 
if(isset($_GET['page'])) {
	$pageNum = $_GET['page']; 
} else {
	$pageNum = 1;
}

$rowsPerPage = 20;
$offset = ($pageNum - 1) * $rowsPerPage;  //calculate current page
$totalRows = ch_gettotalsnippets();    //get total number of records in table codes

//calculate the total number of pages the rows are divided into. Used ceil() to round it to the next
//highest number, e.g. 24 rows divided it into 20 rows per page will return 3 and not 2 
$totalPages = ceil($totalRows/$rowsPerPage);

$listings = mysql_query("SELECT * FROM `codes` order by `id` LIMIT $offset, $rowsPerPage");	
?>

<form>
<table style="border:1px solid #999; width:100%;">
<tr>
<!--	<th class="tabletitle" style="width:25px;"><input type="checkbox" id="checkboxall" onchange="selectAll(this.checked)" /></th>-->
	<th class="tabletitle" style="width:40px;">ID</th>
	<th class="tabletitle">Title</th>
    <th class="tabletitle" style="width:125px;">Date</th>
    <th class="tabletitle" style="width:44px;"></th>
</tr>

<?php while($row = mysql_fetch_array($listings)) {?>
<tr>
<!--	<td class="tablerow"><input type="checkbox" id="check<?php echo $row['id']; ?>" class="checkboxes" /></td>-->
    <td class="tablerow"><?php echo $row['id']; ?></td>
    <td class="tablerow"><?php echo $row['codetitle']; if(!empty($row['password'])) { ?>
    	<img src="../images/lock.png" title="Password Protected" style="float:right;" /><?php } ?></td>
    <td class="tablerow"><?php echo $row['submitdate']; ?></td>
    <th class="tablerow" style="text-align:center; padding-left:0 !important;">
    	<a onclick="showCode('<?php echo $row['codetitle']; ?>', <?php echo $row['id']; ?>, '<?php echo ch_gettype($row['type'], false); ?>')">
			<img src="../images/moderate/edit.png" title="Edit Snippet" alt="Edit" style="padding-right:3px;" />
		</a>
        <a  onclick="deleterow(<?php echo $row['id']; ?>)">
        	<img src="../images/moderate/delete.png" title="Delete Snippet" alt="Delete" />
		</a>
	</th>
</tr>
<?php } ?>

<tr>
	<td colspan="5" class="tabletitle">
    	<table>
        	<tr>
            	<td class="tablenav">
                	<?php
						if($pageNum > 1) {
							echo '<a href="moderate.php?page=1">First</a>';	
						} else {
							echo 'First';
						}
					?>
                </td>
                <td class="tablenav">
                	<?php
						if($pageNum > 1) {
							echo '<a href="moderate.php?page=' . ($pageNum - 1) . '">Prev</a>';
						} else {
							echo 'Prev';
						}
					?>
                </td>
                <td class="tablenav" style="width: 350px;">
                	<?php
						for($c=1 ; $c<=$totalPages ; $c++) {
							if($c == $pageNum) {
								echo '<strong>' . $c . '</strong>';
							} else {
								echo '<a href="moderate.php?page=' . $c . '">' . $c . '</a>';
							}
							
							if($c < $totalPages)
								echo "&nbsp;&nbsp;";
						}
					?>
                </td>
                <td class="tablenav">
                	<?php
						if($pageNum < $totalPages) {
							echo '<a href="moderate.php?page=' . ($pageNum + 1) . '">Next</a>';
						} else {
							echo 'Next';
						}					
					?>
                </td>
                <td class="tablenav">
                	<?php
						if($pageNum < $totalPages) {
							echo '<a href="moderate.php?page=' . $totalPages . '">Last</a>';
						} else {
							echo 'Last';
						}					
					?>
                </td>
			</tr>
		</table>
    </td>
</tr>
</table>
</form>