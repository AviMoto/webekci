<?php /* Smarty version 2.6.26, created on 2009-09-01 23:05:34
         compiled from wb_manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'wb_manage.tpl', 2, false),array('function', 'html_checkboxes', 'wb_manage.tpl', 10, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'WebekciManage'), $this);?>

<FORM action="webekci_manage.php?tab=wbmng&c=0" method="post">	
<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['wbManageTitle']; ?>

<hr>
</td></tr>
<tr><td>
   <?php echo smarty_function_html_checkboxes(array('name' => 'mchoise','options' => $this->_tpl_vars['wb_list'],'selected' => $this->_tpl_vars['selected_wb'],'separator' => '<br/>'), $this);?>

</td></tr>
<tr><td>
<input type=submit value=Commit name=submit />
</td></tr>
</table>
</FORM>