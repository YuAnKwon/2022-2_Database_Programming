<style>
  table {
    border-collapse: collapse;
  }
  th, td {
    padding: 8px;
  }
</style>

<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);
$result=mysql_query("select * from $board where id=$id",$con);

$result4 = mysql_query("select * from $board order by id desc", $con);
$total2 = mysql_num_rows($result4);

// 각 필드에 해당하는 데이터를 뽑아 내는 과정
$id=mysql_result($result,0,"id");
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$hit=mysql_result($result,0,"hit");

$hit = $hit +1;   //조회수를 하나 증가
mysql_query("update $board set hit=$hit where id=$id",$con);

$wdate=mysql_result($result,0,"wdate");
$email=mysql_result($result,0,"email");
$content=mysql_result($result,0,"content");
$filename=mysql_result($result,0,"filename");
$filesize=mysql_result($result,0,"filesize");

if($id == $total2) {
	$result3=mysql_query("select * from $board where id=($id-1)",$con);
	$id3=mysql_result($result3,0,"id");
	$topic3=mysql_result($result3,0,"topic");
}

if($id < $total2 && $id > 1) {
	$result2=mysql_query("select * from $board where id=($id+1)",$con);
	$id2=mysql_result($result2,0,"id");
	$topic2=mysql_result($result2,0,"topic");
	
	$result3=mysql_query("select * from $board where id=($id-1)",$con);
	$id3=mysql_result($result3,0,"id");
	$topic3=mysql_result($result3,0,"topic");
}

if($id == 1) {
	$result2=mysql_query("select * from $board where id=($id+1)",$con);
	$id2=mysql_result($result2,0,"id");
	$topic2=mysql_result($result2,0,"topic");
}

if ($filesize > 1000) {
	$kb_filesize =   (int)($filesize / 1000);
	$disp_size = $kb_filesize . ' KBytes';
} else {
	$disp_size = $filesize . ' Bytes';
}

// 테이블로부터 읽은 내용을 화면에 디스플레이
echo("
	<table width=700 align=center>
	<tr><td colspan=4 align=center><h1>게시판</h1></td></tr></table>
	<table width=700 align=center >
	<tr bgcolor ='#E6E6FA' style='border-bottom: 1px solid black;'>
		<td width=100>번호: $id</td>
		<td width=200>글쓴이: <a href=mailto:$email>$writer</a></td>
		<td width=300>글쓴날짜: $wdate</td>
		<td width=100>조회: $hit</td>
	</tr>");

	if(!$filesize){}
	else{
		echo("
		<td style='border-bottom: 1px solid '#E6E6FA';' colspan=4 >파일: <a href=./pds/$filename>$filename</a> [ $disp_size ]</td>
		</tr>
	");
}

echo("

	<tr style='border-bottom: 1px solid #E6E6FA;'>
		<td colspan=4 >제목: $topic</td>
	</tr>
	<tr style='border-bottom: 1px solid black;'>
		<td colspan=4>$content</td>
	</tr>
	<tr><td align=right  colspan=4>
		<a href=pass.php?board=$board&id=$id&mode=0>수정</a> |
		<a href=pass.php?board=$board&id=$id&mode=1>삭제</a> |
		<a href=reply.php?board=$board&id=$id>답변</a> |
		<a href=show.php?board=$board><img src=list.png width=20 height=20></a></td>
	</tr>
	</table>
	
");

$result1 = mysql_query("select * from memojang where id=$id order by wdate ", $con);
$total1 = mysql_num_rows($result1);

echo("<br><br>");
echo("<table width=700  align=center border=0><tr><td align=left ><font size=4>댓글 </td></tr></table>");
if (!$total1)   {
	echo ("<table align=center border=1 width=700>
			<tr align=center>
			<tr><td align=center colspan=4>등록된 댓글이 없습니다</td></tr></table>");
} 
else{
	echo ("<table align=center border=1 width=700 align=center>");}
				
$i = 0;	
	while ( $i < $total1 ) :
		$name = mysql_result($result1, $i, "name");
		$wdate = mysql_result($result1, $i, "wdate");
		$message = mysql_result($result1, $i, "message");
		
		echo ("
			<tr><td align=center rowspan=2 width=70 style='border-right:hidden;'>$name</td>
				<td align=left width=100 style='border-bottom:hidden;'><font size=2>$wdate</td>
				<td align=center rowspan=2 width=100 style='border-left:hidden;'>
				<a href=cpass.php?board=$board&id=$id&mode=0&wdate=$wdate&wname=$name&wmemo=$message>수정</a> | 
				<a href=cpass.php?board=$board&id=$id&mode=1&wdate=$wdate>삭제</a></td>
			</tr>
			<tr><td align=left width=300 style='border-top:hidden;'>$message</td></tr>
		");
		
		$i++;
	endwhile;
	echo ("</table>");

echo("<br>");
echo("<form method=post action=memo.php?board=$board&id=$id>
		<table width=700 align=center border=1>
		<tr><td align=center style='border-right:hidden;'>이름<br>
			<input type=text size=10 name=wname align=center></td>
			<td align=center>
			<input type=text size=45 name=wmemo></td>
			<td align=center style='border-left:hidden;'>암호<br>
			<input type=password name=wpasswd size=7 ></td>
			<td><input type=image src='upload.png' width=30 height=30></td>
		</tr></table></form>");



	
echo("<br><br><br>");
	
echo("
	<table width=700 border=1 align=center>
	");
	
	if ($total2 == $id) {
		echo("
		<tr><td width=30 align=right style='border-right:hidden;'><img src=up.png width=20 height=20></td><td width=80 align=left style='border-right:hidden;'>이전글</td><td><a href=content.php?board=$board&id=$id3>$topic3</td></tr>");
	}
	
	if ($id == 1) {
		echo("
		<tr><td width=30 align=right style='border-right:hidden;'><img src=down.png width=20 height=20 ></td><td width=80 align=left style='border-right:hidden;'>다음글</td><td><a href=content.php?board=$board&id=$id2>$topic2</td></tr>
		");
	}
	
	if ($total2 > $id && $id > 1) {
		echo("<tr><td width=30 align=right style='border-right:hidden;'><img src=up.png width=20 height=20></td><td width=80 align=left style='border-right:hidden;'>이전글</td><td><a href=content.php?board=$board&id=$id3>$topic3</td></tr>
		<tr><td width=30 align=right style='border-right:hidden;'><img src=down.png width=20 height=20></td><td width=80 align=left style='border-right:hidden;'>다음글</td><td><a href=content.php?board=$board&id=$id2>$topic2</td></tr>");
		
	}
	
?>


