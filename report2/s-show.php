
<?
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);
	$result2 = mysql_query("select * from scoreboard order by score desc",$con);
	$total = mysql_num_rows($result2);
	
	mysql_query("alter table scoreboard add grade varchar(10)",$con); //등급 추가
	
	$ii=0;
	$a=0;
	$b=0;
	$c=0;
	$f=0;
	
	while($ii < $total):
		//등급 계산
		$j =$ii+1; //순위
		$percent = (int)($j/$total*100); //상위 퍼센트
		$oname= mysql_result($result2,$ii,"name");
		$oattend= mysql_result($result2,$ii,"attend");
		$oscore= mysql_result($result2,$ii,"score");
		if ($percent <= 30){
			mysql_query("update scoreboard set grade='A' where name='$oname'",$con);
			$a=$a+1;
		}
		else if($percent <= 70){
			mysql_query("update scoreboard set grade='B' where name='$oname'",$con);
			$b=$b+1;
		}
		else if($oscore<50 || $oattend<5){
			mysql_query("update scoreboard set grade='F' where name='$oname'",$con);
			$f=$f+1;
		}
		else {
			mysql_query("update scoreboard set grade='C' where name='$oname'",$con);
			$c=$c+1;
		}
		$ii++;
	endwhile;
	
	echo ("<table border=0 align=center width=850><tr>
		<td align=right>총 $total 명 (A: $a 명 B: $b 명 C: $c 명 F: $f 명)</td></tr></table>");
		
	echo("<table border=1 style = 'border-collapse: collapse' width=850 align=center>
		<tr align=center>
		<td><a href=s-show.php?mode=1>이름</a></td>
		<td><a href=s-show.php?mode=2>학번</a></td>
		<td><a href=s-show.php?mode=3>출석</a></td>
		<td><a href=s-show.php?mode=4>국어</a></td>
		<td><a href=s-show.php?mode=5>영어</a></td>
		<td><a href=s-show.php?mode=6>수학</a></td>
		<td>총점</td><td>등급</td></tr>");
		
	switch($mode){
		case 1:
			$result = mysql_query("select * from scoreboard order by name",$con);
			break;
		case 2:
			$result = mysql_query("select * from scoreboard order by number",$con);
			break;
		case 3:
			$result = mysql_query("select * from scoreboard order by attend desc",$con);
			break;
		case 4:
			$result = mysql_query("select * from scoreboard order by kor desc",$con);
			break;
		case 5:
			$result = mysql_query("select * from scoreboard order by eng desc",$con);
			break;
		case 6:
			$result = mysql_query("select * from scoreboard order by math desc",$con);
			break;
		default:
			$result = mysql_query("select * from scoreboard order by score desc",$con);
	}
	$i=0;
	while($i <$total):
		$oname= mysql_result($result,$i,"name");
		$onumber= mysql_result($result,$i,"number");
		$oattend= mysql_result($result,$i,"attend");
		$okor= mysql_result($result,$i,"kor");
		$oeng= mysql_result($result,$i,"eng");
		$omath= mysql_result($result,$i,"math");
		$oscore= mysql_result($result,$i,"score");
		$ograde= mysql_result($result,$i,"grade");
		
		echo ("<tr align=center><td>$oname</td>
				<td>$onumber</td>
				<td>$oattend</td>
				<td>$okor</td>
				<td>$oeng</td>
				<td>$omath</td>
				<td>$oscore</td>
				<td>$ograde</td></tr>");
		$i++;
	endwhile;
	echo("</table><br>");

	mysql_close($con);
	
?>