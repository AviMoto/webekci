{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM action="rules.php?tab=rdfile&cmd={if $rdf_id}rdf_edit{else}rdf_inst{/if}&c=2" method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='{#tblClass#}'>
<tr><td colspan=2>
{#domainAddTitle#}
<hr>
</td>
</tr>

<tr>
<td>Rule File</td>
<td><select name="rf_filter"  id="rf_filter">
   {section name=rfilter loop=$rule_filter}
   <option value="{$rule_filter[rfilter].rf_id}"
	{if $rule_filter[rfilter].rf_id == $rfile_id }
	selected="selected"
	{/if}>
	{$rule_filter[rfilter].rf_name} ({$rule_filter[rfilter].rf_rule_count})</option>
   {/section}
</select>
</td>
</tr>

<tr>
<td>Data File Name</td>
<td><input type='text' name='rdf_name' value="{$rdf_name}" size='60' maxlength='100'></td>
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
{if $rdf_id}
<input type=hidden value={$rdf_id} name='rdf_id'>
<a href='rules.php?tab=rdfile&cmd=rdf_deleted&id={$rdf_id}&c=2'>
<input type=submit value=Delete name=delete/></a> 
{/if}
</td>
</tr>
</table>
</FORM>