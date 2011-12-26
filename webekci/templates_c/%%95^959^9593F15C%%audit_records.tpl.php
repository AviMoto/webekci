<?php /* Smarty version 2.6.26, created on 2009-09-15 16:01:07
         compiled from audit_records.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'audit_records.tpl', 2, false),array('function', 'html_options', 'audit_records.tpl', 15, false),array('function', 'cycle', 'audit_records.tpl', 60, false),array('function', 'html_image', 'audit_records.tpl', 62, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => 'template.conf','section' => 'Report'), $this);?>

<link href="web/css/CalendarControl.css" rel="stylesheet" type="text/css">
<script src="web/js/CalendarControl.js" language="javascript"></script>
<FORM name="audit" id="audit" action="reports.php?tab=audit" method="POST">
<table width=100% cellspacing=0 cellpadding=4 border=0 class='<?php echo $this->_config[0]['vars']['tblClass']; ?>
'>
<tr><td>
<?php echo $this->_config[0]['vars']['auditreportTitle']; ?>

<hr>
</td></tr>
<tr><td>

<table>
<tr>
<td><?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'severity','onChange' => 'this.form.submit();','selected' => $this->_tpl_vars['filter']['severity'],'options' => $this->_tpl_vars['filters']['severity']), $this);?>
</td>
<td><?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'category','onChange' => 'this.form.submit();','selected' => $this->_tpl_vars['filter']['category'],'options' => $this->_tpl_vars['filters']['category']), $this);?>
</td>
<td><?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'phase','onChange' => 'this.form.submit();','selected' => $this->_tpl_vars['filter']['phase'],'options' => $this->_tpl_vars['filters']['phase']), $this);?>
</td>
<td><?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'http_pro','onChange' => 'this.form.submit();','selected' => $this->_tpl_vars['filter']['http_pro'],'options' => $this->_tpl_vars['filters']['http_pro']), $this);?>
</td>
</tr>
<tr>
<td><?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'http_method','onChange' => 'this.form.submit();','selected' => $this->_tpl_vars['filter']['http_method'],'options' => $this->_tpl_vars['filters']['http_method']), $this);?>
</td>
<td><?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'status','onChange' => 'this.form.submit();','selected' => $this->_tpl_vars['filter']['status'],'options' => $this->_tpl_vars['filters']['status']), $this);?>
</td>
<td><?php echo smarty_function_html_options(array('class' => 'sbox','name' => 'http_code','onChange' => 'this.form.submit();','selected' => $this->_tpl_vars['filter']['http_code'],'options' => $this->_tpl_vars['filters']['http_code']), $this);?>
</td>
<td></td>
</tr>
</table>

</tr></td>
<tr><td>
<table>
<tr>
<td><input class="inputbox" type=text value="<?php if ($this->_tpl_vars['filter']['sdate']): ?><?php echo $this->_tpl_vars['filter']['sdate']; ?>
<?php endif; ?>"
    onfocus="showCalendarControl(this);" size="10" name="sdate" id="sdate"/></td>
<td>&nbsp;</td>
<td><input class=inputbox type=text  value="<?php if ($this->_tpl_vars['filter']['edate']): ?><?php echo $this->_tpl_vars['filter']['edate']; ?>
<?php endif; ?>"
    onfocus="showCalendarControl(this);" size="10" name="edate" id="edate"/></td>
<td><input type=submit  class=buton value="Go" name="go_date" onClick='this.form.submit();'/></td>
<td>&nbsp;</td>
<td><div style='padding-bottom:3px;position:relative;'>
<img src="web/images/search_icon.gif" width="16" style='position:absolute;top:2px;left:3px;' id="search_icon" height="16" border="0">
<input class="inputbox" type="text"  value="<?php echo $this->_tpl_vars['filter']['search']; ?>
" name="search" id="search" size="22" style="padding-left:20px;"></div></td>
<td width="%100"></td>
</tr>
</table>
<br>

<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Source IP</th>
<th align=left>Source Port</th>
<th align=left>Date</th>
<th align=left>Time</th>
<th align=left>Host</th>
<th align=left>Message</th>
</tr>
</thead>
   <?php unset($this->_sections['alog']);
$this->_sections['alog']['name'] = 'alog';
$this->_sections['alog']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['alog']['show'] = true;
$this->_sections['alog']['max'] = $this->_sections['alog']['loop'];
$this->_sections['alog']['step'] = 1;
$this->_sections['alog']['start'] = $this->_sections['alog']['step'] > 0 ? 0 : $this->_sections['alog']['loop']-1;
if ($this->_sections['alog']['show']) {
    $this->_sections['alog']['total'] = $this->_sections['alog']['loop'];
    if ($this->_sections['alog']['total'] == 0)
        $this->_sections['alog']['show'] = false;
} else
    $this->_sections['alog']['total'] = 0;
if ($this->_sections['alog']['show']):

            for ($this->_sections['alog']['index'] = $this->_sections['alog']['start'], $this->_sections['alog']['iteration'] = 1;
                 $this->_sections['alog']['iteration'] <= $this->_sections['alog']['total'];
                 $this->_sections['alog']['index'] += $this->_sections['alog']['step'], $this->_sections['alog']['iteration']++):
$this->_sections['alog']['rownum'] = $this->_sections['alog']['iteration'];
$this->_sections['alog']['index_prev'] = $this->_sections['alog']['index'] - $this->_sections['alog']['step'];
$this->_sections['alog']['index_next'] = $this->_sections['alog']['index'] + $this->_sections['alog']['step'];
$this->_sections['alog']['first']      = ($this->_sections['alog']['iteration'] == 1);
$this->_sections['alog']['last']       = ($this->_sections['alog']['iteration'] == $this->_sections['alog']['total']);
?>
   <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#dddddd"), $this);?>
">
	 <td><a href="javascript:void(0);" OnClick="WindowOpen('reports.php?tab=audit&cmd=show_det&id=<?php echo $this->_tpl_vars['data'][$this->_sections['alog']['index']]['alog_id']; ?>
');">
	<?php echo smarty_function_html_image(array('file' => 'web/images/edit.gif','border' => '0'), $this);?>

	</a></td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['alog']['index']]['source_ip']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['alog']['index']]['source_port']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['alog']['index']]['date']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['alog']['index']]['time']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['alog']['index']]['host']; ?>
</td>
         <td><?php echo $this->_tpl_vars['data'][$this->_sections['alog']['index']]['msg']; ?>
</td>
      </tr>
   <?php endfor; endif; ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</td></tr>
</table>

</FORM>

<?php echo '
<script type="text/javascript">
	function WindowOpen (url) {
	w=window.open(url,\'s\',\'scrollbars=yes,status=no,resizable=no,width=450,height=450\',\'if (!w.opener) {w.opener = self;}w.focus();\')
	}

</script>
'; ?>