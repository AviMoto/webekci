{*{debug}*}
{config_load file='template.conf' section='Configuration'}
<FORM action="configurations.php?tab=mscnf&cmd={if $cid}cedit{else}cinst{/if} " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='{#tblClass#}'>
<tr><td colspan=2>
{#msecconfAddTitle#}
<hr>
</td>
</tr>

<tr>
<td>Configuration Name</td>
<td><input type='text' class=inputbox name='cname' value={$cname} size='67' maxlength='100'></td>
</tr>

<tr>
<td>Description</td>
<td><textarea name='cdescription' class=inputbox rows="2" cols="50">{$cdescription}</textarea></td>
</tr>

<tr>
<td>Validity</td>
<td>
<select name="validity" class=inputbox>
<option value="1" selected="selected">Active</option>
<option value="0" >Pasif</option>
</select>
</td>
</tr>

<tr>
<td>SecArgumentSperator</td>
<td>
{html_options class=inputbox name=SecArgumentSperator options=$SecArgumentSperator selected=$arg_sperator}
</td>
</tr>

<tr>
<td>SecAuditEngine</td>
<td>
{html_options class=inputbox name=SecAuditEngine options=$SecAuditEngine selected=$audit_engine}
</td>
</tr>

{*<tr>
<td>SecAuditLogParts</td>
<td>
{html_checkboxes class=inputbox name='SecAuditLogParts' options=$SecAuditLogParts selected=$audit_log_parts separator=' '}
</td>
</tr>*}

<tr>
<td>SecAuditLog</td>
<td><input type='text' class=inputbox name='audit_log' value={$audit_log} &nbsp;  size='60' maxlength='100'></td>
</tr>

{*<tr>
<td>SecAuditLog2</td>
<td><input type='text' class=inputbox name='audit_log2' value={$audit_log2} &nbsp; size='60' maxlength='100'></td>
</tr>*}

<tr>
<td>SecAuditLogRelevantStatus</td>
<td><input type='text' class=inputbox name='alog_rstatus' value={$alog_rstatus} &nbsp; size='60' maxlength='100'></td>
</tr>

<tr>
<td>SecAuditLogStorageDir</td>
<td><input type='text' class=inputbox name='alog_storegadir' value={$alog_storegadir} &nbsp; size='60' maxlength='100'></td>
</tr>

{*<tr>
<td>SecAuditLogType</td>
<td>
{html_options class=inputbox name=SecAuditLogType options=$SecAuditLogType selected=$audit_log_type}
</td>
</tr>*}

{*<tr>
<td>SecCacheTransformations</td>
<td>
{html_options class=inputbox name=SecCacheTransformations options=$SecCacheTransformations selected=$cache_transformations}
</td>
</tr>*}

<tr>
<td>SecChrootDir</td>
<td><input type='text' class=inputbox name='chroot_dir' value={$chroot_dir} &nbsp; size='60' maxlength='100'></td>
</tr>

{*<tr>
<td>SecComponentSignature</td>
<td><input type='text' class=inputbox name='comp_signature' value={$comp_signature} &nbsp; size='60' maxlength='100'></td>
</tr>*}

<tr>
<td>SecContentInjection</td>
<td>
{html_options class=inputbox name=SecContentInjection options=$SecContentInjection selected=$content_injection}
</td>
</tr>

<tr>
<td>SecCookieFormat</td>
<td>
{html_options class=inputbox name=SecCookieFormat options=$SecCookieFormat selected=$cookie_format}
</td>
</tr>

<tr>
<td>SecDataDir</td>
<td><input type='text' class=inputbox  name='data_dir' value={$data_dir} &nbsp; size='60' maxlength='100'></td>
</tr>

{*<tr>
<td>SecDebugLog</td>
<td><input type='text' class=inputbox name='debug_log' value={$debug_log} &nbsp; size='60' maxlength='100'></td>
</tr>*}

{*<tr>
<td>SecDebugLogLevel</td>
<td>
{html_options class=inputbox name=SecDebugLogLevel options=$SecDebugLogLevel selected=$debug_log_level}
</td>
</tr>*}

<tr>
<td>SecGuardianLog</td>
<td><input type='text' class=inputbox name='guardian_log' value={$guardian_log} &nbsp; size='60' maxlength='100'></td>
</tr>

<tr>
<td>SecPdfProtect</td>
<td>
{html_options class=inputbox name=SecPdfProtect options=$SecPdfProtect selected=$pdf_protect}
</td>
</tr>

<tr>
<td>SecPdfProtectMethod</td>
<td>
{html_options class=inputbox name=SecPdfProtectMethod options=$SecPdfProtectMethod selected=$pdf_protect_method}
</td>
</tr>

<tr>
<td>SecPdfProtectTimeout</td>
<td>
{html_options class=inputbox name=SecPdfProtectTimeout options=$SecPdfProtectTimeout selected=$pdf_protect_timeout}
</td>
</tr>

{*<tr>
<td>SecRequestBodyAccess</td>
<td>
{html_options class=inputbox name=SecRequestBodyAccess options=$SecRequestBodyAccess selected=$req_body_access}
</td>
</tr>*}

<tr>
<td>SecRequestBodyLimit</td>
<td><input type='text' class=inputbox name='req_body_limit' value={$req_body_limit} &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td>SecRequestBodyNoFilesLimit</td>
<td><input type='text' class=inputbox name='req_body_no_files_limit' value={$req_body_no_files_limit} &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td>SecRequestBodyInMemoryLimit</td>
<td><input type='text' class=inputbox name='req_body_in_memo_limit' value={$req_body_in_memo_limit} &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td>SecResponseBodyLimit</td>
<td><input type='text' class=inputbox name='resp_body_limit' value={$resp_body_limit} &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td>SecResponseBodyLimitAction</td>
<td>
{html_options  class=inputbox name=SecResponseBodyLimitAction options=$SecResponseBodyLimitAction selected=$resp_body_limit_action}
</td>
</tr>

<tr>
<td>SecResponseBodyMimeType</td>
<td>
{html_checkboxes class=inputbox name='SecResponseBodyMimeType' options=$SecResponseBodyMimeType selected=$resp_body_mime_type separator=' '}
</td>
</tr>

{*<tr>
<td>SecResponseBodyAccess</td>
<td>
{html_options class=inputbox name=SecResponseBodyAccess options=$SecResponseBodyAccess selected=$resp_body_access}
</td>
</tr>*}

<tr>
<td>SecRuleInheritance</td>
<td>
{html_options class=inputbox name=SecRuleInheritance options=$SecRuleInheritance selected=$rule_inheritance}
</td>
</tr>

<tr>
<td>SecRuleEngine</td>
<td>
{html_options class=inputbox name=SecRuleEngine options=$SecRuleEngine selected=$rule_engine}
</td>
</tr>

<tr>
<td>SecTmpDir</td>
<td><input type='text' class=inputbox name='tmp_dir' value={$tmp_dir} &nbsp; size='60' maxlength='100'></td>
</tr>

{*<tr>
<td>SecUploadDir</td>
<td><input type='text'  class=inputbox name='upload_dir' value={$upload_dir} &nbsp; size='60' maxlength='100'></td>
</tr>*}

{*<tr>
<td>SecUploadKeepFiles</td>
<td>
{html_options  class=inputbox name=SecUploadKeepFiles options=$SecUploadKeepFiles selected=$upload_keep_files}
</td>
</tr>*}

<tr>
<td>SecWebAppId</td>
<td><input type='text' class=inputbox name='web_app_id' value={$web_app_id} &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td><input type=submit value=Submit name=submit/></td>
<td align=right>
{if $cid}
<input type=hidden value={$cid} name="id">
<a href='configurations.php?tab=mscnf&cmd=cdeleted&id={$cid}'>
<input type=submit value=Delete name=delete/></a> 
{/if}
</td>
</tr>
</table>
</FORM>