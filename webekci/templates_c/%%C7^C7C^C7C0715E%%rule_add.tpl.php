<?php /* Smarty version 2.6.26, created on 2009-10-17 13:44:09
         compiled from rule_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule_add.tpl', 2, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM action="rules.php?tab=rule&cmd=<?php if ($this->_tpl_vars['rule_rid']): ?>rule_edit<?php else: ?>rule_inst<?php endif; ?>&c=1 " method="post">
<table width=100% cellspacing=0 cellpadding=1 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td colspan=2>
<?php echo $this->_config[0]['vars']['domainAddTitle']; ?>

<hr>
</td>
</tr>

<tr>
<td>RuleID</td>
<td><input type='text' name='rule_id' value="<?php echo $this->_tpl_vars['rule_id']; ?>
" size='16' maxlength='16'></td>
</tr>

<tr>
<td>Parent RuleID</td>
<td><input type='text' name='rule_pid' value="<?php echo $this->_tpl_vars['rule_pid']; ?>
" size='16' maxlength='16'></td>
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
<td>Information</td>
<td><input type='text' name='rule_msg' value="<?php echo $this->_tpl_vars['rule_msg']; ?>
" size='93' maxlength='150'></td>
</tr>

<tr>
<td>Rule</td>
<td><textarea name='rule' rows="10" cols="70"><?php echo $this->_tpl_vars['rule']; ?>
</textarea></td>
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
<?php if ($this->_tpl_vars['rule_rid']): ?>
<input type=hidden value="<?php echo $this->_tpl_vars['rule_rid']; ?>
" name='rule_rid'>
<a href='rules.php?tab=rule&cmd=rule_deleted&id=<?php echo $this->_tpl_vars['rule_rid']; ?>
'&c=1>
<input type=submit value=Delete name=delete/></a> 
<?php endif; ?>
</td>
</tr>
</table>
</FORM>