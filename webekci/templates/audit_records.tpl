{*{debug}*}
{config_load file='template.conf' section='Report'}
<link href="web/css/CalendarControl.css" rel="stylesheet" type="text/css">
<script src="web/js/CalendarControl.js" language="javascript"></script>
<FORM name="audit" id="audit" action="reports.php?tab=audit" method="POST">
<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#auditreportTitle#}
<hr>
</td></tr>
<tr><td>

<table>
<tr>
<td>{html_options class=sbox name="severity" onChange='this.form.submit();' selected=$filter.severity options=$filters.severity}</td>
<td>{html_options class=sbox name="category" onChange='this.form.submit();' selected=$filter.category options=$filters.category}</td>
<td>{html_options class=sbox name="phase" onChange='this.form.submit();' selected=$filter.phase options=$filters.phase}</td>
<td>{html_options class=sbox name="http_pro" onChange='this.form.submit();' selected=$filter.http_pro options=$filters.http_pro}</td>
</tr>
<tr>
<td>{html_options class=sbox name="http_method" onChange='this.form.submit();' selected=$filter.http_method options=$filters.http_method}</td>
<td>{html_options class=sbox name="status" onChange='this.form.submit();' selected=$filter.status options=$filters.status}</td>
<td>{html_options class=sbox name="http_code" onChange='this.form.submit();' selected=$filter.http_code options=$filters.http_code}</td>
<td></td>
</tr>
</table>

</tr></td>
<tr><td>
<table>
<tr>
<td><input class="inputbox" type=text value="{if $filter.sdate}{$filter.sdate}{/if}"
    onfocus="showCalendarControl(this);" size="10" name="sdate" id="sdate"/></td>
<td>&nbsp;</td>
<td><input class=inputbox type=text  value="{if $filter.edate}{$filter.edate}{/if}"
    onfocus="showCalendarControl(this);" size="10" name="edate" id="edate"/></td>
<td><input type=submit  class=buton value="Go" name="go_date" onClick='this.form.submit();'/></td>
<td>&nbsp;</td>
<td><div style='padding-bottom:3px;position:relative;'>
<img src="web/images/search_icon.gif" width="16" style='position:absolute;top:2px;left:3px;' id="search_icon" height="16" border="0">
<input class="inputbox" type="text"  value="{$filter.search}" name="search" id="search" size="22" style="padding-left:20px;"></div></td>
<td width="%100"></td>
</tr>
</table>
<br>

<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Source IP</th>
<th align=left>Source Port</th>
<th align=left>Date</th>
<th align=left>Time</th>
<th align=left>Host</th>
<th align=left>Message</th>
</tr>
</thead>
   {section name=alog loop=$data}
   <tr bgcolor="{cycle values="#eeeeee,#dddddd"}">
	 <td><a href="javascript:void(0);" OnClick="WindowOpen('reports.php?tab=audit&cmd=show_det&id={$data[alog].alog_id}');">
	{html_image file='web/images/edit.gif' border='0'}
	</a></td>
         <td>{$data[alog].source_ip}</td>
         <td>{$data[alog].source_port}</td>
         <td>{$data[alog].date}</td>
         <td>{$data[alog].time}</td>
         <td>{$data[alog].host}</td>
         <td>{$data[alog].msg}</td>
      </tr>
   {/section}
</table>

{include file="navigation.tpl"}

</td></tr>
</table>

</FORM>

{literal}
<script type="text/javascript">
	function WindowOpen (url) {
	w=window.open(url,'s','scrollbars=yes,status=no,resizable=no,width=450,height=450','if (!w.opener) {w.opener = self;}w.focus();')
	}

</script>
{/literal}