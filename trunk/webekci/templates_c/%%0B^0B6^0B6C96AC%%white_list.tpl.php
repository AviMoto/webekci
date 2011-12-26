<?php /* Smarty version 2.6.26, created on 2009-10-17 13:34:24
         compiled from white_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'white_list.tpl', 2, false),array('function', 'html_options', 'white_list.tpl', 9, false),array('function', 'cycle', 'white_list.tpl', 25, false),array('function', 'html_image', 'white_list.tpl', 27, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>

<FORM name="wlist" id="wlist" action="rules.php?tab=wlist&c=4" method="POST">
<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['WhiteListTitle']; ?>

</td>
<td align=right>
<?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'wlist_filter','onChange' => 'this.form.submit();','selected' => $this->_tpl_vars['wl_type_id'],'options' => $this->_tpl_vars['filters']['wlist_filter']), $this);?>

</td>
</tr>
<tr>
<td colspan=2>
<hr>
<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Type</th>
<th align=left>Data</th>
<th align=left>Status</th>
</tr>
</thead>
   <?php unset($this->_sections['white_lists']);
$this->_sections['white_lists']['name'] = 'white_lists';
$this->_sections['white_lists']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['white_lists']['show'] = true;
$this->_sections['white_lists']['max'] = $this->_sections['white_lists']['loop'];
$this->_sections['white_lists']['step'] = 1;
$this->_sections['white_lists']['start'] = $this->_sections['white_lists']['step'] > 0 ? 0 : $this->_sections['white_lists']['loop']-1;
if ($this->_sections['white_lists']['show']) {
    $this->_sections['white_lists']['total'] = $this->_sections['white_lists']['loop'];
    if ($this->_sections['white_lists']['total'] == 0)
        $this->_sections['white_lists']['show'] = false;
} else
    $this->_sections['white_lists']['total'] = 0;
if ($this->_sections['white_lists']['show']):

            for ($this->_sections['white_lists']['index'] = $this->_sections['white_lists']['start'], $this->_sections['white_lists']['iteration'] = 1;
                 $this->_sections['white_lists']['iteration'] <= $this->_sections['white_lists']['total'];
                 $this->_sections['white_lists']['index'] += $this->_sections['white_lists']['step'], $this->_sections['white_lists']['iteration']++):
$this->_sections['white_lists']['rownum'] = $this->_sections['white_lists']['iteration'];
$this->_sections['white_lists']['index_prev'] = $this->_sections['white_lists']['index'] - $this->_sections['white_lists']['step'];
$this->_sections['white_lists']['index_next'] = $this->_sections['white_lists']['index'] + $this->_sections['white_lists']['step'];
$this->_sections['white_lists']['first']      = ($this->_sections['white_lists']['iteration'] == 1);
$this->_sections['white_lists']['last']       = ($this->_sections['white_lists']['iteration'] == $this->_sections['white_lists']['total']);
?>
   <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#dddddd"), $this);?>
">
	 <td><a href='rules.php?tab=wlist&cmd=wl_add&id=<?php echo $this->_tpl_vars['data'][$this->_sections['white_lists']['index']]['wl_id']; ?>
&c=4'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/edit.gif','border' => '0'), $this);?>
</a></td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['white_lists']['index']]['wl_type']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['white_lists']['index']]['wl_data']; ?>
</td>
         <td><?php if ($this->_tpl_vars['data'][$this->_sections['white_lists']['index']]['wl_isactive']): ?>
	<a href='rules.php?tab=wlist&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['white_lists']['index']]['wl_id']; ?>
&v=0&c=4'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_err.png','border' => '0'), $this);?>

	</a>
	<?php else: ?>
	<a href='rules.php?tab=wlist&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['white_lists']['index']]['wl_id']; ?>
&v=1&c=4'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_ok.png','border' => '0'), $this);?>

	</a>
	<?php endif; ?>
	</td>
      </tr>
   <?php endfor; endif; ?>
</table>

</td></tr>
<?php if ($this->_tpl_vars['ceil'] > 1): ?>
<tr><td colspan=4>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td></tr>
<?php endif; ?>

<tr><td>
<a href='rules.php?tab=wlist&cmd=wl_add&c=4'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>

</FORM>