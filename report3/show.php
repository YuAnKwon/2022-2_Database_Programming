<style>
  table {
    border-collapse: collapse;
  }
  th, td {
    padding: 10px;
  }
	a:link { color:black;text-decoration-line :none; }
	a:visited { color:black; } 
	a:hover { color:red; } 
</style>

<?

$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);
$result = mysql_query("select * from $board order by id desc", $con);
$total = @mysql_num_rows($result);

echo("
	<table  width=700 align=center >
	<tr><td colspan=2 align=center><h1>게시판</h1></td></tr>
	<tr><td align=left>
		<form method=post action=search.php?board=$board>
			<select name=field>
			<option value=writer>글쓴이</option>
			<option value=topic>제목</option>
			<option value=content>내용</option>
		</select>
		<input type=text  name=key size=30>
		<input type=image src='search.png' width=20 height=20 >
	</td>
	</form>
		<td align=right><a href=input.php?board=$board><img src=pencil.png width=30 height=30></a></td></tr>
	</table>
	<table width=700 align=center style='border-bottom: 1px solid #E6E6FA;'>
		<tr  bgcolor ='#E6E6FA'><td align=center width=50><b>번호</b></td>
			<td align=center width=100><b>글쓴이</b></td>
			<td align=center width=400><b>제목</b></td>
			<td align=center width=150><b>날짜</b></td>
			<td align=center width=50><b>조회</b></td>
		</tr>
");

if (!$total){
	echo("
		<tr><td colspan=5 align=center>아직 등록된 글이 없습니다.</td></tr>
	");
} else {

	if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
	$pagesize = 5;                // $pagesize - 한 페이지에 출력할 목록 개수

	$totalpage = (int)($total/$pagesize);
	if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

	$counter=0;

	while($counter<$pagesize):
		
		$newcounter=($cpage-1)*$pagesize+$counter;
		if ($newcounter == $total) break;

		$id=mysql_result($result,$newcounter,"id");
		$writer=mysql_result($result,$newcounter,"writer");
		$topic=mysql_result($result,$newcounter,"topic");
		$hit=mysql_result($result,$newcounter,"hit");
		$wdate=mysql_result($result,$newcounter,"wdate");
		$date=substr($wdate,0,10);
		$space=mysql_result($result,$newcounter,"space");
		$file=mysql_result($result,$newcounter,"filename");
		$result1 = mysql_query("select * from memojang where id=$id", $con);
		$total1 = mysql_num_rows($result1);

		
		$t="";
		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t=$t . "&nbsp;";	// 답변 글의 경우 제목 앞 부분에 공백 채움
		}

		echo("
			<tr style='border-bottom: 1px solid #E6E6FA;' onMouseOver=\"this.style.backgroundColor='#E6E6FA'\" onMouseOut=\"this.style.backgroundColor='white'\"><td align=center>$id</td>
			<td align=center>$writer</td>");
			
			if(!$file){ //첨부파일이 없을 경우 
				if($total1!=0){
					echo("
						<td align=left>$t<a href=content.php?board=$board&id=$id >$topic [$total1]</a></td>
					");
				}
				else {
					echo("
						<td align=left>$t<a href=content.php?board=$board&id=$id>$topic</a></td>
					");
				}
			}else{ //첨부파일이 있을경우 표시 남김.
				if($total1!=0){
					echo("
						<td align=left>$t<img src=file.png width=15 height=15><a href=content.php?board=$board&id=$id>$topic [$total1]</a></td>
					");
				}
				else {
					echo("
						<td align=left>$t<img src=file.png width=15 height=15><a href=content.php?board=$board&id=$id>$topic</a></td>
					");
				}			
			}		
		echo("
			<td align=center>$date</td>
			<td align=center>$hit</td>
			</tr>
		");
		$counter = $counter + 1;

	endwhile;

	echo("</table>");
echo("<br>");
	echo ("<table border=1 width=700 align=center style='border-color:#E6E6FA;'>
		  <tr align=center ><td style='border-top:hidden; border-bottom:hidden; border-left:hidden;'>");
		   
	// 화면 하단에 페이지 번호 출력
	if ($cblock=='') $cblock=1;   // $cblock - 현재 페이지 블록값
	$blocksize = 5;             // $blocksize - 화면상에 출력할 페이지 번호 개수

	$pblock = $cblock - 1;      // 이전 블록은 현재 블록 - 1
	$nblock = $cblock + 1;     // 다음 블록은 현재 블록 + 1
		
	// 현재 블록의 첫 페이지 번호
	$startpage = ($cblock - 1) * $blocksize + 1;	

	$pstartpage = $startpage - 1;  // 이전 블록의 마지막 페이지 번호
	$nstartpage = $startpage + $blocksize;  // 다음 블록의 첫 페이지 번호

	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("<td width=30 onMouseOver=\"this.style.backgroundColor='#E6E6FA'\" onMouseOut=\"this.style.backgroundColor='white'\">
				<a href=show.php?board=$board&cblock=$pblock&cpage=$pstartpage><<</a></td> ");

	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;	   // 마지막 페이지를 출력했으면 종료함
	   if ($i == $cpage){
		   echo ("<td width=30 bgcolor='#E6E6FA'>
			<a href=show.php?board=$board&cblock=$cblock&cpage=$i>$i</a></td>");
	   }
		else{
			echo ("<td width=30 onMouseOver=\"this.style.backgroundColor='#E6E6FA'\" onMouseOut=\"this.style.backgroundColor='white'\">
		<a href=show.php?board=$board&cblock=$cblock&cpage=$i>$i</a></td>");}
	   $i = $i + 1;
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("<td width=30 onMouseOver=\"this.style.backgroundColor='#E6E6FA'\" onMouseOut=\"this.style.backgroundColor='white'\">
			<a href=show.php?board=$board&cblock=$nblock&cpage=$nstartpage>>></a></td> ");

	echo ("</td><td style='border-top:hidden; border-bottom:hidden; border-right:hidden;'></td></tr></table>");
}


 mysql_close($con);

?>