<?php /* Smarty version 2.6.26, created on 2009-12-20 15:49:44
         compiled from source_ip_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'source_ip_detail.tpl', 22, false),)), $this); ?>
<html>
<HEAD>
<TITLE>WeBekci ( ModSecurity Managament Tool)</TITLE>
<link rel="StyleSheet" href="web/css/menu.css" type="text/css">   
<link rel="StyleSheet" href="web/css/renk.css" type="text/css">
</HEAD>
<BODY>
<table width="98%" height="90%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" class="site">
 <TR>
<td height="95" colspan="2" class=site_logo>  
   <table width="21%" border="0" align="left" cellpadding="0" cellspacing="0">
   <tr>
<td><img src="web/images/logo.jpg"  border=0></td>
</tr>
</table>
</td>
</TR>
<tr>
<td>
<br>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Report'), $this);?>

<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
Weekly Report For <?php echo $this->_tpl_vars['source_ip']; ?>

<hr>
</td></tr>
<tr><td>


<?php echo '
<script type="text/javascript" src="web/js/json/json2.js"></script>
<script type="text/javascript" src="web/js/swfobject.js"></script>
<script type="text/javascript">

swfobject.embedSWF(
  "web/js/open-flash-chart.swf", "source_ip_trend", "500", "300",
  "9.0.0", "web/js/expressInstall.swf",
  {"data-file":"source_ip_trend.php?ip='; ?>
<?php echo $this->_tpl_vars['source_ip']; ?>
<?php echo '"}
  );

</script>

'; ?>


<div id="source_ip_trend"></div>

</td></tr>
</table>

<br>

</TD>
</tr>
</table>
<br>
</BODY>
</html>
