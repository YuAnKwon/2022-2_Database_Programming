<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	$result = mysql_query("select * from product where pcode='$mcode'",$con);
	$oname = mysql_result($result, 0, "pname");
	$oprice = mysql_result($result,0,"pprice"); 
	$ounit = mysql_result($result,0,"punit"); 
	mysql_close($con);
	
	echo("<form method=post action='process2.php?mcode=$mcode' align=center>
		상품코드 : $mcode 
		상품이름 : <input type=text name=iname value=$oname size=20>
		상품단가 : <input type=text name=iprice value=$oprice size=20>
		상품수량 : <input type=text name=iunit value=$ounit size=10>
		<input type=submit value='수정완료'>
		</form>");

?>