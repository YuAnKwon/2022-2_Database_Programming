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

<? include ("top.html"); ?>

<?echo("<br><br>");?>


<table border=1 width=1000 align=center >
<tr height=900>
   <td width=230 valign=top><? include ("p-left.php"); ?></td>
    <td width=770 align=center  valign=top>
   
   <table border=1 width=750 >
      <form method=post action=p-process.php enctype='multipart/form-data'>
      <tr>
         <td width=100  align=center>상품 분류</td>
         <td width=550>
            <select name=class>
               <option value=1>스킨케어</option>
               <option value=2>클렌징</option>
               <option value=3>메이크업</option>
               <option value=4>바디케어</option>
               <option value=5>향수/디퓨저</option>
            </select>
         </td>
      </tr>
      <tr>
         <td align=center>상품 코드</td>
         <td><input type=text name=code size=20></td>
      </tr>
      <tr>
         <td align=center>상품 이름</td>
         <td><input type=text name=name size=70></td>
      </tr>
      <tr>
         <td align=center>상품 설명</td>
         <td><textarea  name=content rows=15 cols=75 id=summernote></textarea></td>
      </tr>
      <tr>
         <td align=center>원가</td>
         <td><input type=text name=cprice size=10>원</td>
      </tr>
      <tr>
         <td align=center>할인가</td>
         <td><input type=text name=sprice size=10>원</td>
      </tr>
      <tr>
         <td align=center>배송비</td>
         <td><input type=text name=deliver size=10>원</td>
      </tr>
      <tr>
         <td align=center>포인트</td>
         <td><input type=text name=point size=10>원</td>
      </tr>
      <tr>
         <td align=center>상품 대표<br>사진</td>
         <td><input type=file size=30 name=userfile></td>
      </tr>
      <tr>
         <td align=center colspan=5>
         <input type=submit value=등록하기></td>
      </tr>
      </form>
   </table>

   </td></tr>
</table>
  
<? include ("bottom.html"); ?>
