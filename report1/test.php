<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	
	$result = mysql_query("select * from product where $pcode='$icode'",$con);
	$total = mysql_num_rows($result);

	
	mysql_close($con);
?>