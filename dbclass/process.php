<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	mysql_query("insert into product values ('$icode','$iname','$iprice','$iunit')",$con);
	mysql_close($con);
	echo ("<meta http-equiv='Refresh' content='0; url=input.php'>");
?>