{config_load file='template.conf'}
{include file="header.tpl"}
{include file="menu.tpl"}
  
    <div class="{#cptBox#}" align=center><b>Webekci 2.0</b></div>

<table width="95%">
<tr>
<td>
<fieldset>
  <legend style='color:#39C;'>Configuration </legend>

    <table  border="0" cellpadding="0" cellspacing="0" >
    <tr><td width="20%">

    <table class="cerceveic"  border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td width="120"><b>&nbsp;Virtual Host</b></td>
    <td align=left>:&nbsp;<a href='configurations.php?tab=dmns&c=1'>{$vhost}<a></td>
    </tr>
    <tr>
    <td width="120"><b>&nbsp;Modsecurity Conf</b></td>
    <td align=left>:&nbsp;<a href='configurations.php?tab=mscnf&c=0'>{$modsec_conf}</a></td>
    </tr>
    <tr>
    <td width="120">&nbsp;</td>
    <td></td>
    </tr>
    <tr>
    <td width="120">&nbsp;</td>
    <td></td>
    </tr>
    </table>
    </td></tr>
    </table>
</fieldset>
</td>
<td>

<fieldset>
  <legend style='color:#39C;'>Rule </legend>
    <table  border="0" cellpadding="0" cellspacing="0">
    <tr><td width="20%">

    <table class="cerceveic"  border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td width="120"><b>&nbsp;Rules</b></td>
    <td align=left>:&nbsp;<a href='rules.php?tab=rule&c=1'>{$rules}<a></td>
    </tr>
    <tr>
    <td width="120"><b>&nbsp;Rule Files</b></td>
    <td align=left>:&nbsp;<a href='rules.php?tab=rfile&c=0'>{$rule_files}</a></td>
    </tr>
    <tr>
    <td width="120"><b>&nbsp;Rule Data Files</b></td>
    <td align=left>:&nbsp;<a href='rules.php?tab=rdfile&c=2'>{$rule_dfiles}</a></td>
    </tr>
    <tr>
    <td width="120"><b>&nbsp;Rule Data</b></td>
    <td align=left>:&nbsp;<a href='rules.php?tab=rdata&c=3'>{$rule_data}</a></td>
    </tr>
    </table>

    </td></tr>
    </table>
</fieldset>
</td>
<td>

<fieldset>
  <legend style='color:#39C;text'>Audit Log</legend>
    <table  border="0" cellpadding="0" cellspacing="0">
    <tr><td width="20%">

    <table class="cerceveic"  border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td width="120"><b>&nbsp;Daily Alerts</b></td>
    <td align=left>:&nbsp;<a href='reports.php?tab=audit&c=0'>{$dalert}<a></td>
    </tr>
    <tr>
    <td width="120"><b>&nbsp;Weekly Alerts</b></td>
    <td align=left>:&nbsp;<a href='reports.php?tab=audit&c=0'>{$walert}</a></td>
    </tr>
    <tr>
    <td width="120"><b>&nbsp;Monthly Alerts</b></td>
    <td align=left>:&nbsp;<a href='reports.php?tab=audit&c=0'>{$malert}</a></td>
    </tr>
    <tr>
    <td width="120"><b>&nbsp;Blocked IPs</b></td>
    <td align=left>:&nbsp;<a href='reports.php?tab=sip&c=1&ip_block=2'>{$blocked_ip}</a></td>
    </tr>
    </table>

    </td></tr>
    </table>
</fieldset>
</td>
</tr>
</table>

{literal}
<script type="text/javascript" src="web/js/json/json2.js"></script>
<script type="text/javascript" src="web/js/swfobject.js"></script>
<script type="text/javascript">
 
swfobject.embedSWF(
  "web/js/open-flash-chart.swf", "severity_pie", "350", "230",
  "9.0.0", "web/js/expressInstall.swf",
  {"data-file":"severity_dist.php"}
  );

swfobject.embedSWF(
  "web/js/open-flash-chart.swf", "category_pie", "400", "230",
  "9.0.0", "web/js/expressInstall.swf",
  {"data-file":"category_dist.php"}
  );

swfobject.embedSWF(
  "web/js/open-flash-chart.swf", "month_request", "700", "300",
  "9.0.0", "web/js/expressInstall.swf",
  {"data-file":"month_request_bar.php"}
  );

</script>

{/literal}

<table width="95%">
<tr><td>

<fieldset>
<legend style='color:#39C;text'>Severity Distribution </legend>
<div id="severity_pie"></div>
</fieldset>

</td>
<td>

<fieldset>
<legend style='color:#39C;text'>Category Distribution </legend>
<div id="category_pie"></div>
</fieldset>

</td>
</tr>
<tr><td colspan="2" align="center">

<fieldset>
<legend style='color:#39C;text'>Monthly Alerts </legend>
<div id="month_request"></div>
</fieldset>

</td>
<tr>
</table>
<br>
{include file="footer.tpl"}

