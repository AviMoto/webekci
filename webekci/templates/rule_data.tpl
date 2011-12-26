{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM name="rdata" id="rdata" action="rules.php?tab=rdata&c=3" method="POST">
<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#ruleTitle#}
</td>
<td align=right>

<select name="rule_dfile_filter"  id="rule_dfile_filter" onChange='this.form.submit();'>
<option value="0" align=center>--- All Rule Data Files ---</option>
   {section name=rdfilter loop=$rule_dfilter}
   <option value="{$rule_dfilter[rdfilter].rdf_id}"
	{if $rule_dfilter[rdfilter].rdf_id == $rdfile_id }
	selected="selected"
	{/if}>
	{$rule_dfilter[rdfilter].rdf_name} ({$rule_dfilter[rdfilter].rdf_rule_count})</option>
   {/section}
</select>

</td>
</tr>
<tr>
<td colspan=2>
<hr>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Data</th>
<th align=left>Data File</th>
<th align=left>Status</th>
</tr>
</thead>
   {section name=rule_datas loop=$data}
   <tr bgcolor="{cycle values="#eeeeee,#dddddd"}">
	 <td><a href='rules.php?tab=rdata&cmd=rd_add&id={$data[rule_datas].rd_id}&c=3'>
	{html_image file='web/images/edit.gif' border='0'}</a></td>
         <td>{$data[rule_datas].rd_name}</td>
         <td>{$data[rule_datas].rdf_name}</td>
         <td>{if $data[rule_datas].rd_isactive}
	<a href='rules.php?tab=rdata&cmd=validity&id={$data[rule_datas].rd_id}&v=0&c=3'>
	{html_image file='web/images/_err.png' border='0'}
	</a>
	{else}
	<a href='rules.php?tab=rdata&cmd=validity&id={$data[rule_datas].rd_id}&v=1&c=3'>
	{html_image file='web/images/_ok.png' border='0'}
	</a>
	{/if}
	</td>
      </tr>
   {/section}
</table>

</td></tr>
<tr><td colspan=4>
{include file="navigation.tpl"}
</td></tr>

<tr><td>
<a href='rules.php?tab=rdata&cmd=rd_add&c=3'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>

</FORM>