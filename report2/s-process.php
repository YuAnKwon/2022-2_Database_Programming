<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	$iscore = $iattend+$ikor+$ieng+$imath;
	mysql_query("insert into scoreboard values ('$iname','$inumber','$iattend','$ikor','$ieng','$imath','$iscore','')",$con);
	mysql_close($con);
	echo ("<meta http-equiv='Refresh' content='0; url=s-input.php'>");
?>