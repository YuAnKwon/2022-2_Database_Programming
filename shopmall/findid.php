<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<? include ("top.html"); ?>


<table border=0 width=600 align=center>
	<tr height=500><td align=center valign=top>  
	<table width=600 border=0>
		<tr><td height=40 align=center><h3><b>아이디 찾기</b></h3></td></tr>
</table>


<table border=0 width=600>
<tr><td>
	<form method=post action=findid2.php onsubmit="if(!this.uname.value ||   !this.email.value) return false;">
	<table border=0 width=300 align=center>
        <tr align=left><td height=50 valign=bottom>이름</td></tr>
		<tr><td colspan=2><input type=text name=uname placeholder=' 이름을 입력해주세요' style='width:300px; height:40px; font-size:15px; '></td></tr>
		<tr align=left><td height=50 valign=bottom>이메일</td></tr>
		<tr align=center><td colspan=2><input type=text size=60 name=email placeholder='이메일을 입력해주세요' style='width:300px; height:40px; font-size:15px; '></td></tr>	
		<tr><td height=20></td></tr>
		<tr><td colspan=2 align=center><input type=submit value='아이디 확인' style='height:45px; width:300px; border: 0; border-radius: 15px; outline: none; font-size:15px;'></td></tr>
	</form>
	</table>
</td></tr>
</table>


   </td></tr>
</table>
  
<? include ("bottom.html"); ?>