<?php /* Smarty version 2.6.26, created on 2009-09-01 23:12:25
         compiled from modsec_conf.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'modsec_conf.tpl', 2, false),array('function', 'cycle', 'modsec_conf.tpl', 21, false),array('function', 'html_image', 'modsec_conf.tpl', 23, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>


<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['msecconfTitle']; ?>

<hr>
</td></tr>
<tr><td>

<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Configuration Name</th>
<th align=left>Description</th>
<th align=left>Status</th>
</tr>
</thead>
   <?php unset($this->_sections['conf']);
$this->_sections['conf']['name'] = 'conf';
$this->_sections['conf']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['conf']['show'] = true;
$this->_sections['conf']['max'] = $this->_sections['conf']['loop'];
$this->_sections['conf']['step'] = 1;
$this->_sections['conf']['start'] = $this->_sections['conf']['step'] > 0 ? 0 : $this->_sections['conf']['loop']-1;
if ($this->_sections['conf']['show']) {
    $this->_sections['conf']['total'] = $this->_sections['conf']['loop'];
    if ($this->_sections['conf']['total'] == 0)
        $this->_sections['conf']['show'] = false;
} else
    $this->_sections['conf']['total'] = 0;
if ($this->_sections['conf']['show']):

            for ($this->_sections['conf']['index'] = $this->_sections['conf']['start'], $this->_sections['conf']['iteration'] = 1;
                 $this->_sections['conf']['iteration'] <= $this->_sections['conf']['total'];
                 $this->_sections['conf']['index'] += $this->_sections['conf']['step'], $this->_sections['conf']['iteration']++):
$this->_sections['conf']['rownum'] = $this->_sections['conf']['iteration'];
$this->_sections['conf']['index_prev'] = $this->_sections['conf']['index'] - $this->_sections['conf']['step'];
$this->_sections['conf']['index_next'] = $this->_sections['conf']['index'] + $this->_sections['conf']['step'];
$this->_sections['conf']['first']      = ($this->_sections['conf']['iteration'] == 1);
$this->_sections['conf']['last']       = ($this->_sections['conf']['iteration'] == $this->_sections['conf']['total']);
?>
   <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#dddddd"), $this);?>
">
	 <td><a href='configurations.php?tab=mscnf&cmd=cadd&id=<?php echo $this->_tpl_vars['data'][$this->_sections['conf']['index']]['id']; ?>
'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/edit.gif','border' => '0'), $this);?>
</a></td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['conf']['index']]['cname']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['conf']['index']]['cdescription']; ?>
</td>
         <td><?php if ($this->_tpl_vars['data'][$this->_sections['conf']['index']]['isactive'] == 1): ?>
	<a href='configurations.php?tab=mscnf&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['conf']['index']]['id']; ?>
&v=0'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_ok.png','border' => '0'), $this);?>

	</a>
	<?php else: ?>
	<a href='configurations.php?tab=mscnf&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['conf']['index']]['id']; ?>
&v=1'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_err.png','border' => '0'), $this);?>

	</a>
	<?php endif; ?>
	</td>
      </tr>
   <?php endfor; endif; ?>
</table>

</td></tr>
<tr><td>
<a href='configurations.php?tab=mscnf&cmd=cadd'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>
</FORM>