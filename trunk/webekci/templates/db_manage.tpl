{*{debug}*}
{config_load file='template.conf' section='WebekciManage'}
<FORM action="webekci_manage.php?tab=dbmng" method="post">	
<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#dbTitle#}
<hr>
</td></tr>
<tr><td>
   {html_checkboxes name='tables' options=$db_list
   selected=$selected_db  separator='<br />'}
</td></tr>
<tr><td>
<input type=submit value=Submit name=submit />
</td></tr>
</table>
</FORM>