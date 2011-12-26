<?php /* Smarty version 2.6.26, created on 2009-09-01 23:05:13
         compiled from domains_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'domains_add.tpl', 2, false),array('function', 'html_options', 'domains_add.tpl', 55, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM action="configurations.php?tab=dmns&cmd=<?php if ($this->_tpl_vars['did']): ?>dedit<?php else: ?>dinst<?php endif; ?> " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td colspan=2>
<?php echo $this->_config[0]['vars']['domainAddTitle']; ?>

<hr>
</td>
</tr>

<tr>
<td>Domain Name</td>
<td><input type='text' name='dname' value="<?php echo $this->_tpl_vars['dname']; ?>
" size='30' maxlength='30'></td>
</tr>

<tr>
<td>Server Name</td>
<td><input type='text' name='sname' value="<?php echo $this->_tpl_vars['sname']; ?>
" size='45' maxlength='100'></td>
</tr>

<tr>
<td>Server IP</td>
<td><input type='text' name='sip' value="<?php echo $this->_tpl_vars['sip']; ?>
" size='20' maxlength='20'></td>
</tr>

<tr>
<td>Server Port</td>
<td><input type='text' name='sport' value="<?php echo $this->_tpl_vars['sport']; ?>
" size='4' maxlength='4'></td>
</tr>

<tr>
<td>Server Admin</td>
<td><input type='text' name='sadmin' value="<?php echo $this->_tpl_vars['sadmin']; ?>
" size='45' maxlength='100'></td>
</tr>

<tr>
<td>Server Alias</td>
<td><input type='text' name='salias' value="<?php echo $this->_tpl_vars['salias']; ?>
" size='45' maxlength='100'></td>
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
<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['msec_id'],'output' => $this->_tpl_vars['msec_name'],'selected' => $this->_tpl_vars['mod_sec_conf']), $this);?>

</select>
</td>
</tr>

<tr>
<td>Others</td>
<td><textarea name='other' rows="8" cols="80"><?php echo $this->_tpl_vars['other']; ?>
</textarea></td>
</tr>

<tr>
<td><input type=submit value=Submit name=submit/></td>
<td align=right>
<?php if ($this->_tpl_vars['did']): ?>
<input type=hidden value=<?php echo $this->_tpl_vars['did']; ?>
 name="id">
<a href='configurations.php?tab=dmns&cmd=ddeleted&id=<?php echo $this->_tpl_vars['did']; ?>
'>
<input type=submit value=Delete name=delete/></a> 
<?php endif; ?>
</td>
</tr>
</table>
</FORM>