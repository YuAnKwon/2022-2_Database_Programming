<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	$iscore = $iattend+$ikor+$ieng+$imath;
	$result = mysql_query("update scoreboard
	set attend=$iattend, kor=$ikor, eng=$ieng, math=$imath, score=$iscore where name='$mname'",$con);
	mysql_close($con);
	echo("<meta http-equiv='Refresh' content='0; url=s-input.php'>");
?>