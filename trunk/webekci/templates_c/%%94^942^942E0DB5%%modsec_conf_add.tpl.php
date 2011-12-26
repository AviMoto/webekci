<?php /* Smarty version 2.6.26, created on 2009-09-01 23:16:43
         compiled from modsec_conf_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'modsec_conf_add.tpl', 2, false),array('function', 'html_options', 'modsec_conf_add.tpl', 34, false),array('function', 'html_checkboxes', 'modsec_conf_add.tpl', 190, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM action="configurations.php?tab=mscnf&cmd=<?php if ($this->_tpl_vars['cid']): ?>cedit<?php else: ?>cinst<?php endif; ?> " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td colspan=2>
<?php echo $this->_config[0]['vars']['msecconfAddTitle']; ?>

<hr>
</td>
</tr>

<tr>
<td>Configuration Name</td>
<td><input type='text' class=inputbox name='cname' value=<?php echo $this->_tpl_vars['cname']; ?>
 size='67' maxlength='100'></td>
</tr>

<tr>
<td>Description</td>
<td><textarea name='cdescription' class=inputbox rows="2" cols="50"><?php echo $this->_tpl_vars['cdescription']; ?>
</textarea></td>
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
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecArgumentSperator','options' => $this->_tpl_vars['SecArgumentSperator'],'selected' => $this->_tpl_vars['arg_sperator']), $this);?>

</td>
</tr>

<tr>
<td>SecAuditEngine</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecAuditEngine','options' => $this->_tpl_vars['SecAuditEngine'],'selected' => $this->_tpl_vars['audit_engine']), $this);?>

</td>
</tr>


<tr>
<td>SecAuditLog</td>
<td><input type='text' class=inputbox name='audit_log' value=<?php echo $this->_tpl_vars['audit_log']; ?>
 &nbsp;  size='60' maxlength='100'></td>
</tr>


<tr>
<td>SecAuditLogRelevantStatus</td>
<td><input type='text' class=inputbox name='alog_rstatus' value=<?php echo $this->_tpl_vars['alog_rstatus']; ?>
 &nbsp; size='60' maxlength='100'></td>
</tr>

<tr>
<td>SecAuditLogStorageDir</td>
<td><input type='text' class=inputbox name='alog_storegadir' value=<?php echo $this->_tpl_vars['alog_storegadir']; ?>
 &nbsp; size='60' maxlength='100'></td>
</tr>



<tr>
<td>SecChrootDir</td>
<td><input type='text' class=inputbox name='chroot_dir' value=<?php echo $this->_tpl_vars['chroot_dir']; ?>
 &nbsp; size='60' maxlength='100'></td>
</tr>


<tr>
<td>SecContentInjection</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecContentInjection','options' => $this->_tpl_vars['SecContentInjection'],'selected' => $this->_tpl_vars['content_injection']), $this);?>

</td>
</tr>

<tr>
<td>SecCookieFormat</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecCookieFormat','options' => $this->_tpl_vars['SecCookieFormat'],'selected' => $this->_tpl_vars['cookie_format']), $this);?>

</td>
</tr>

<tr>
<td>SecDataDir</td>
<td><input type='text' class=inputbox  name='data_dir' value=<?php echo $this->_tpl_vars['data_dir']; ?>
 &nbsp; size='60' maxlength='100'></td>
</tr>



<tr>
<td>SecGuardianLog</td>
<td><input type='text' class=inputbox name='guardian_log' value=<?php echo $this->_tpl_vars['guardian_log']; ?>
 &nbsp; size='60' maxlength='100'></td>
</tr>

<tr>
<td>SecPdfProtect</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecPdfProtect','options' => $this->_tpl_vars['SecPdfProtect'],'selected' => $this->_tpl_vars['pdf_protect']), $this);?>

</td>
</tr>

<tr>
<td>SecPdfProtectMethod</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecPdfProtectMethod','options' => $this->_tpl_vars['SecPdfProtectMethod'],'selected' => $this->_tpl_vars['pdf_protect_method']), $this);?>

</td>
</tr>

<tr>
<td>SecPdfProtectTimeout</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecPdfProtectTimeout','options' => $this->_tpl_vars['SecPdfProtectTimeout'],'selected' => $this->_tpl_vars['pdf_protect_timeout']), $this);?>

</td>
</tr>


<tr>
<td>SecRequestBodyLimit</td>
<td><input type='text' class=inputbox name='req_body_limit' value=<?php echo $this->_tpl_vars['req_body_limit']; ?>
 &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td>SecRequestBodyNoFilesLimit</td>
<td><input type='text' class=inputbox name='req_body_no_files_limit' value=<?php echo $this->_tpl_vars['req_body_no_files_limit']; ?>
 &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td>SecRequestBodyInMemoryLimit</td>
<td><input type='text' class=inputbox name='req_body_in_memo_limit' value=<?php echo $this->_tpl_vars['req_body_in_memo_limit']; ?>
 &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td>SecResponseBodyLimit</td>
<td><input type='text' class=inputbox name='resp_body_limit' value=<?php echo $this->_tpl_vars['resp_body_limit']; ?>
 &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td>SecResponseBodyLimitAction</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecResponseBodyLimitAction','options' => $this->_tpl_vars['SecResponseBodyLimitAction'],'selected' => $this->_tpl_vars['resp_body_limit_action']), $this);?>

</td>
</tr>

<tr>
<td>SecResponseBodyMimeType</td>
<td>
<?php echo smarty_function_html_checkboxes(array('class' => 'inputbox','name' => 'SecResponseBodyMimeType','options' => $this->_tpl_vars['SecResponseBodyMimeType'],'selected' => $this->_tpl_vars['resp_body_mime_type'],'separator' => ' '), $this);?>

</td>
</tr>


<tr>
<td>SecRuleInheritance</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecRuleInheritance','options' => $this->_tpl_vars['SecRuleInheritance'],'selected' => $this->_tpl_vars['rule_inheritance']), $this);?>

</td>
</tr>

<tr>
<td>SecRuleEngine</td>
<td>
<?php echo smarty_function_html_options(array('class' => 'inputbox','name' => 'SecRuleEngine','options' => $this->_tpl_vars['SecRuleEngine'],'selected' => $this->_tpl_vars['rule_engine']), $this);?>

</td>
</tr>

<tr>
<td>SecTmpDir</td>
<td><input type='text' class=inputbox name='tmp_dir' value=<?php echo $this->_tpl_vars['tmp_dir']; ?>
 &nbsp; size='60' maxlength='100'></td>
</tr>



<tr>
<td>SecWebAppId</td>
<td><input type='text' class=inputbox name='web_app_id' value=<?php echo $this->_tpl_vars['web_app_id']; ?>
 &nbsp; size='30' maxlength='30'></td>
</tr>

<tr>
<td><input type=submit value=Submit name=submit/></td>
<td align=right>
<?php if ($this->_tpl_vars['cid']): ?>
<input type=hidden value=<?php echo $this->_tpl_vars['cid']; ?>
 name="id">
<a href='configurations.php?tab=mscnf&cmd=cdeleted&id=<?php echo $this->_tpl_vars['cid']; ?>
'>
<input type=submit value=Delete name=delete/></a> 
<?php endif; ?>
</td>
</tr>
</table>
</FORM>