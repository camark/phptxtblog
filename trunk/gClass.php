<?php	
	include("inc/ghome.lib.php");
	checkLogin();
	include("inc/head.php");	
?>
<TABLE class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
   <tr>
	   <?php
			include("inc/admin_left.php");
	   ?>
	<td valign=top>
	   <?php
			$Cats=GetCategories();			
			if(isset($_POST['Submit'])){
				$count=count($Cats);
				for($i=0;$i<$count;$i++){
					if(!isset($_POST['Cat_Del'.$i])){
						list($temp_id,$temp_name)=explode(':',$Cats[$i]);
						$array[]=trim($temp_name);
					}
				}

				$newCat=$_POST['new_CateName'];
				if($newCat!='')
					$array[]=$newCat;

				if(count($Cats)!=count($array)){
					$Cats=array();
					$fhandle=fopen($catFile,'wb');
					foreach($array as $index => $name){
						$str_temp=$index.":".$name.$sepChar;
						$Cats[]=$str_temp;
						fwrite($fhandle,$str_temp);						
					}
					fclose($fhandle);
				}
			}
	   ?>
       <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign=top align=middle><BR>
            <TABLE cellSpacing=1 cellPadding=6 width="99%" align=center 
            bgColor=#cccccc border=0>
              <TBODY>
              <TR>
                <TD class=siderbar_head bgColor=#ffffff><?= $siteName ?> 
                分类管理</TD></TR>
              <FORM name=edit_Category action=gClass.php method=post>
              <TR>
                <TD vAlign=top align=middle bgColor=#ffffff>
                  <TABLE cellSpacing=1 cellPadding=4 width="90%" bgColor=#cccccc 
                  border=0>
                    <TBODY>
                    <TR bgColor=#efefef>
                      <TD noWrap>删除？</TD>
                      <TD noWrap>名称</TD>                      
					</TR>
					<?php
						 if(count($Cats)>0)
						 {
							 foreach($Cats as $Cat){
								 list($Cat_id,$Cat_name)=explode(':',$Cat);
					?>
  					<tr>
						<td bgcolor="white"><input type="checkbox" name="Cat_Del<?= $Cat_id ?>" value=<?= $Cat_id ?>></td>
						<td bgcolor="white"><?= $Cat_name ?></td>
					</tr>
					<?php
							 }
						 }
					?>
                    <TR bgColor=#ffffff>
                      <TD noWrap><B>添加</B>：</TD>
                      <TD><INPUT id=new_CateName size=15 name=new_CateName></TD>                      
                      <TD></TD>
					</TR>
				 </table>
				</td>
			 </tr>
			</table>
			<input type="submit" value="确定编辑" name=Submit>
			</form>
		 </td>
		</tr>
	 </table>
	</td>
  </tr>
</table>
<?php
include("inc/footer.php");
?>
