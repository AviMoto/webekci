<?php /* Smarty version 2.6.26, created on 2009-09-01 23:05:11
         compiled from tab_menu.tpl */ ?>
<link rel="StyleSheet" href="web/css/jstabs.css" type="text/css"> 
<div id=wrapper style='width:99%'>
<div id=content>
	<?php $_from = $this->_tpl_vars['sub_menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sub_menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sub_menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['path']):
        $this->_foreach['sub_menu']['iteration']++;
?>	
	<div id=tab<?php echo ($this->_foreach['sub_menu']['iteration']-1)+1; ?>
 class=tab

	<?php if (($this->_foreach['sub_menu']['iteration']-1) == $this->_tpl_vars['select_menu']): ?>
	style='background:url(web/images/tab_on.png) no-repeat;'
	<?php else: ?>
	style='background:url(web/images/tab_off.png) no-repeat;'
	<?php endif; ?>	

	OnClick='tab_menu(<?php echo ($this->_foreach['sub_menu']['iteration']-1)+1; ?>
,
	<?php echo $this->_tpl_vars['count_menus']; ?>
);'>
	<h3 class=tabtxt>
	<a href='<?php echo $this->_tpl_vars['path']; ?>
&c=<?php echo ($this->_foreach['sub_menu']['iteration']-1); ?>
' class='tablink'><?php echo $this->_tpl_vars['label']; ?>
</a></h3></div>
	<?php endforeach; endif; unset($_from); ?>
	
	<div class=boxholder>

	<?php $_from = $this->_tpl_vars['sub_menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sub_div'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sub_div']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['path']):
        $this->_foreach['sub_div']['iteration']++;
?>
        <div id='box<?php echo ($this->_foreach['sub_div']['iteration']-1)+1; ?>
'
	class='box'
	<?php if (($this->_foreach['sub_div']['iteration'] <= 1)): ?>
	 style='display:block;'>
	<?php else: ?>
	 style='display:none;'>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tab_page']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php endforeach; endif; unset($_from); ?>

	</div>
	</div>
	</div>
	

<script type="text/javascript" src="web/js/prototype.js"></script>
<script type="text/javascript">
<?php echo '
	function tab_menu (ch,count) {
	     for (i=1; i<=count; i++) {
	       var box = $(\'box\'+i);
	       var tab = $(\'tab\'+i);
	     if (i==ch) {
	       box.style.display    = \'block\';
	       tab.style.background = \'url(web/images/tab_on.png) no-repeat\';
	     }
	     else {
	       box.style.display    = \'none\';
	       tab.style.background = \'url(web/images/tab_off.png) no-repeat\';
	     }
	   }
	 }
'; ?>

</script>