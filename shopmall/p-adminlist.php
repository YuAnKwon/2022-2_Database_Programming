 <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">  
 
<? include ("top.html"); ?>
<?echo("<br><br>");?>
<table border=1 width=1000 align=center>
<tr height=1000>
   <td width=230 valign=top><? include ("p-left.php"); ?></td>
   <td width=770 align=center valign=top>

<?
	
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
$result = mysql_query("select * from product order by code", $con);

$total = mysql_num_rows($result);

echo ("
	<table border=1 width=750 align=center >
	
	<tr><td colspan=6><h2 align=left>상품수정/삭제</h1></td></tr>
	<tr>
		<td align=center><font size=3>상품코드</td>
		<td colspan=2 align=center><font size=3>상품명</td>
		<td align=center><font size=3>원가</td>
		<td align=center><font size=3>할인가</td>
		<td align=center><font size=3>수정/삭제</td></tr>");
							
if (!$total) {

  echo("<tr><td colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");

} else {

	$counter = 0;

	while ($counter < $total) :

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$cprice=mysql_result($result,$counter,"cprice");
		$sprice=mysql_result($result,$counter,"sprice");

		echo ("
		   <tr><td width=80 align=center ><font size=3>$code</td>
				<td align=center width=50><img src=./photo/$userfile width=50 height=70 border=0></td>
			   <td width=350 align=left><a href=p-show.php?code=$code><font size=3>$name</a></td>
			   <td align=right width=70><font size=3><strike>$cprice&nbsp;원</strike></td>
			   <td align=right width=70><font size=3>$sprice&nbsp;원</td>
			   <td width=80 align=center><font size=3><a href=p-modify.php?code=$code>수정</a><a href=p-delete.php?code=$code>/삭제</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("</table>");
	     
mysql_close($con);


	
?>

   </td></tr>
</table>
  
<? include ("bottom.html"); ?>




