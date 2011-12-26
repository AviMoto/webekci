<?php /* Smarty version 2.6.26, created on 2009-09-15 16:03:53
         compiled from rule_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule_detail.tpl', 22, false),)), $this); ?>
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
Rule
<hr>
</td></tr>
<tr><td>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<tr>
<td><?php echo $this->_tpl_vars['rule']; ?>
</td>
</tr>
</table>

</TD>
</tr>
   <tr><td>
   <div id="status" class="subtitle"><?php echo $this->_tpl_vars['dede']; ?>
</div>
   </td></tr>
<tr>
<TD valign="top" align="left"></TD>
</tr>
<TR>
<TD height="20" colspan="2">
<br><br>
</TD>
</TR>
</table>
<br>
</BODY>
</html>