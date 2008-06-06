<?php
	include("inc/ghome.lib.php");
	include("inc/head.php");
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<td width=128>
			ทรฮสผอยผ
		</td>
		<td>
		<?php
			$a='222';
			$b='aaaaaaaaaaaa1111bbbbb';
			$finds=preg_grep('/'.$a.'/',array($b));
			if(count($finds)>0)
				echo 'find it';
			else
				echo 'find no';
		?>
		</td>
	</tr>
</table>	
<?php
	include("inc/footer.php");
?>