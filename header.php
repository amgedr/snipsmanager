<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="shortcut icon" href="favicon.ico" />

<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/buttons.css" />
<link rel="alternate" type="application/rss+xml" title="<?php echo ch_getsetting('title'); ?>" href="<?php echo $sitename . 'feed/'; ?>" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/jquery.textarearesizer.compressed.js"></script>
<script type="text/javascript">
	/* jQuery textarea resizer plugin usage */
	$(document).ready(function() {
		$('textarea.resizable:not(.processed)').TextAreaResizer();
	});
</script>

<?php if(isset($additional_script_tags)) { echo $additional_script_tags; } ?>

<meta name="description" content="<?php echo ch_getsetting('metadescription'); ?>" />
<meta name="keywords" content="<?php echo ch_getsetting('metakeywords'); ?>" />
<meta name="generator" content="SnipsManager <?php echo ch_getsetting('version'); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ch_getsetting('title') . ' - ' . ch_getsetting('slogan'); ?></title>
</head>

<body>
    <div class='header'>
       <?php ch_displaytopmenu(); ?>
       <a href="index.php"><?php echo ch_displaylogo(); ?></a>
    </div>
    <div class='work'>