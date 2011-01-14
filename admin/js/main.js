function refreshsbicons() {
	var c = document.form1.sbfolders.selectedIndex;
	c++;
	
	$.post("getsbicons.php", {iconset:c}, function(data){$("#sbicons").html(data);});	
}