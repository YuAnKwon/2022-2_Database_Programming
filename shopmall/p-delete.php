
<? include ("top.html"); ?>
<?echo("<br><br>");?>
<table border=1 width=1000 align=center>
<tr height=1000>
   <td width=230 valign=top><? include ("p-left.php"); ?></td>
   <td width=770 align=center valign=top>
   
<?

$con=mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);

$result = mysql_query("select * from product where code='$code'", $con);

$name=mysql_result($result,0,"name");
		
echo("<table border=1 width=750 align=center>
	<tr><td colspan=2><h1 align=left>상품삭제</h1></td>
	<tr><td width=100 align=center>상품 코드</td>
		<td width=550><b>$code</b></td></tr>
	<tr><td align=center>상품 이름</td>
		<td><b>$name</b>></td></tr>
	<tr><td colspan=2 height=50 align=center>위 상품을 삭제하시겠습니까?</td></tr> 
	<tr><td colspan=2 align=center><form method=post action=p-delete2.php?code=$code><input type=submit value='삭제'></form></td></tr>
	<tr><td colspan=2 align=center><a href=p-adminlist.php>취소</a></td></tr>
</table>");
	
mysql_close($con);

?>

   </td></tr>
</table>
  
<? include ("bottom.html"); ?>