<?php
	$iconSet = $_POST['iconset'];
	
	$html = '<img src="../images/sb/' . $iconSet . '/digg.png" alt="Digg" title="Digg it!" />' . 	
	'<img src="../images/sb/' . $iconSet . '/delicious.png" alt="Delicious" title="Bookmark in del.icio.us" />' .
	'<img src="../images/sb/' . $iconSet . '/reddit.png" alt="Reddit" title="Bookmark in Reddit" />' .	
	'<img src="../images/sb/' . $iconSet . '/technorati.png" alt="Technorati" title="Bookmark in Technorati" />';
	
	echo $html;
?>