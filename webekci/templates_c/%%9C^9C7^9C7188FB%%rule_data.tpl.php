<?php /* Smarty version 2.6.26, created on 2009-10-17 13:34:14
         compiled from rule_data.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule_data.tpl', 2, false),array('function', 'cycle', 'rule_data.tpl', 36, false),array('function', 'html_image', 'rule_data.tpl', 38, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM name="rdata" id="rdata" action="rules.php?tab=rdata&c=3" method="POST">
<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['ruleTitle']; ?>

</td>
<td align=right>

<select name="rule_dfile_filter"  id="rule_dfile_filter" onChange='this.form.submit();'>
<option value="0" align=center>--- All Rule Data Files ---</option>
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
	<?php if ($this->_tpl_vars['rule_dfilter'][$this->_sections['rdfilter']['index']]['rdf_id'] == $this->_tpl_vars['rdfile_id']): ?>
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
<td colspan=2>
<hr>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Data</th>
<th align=left>Data File</th>
<th align=left>Status</th>
</tr>
</thead>
   <?php unset($this->_sections['rule_datas']);
$this->_sections['rule_datas']['name'] = 'rule_datas';
$this->_sections['rule_datas']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rule_datas']['show'] = true;
$this->_sections['rule_datas']['max'] = $this->_sections['rule_datas']['loop'];
$this->_sections['rule_datas']['step'] = 1;
$this->_sections['rule_datas']['start'] = $this->_sections['rule_datas']['step'] > 0 ? 0 : $this->_sections['rule_datas']['loop']-1;
if ($this->_sections['rule_datas']['show']) {
    $this->_sections['rule_datas']['total'] = $this->_sections['rule_datas']['loop'];
    if ($this->_sections['rule_datas']['total'] == 0)
        $this->_sections['rule_datas']['show'] = false;
} else
    $this->_sections['rule_datas']['total'] = 0;
if ($this->_sections['rule_datas']['show']):

            for ($this->_sections['rule_datas']['index'] = $this->_sections['rule_datas']['start'], $this->_sections['rule_datas']['iteration'] = 1;
                 $this->_sections['rule_datas']['iteration'] <= $this->_sections['rule_datas']['total'];
                 $this->_sections['rule_datas']['index'] += $this->_sections['rule_datas']['step'], $this->_sections['rule_datas']['iteration']++):
$this->_sections['rule_datas']['rownum'] = $this->_sections['rule_datas']['iteration'];
$this->_sections['rule_datas']['index_prev'] = $this->_sections['rule_datas']['index'] - $this->_sections['rule_datas']['step'];
$this->_sections['rule_datas']['index_next'] = $this->_sections['rule_datas']['index'] + $this->_sections['rule_datas']['step'];
$this->_sections['rule_datas']['first']      = ($this->_sections['rule_datas']['iteration'] == 1);
$this->_sections['rule_datas']['last']       = ($this->_sections['rule_datas']['iteration'] == $this->_sections['rule_datas']['total']);
?>
   <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#dddddd"), $this);?>
">
	 <td><a href='rules.php?tab=rdata&cmd=rd_add&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_datas']['index']]['rd_id']; ?>
&c=3'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/edit.gif','border' => '0'), $this);?>
</a></td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rule_datas']['index']]['rd_name']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rule_datas']['index']]['rdf_name']; ?>
</td>
         <td><?php if ($this->_tpl_vars['data'][$this->_sections['rule_datas']['index']]['rd_isactive']): ?>
	<a href='rules.php?tab=rdata&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_datas']['index']]['rd_id']; ?>
&v=0&c=3'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_err.png','border' => '0'), $this);?>

	</a>
	<?php else: ?>
	<a href='rules.php?tab=rdata&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_datas']['index']]['rd_id']; ?>
&v=1&c=3'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_ok.png','border' => '0'), $this);?>

	</a>
	<?php endif; ?>
	</td>
      </tr>
   <?php endfor; endif; ?>
</table>

</td></tr>
<tr><td colspan=4>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td></tr>

<tr><td>
<a href='rules.php?tab=rdata&cmd=rd_add&c=3'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>

</FORM>