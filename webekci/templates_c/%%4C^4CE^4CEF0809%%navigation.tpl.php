<?php /* Smarty version 2.6.26, created on 2009-09-15 16:01:07
         compiled from navigation.tpl */ ?>
<table class="nav" border="0" cellpadding="0" cellspacing="2">
<tr><td align=left style="width:10">
<input name="rows" id="rows" type="text" class=inputbox value="<?php echo $this->_tpl_vars['rows']; ?>
" maxlength="4" size="4"/></td>
<td align=left style="width:50">Records</td>
<td align=left style="width:25">
<input name="begin" id="begin" type="text" class=inputbox value="<?php echo $this->_tpl_vars['begin']; ?>
" maxlength="4" size="4"/></td>
<td align=left style="width:35">Page</td>
<td align=left style="width:25" >
<input type=submit class=buton value="Go" name="go" onClick='this.form.submit();'/>
</td><td align=center>


<?php if ($this->_tpl_vars['total_row'] > $this->_tpl_vars['rows']): ?>

<?php if ($this->_tpl_vars['start'] > 1): ?>
<span class="nav_records">
<a href="javascript:nav_page('<?php echo $this->_tpl_vars['tab']; ?>
',<?php echo $this->_tpl_vars['start']-10; ?>
);"><</a>
</span>
<?php endif; ?>

<?php unset($this->_sections['nav']);
$this->_sections['nav']['name'] = 'nav';
$this->_sections['nav']['start'] = (int)$this->_tpl_vars['start'];
$this->_sections['nav']['loop'] = is_array($_loop=$this->_tpl_vars['ceil']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nav']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['nav']['show'] = true;
$this->_sections['nav']['max'] = $this->_sections['nav']['loop'];
if ($this->_sections['nav']['start'] < 0)
    $this->_sections['nav']['start'] = max($this->_sections['nav']['step'] > 0 ? 0 : -1, $this->_sections['nav']['loop'] + $this->_sections['nav']['start']);
else
    $this->_sections['nav']['start'] = min($this->_sections['nav']['start'], $this->_sections['nav']['step'] > 0 ? $this->_sections['nav']['loop'] : $this->_sections['nav']['loop']-1);
if ($this->_sections['nav']['show']) {
    $this->_sections['nav']['total'] = min(ceil(($this->_sections['nav']['step'] > 0 ? $this->_sections['nav']['loop'] - $this->_sections['nav']['start'] : $this->_sections['nav']['start']+1)/abs($this->_sections['nav']['step'])), $this->_sections['nav']['max']);
    if ($this->_sections['nav']['total'] == 0)
        $this->_sections['nav']['show'] = false;
} else
    $this->_sections['nav']['total'] = 0;
if ($this->_sections['nav']['show']):

            for ($this->_sections['nav']['index'] = $this->_sections['nav']['start'], $this->_sections['nav']['iteration'] = 1;
                 $this->_sections['nav']['iteration'] <= $this->_sections['nav']['total'];
                 $this->_sections['nav']['index'] += $this->_sections['nav']['step'], $this->_sections['nav']['iteration']++):
$this->_sections['nav']['rownum'] = $this->_sections['nav']['iteration'];
$this->_sections['nav']['index_prev'] = $this->_sections['nav']['index'] - $this->_sections['nav']['step'];
$this->_sections['nav']['index_next'] = $this->_sections['nav']['index'] + $this->_sections['nav']['step'];
$this->_sections['nav']['first']      = ($this->_sections['nav']['iteration'] == 1);
$this->_sections['nav']['last']       = ($this->_sections['nav']['iteration'] == $this->_sections['nav']['total']);
?> 

<?php if ($this->_sections['nav']['index'] <= $this->_tpl_vars['start']+10): ?> 
<span class="<?php if ($this->_tpl_vars['begin'] == $this->_sections['nav']['index']): ?> nav_highlight <?php else: ?> nav_records <?php endif; ?> ">
<a href="javascript:nav('<?php echo $this->_tpl_vars['tab']; ?>
',<?php echo $this->_sections['nav']['index']; ?>
);"><?php echo $this->_sections['nav']['index']; ?>
</a>
</span>
<?php endif; ?>

<?php endfor; endif; ?>

<?php if ($this->_tpl_vars['ceil'] > $this->_tpl_vars['start']+10): ?>
<span class="nav_records">
<a href="javascript:nav_page('<?php echo $this->_tpl_vars['tab']; ?>
',<?php echo $this->_tpl_vars['start']+10; ?>
);">></a>
</span>
<?php endif; ?>

<?php endif; ?>

</td></tr>
</table>

<input name="start" id="start" type="hidden" value=""/>

<?php echo '
<script type="text/javascript">
	function nav (formid,begin) {
	    var formObj = document.getElementById(formid);
	    formObj.begin.value=begin;
            formObj.submit();
	}

	function nav_page (formid,start) {
	    var formObj = document.getElementById(formid);
	    formObj.start.value=start;
	    formObj.begin.value=start;
            formObj.submit();
	}
</script>
'; ?>