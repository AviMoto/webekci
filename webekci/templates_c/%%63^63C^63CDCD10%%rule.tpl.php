<?php /* Smarty version 2.6.26, created on 2009-10-17 13:36:31
         compiled from rule.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule.tpl', 2, false),array('function', 'cycle', 'rule.tpl', 40, false),array('function', 'html_image', 'rule.tpl', 42, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM name="rule" id="rule" action="rules.php?tab=rule&c=1" method="POST">
<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['ruleTitle']; ?>

</td>
<td align=right>

<select name="rule_file_filter"  id="rule_file_filter" onChange='this.form.submit();'>
<option value="0" align=center>--- All Rule Files ---</option>
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
<td colspan=2>
<hr>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>RuleID</th>
<th align=left>Directive (Rule)</th>
<th align=left>Default</th>
<th align=left>Rule File</th>
<th align=left>Status</th>
</tr>
</thead>
   <?php unset($this->_sections['rules']);
$this->_sections['rules']['name'] = 'rules';
$this->_sections['rules']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rules']['show'] = true;
$this->_sections['rules']['max'] = $this->_sections['rules']['loop'];
$this->_sections['rules']['step'] = 1;
$this->_sections['rules']['start'] = $this->_sections['rules']['step'] > 0 ? 0 : $this->_sections['rules']['loop']-1;
if ($this->_sections['rules']['show']) {
    $this->_sections['rules']['total'] = $this->_sections['rules']['loop'];
    if ($this->_sections['rules']['total'] == 0)
        $this->_sections['rules']['show'] = false;
} else
    $this->_sections['rules']['total'] = 0;
if ($this->_sections['rules']['show']):

            for ($this->_sections['rules']['index'] = $this->_sections['rules']['start'], $this->_sections['rules']['iteration'] = 1;
                 $this->_sections['rules']['iteration'] <= $this->_sections['rules']['total'];
                 $this->_sections['rules']['index'] += $this->_sections['rules']['step'], $this->_sections['rules']['iteration']++):
$this->_sections['rules']['rownum'] = $this->_sections['rules']['iteration'];
$this->_sections['rules']['index_prev'] = $this->_sections['rules']['index'] - $this->_sections['rules']['step'];
$this->_sections['rules']['index_next'] = $this->_sections['rules']['index'] + $this->_sections['rules']['step'];
$this->_sections['rules']['first']      = ($this->_sections['rules']['iteration'] == 1);
$this->_sections['rules']['last']       = ($this->_sections['rules']['iteration'] == $this->_sections['rules']['total']);
?>
   <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#dddddd"), $this);?>
">
	 <td><a href='rules.php?tab=rule&cmd=rule_add&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rules']['index']]['rule_rid']; ?>
&c=1'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/edit.gif','border' => '0'), $this);?>
</a></td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rules']['index']]['rule_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['data'][$this->_sections['rules']['index']]['rule']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rules']['index']]['rule_default']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rules']['index']]['rule_file']; ?>
</td>
                  <td><?php if ($this->_tpl_vars['data'][$this->_sections['rules']['index']]['rule_isactive']): ?>
	<a href='rules.php?tab=rule&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rules']['index']]['rule_rid']; ?>
&v=0'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_err.png','border' => '0'), $this);?>

	</a>
	<?php else: ?>
	<a href='rules.php?tab=rule&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rules']['index']]['rule_rid']; ?>
&v=1'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_ok.png','border' => '0'), $this);?>

	</a>
	<?php endif; ?>
	</td>
      </tr>
   <?php endfor; endif; ?>
</table>

</td></tr>
<tr><td colspan=6>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td></tr>

<tr><td>
<a href='rules.php?tab=rule&cmd=rule_add&c=1'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>

</FORM>