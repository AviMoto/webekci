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
Rule
<hr>
</td></tr>
<tr><td>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>{$rule}</td>
</tr>
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
