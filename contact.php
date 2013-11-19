<?php
session_start();
include('config.php');
include('includes/functions.php');
connect();

include('header.php');
?>

<div id="content">
    <div class='sub'>
        <span></span>
           Contact
    </div>
<div class='body'>
	<div id='error'></div>
	<div class='top'></div>
	<center><div class='textbox2' name="content">
        <form action="contact.php" method="post" name="form1">
        <table>
        <tr style="height: 30px;">
            <td width="120px">Email:</td>
            <td><input type="text" name="email" value="" style="width: 200px;"></td>
        </tr>
        <tr style="height: 30px;">
            <td>Name:</td>
            <td><input type="text" name="name" value="" style="width: 200px;"></td>
        </tr>
        <tr style="height: 30px;">
            <td style="vertical-align:top; padding-top:3px;">Message:</td>
            <td><textarea name="message" cols="50" rows="6"></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><a href="javascript:void(0);" onClick="submit_contact();" class="button orange">Submit</a></td>
        </tr>
        </table>
        </form>
    </div></center>
	<div class='bottom'></div>
<?php include("footer.php"); ?>