<?php /* Smarty version 2.6.26, created on 2009-10-17 13:35:20
         compiled from white_list_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'white_list_add.tpl', 2, false),array('function', 'html_options', 'white_list_add.tpl', 13, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM action="rules.php?tab=wlist&cmd=<?php if ($this->_tpl_vars['wl_id']): ?>wl_edit<?php else: ?>wl_inst<?php endif; ?>&c=4" method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td colspan=2>
<?php echo $this->_config[0]['vars']['WhiteListTitle']; ?>

<hr>
</td>
</tr>

<tr>
<td>Type</td>
<td><?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'wl_filter','selected' => $this->_tpl_vars['wl_type'],'options' => $this->_tpl_vars['filters']['wlist_filter']), $this);?>

</td>
</tr>

<tr>
<td>Data</td>
<td><input type='text' name='wl_data' value="<?php echo $this->_tpl_vars['wl_data']; ?>
" size='93' maxlength='200'></td>
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
<?php if ($this->_tpl_vars['wl_id']): ?>
<input type=hidden value="<?php echo $this->_tpl_vars['wl_id']; ?>
" name='wl_id'>
<a href='rules.php?tab=wlist&cmd=wl_deleted&id=<?php echo $this->_tpl_vars['wl_id']; ?>
&c=4'>
<input type=submit value=Delete name=delete/></a> 
<?php endif; ?>
</td>
</tr>
</table>
</FORM>