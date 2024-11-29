<? //판매완료 버튼누르면 처리하는 곳
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	
	$wdate = date("m월 d일 H시 i분");
	
	$result = mysql_query("select * from product where pcode='$icode'",$con); //icode 레코드 검색
	$ounit = mysql_result($result,0,"punit"); 
	// iunit = 판매수량, ounit=현재수량, nunit=남은수량
	
	if ($iunit < $ounit){
		$nunit = $ounit - $iunit; //남은 상품량
		mysql_query("insert into sales values ('$icode','$iunit','$wdate')",$con);
		mysql_query("update product set punit=$nunit where pcode='$icode'",$con);
	}
	mysql_close($con);
	echo("<meta http-equiv='Refresh' content='0; url=sales.php'>");
?>