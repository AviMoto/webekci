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
Weekly Report For {$source_ip}
<hr>
</td></tr>
<tr><td>


{literal}
<script type="text/javascript" src="web/js/json/json2.js"></script>
<script type="text/javascript" src="web/js/swfobject.js"></script>
<script type="text/javascript">

swfobject.embedSWF(
  "web/js/open-flash-chart.swf", "source_ip_trend", "500", "300",
  "9.0.0", "web/js/expressInstall.swf",
  {"data-file":"source_ip_trend.php?ip={/literal}{$source_ip}{literal}"}
  );

</script>

{/literal}

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

