
<style>
   table {border-collapse:collapse;}
   th, td {padding : 5px;}
</style>

<? include ("top.html"); ?>
<?echo("<br><br>");?>

<table border=1 width=1000 align=center>
<tr height=1000>
   <td width=230 valign=top><? include ("p-left.php"); ?></td>
   <td width=770 align=center valign=top> 
   

<?echo("<br><br>");?>   
   <?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$name=mysql_result($result,0,"name");
$content=mysql_result($result,0,"content");
$content=nl2br($content);

$cprice=mysql_result($result,0,"cprice");
$sprice=mysql_result($result,0,"sprice");
$userfile=mysql_result($result,0,"userfile");
$deliver=mysql_result($result,0,"deliver");
$point=mysql_result($result,0,"point");
$sale=mysql_result($result,0,"sale");
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update product set hit=$hit where code='$code'", $con);

echo ("
	<table width=750 border=0 align=center>
		<tr><td width=250 align=center>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=550, height=550,left=700,top=300')\">
			<img src='./photo/$userfile' width=270 border=1></a></td>
			<td width=400 valign=top>
    <table border=0 width=100%>
		<tr><td width=80 align=center>상품코드: </td>
			<td width=320>&nbsp;&nbsp;$code</td></tr>
		<tr><td align=center>상품이름: </td>
			<td>&nbsp;&nbsp;$name</td></tr>
		<tr><td align=center>상품가격: </td>
			<td>&nbsp;&nbsp;<strike>$cprice&nbsp;원</strike></td></tr>
		<tr><td align=center>할인가격: </td>
			<td>&nbsp;&nbsp;<b>$sprice&nbsp;원</b></td></tr>
		<tr><td align=center>할인율: </td>
			<td>&nbsp;&nbsp;<b>$sale %</b></td></tr>
		<tr><td align=center>배송비: </td>
			<td>&nbsp;&nbsp;<b>$deliver&nbsp;원</b></td></tr>
		<tr><td colspan=2 height=100 valign=bottom align=center>
	     <form method=post action=tobag.php?code=$code>
			<input type=text size=3 name=quantity value=1>&nbsp;
			<input type=submit value=담기>
	     </td></tr></form>
	</table>
	</td>
	</tr>
	</table>	
	
	<br>
	
	<table width=650 border=0 align=center>
	<tr><td align=center>[상품 상세 설명]</td></tr>
	<tr><td><hr size=1></td></tr>
	<tr><td>$content</td></tr>
	</table>
");
			 
mysql_close($con);

?>

   
   
   </td></tr>
</table>
  
<? include ("bottom.html"); ?>


