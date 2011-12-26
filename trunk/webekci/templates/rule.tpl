{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM name="rule" id="rule" action="rules.php?tab=rule&c=1" method="POST">
<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#ruleTitle#}
</td>
<td align=right>

<select name="rule_file_filter"  id="rule_file_filter" onChange='this.form.submit();'>
<option value="0" align=center>--- All Rule Files ---</option>
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
<td colspan=2>
<hr>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>RuleID</th>
{* <th align=left>Rule Inormation</th> *}
<th align=left>Directive (Rule)</th>
<th align=left>Default</th>
<th align=left>Rule File</th>
{* <th align=left>Rule Data File</th> *}
<th align=left>Status</th>
</tr>
</thead>
   {section name=rules loop=$data}
   <tr bgcolor="{cycle values="#eeeeee,#dddddd"}">
	 <td><a href='rules.php?tab=rule&cmd=rule_add&id={$data[rules].rule_rid}&c=1'>
	{html_image file='web/images/edit.gif' border='0'}</a></td>
         <td>{$data[rules].rule_id}</td>
         {* <td>{$data[rules].rule_msg}</td> *}
         <td>{$data[rules].rule}</td>
         <td>{$data[rules].rule_default}</td>
         <td>{$data[rules].rule_file}</td>
         {* <td>{$data[rules].rule_data_file}</td> *}
         <td>{if $data[rules].rule_isactive}
	<a href='rules.php?tab=rule&cmd=validity&id={$data[rules].rule_rid}&v=0'>
	{html_image file='web/images/_err.png' border='0'}
	</a>
	{else}
	<a href='rules.php?tab=rule&cmd=validity&id={$data[rules].rule_rid}&v=1'>
	{html_image file='web/images/_ok.png' border='0'}
	</a>
	{/if}
	</td>
      </tr>
   {/section}
</table>

</td></tr>
<tr><td colspan=6>
{include file="navigation.tpl"}
</td></tr>

<tr><td>
<a href='rules.php?tab=rule&cmd=rule_add&c=1'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>

</FORM>