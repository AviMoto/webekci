{*{debug}*}
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
{config_load file='template.conf' section='Report'}
<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#auditdetailentry#}
<hr>
</td></tr>
<tr><td>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<tr>
<td> Unique ID</td>
<td>:</td>
<td>{$unique_id}</td>
</tr>
<tr>
<td> Source IP</td>
<td>:</td>
<td>{$source_ip} 
	{if isset($sip_is_blocked)}
	 <a href='reports.php?tab=audit&cmd=ip_block&id={$alog_id}&ip={$source_ip}&v=0'>
	 {html_image file='web/images/_err.png' border='0'}
	 {else}
	 <a href='reports.php?tab=audit&cmd=ip_block&id={$alog_id}&ip={$source_ip}&v=1'>
	 {html_image file='web/images/_ok.png' border='0'}
	 </a>
	 </a>
	 {/if}
	 </td>

</tr>
<tr>
<td> Source Port</td>
<td>:</td>
<td>{$source_port}</td>
</tr>
<tr>
<td> Destination IP</td>
<td>:</td>
<td>{$destination_ip}</td>
</tr>
<tr>
<td> Destination Port</td>
<td>:</td>
<td>{$destination_port}</td>
</tr>
<tr>
<td> HTTP Method</td>
<td>:</td>
<td>{$http_method}</td>
</tr>
<tr>
<td> Uri</td>
<td>:</td>
<td>{$uri}</td>
</tr>
<tr>
<td> HTTP Version</td>
<td>:</td>
<td>{$http_version}</td>
</tr>
<tr>
<td> Host</td>
<td>:</td>
<td>{$host}</td>
</tr>
<tr>
<td> Date</td>
<td>:</td>
<td>{$date}</td>
</tr>
<td> Time</td>
<td>:</td>
<td>{$time}</td>
</tr>
</table>
</td></tr>
</table>

<br>

<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#auditdetailalert#}
<hr>
</td></tr>
<tr><td>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<tr>
<td> General Message</td>
<td>:</td>
<td>{$general_msg}</td>
</tr>
<tr>
<td> Technical Message</td>
<td>:</td>
<td>{$technical_msg}</td>
</tr>
<tr>
<td> Rule ID</td>
<td>:</td>
<td><a href="javascript:void(0);" OnClick="WindowOpen('reports.php?tab=rule&cmd=show_rule&rule_id={$rule_id}');">{$rule_id}</a></td>
</tr>
<tr>
<td> Message</td>
<td>:</td>
<td>{$msg}</td>
</tr>
<tr>
<td> Severity</td>
<td>:</td>
<td>{$severity}</td>
</tr>
</table>
</td></tr>
</table>


</TD>
</tr>
   <tr><td>
   <div id="status" class="subtitle">{$dede}</div>
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

{literal}
<script type="text/javascript">
	function WindowOpen (url) {
	w=window.open(url,'s','scrollbars=yes,status=no,resizable=no,width=650,height=450','if (!w.opener) {w.opener = self;}w.focus();')
	}

</script>
{/literal}