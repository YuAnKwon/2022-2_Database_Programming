<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	
	$result= mysql_query("delete from addressbook where name='$dname'",$con);
	mysql_close($con);
	echo("<meta http-equiv='Refresh' content='0; url=show.php'>");
?>