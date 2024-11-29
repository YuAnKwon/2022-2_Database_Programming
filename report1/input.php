<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	$result = mysql_query("select * from product",$con);
	$total = mysql_num_rows($result);
	
	echo ("<h1 align=center>재고관리</h2>
		<form method=post action=process.php align=center>
		상품코드 : <input type=text name=icode size=20>
		상품이름 : <input type=text name=iname size=20>
		상품단가 : <input type=text name=iprice size=20>
		상품수량 : <input type=text name=iunit size=10>
		<input type=submit value='신규구입'>
		</form>");
		
	// 테이블	
	echo("<table border=1 width=1000 align=center>
		<tr align=center><td>상품코드</td><td>상품이름</td><td>상품단가</td><td>상품수량</td><td>관리</td></tr>");
	$i=0;
	while($i <$total):
		$ocode= mysql_result($result,$i,"pcode");
		$oname= mysql_result($result,$i,"pname");
		$oprice= mysql_result($result,$i,"pprice");
		$ounit= mysql_result($result,$i,"punit");
		
		echo ("<tr align=center><td>$ocode</td>
				<td>$oname</td>
				<td>$oprice</td>
				<td>$ounit</td>
				<td>
				[<a href='modify.php?mcode=$ocode'>O</a>]
				/
				[<a href='delete.php?dcode=$ocode'>X</a>]
				</td></tr>");
		$i++;
	endwhile;
	echo("</table><br>");
	
	mysql_close($con);
	echo("<center><a href=sales.php>[매출관리]</a></center>");
		
?>