<link rel="StyleSheet" href="web/css/jstabs.css" type="text/css"> 
<div id=wrapper style='width:99%'>
<div id=content>
	{foreach from=$sub_menus key=label item=path name=sub_menu}	
	<div id=tab{$smarty.foreach.sub_menu.index+1} class=tab

	{if $smarty.foreach.sub_menu.index eq $select_menu}
	style='background:url(web/images/tab_on.png) no-repeat;'
	{else}
	style='background:url(web/images/tab_off.png) no-repeat;'
	{/if}	

	OnClick='tab_menu({$smarty.foreach.sub_menu.index+1},
	{$count_menus});'>
	<h3 class=tabtxt>
	<a href='{$path}&c={$smarty.foreach.sub_menu.index}' class='tablink'>{$label}</a></h3></div>
	{/foreach}
	
	<div class=boxholder>

	{foreach from=$sub_menus key=label item=path name=sub_div}
        <div id='box{$smarty.foreach.sub_div.index+1}'
	class='box'
	{if $smarty.foreach.sub_div.first}
	 style='display:block;'>
	{else}
	 style='display:none;'>
	{/if}
	{include file="$tab_page"}
	</div>
	{/foreach}

	</div>
	</div>
	</div>
	

<script type="text/javascript" src="web/js/prototype.js"></script>
<script type="text/javascript">
{literal}
	function tab_menu (ch,count) {
	     for (i=1; i<=count; i++) {
	       var box = $('box'+i);
	       var tab = $('tab'+i);
	     if (i==ch) {
	       box.style.display    = 'block';
	       tab.style.background = 'url(web/images/tab_on.png) no-repeat';
	     }
	     else {
	       box.style.display    = 'none';
	       tab.style.background = 'url(web/images/tab_off.png) no-repeat';
	     }
	   }
	 }
{/literal}
</script>
