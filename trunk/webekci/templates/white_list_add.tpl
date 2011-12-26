{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM action="rules.php?tab=wlist&cmd={if $wl_id}wl_edit{else}wl_inst{/if}&c=4" method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='{#tblClass#}'>
<tr><td colspan=2>
{#WhiteListTitle#}
<hr>
</td>
</tr>

<tr>
<td>Type</td>
<td>{html_options class=sbox name="wl_filter" selected=$wl_type options=$filters.wlist_filter}
</td>
</tr>

<tr>
<td>Data</td>
<td><input type='text' name='wl_data' value="{$wl_data}" size='93' maxlength='200'></td>
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
{if $wl_id}
<input type=hidden value="{$wl_id}" name='wl_id'>
<a href='rules.php?tab=wlist&cmd=wl_deleted&id={$wl_id}&c=4'>
<input type=submit value=Delete name=delete/></a> 
{/if}
</td>
</tr>
</table>
</FORM>