<?php
session_start();
include('config.php');
include('includes/functions.php');
connect();

include('header.php');

if(empty($_GET['id'])) {
?>

<div class="work">
<div class='sub'></div>

<div class='body'>
<div id='error' style="display:block;">Please enter an ID</div>

<?php
}
else {
	$id = mysql_real_escape_string(htmlspecialchars(strip_tags($_GET['id'])));

	if(isset($_POST['submit']))	{
		if(empty($_POST['keystring'])) {
			$error = 'Invalid.';
		}
		else {
			if(count($_POST)>0){
				if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']){
					$_SESSION['pages'] = $id;
					die("<html><head><script>window.location='show.php?id=$id';</script></head></html>");
				}else{
					$error = 'The text you entered does not match.';
				}
			}

			unset($_SESSION['captcha_keystring']);
		}
	}
?>

<div class="work">
<div class='sub'>
      Viewing #<?php echo $id;?> (CAPTCHA PROTECTED !)
</div>

<div class='body'>
<div id='error'></div>
   <div class='top'></div>
   <center><div class='textbox2' name="gottaload">

	<form method="post">
        <span style="color:#FF0000; font-weight:bold;"><?php if(isset($error)){ echo "$error<br />"; } ?></span>

        Please enter the text in the image to view this code snippet: <br /><br />
		<input type="text" name="keystring" id="keystring"  class="password" style="width:297px;" />
		<img src="./includes/kcaptcha/?<?php echo session_name()?>=<?php echo session_id()?>"
			style="margin:0px 20px -19px 20px;">
        <input type="submit" name="submit" value="Submit" class="button orange" />
	</form>

   </div></center>
   <div class='bottom'></div>

<?php }
include('footer.php');
?>