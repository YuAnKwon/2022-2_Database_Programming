<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	
	$result = mysql_query("select * from product where pcode='$icode'",$con);
	// icode가 존재하는지 일단 검색
	$total = mysql_num_rows($result);
	
	if ($total>0){ //검색하니까 있음
		$oname = mysql_result($result,0,"pname");
		$oprice = mysql_result($result,0,"pprice"); //기존 price값 받아옴
		$ounit = mysql_result($result,0,"punit");  // 기존 unit 값 받아옴
		
		$nunit = $ounit + $iunit;
		$nprice = ($oprice*$ounit + $iprice*$iunit)/$nunit;

		mysql_query("update product set pname='$iname', pprice='$nprice', punit='$nunit' where pcode='$icode'",$con);
	}
	else{ //검색하니까 없음 -> 추가
		mysql_query("insert into product values ('$icode','$iname','$iprice','$iunit')",$con);
	}
	
	mysql_close($con);
	echo ("<meta http-equiv='Refresh' content='0; url=input.php'>");
?>