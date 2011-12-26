{*{debug}*}
{config_load file='template.conf' section='WebekciManage'}
<FORM action="webekci_manage.php?tab=wbmng&c=0" method="post">	
<table width=100% cellspacing=0 cellpadding=4 border=0 class='{#tblClass#}'>
<tr><td>
{#wbManageTitle#}
<hr>
</td></tr>
<tr><td>
   {html_checkboxes name='mchoise' options=$wb_list
   selected=$selected_wb  separator='<br/>'}
</td></tr>
<tr><td>
<input type=submit value=Commit name=submit />
</td></tr>
</table>
</FORM>