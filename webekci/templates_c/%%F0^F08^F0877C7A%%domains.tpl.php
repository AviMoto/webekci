<?php /* Smarty version 2.6.26, created on 2009-09-01 23:05:11
         compiled from domains.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'domains.tpl', 2, false),array('function', 'cycle', 'domains.tpl', 24, false),array('function', 'html_image', 'domains.tpl', 26, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Configuration'), $this);?>


<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['domainTitle']; ?>

<hr>
</td></tr>
<tr><td>

<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Domain Name</th>
<th align=left>Server Name</th>
<th align=left>Server IP</th>
<th align=left>Server Port</th>
<th align=left>Server Admin</th>
<th align=left>Status</th>
</tr>
</thead>
   <?php unset($this->_sections['domain']);
$this->_sections['domain']['name'] = 'domain';
$this->_sections['domain']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['domain']['show'] = true;
$this->_sections['domain']['max'] = $this->_sections['domain']['loop'];
$this->_sections['domain']['step'] = 1;
$this->_sections['domain']['start'] = $this->_sections['domain']['step'] > 0 ? 0 : $this->_sections['domain']['loop']-1;
if ($this->_sections['domain']['show']) {
    $this->_sections['domain']['total'] = $this->_sections['domain']['loop'];
    if ($this->_sections['domain']['total'] == 0)
        $this->_sections['domain']['show'] = false;
} else
    $this->_sections['domain']['total'] = 0;
if ($this->_sections['domain']['show']):

            for ($this->_sections['domain']['index'] = $this->_sections['domain']['start'], $this->_sections['domain']['iteration'] = 1;
                 $this->_sections['domain']['iteration'] <= $this->_sections['domain']['total'];
                 $this->_sections['domain']['index'] += $this->_sections['domain']['step'], $this->_sections['domain']['iteration']++):
$this->_sections['domain']['rownum'] = $this->_sections['domain']['iteration'];
$this->_sections['domain']['index_prev'] = $this->_sections['domain']['index'] - $this->_sections['domain']['step'];
$this->_sections['domain']['index_next'] = $this->_sections['domain']['index'] + $this->_sections['domain']['step'];
$this->_sections['domain']['first']      = ($this->_sections['domain']['iteration'] == 1);
$this->_sections['domain']['last']       = ($this->_sections['domain']['iteration'] == $this->_sections['domain']['total']);
?>
   <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#dddddd"), $this);?>
">
	 <td><a href='configurations.php?tab=dmns&cmd=dadd&id=<?php echo $this->_tpl_vars['data'][$this->_sections['domain']['index']]['id']; ?>
'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/edit.gif','border' => '0'), $this);?>
</a></td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['domain']['index']]['dname']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['domain']['index']]['sname']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['domain']['index']]['sip']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['domain']['index']]['sport']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['domain']['index']]['sadmin']; ?>
</td>
         <td><?php if ($this->_tpl_vars['data'][$this->_sections['domain']['index']]['isactive'] == 1): ?>
	<a href='configurations.php?tab=dmns&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['domain']['index']]['id']; ?>
&v=0'>
	<?php echo smarty_function_html_image(array('file' => 'web/images/_ok.png','border' => '0'), $this);?>

	</a>
	<?php else: ?>
	<a href='configurations.php?tab=dmns&cmd=validity&id=<?php echo $this->_tpl_vars['data'][$this->_sections['domain']['index']]['id']; ?>
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
<a href='configurations.php?tab=dmns&cmd=dadd'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>
</FORM>