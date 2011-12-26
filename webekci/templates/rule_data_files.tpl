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
<th align=left>Rule Data File</th>
<th align=left>Rule Datas</th>
<th align=left>Rule File </th>
<th align=left>Status</th>
</tr>
</thead>
   {section name=rule_dfile loop=$data}
   <tr bgcolor="{cycle values="#eeeeee,#dddddd"}">
	 <td><a href='rules.php?tab=rdfile&cmd=rdf_add&id={$data[rule_dfile].rdf_id}'>
	{html_image file='web/images/edit.gif' border='0'}</a></td>
         <td>{$data[rule_dfile].rdf_name}</td>
         <td>{$data[rule_dfile].rdf_data_count}</td>
         <td>{$data[rule_dfile].rf_name}</td>
         <td>{if $data[rule_dfile].rdf_isactive}
	<a href='rules.php?tab=rdfile&cmd=validity&id={$data[rule_dfile].rdf_id}&v=0&c=2'>
	{html_image file='web/images/_err.png' border='0'}
	</a>
	{else}
	<a href='rules.php?tab=rdfile&cmd=validity&id={$data[rule_dfile].rdf_id}&v=1&c=2'>
	{html_image file='web/images/_ok.png' border='0'}
	</a>
	{/if}
	</td>
      </tr>
   {/section}
</table>

</td></tr>
<tr><td>
<a href='rules.php?tab=rdfile&cmd=rdf_add&c=2'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>
</FORM>