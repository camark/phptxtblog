{include_php file="inc/head.php"}
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<td width="128" bgcolor="#f8f8f8" valign="top">
			{$msg}
		</td>
		<td valign=top align="left">
		{section name=loop loop=$Downloads}
			<div class="content_head">
				 <img src="images/weather/1.gif">
				<strong>{$Downloads[loop].name}</strong>
			</div>
			<div class="content_main">
				&nbsp;&nbsp;{$Downloads[loop].readme}
			</div>
			<br/>
			 <div align="right" class="smalltxt" height="32px">
				����ϵͳ:{$Downloads[loop].os}&nbsp;|&nbsp;��������:{$Downloads[loop].dev_tools}
			&nbsp;|&nbsp;<a href="{$Downloads[loop].durl}">����</a>&nbsp;&nbsp;
			</div>
		{sectionelse}
			��ǰû�п������ص����			
		{/section}
		</td>
	</tr>
</table>	
{include file="footer.tpl"}