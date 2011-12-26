{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM action="rules.php?tab=rdata&cmd={if $rd_id}rd_edit{else}rd_inst{/if}&c=3 " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='{#tblClass#}'>
<tr><td colspan=2>
{#domainAddTitle#}
<hr>
</td>
</tr>

<tr>
<td>Data File</td>
<td><select name="rdf_filter"  id="rdf_filter">
   {section name=rdfilter loop=$rule_dfilter}
   <option value="{$rule_dfilter[rdfilter].rdf_id}"
	{if $rule_dfilter[rdfilter].rdf_id == $rdf_id }
	selected="selected"
	{/if}>
	{$rule_dfilter[rdfilter].rdf_name} ({$rule_dfilter[rdfilter].rdf_rule_count})</option>
   {/section}
</select>
</td>
</tr>

<tr>
<td>Data</td>
<td><input type='text' name='rd_name' value="{$rd_name}" size='93' maxlength='150'></td>
</tr>

<tr>
<td>Validity</td>
<td>
<select name="validity">
<option value="0" selected="selected">Active</option>
<option value="1" >Pasif</option>
</select>
</td>
</tr>

<tr>
<td><input type=submit value=Submit name=submit/></td>
<td align=right>
{if $rd_id}
<input type=hidden value="{$rd_id}" name='rd_id'>
<a href='rules.php?tab=rdata&cmd=rd_deleted&id={$rd_id}&c=3'>
<input type=submit value=Delete name=delete/></a> 
{/if}
</td>
</tr>
</table>
</FORM>