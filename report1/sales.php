<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	$result2 = mysql_query("select * from sales order by wdate",$con);
	$total = mysql_num_rows($result2);
	
	echo ("<h1 align=center>매출관리</h2>
		<form method=post action=process3.php align=center>
		상품코드 : <input type=text name=icode size=20>
		상품수량 : <input type=text name=iunit size=10>
		<input type=submit value='판매완료'>
		</form>");
		

		
	echo("<table border=1 width=1000 align=center>
		<tr align=center><td>판매날짜</td><td>상품코드</td><td>상품이름</td><td>판매수량</td><td>상품단가</td><td>부분합계</td></tr>");
	$i=0;
	$sum =0;
	while($i <$total):
		$owdate = mysql_result($result2,$i,"wdate");
		$ocode= mysql_result($result2,$i,"pcode");
		
		$result = mysql_query("select * from product where pcode='$ocode'",$con);
		
		$oname= mysql_result($result,0,"pname");
		$ounit= mysql_result($result2,$i,"punit");
		$oprice= mysql_result($result,0,"pprice");
		
		$partsum = $ounit*$oprice;
		$sum = $sum + $partsum;
		echo ("<tr align=center>
				<td>$owdate</td>
				<td>$ocode</td>
				<td>$oname</td>
				<td>$ounit</td>
				<td>$oprice</td>
				<td>$partsum</td></tr>");
		$i++;
	endwhile;
	echo("<tr align=center><td colspan=6>매출합계: $sum 원</td></tr></table><br>");
	
	mysql_close($con);
	echo("<center><a href=input.php>[재고관리]</a></center>");
?>