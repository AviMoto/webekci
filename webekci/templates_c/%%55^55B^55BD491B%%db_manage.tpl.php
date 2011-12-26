<?php /* Smarty version 2.6.26, created on 2009-09-01 23:18:15
         compiled from db_manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'db_manage.tpl', 2, false),array('function', 'html_checkboxes', 'db_manage.tpl', 10, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'WebekciManage'), $this);?>

<FORM action="webekci_manage.php?tab=dbmng" method="post">	
<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['dbTitle']; ?>

<hr>
</td></tr>
<tr><td>
   <?php echo smarty_function_html_checkboxes(array('name' => 'tables','options' => $this->_tpl_vars['db_list'],'selected' => $this->_tpl_vars['selected_db'],'separator' => '<br />'), $this);?>

</td></tr>
<tr><td>
<input type=submit value=Submit name=submit />
</td></tr>
</table>
</FORM>