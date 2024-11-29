<?

if (!$name){
	echo("
		<script>
		window.alert('상품명이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$cprice || !$sprice){
	echo("
		<script>
		window.alert('가격이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}
$sale = ($cprice-$sprice)/$cprice*100;
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
// 기존 상품 이미지를 그대로 사용하는 경우
if (!$userfile){
	$result = mysql_query("update product set class=$class, name='$name', content='$content', cprice=$cprice, sprice=$sprice, deliver=$deliver, point=$point, sale=$sale where code='$code'", $con);

} else {

     // 기존 상품 이미지 파일을 삭제
	$tmp = mysql_query("select userfile from product where code='$code'", $con);
	$fname = mysql_result($tmp, 0, "userfile");
    $savedir = "./photo";
	unlink("$savedir/$fname");
	
    // 새로이 첨부한 이미지 파일을 저장	
    $temp = $userfile_name;
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile, "$savedir/$temp");
         unlink($userfile);
    }
	$result = mysql_query("update product set class=$class, name='$name', content='$content', cprice=$cprice, sprice=$sprice, deliver=$deliver, point=$point, sale=$sale, userfile='$userfile_name' where code='$code'", $con);
}

if (!$result) {
	echo("
      <script>
      window.alert('상품 수정에 실패했습니다')
      </script>
    ");
    exit;
} else {
	echo("
      <script>
      window.alert('상품 수정이 완료되었습니다')
      </script>
   ");
} 

mysql_close($con);		//데이터베이스 연결해제

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>
