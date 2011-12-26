<?php /* Smarty version 2.6.26, created on 2009-10-17 13:43:46
         compiled from rule_data_files_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule_data_files_add.tpl', 2, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM action="rules.php?tab=rdfile&cmd=<?php if ($this->_tpl_vars['rdf_id']): ?>rdf_edit<?php else: ?>rdf_inst<?php endif; ?>&c=2" method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td colspan=2>
<?php echo $this->_config[0]['vars']['domainAddTitle']; ?>

<hr>
</td>
</tr>

<tr>
<td>Rule File</td>
<td><select name="rf_filter"  id="rf_filter">
   <?php unset($this->_sections['rfilter']);
$this->_sections['rfilter']['name'] = 'rfilter';
$this->_sections['rfilter']['loop'] = is_array($_loop=$this->_tpl_vars['rule_filter']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rfilter']['show'] = true;
$this->_sections['rfilter']['max'] = $this->_sections['rfilter']['loop'];
$this->_sections['rfilter']['step'] = 1;
$this->_sections['rfilter']['start'] = $this->_sections['rfilter']['step'] > 0 ? 0 : $this->_sections['rfilter']['loop']-1;
if ($this->_sections['rfilter']['show']) {
    $this->_sections['rfilter']['total'] = $this->_sections['rfilter']['loop'];
    if ($this->_sections['rfilter']['total'] == 0)
        $this->_sections['rfilter']['show'] = false;
} else
    $this->_sections['rfilter']['total'] = 0;
if ($this->_sections['rfilter']['show']):

            for ($this->_sections['rfilter']['index'] = $this->_sections['rfilter']['start'], $this->_sections['rfilter']['iteration'] = 1;
                 $this->_sections['rfilter']['iteration'] <= $this->_sections['rfilter']['total'];
                 $this->_sections['rfilter']['index'] += $this->_sections['rfilter']['step'], $this->_sections['rfilter']['iteration']++):
$this->_sections['rfilter']['rownum'] = $this->_sections['rfilter']['iteration'];
$this->_sections['rfilter']['index_prev'] = $this->_sections['rfilter']['index'] - $this->_sections['rfilter']['step'];
$this->_sections['rfilter']['index_next'] = $this->_sections['rfilter']['index'] + $this->_sections['rfilter']['step'];
$this->_sections['rfilter']['first']      = ($this->_sections['rfilter']['iteration'] == 1);
$this->_sections['rfilter']['last']       = ($this->_sections['rfilter']['iteration'] == $this->_sections['rfilter']['total']);
?>
   <option value="<?php echo $this->_tpl_vars['rule_filter'][$this->_sections['rfilter']['index']]['rf_id']; ?>
"
	<?php if ($this->_tpl_vars['rule_filter'][$this->_sections['rfilter']['index']]['rf_id'] == $this->_tpl_vars['rfile_id']): ?>
	selected="selected"
	<?php endif; ?>>
	<?php echo $this->_tpl_vars['rule_filter'][$this->_sections['rfilter']['index']]['rf_name']; ?>
 (<?php echo $this->_tpl_vars['rule_filter'][$this->_sections['rfilter']['index']]['rf_rule_count']; ?>
)</option>
   <?php endfor; endif; ?>
</select>
</td>
</tr>

<tr>
<td>Data File Name</td>
<td><input type='text' name='rdf_name' value="<?php echo $this->_tpl_vars['rdf_name']; ?>
" size='60' maxlength='100'></td>
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
<?php if ($this->_tpl_vars['rdf_id']): ?>
<input type=hidden value=<?php echo $this->_tpl_vars['rdf_id']; ?>
 name='rdf_id'>
<a href='rules.php?tab=rdfile&cmd=rdf_deleted&id=<?php echo $this->_tpl_vars['rdf_id']; ?>
&c=2'>
<input type=submit value=Delete name=delete/></a> 
<?php endif; ?>
</td>
</tr>
</table>
</FORM>