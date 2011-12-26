{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM name="wlist" id="wlist" action="rules.php?tab=wlist&c=4" method="POST">
<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#WhiteListTitle#}
</td>
<td align=right>
{html_options class=sbox name="wlist_filter" onChange='this.form.submit();' selected=$wl_type_id options=$filters.wlist_filter}
</td>
</tr>
<tr>
<td colspan=2>
<hr>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Type</th>
<th align=left>Data</th>
<th align=left>Status</th>
</tr>
</thead>
   {section name=white_lists loop=$data}
   <tr bgcolor="{cycle values="#eeeeee,#dddddd"}">
	 <td><a href='rules.php?tab=wlist&cmd=wl_add&id={$data[white_lists].wl_id}&c=4'>
	{html_image file='web/images/edit.gif' border='0'}</a></td>
         <td>{$data[white_lists].wl_type}</td>
         <td>{$data[white_lists].wl_data}</td>
         <td>{if $data[white_lists].wl_isactive}
	<a href='rules.php?tab=wlist&cmd=validity&id={$data[white_lists].wl_id}&v=0&c=4'>
	{html_image file='web/images/_err.png' border='0'}
	</a>
	{else}
	<a href='rules.php?tab=wlist&cmd=validity&id={$data[white_lists].wl_id}&v=1&c=4'>
	{html_image file='web/images/_ok.png' border='0'}
	</a>
	{/if}
	</td>
      </tr>
   {/section}
</table>

</td></tr>
{if $ceil > 1}
<tr><td colspan=4>
{include file="navigation.tpl"}
</td></tr>
{/if}

<tr><td>
<a href='rules.php?tab=wlist&cmd=wl_add&c=4'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>

</FORM>