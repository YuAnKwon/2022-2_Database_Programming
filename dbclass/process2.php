<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	
	$result = mysql_query("update addressbook 
		set name='$iname', phone='$iphone', address='$iaddress' where name='$mname'",$con);
	mysql_close($con);
	echo("<meta http-equiv='Refresh' content='0; url=show.php'>");
?>