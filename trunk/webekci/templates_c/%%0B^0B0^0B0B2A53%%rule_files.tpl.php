<?php /* Smarty version 2.6.26, created on 2009-09-15 16:01:03
         compiled from rule_files.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule_files.tpl', 2, false),array('function', 'cycle', 'rule_files.tpl', 22, false),array('function', 'html_image', 'rule_files.tpl', 24, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>


<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['rulefileTitle']; ?>

<hr>
</td></tr>
<tr><td>

<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Rule File Name</th>
<th align=left>Directives (Rules)</th>
<th align=left>Rule Data Files</th>
<th align=left>Status</th>
</tr>
</thead>
   <?php unset($this->_sections['rule_file']);
$this->_sections['rule_file']['name'] = 'rule_file';
$this->_sections['rule_file']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rule_file']['show'] = true;
$this->_sections['rule_file']['max'] = $this->_sections['rule_file']['loop'];
$this->_sections['rule_file']['step'] = 1;
$this->_sections['rule_file']['start'] = $this->_sections['rule_file']['step'] > 0 ? 0 : $this->_sections['rule_file']['loop']-1;
if ($this->_sections['rule_file']['show']) {
    $this->_sections['rule_file']['total'] = $this->_sections['rule_file']['loop'];
    if ($this->_sections['rule_file']['total'] == 0)
        $this->_sections['rule_file']['show'] = false;
} else
    $this->_sections['rule_file']['total'] = 0;
if ($this->_sections['rule_file']['show']):

            for ($this->_sections['rule_file']['index'] = $this->_sections['rule_file']['start'], $this->_sections['rule_file']['iteration'] = 1;
                 $this->_sections['rule_file']['iteration'] <= $this->_sections['rule_file']['total'];
                 $this->_sections['rule_file']['index'] += $this->_sections['rule_file']['step'], $this->_sections['rule_file']['iteration']++):
$this->_sections['rule_file']['rownum'] = $this->_sections['rule_file']['iteration'];
$this->_sections['rule_file']['index_prev'] = $this->_sections['rule_file']['index'] - $this->_sections['rule_file']['step'];
$this->_sections['rule_file']['index_next'] = $this->_sections['rule_file']['index'] + $this->_sections['rule_file']['step'];
$this->_sections['rule_file']['first']      = ($this->_sections['rule_file']['iteration'] == 1);
$this->_sections['rule_file']['last']       = ($this->_sections['rule_file']['iteration'] == $this->_sections['rule_file']['total']);
?>
   <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#dddddd"), $this);?>
">
	 <td><a href='rules.php?tab=rfile&cmd=rf_add&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_file']['index']]['rf_id']; ?>
'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/edit.gif','border' => '0'), $this);?>
</a></td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rule_file']['index']]['rf_name']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rule_file']['index']]['rf_rule_count']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rule_file']['index']]['rf_data_file_count']; ?>
</td>
         <td><?php if ($this->_tpl_vars['data'][$this->_sections['rule_file']['index']]['rf_isactive']): ?>
	<a href='rules.php?tab=rfile&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_file']['index']]['rf_id']; ?>
&v=0'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_err.png','border' => '0'), $this);?>

	</a>
	<?php else: ?>
	<a href='rules.php?tab=rfile&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_file']['index']]['rf_id']; ?>
&v=1'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_ok.png','border' => '0'), $this);?>

	</a>
	<?php endif; ?>
	</td>
      </tr>
   <?php endfor; endif; ?>
</table>

</td></tr>
<tr><td>
<a href='rules.php?tab=rfile&cmd=rf_add'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>
</FORM>