<?php
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
<table class="hor-minimalist" style="width:100%;" >
<thead>
	<tr>
	<!--	<th class="tabletitle" style="width:25px;"><input type="checkbox" id="checkboxall" onchange="selectAll(this.checked)" /></th>-->
		<th style="width:40px;">ID</th>
		<th>Title</th>
		<th style="width:125px;">Date</th>
		<th style="width:40px;"></th>
	</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="5">
			<table style="width:100%;">
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
							$pagingStart = $pageNum > 5? $pageNum - 5 : 1;
							$pagingEnd = $totalPages < ($pageNum + 5)? $totalPages : $pageNum + 5;

							for($c=$pagingStart ; $c<=$pagingEnd ; $c++) {
								if($c == $pageNum) {
									echo '<strong>' . $c . '</strong>';
								} else {
									echo '<a href="moderate.php?page=' . $c . '">' . $c . '</a>';
								}

								if($c < $totalPages)
									echo "&nbsp;&nbsp;";
								else
									break;
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
</tfoot>
<tbody>
	<?php while($row = mysql_fetch_array($listings)) {?>
	<tr>
		<!--<td><input type="checkbox" id="check<?php echo $row['id']; ?>" /></td>-->
		<td>
			<a onclick="showCode('<?php echo $row['codetitle']; ?>', <?php echo $row['id']; ?>, '<?php echo ch_gettype($row['type'], false); ?>')"
				style="cursor:pointer;" title="Edit Snippet">
				<?php echo $row['id']; ?>
			</a>
		</td>
		<td><?php echo $row['codetitle']; if(!empty($row['password'])) { ?>
			<img src="../images/lock.png" title="Password Protected" style="float:right;" /><?php } ?></td>
		<td><?php echo $row['submitdate']; ?></td>
		<td>
			<a onclick="showCode('<?php echo $row['codetitle']; ?>', <?php echo $row['id']; ?>, '<?php echo ch_gettype($row['type'], false); ?>')"
				style="cursor:pointer;">
				<img src="../images/moderate/edit.png" alt="Edit" style="padding-right:3px;" />
			</a>
			<a  onclick="deleterow(<?php echo $row['id']; ?>)" style="cursor:pointer;">
				<img src="../images/moderate/delete.png" title="Delete Snippet" alt="Delete" />
			</a>
		</td>
	</tr>
	<?php } ?>
</tbody>
</table>
</form>