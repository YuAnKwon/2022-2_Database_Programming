<? include ("top.html"); ?>

<?	

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	     
switch($class){
	case 1:
		$name_class = '스킨케어';
		break;
	case 2:
		$name_class = '클렌징';
		break;
	case 3:
		$name_class = '메이크업';
		break;
	case 4:
		$name_class = '바디케어';
		break;
	case 5:
		$name_class = '향수/디퓨저';
		break;
}

echo("<table border=0 width=1000 align=center>
			<tr height=70><td width=210 align=center style='font-size:27px;'>$name_class</td><td></td></tr></table>
		<hr width=980 style='border: solid 3px #eee;'>");

echo("<table border=1 align=center width=970>
		<tr style='border-left:hidden; border-top:hidden; border-bottom:hidden; border-right:hidden; '>
			<td align=center><a href=p-list.php?class=$class&mode=1>인기순</a></td>
			<td align=center><a href=p-list.php?class=$class&mode=2>낮은 가격순</a></td>
			<td align=center><a href=p-list.php?class=$class&mode=3>높은 가격순</a></td>
			<td align=center><a href=p-list.php?class=$class&mode=4>할인율순</a></td>
			<td width=500></td></tr></table>
	<hr width=980 style='border: solid 3px #eee;'><br>");
	
switch($mode){
		case 1:
			$result = mysql_query("select * from product where class=$class order by hit desc",$con);
			break;
		case 2:
			$result = mysql_query("select * from product where class=$class order by sprice",$con);
			break;
		case 3:
			$result = mysql_query("select * from product where class=$class order by sprice desc",$con);
			break;
		case 4:
			$result = mysql_query("select * from product where class=$class order by sale desc",$con);
			break;
		default:
			$result = mysql_query("select * from product where class=$class order by hit desc",$con);
	}

$total = mysql_num_rows($result);

echo("<table border=0 width=1000 align=center valign=top><tr>");

if (!$total){
	echo ("<td align=center><font color=red>아직 등록된 상품이 없습니다</td>");
} else {

	$counter = 0;
	while ($counter < $total &&   $counter < 15) :

		if ($counter > 0 && ($counter % 3) == 0) 
			echo ("<tr><td colspan=3><hr width=980 style='border: solid 3px #eee;'></td></tr><tr>");

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$cprice=mysql_result($result,$counter,"cprice");
		$sprice=mysql_result($result,$counter,"sprice");
		$sale=mysql_result($result,$counter,"sale");

		switch(strlen($sprice)) {
			case 6: 
			   $sprice = substr($sprice, 0, 3) . "," . substr($sprice, 3,   3);
			   $cprice = substr($cprice, 0, 3) . "," . substr($cprice, 3,   3);
			   break;
			case 5:
			   $sprice = substr($sprice, 0, 2) . "," . substr($sprice, 2,   3);
			   $cprice = substr($cprice, 0, 2) . "," . substr($cprice, 2,   3);
			   break;
			case 4:
			   $sprice = substr($sprice, 0, 1) . "," . substr($sprice, 1,   3);
			   $cprice = substr($cprice, 0, 1) . "," . substr($cprice, 1,   3);
			   break;	   
		}
		
		echo ("<td width=330 align=center height=300><a href=show.php?code=$code> 
				<table border=0>
				<tr><td align=center><img src='./photo/$userfile' width=230 border=0></td></tr>
				<tr><td width=70 height=56><font style='text- decoration:none; font-size:12pt;'>$name</a></font></td></tr>
				<tr><td align=center><font color=red size=4>$sale%&nbsp;</font>$sprice&nbsp;원<br><font style='color:#a1a3a6;'><strike>$cprice&nbsp;원</strike></font></td></tr>
				</table>
				</td>");

		$counter++;
	endwhile;
}
echo ("</tr></table>");
echo ("<br>");
mysql_close($con);

?>


<? include ("bottom.html");   ?>
