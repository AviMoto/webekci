<?php /* Smarty version 2.6.26, created on 2010-02-25 14:20:08
         compiled from rule_files_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule_files_add.tpl', 2, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM action="rules.php?tab=rfile&cmd=<?php if ($this->_tpl_vars['rf_id']): ?>rf_edit<?php else: ?>rf_inst<?php endif; ?> " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td colspan=2>
<?php echo $this->_config[0]['vars']['domainAddTitle']; ?>

<hr>
</td>
</tr>

<tr>
<td>Rule File Name</td>
<td><input type='text' name='rf_name' value=<?php echo $this->_tpl_vars['rf_name']; ?>
 size='60' maxlength='100'></td>
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
<?php if ($this->_tpl_vars['rf_id']): ?>
<input type=hidden value=<?php echo $this->_tpl_vars['rf_id']; ?>
 name='rf_id'>
<a href='rules.php?tab=rfile&cmd=rf_deleted&id=<?php echo $this->_tpl_vars['rf_id']; ?>
'>
<input type=submit value=Delete name=delete/></a> 
<?php endif; ?>
</td>
</tr>
</table>
</FORM>