<?php
session_start();
include('../config.php');
include('../includes/functions.php');
connect();

require('../includes/login.class.php');
$loginSys = new LoginSystem();

//if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}

include('header.php');

?>

	<div class='sub'>
	    <span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
    	Moderate</div>

	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center>
<div class='textbox2'>

<script type="text/javascript" language="javascript" >
	function deleterow(id){
		if (confirm('Are you sure you want to delete this snippet?')) {
			$.post('../includes/delete.php', {id: +id},
				function(){
					$("#grid").load("moderategrid.php<?php if(!empty($_GET['page'])) echo "?page=" . $_GET['page']; ?>").fadeIn('slow');
				}
			);
		}
	}


	//display the code in a jQuery dialog
	function showCode(codeTitle, codeId, codeType) {
		var txt = '<h2>ID: ' + codeId + '</h2><br /><input type="text" id="codetitle" name="codetitle" value="' +
			codeTitle + '" /><br /><textarea id="codeview" name="codeview"></textarea>';

		$.prompt(txt, { buttons: {Change:true, Cancel:false}, opacity: 0,
			callback: function(v,m,f){ if(v){
				$.post('moderatemodify.php', {id:codeId, codetitle:f.codetitle, code:f.codeview});
				$("#grid").load("moderategrid.php<?php if(!empty($_GET['page'])) echo "?page=" . $_GET['page']; ?>").fadeIn('slow');
			}}});
		$.get("moderatecode.php?id=" + codeId, function(data){ $('textarea#codeview').val(data); });

	}
</script>

<div id="grid">
	<?php include("moderategrid.php"); ?>
</div>

</div></center>
<div class='bottom'></div>

<?php include("footer.php"); ?>