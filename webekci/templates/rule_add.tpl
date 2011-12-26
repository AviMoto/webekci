{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM action="rules.php?tab=rule&cmd={if $rule_rid}rule_edit{else}rule_inst{/if}&c=1 " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='{#tblClass#}'>
<tr><td colspan=2>
{#domainAddTitle#}
<hr>
</td>
</tr>

<tr>
<td>RuleID</td>
<td><input type='text' name='rule_id' value="{$rule_id}" size='16' maxlength='16'></td>
</tr>

<tr>
<td>Parent RuleID</td>
<td><input type='text' name='rule_pid' value="{$rule_pid}" size='16' maxlength='16'></td>
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
<td>Information</td>
<td><input type='text' name='rule_msg' value="{$rule_msg}" size='93' maxlength='150'></td>
</tr>

<tr>
<td>Rule</td>
<td><textarea name='rule' rows="10" cols="70">{$rule}</textarea></td>
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
{if $rule_rid}
<input type=hidden value="{$rule_rid}" name='rule_rid'>
<a href='rules.php?tab=rule&cmd=rule_deleted&id={$rule_rid}'&c=1>
<input type=submit value=Delete name=delete/></a> 
{/if}
</td>
</tr>
</table>
</FORM>