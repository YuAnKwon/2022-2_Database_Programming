<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

mysql_query("delete from memojang where wdate='$wdate' and id=$id",$con);
echo("
	<script>
	window.alert('댓글이 삭제 되었습니다.');
	</script>
");

echo("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");

mysql_close($con);

?>
