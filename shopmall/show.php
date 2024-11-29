<? include ("top.html"); ?>
<?echo("<br>");?>

<table border=0 width=1000 align=center>
<tr><td align=center valign=top> 
<?
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$name=mysql_result($result,0,"name");
$content=mysql_result($result,0,"content");
$content=nl2br($content);

$cprice=mysql_result($result,0,"cprice");
$sprice=mysql_result($result,0,"sprice");
$userfile=mysql_result($result,0,"userfile");
$deliver=mysql_result($result,0,"deliver");
$point=mysql_result($result,0,"point");
$sale=mysql_result($result,0,"sale");
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update product set hit=$hit where code='$code'", $con);
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
echo ("
	<table width=1000 border=0 align=center>
		<tr valign=top><td width=450>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=550, height=550,left=700,top=300')\">
			<img src='./photo/$userfile' width=400 border=0></a></td>
			<td width=550 valign=top>
    <table border=0 align=center width=98% cellspacing=20>
		<tr><td width=80 style='font-size:16px;'> $code</td>
			<td width=320>&nbsp;&nbsp;</td></tr>
		<tr><td align=left colspan=2 style='font-size:23px;'><b>$name</b></td></tr>
		<tr><td height=90 colspan=2><font color=red size=6><b>$sale%&nbsp;</font>
			<font size=6>$sprice</font><font size=4>원</font></b><br>
			<font style='color:#a1a3a6;'>
			<strike>$cprice&nbsp;원</strike></font></td></tr>
		<tr  height=8><td colspan=2><hr style='border: solid 1px #eee;'></td>
		<tr><td width=30>배송</td>
			<td width=430><b>$deliver 원</b></td></tr>
		<tr><td colspan=2><hr style='border: solid 1px #eee;'></td>
		<tr><td width=30>적립금</td>
			<td width=430><b>$point 원</b></td></tr>
		<tr><td colspan=2><hr style='border: solid 1px #eee;'></td>
		<tr><td width=30>구매수량</td>
			<td width=430><form method=post action=tobag.php?code=$code>
			<input type=number name=quantity value=1 min=1  style='width:100px; height:30px; font-size:15px;'></td></tr>
		<tr><td colspan=2><hr style='border: solid 1px #eee;'></td>
		<tr><td colspan=2>총 상품금액 : $quantity </td></tr>
		<tr><td>하트</td><td><input type=submit value='장바구니 담기' style='height:50px; width:350px; border: 0; border-radius: 15px; outline: none; font-size:25px;'></td></tr></form>
	</table>
	</td>
	</tr>
	</table>	
	
	<br><br><br>
	
	<table width=650 border=0 align=center>
	<tr><td align=center><font size=5>상품 상세 설명</font></td></tr>
	<tr><td><hr size=1></td></tr>
	<tr><td>$content</td></tr>
	</table>
");
			 
mysql_close($con);

?>

   
   
   </td></tr>
</table>
<?echo("<br><br>");?>  
<? include ("bottom.html"); ?>


