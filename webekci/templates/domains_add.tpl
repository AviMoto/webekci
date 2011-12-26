{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM action="configurations.php?tab=dmns&cmd={if $did}dedit{else}dinst{/if} " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='{#tblClass#}'>
<tr><td colspan=2>
{#domainAddTitle#}
<hr>
</td>
</tr>

<tr>
<td>Domain Name</td>
<td><input type='text' name='dname' value="{$dname}" size='30' maxlength='30'></td>
</tr>

<tr>
<td>Server Name</td>
<td><input type='text' name='sname' value="{$sname}" size='45' maxlength='100'></td>
</tr>

<tr>
<td>Server IP</td>
<td><input type='text' name='sip' value="{$sip}" size='20' maxlength='20'></td>
</tr>

<tr>
<td>Server Port</td>
<td><input type='text' name='sport' value="{$sport}" size='4' maxlength='4'></td>
</tr>

<tr>
<td>Server Admin</td>
<td><input type='text' name='sadmin' value="{$sadmin}" size='45' maxlength='100'></td>
</tr>

<tr>
<td>Server Alias</td>
<td><input type='text' name='salias' value="{$salias}" size='45' maxlength='100'></td>
</tr>

<tr>
<td>Validity</td>
<td>
<select name="validity">
<option value="1" selected="selected">Active</option>
<option value="0" >Pasif</option>
</select>
</td>
</tr>

<tr>
<td>ModSecurity Conf.</td>
<td>
<select name=mod_sec_conf>
{html_options values=$msec_id output=$msec_name selected=$mod_sec_conf}
</select>
</td>
</tr>

<tr>
<td>Others</td>
<td><textarea name='other' rows="8" cols="80">{$other}</textarea></td>
</tr>

<tr>
<td><input type=submit value=Submit name=submit/></td>
<td align=right>
{if $did}
<input type=hidden value={$did} name="id">
<a href='configurations.php?tab=dmns&cmd=ddeleted&id={$did}'>
<input type=submit value=Delete name=delete/></a> 
{/if}
</td>
</tr>
</table>
</FORM>