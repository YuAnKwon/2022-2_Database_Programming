<?
if (!$wname){
	echo("
		<script>
		window.alert('이름이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}
if (!$wmemo){
	echo("
		<script>
		window.alert('댓글내용이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);
$result = mysql_query("select * from memojang where id=$id and wdate='$wdate'", $con);

// 기존 필드값을 유지할 항목을 추출함
//$space = mysql_result($result, 0, "space");
//$hit = mysql_result($result, 0, "hit");

$mwdate = date("Y-m-d-H:i:s");	//글 수정한 날짜 저장

// 변경 내용을 테이블에 저장함
mysql_query("update memojang set name='$wname', message='$wmemo', wdate='$mwdate' where id=$id and wdate='$wdate'", $con);
echo("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");

mysql_close($con);

?>
