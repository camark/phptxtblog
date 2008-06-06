<?php
	include("inc/head.php");
	include("inc/ghome.lib.php");
?>
	<script language="JavaScript">
		  <!--
			var now = new Date();
			var month = new Date( fixYear( now.getYear() ), now.getMonth(), 1 );			
			function fixYear( year )
			{
			  return( year < 1000 ? year + 1900 : year );
			}
			
			function getNumberDays( d )
			{
			  switch( d.getMonth() + 1 )
			  {
				case 1: case 3: case 5: case 7:
				case 8: case 10: case 12:
				  return( 31 );
				case 4: case 6: case 9: case 11:
				  return( 30 );
				case 2:
				  return( 28 + ( d.getYear % 4 == 0 ? 1 : 0 ) );
			  }
			}
		  //-->
	</script>
	<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
		  <tr>
			  <?php
				   if(isset($_SESSION['logined']))
				   {
					   include("inc/admin_left.php");
				   }
				   else
				   {
					   include("inc/left.php");
				   }				   
			  ?>
			  <td valign=top>	
			  <?php
				   include("inc/allArticle.php");
			  ?>
			  </td>
		  </tr>
	</table>
		  
<?php
	include("inc/footer.php");
?>
