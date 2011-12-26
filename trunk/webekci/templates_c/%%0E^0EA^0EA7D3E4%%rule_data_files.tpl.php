<?php /* Smarty version 2.6.26, created on 2009-10-17 13:35:32
         compiled from rule_data_files.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'rule_data_files.tpl', 2, false),array('function', 'cycle', 'rule_data_files.tpl', 22, false),array('function', 'html_image', 'rule_data_files.tpl', 24, false),)), $this); ?>
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
<th align=left>Rule Data File</th>
<th align=left>Rule Datas</th>
<th align=left>Rule File </th>
<th align=left>Status</th>
</tr>
</thead>
   <?php unset($this->_sections['rule_dfile']);
$this->_sections['rule_dfile']['name'] = 'rule_dfile';
$this->_sections['rule_dfile']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rule_dfile']['show'] = true;
$this->_sections['rule_dfile']['max'] = $this->_sections['rule_dfile']['loop'];
$this->_sections['rule_dfile']['step'] = 1;
$this->_sections['rule_dfile']['start'] = $this->_sections['rule_dfile']['step'] > 0 ? 0 : $this->_sections['rule_dfile']['loop']-1;
if ($this->_sections['rule_dfile']['show']) {
    $this->_sections['rule_dfile']['total'] = $this->_sections['rule_dfile']['loop'];
    if ($this->_sections['rule_dfile']['total'] == 0)
        $this->_sections['rule_dfile']['show'] = false;
} else
    $this->_sections['rule_dfile']['total'] = 0;
if ($this->_sections['rule_dfile']['show']):

            for ($this->_sections['rule_dfile']['index'] = $this->_sections['rule_dfile']['start'], $this->_sections['rule_dfile']['iteration'] = 1;
                 $this->_sections['rule_dfile']['iteration'] <= $this->_sections['rule_dfile']['total'];
                 $this->_sections['rule_dfile']['index'] += $this->_sections['rule_dfile']['step'], $this->_sections['rule_dfile']['iteration']++):
$this->_sections['rule_dfile']['rownum'] = $this->_sections['rule_dfile']['iteration'];
$this->_sections['rule_dfile']['index_prev'] = $this->_sections['rule_dfile']['index'] - $this->_sections['rule_dfile']['step'];
$this->_sections['rule_dfile']['index_next'] = $this->_sections['rule_dfile']['index'] + $this->_sections['rule_dfile']['step'];
$this->_sections['rule_dfile']['first']      = ($this->_sections['rule_dfile']['iteration'] == 1);
$this->_sections['rule_dfile']['last']       = ($this->_sections['rule_dfile']['iteration'] == $this->_sections['rule_dfile']['total']);
?>
   <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#dddddd"), $this);?>
">
	 <td><a href='rules.php?tab=rdfile&cmd=rdf_add&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_dfile']['index']]['rdf_id']; ?>
'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/edit.gif','border' => '0'), $this);?>
</a></td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rule_dfile']['index']]['rdf_name']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rule_dfile']['index']]['rdf_data_count']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['rule_dfile']['index']]['rf_name']; ?>
</td>
         <td><?php if ($this->_tpl_vars['data'][$this->_sections['rule_dfile']['index']]['rdf_isactive']): ?>
	<a href='rules.php?tab=rdfile&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_dfile']['index']]['rdf_id']; ?>
&v=0&c=2'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_err.png','border' => '0'), $this);?>

	</a>
	<?php else: ?>
	<a href='rules.php?tab=rdfile&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['rule_dfile']['index']]['rdf_id']; ?>
&v=1&c=2'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_ok.png','border' => '0'), $this);?>

	</a>
	<?php endif; ?>
	</td>
      </tr>
   <?php endfor; endif; ?>
</table>

</td></tr>
<tr><td>
<a href='rules.php?tab=rdfile&cmd=rdf_add&c=2'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>
</FORM>