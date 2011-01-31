function refreshsbicons() {
	var c = document.form1.sbfolders.selectedIndex;
	c++;
	
	$.post("getsbicons.php", {iconset:c}, function(data){$("#sbicons").html(data);});	
}

function saveallsettings() {
	var t=$("#sitetitle").val();
	var s=$("#slogan").val();
	var l=$("#logourl").val();
	var d=$("#metadescription").val();
	var k=$("#metakeywords").val();
	var n=$("#ownername").val();
	var e=$("#owneremail").val();
	
	var t1=$("#item1text").val();
	var u1=$("#item1url").val();
	var t2=$("#item2text").val();
	var u2=$("#item2url").val();
	var t3=$("#item3text").val();
	var u3=$("#item3url").val();
	var t4=$("#item4text").val();
	var u4=$("#item4url").val();
	
	var sb=$("#sbfolders").val();
	
	$.post("../includes/saveallsettings.php", { sitetitle:t, slogan:s, logourl:l, metadescription:d, 
		metakeywords:k, ownername:n, owneremail:e , item1text:t1, item1url:u1, item2text:t2, item2url:u2,
		item3text:t3, item3url:u3, item4text:t4, item4url:u4, sbfolders:sb});
}