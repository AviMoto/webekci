<?php /* Smarty version 2.6.26, created on 2009-09-15 16:01:21
         compiled from audit_log_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'audit_log_detail.tpl', 22, false),array('function', 'html_image', 'audit_log_detail.tpl', 41, false),)), $this); ?>
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
<?php echo $this->_config[0]['vars']['auditdetailentry']; ?>

<hr>
</td></tr>
<tr><td>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<tr>
<td> Unique ID</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['unique_id']; ?>
</td>
</tr>
<tr>
<td> Source IP</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['source_ip']; ?>
 
	<?php if (isset ( $this->_tpl_vars['sip_is_blocked'] )): ?>
	 <a href='reports.php?tab=audit&cmd=ip_block&id=<?php echo $this->_tpl_vars['alog_id']; ?>
&ip=<?php echo $this->_tpl_vars['source_ip']; ?>
&v=0'>
	 <?php echo smarty_function_html_image(array('file' => 'web/images/_err.png','border' => '0'), $this);?>

	 <?php else: ?>
	 <a href='reports.php?tab=audit&cmd=ip_block&id=<?php echo $this->_tpl_vars['alog_id']; ?>
&ip=<?php echo $this->_tpl_vars['source_ip']; ?>
&v=1'>
	 <?php echo smarty_function_html_image(array('file' => 'web/images/_ok.png','border' => '0'), $this);?>

	 </a>
	 </a>
	 <?php endif; ?>
	 </td>

</tr>
<tr>
<td> Source Port</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['source_port']; ?>
</td>
</tr>
<tr>
<td> Destination IP</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['destination_ip']; ?>
</td>
</tr>
<tr>
<td> Destination Port</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['destination_port']; ?>
</td>
</tr>
<tr>
<td> HTTP Method</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['http_method']; ?>
</td>
</tr>
<tr>
<td> Uri</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['uri']; ?>
</td>
</tr>
<tr>
<td> HTTP Version</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['http_version']; ?>
</td>
</tr>
<tr>
<td> Host</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['host']; ?>
</td>
</tr>
<tr>
<td> Date</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['date']; ?>
</td>
</tr>
<td> Time</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['time']; ?>
</td>
</tr>
</table>
</td></tr>
</table>

<br>

<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['auditdetailalert']; ?>

<hr>
</td></tr>
<tr><td>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<tr>
<td> General Message</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['general_msg']; ?>
</td>
</tr>
<tr>
<td> Technical Message</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['technical_msg']; ?>
</td>
</tr>
<tr>
<td> Rule ID</td>
<td>:</td>
<td><a href="javascript:void(0);" OnClick="WindowOpen('reports.php?tab=rule&cmd=show_rule&rule_id=<?php echo $this->_tpl_vars['rule_id']; ?>
');"><?php echo $this->_tpl_vars['rule_id']; ?>
</a></td>
</tr>
<tr>
<td> Message</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['msg']; ?>
</td>
</tr>
<tr>
<td> Severity</td>
<td>:</td>
<td><?php echo $this->_tpl_vars['severity']; ?>
</td>
</tr>
</table>
</td></tr>
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

<?php echo '
<script type="text/javascript">
	function WindowOpen (url) {
	w=window.open(url,\'s\',\'scrollbars=yes,status=no,resizable=no,width=650,height=450\',\'if (!w.opener) {w.opener = self;}w.focus();\')
	}

</script>
'; ?>