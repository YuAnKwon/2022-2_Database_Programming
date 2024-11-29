	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

	<script>
		$(document).ready(function() {
			$('#summernote').summernote({
		
			height: 300,                 // set editor height
			minHeight: null,             // set minimum height of editor
			maxHeight: null,             // set maximum height of editor
			focus: true                  // set focus to editable area after initializing summernote 
  
			});
		});
	</script>

<style>
  table {
    border: 0px solid #444444;
    border-collapse: collapse;
  }
  th, td {
    border: 0px solid #444444;
    padding: 3px;
  }
</style>
<?    

echo("
	<center><h1>게시판</h1></center>
	<br>
	<form method=post action=process.php?board=$board enctype='multipart/form-data'>
	<table width=600 border=0 align=center>
	<tr>
		<td align=center width=83>이름 </td>
		<td ><input type=text name=writer size=10></td>
		<td>email</td>
		<td><input type=text name=email size=22></td>
	</tr></table>
	<table width=600 border=0 align=center>
	<tr>
	<td align=center width=80>제목</td>
	<td width=500><input type=text name=topic size=50></td>
	</tr>
	<tr>
	<td align=center colspan=2><textarea name=content rows=12 cols=60 id=summernote></textarea></td>
	</tr>
	<tr>
     <td align=center><font size=2>첨부파일</font></td>
     <td><input type=file name='userfile' size=45 maxlength=80></td>
    </tr>

	<tr>
	<td align=center>암호</td>
	<td><input type=password name=passwd size=10></td>
	</tr>
	<tr>
	<td align=right colspan=2>
	<input type=submit value=등록하기>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form>
");

?>