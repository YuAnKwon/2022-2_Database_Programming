<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

$result=mysql_query("select * from $board where id=$id",$con);

// 수정하고자 하는 원본 게시물에서 수정 가능한 항목을 추출함
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");
$email=mysql_result($result,0,"email");

echo("<form method=post align=center action=cmprocess.php?board=$board&id=$id&wdate=$wdate>
			<table border=1>이름
			<input type=text size=10 name=wname value='$wname'>
			댓글
			<input type=text size=30 name=wmemo value='$wmemo'>&nbsp;&nbsp;
			<input type=image src='upload.png' width=30 height=20 title='수정하기'>
			</table></form>");

mysql_close($con);

?>
