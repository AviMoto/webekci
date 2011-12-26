{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM action="rules.php?tab=rfile&cmd={if $rf_id}rf_edit{else}rf_inst{/if} " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='{#tblClass#}'>
<tr><td colspan=2>
{#domainAddTitle#}
<hr>
</td>
</tr>

<tr>
<td>Rule File Name</td>
<td><input type='text' name='rf_name' value={$rf_name} size='60' maxlength='100'></td>
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
{if $rf_id}
<input type=hidden value={$rf_id} name='rf_id'>
<a href='rules.php?tab=rfile&cmd=rf_deleted&id={$rf_id}'>
<input type=submit value=Delete name=delete/></a> 
{/if}
</td>
</tr>
</table>
</FORM>