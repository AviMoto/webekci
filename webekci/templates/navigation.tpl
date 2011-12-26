<table class="nav" border="0" cellpadding="0" cellspacing="2">
<tr><td align=left style="width:10">
<input name="rows" id="rows" type="text" class=inputbox value="{$rows}" maxlength="4" size="4"/></td>
<td align=left style="width:50">Records</td>
<td align=left style="width:25">
<input name="begin" id="begin" type="text" class=inputbox value="{$begin}" maxlength="4" size="4"/></td>
<td align=left style="width:35">Page</td>
<td align=left style="width:25" >
<input type=submit class=buton value="Go" name="go" onClick='this.form.submit();'/>
</td><td align=center>


{if $total_row>$rows}

{if $start > 1}
<span class="nav_records">
<a href="javascript:nav_page('{$tab}',{$start-10});"><</a>
</span>
{/if}

{section name='nav' start=$start loop=$ceil+1 step=1} 

{if $smarty.section.nav.index <= $start+10} 
<span class="{if $begin == $smarty.section.nav.index} nav_highlight {else} nav_records {/if} ">
<a href="javascript:nav('{$tab}',{$smarty.section.nav.index});">{$smarty.section.nav.index}</a>
</span>
{/if}

{/section}

{if $ceil > $start+10}
<span class="nav_records">
<a href="javascript:nav_page('{$tab}',{$start+10});">></a>
</span>
{/if}

{/if}

</td></tr>
</table>

<input name="start" id="start" type="hidden" value=""/>

{literal}
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
{/literal}