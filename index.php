<?php
session_start();
include('config.php');
include('includes/functions.php');
connect();

if(file_exists("./install.php") & !stristr($sitename, 'localhost')){
	die("Please open 'install.php' in your browser to install SnipsManager.<br />" .
		"When you finish installing the script delete the file 'install.php'!");
}

include('header.php');
?>
	<div class='sub'>
		<span><a href="javascript:void(0);" onClick="extra();">Extra settings</a></span>
		Add your code
	</div>

	<div class='body'>
		<div id='error'></div>

<form method="post">
	<div class='top3'></div>
    <center><input type="text" name="codetitle" id="codetitle" maxlength="200" /></center>
    <div class='bottom3'></div>
    <br />

	<div class='top'></div>
	<center><textarea name="code" class="resizable" id="code"></textarea></center>
      <div class='extra'>
		Assign Password? <input id="password" type="password" class="password" name="password" /><br />
		<label style="text-align:left;margin:5px 13px 0 0;">
			<input type="checkbox" id="captcha" name="captcha" />Ask for CAPTCHA verification
		</label>
      </div>

	<div class='bot'>
		<select name="drop" class='drop'>
			<option value="1">PHP</option>
			<option value="2">JavaScript</option>
			<option value="3">Text</option>
            <option value="5">C++</option>
            <option value="6">ActionScript</option>
            <option value="7">Apache</option>
            <option value="8">AppleScript</option>
            <option value="9">AWK</option>
            <option value="10">Bash</option>
            <option value="11">C</option>
            <option value="12">C#</option>
            <option value="13">CSS</option>
            <option value="14">Delphi</option>
            <option value="15">Fortran</option>
            <option value="16">Haskell</option>
            <option value="17">Java</option>
            <option value="18">jQuery</option>
            <option value="19">Modula-2</option>
            <option value="20">MySQL</option>
            <option value="21">Perl</option>
            <option value="22">Python</option>
            <option value="23">Ruby on Rails</option>
            <option value="24">Scheme</option>
            <option value="25">SQL</option>
            <option value="26">Visual Basic</option>
            <option value="27">Visual Basic .NET</option>
            <option value="28">Vim</option>
            <option value="29">XML</option>
			<option value="4">Other</option>
		</select>

		<a href="javascript:void(0);" onClick="submit_it();" class="button orange">Submit</a>
	</div>
</form>

<?php include("footer.php"); ?>