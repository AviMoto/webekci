{*{debug}*}
{config_load file='template.conf' section='Configuration'}

<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#msecconfTitle#}
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
   {section name=conf loop=$data}
   <tr bgcolor="{cycle values="#eeeeee,#dddddd"}">
	 <td><a href='configurations.php?tab=mscnf&cmd=cadd&id={$data[conf].id}'>
	{html_image file='web/images/edit.gif' border='0'}</a></td>
         <td>{$data[conf].cname}</td>
         <td>{$data[conf].cdescription}</td>
         <td>{if $data[conf].isactive == 1}
	<a href='configurations.php?tab=mscnf&cmd=validity&id={$data[conf].id}&v=0'>
	{html_image file='web/images/_ok.png' border='0'}
	</a>
	{else}
	<a href='configurations.php?tab=mscnf&cmd=validity&id={$data[conf].id}&v=1'>
	{html_image file='web/images/_err.png' border='0'}
	</a>
	{/if}
	</td>
      </tr>
   {/section}
</table>

</td></tr>
<tr><td>
<a href='configurations.php?tab=mscnf&cmd=cadd'>
<input type=submit value=New name=submit/></a>
</td></tr>
</table>
</FORM>