<?php
session_start();
include('config.php');
include('includes/functions.php');
include('includes/cryptor.php');
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
		$password = mysql_real_escape_string(htmlspecialchars(strip_tags($_POST['password'])));

		if(empty($password)) {
			$error = 'Please enter a password!';
		}
		else {
			$result = mysql_query("SELECT * FROM codes WHERE id = '".$id."'");
            $row = mysql_fetch_array($result);

			$cryptor = new Cryptor;
			$password = $cryptor->encrypt($password);

			if($row['password']!=$password)	{
				$error = 'Wrong password!';
			}
			else {
				$_SESSION['pages'] = $id;
				die("<html><head><script>window.location='show.php?id=$id';</script></head></html>");
			}
		}
	}
?>

<div class="work">
<div class='sub'>
      Viewing #<?php echo $id;?> (PASSWORD PROTECTED !)
</div>

<div class='body'>
<div id='error'></div>
   <div class='top'></div>
   <center><div class='textbox2' name="gottaload">

	<form method="post">
        <span style="color:#FF0000; font-weight:bold;"><?php if(isset($error)){ echo "$error<br />"; } ?></span>

        Please enter the password to view this code snippet: <br /><br />
        <input type="password" class="password" name="password" />
        <input type="submit" name="submit" value="Submit" class="button orange" />
	</form>

   </div></center>
   <div class='bottom'></div>

<?php }
include('footer.php');
?>