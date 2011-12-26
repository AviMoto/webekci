<?php /* Smarty version 2.6.26, created on 2010-02-25 17:11:02
         compiled from rule_data_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule_data_add.tpl', 2, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM action="rules.php?tab=rdata&cmd=<?php if ($this->_tpl_vars['rd_id']): ?>rd_edit<?php else: ?>rd_inst<?php endif; ?>&c=3 " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td colspan=2>
<?php echo $this->_config[0]['vars']['domainAddTitle']; ?>

<hr>
</td>
</tr>

<tr>
<td>Data File</td>
<td><select name="rdf_filter"  id="rdf_filter">
   <?php unset($this->_sections['rdfilter']);
$this->_sections['rdfilter']['name'] = 'rdfilter';
$this->_sections['rdfilter']['loop'] = is_array($_loop=$this->_tpl_vars['rule_dfilter']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rdfilter']['show'] = true;
$this->_sections['rdfilter']['max'] = $this->_sections['rdfilter']['loop'];
$this->_sections['rdfilter']['step'] = 1;
$this->_sections['rdfilter']['start'] = $this->_sections['rdfilter']['step'] > 0 ? 0 : $this->_sections['rdfilter']['loop']-1;
if ($this->_sections['rdfilter']['show']) {
    $this->_sections['rdfilter']['total'] = $this->_sections['rdfilter']['loop'];
    if ($this->_sections['rdfilter']['total'] == 0)
        $this->_sections['rdfilter']['show'] = false;
} else
    $this->_sections['rdfilter']['total'] = 0;
if ($this->_sections['rdfilter']['show']):

            for ($this->_sections['rdfilter']['index'] = $this->_sections['rdfilter']['start'], $this->_sections['rdfilter']['iteration'] = 1;
                 $this->_sections['rdfilter']['iteration'] <= $this->_sections['rdfilter']['total'];
                 $this->_sections['rdfilter']['index'] += $this->_sections['rdfilter']['step'], $this->_sections['rdfilter']['iteration']++):
$this->_sections['rdfilter']['rownum'] = $this->_sections['rdfilter']['iteration'];
$this->_sections['rdfilter']['index_prev'] = $this->_sections['rdfilter']['index'] - $this->_sections['rdfilter']['step'];
$this->_sections['rdfilter']['index_next'] = $this->_sections['rdfilter']['index'] + $this->_sections['rdfilter']['step'];
$this->_sections['rdfilter']['first']      = ($this->_sections['rdfilter']['iteration'] == 1);
$this->_sections['rdfilter']['last']       = ($this->_sections['rdfilter']['iteration'] == $this->_sections['rdfilter']['total']);
?>
   <option value="<?php echo $this->_tpl_vars['rule_dfilter'][$this->_sections['rdfilter']['index']]['rdf_id']; ?>
"
	<?php if ($this->_tpl_vars['rule_dfilter'][$this->_sections['rdfilter']['index']]['rdf_id'] == $this->_tpl_vars['rdf_id']): ?>
	selected="selected"
	<?php endif; ?>>
	<?php echo $this->_tpl_vars['rule_dfilter'][$this->_sections['rdfilter']['index']]['rdf_name']; ?>
 (<?php echo $this->_tpl_vars['rule_dfilter'][$this->_sections['rdfilter']['index']]['rdf_rule_count']; ?>
)</option>
   <?php endfor; endif; ?>
</select>
</td>
</tr>

<tr>
<td>Data</td>
<td><input type='text' name='rd_name' value="<?php echo $this->_tpl_vars['rd_name']; ?>
" size='93' maxlength='150'></td>
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
<?php if ($this->_tpl_vars['rd_id']): ?>
<input type=hidden value="<?php echo $this->_tpl_vars['rd_id']; ?>
" name='rd_id'>
<a href='rules.php?tab=rdata&cmd=rd_deleted&id=<?php echo $this->_tpl_vars['rd_id']; ?>
&c=3'>
<input type=submit value=Delete name=delete/></a> 
<?php endif; ?>
</td>
</tr>
</table>
</FORM>