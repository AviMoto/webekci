{*{debug}*}
{config_load file='template.conf' section='Configuration'}

<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#rulefileTitle#}
<hr>
</td></tr>
<tr><td>

<table  class="cerceveic" border="0" cellpadding="0" cellspacing="0">
<thead>
<tr >
<th align=left></th>
<th align=left>Rule File Name</th>
<th align=left>Directives (Rules)</th>
<th align=left>Rule Data Files</th>
<th align=left>Status</th>
</tr>
</thead>
   {section name=rule_file loop=$data}
   <tr bgcolor="{cycle values="#eeeeee,#dddddd"}">
	 <td><a href='rules.php?tab=rfile&cmd=rf_add&id={$data[rule_file].rf_id}'>
	{html_image file='web/images/edit.gif' border='0'}</a></td>
         <td>{$data[rule_file].rf_name}</td>
         <td>{$data[rule_file].rf_rule_count}</td>
         <td>{$data[rule_file].rf_data_file_count}</td>
         <td>{if $data[rule_file].rf_isactive}
	<a href='rules.php?tab=rfile&cmd=validity&id={$data[rule_file].rf_id}&v=0'>
	{html_image file='web/images/_err.png' border='0'}
	</a>
	{else}
	<a href='rules.php?tab=rfile&cmd=validity&id={$data[rule_file].rf_id}&v=1'>
	{html_image file='web/images/_ok.png' border='0'}
	</a>
	{/if}
	</td>
      </tr>
   {/section}
</table>

</td></tr>
<tr><td>
<a href='rules.php?tab=rfile&cmd=rf_add'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>
</FORM>