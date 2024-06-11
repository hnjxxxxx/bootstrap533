<?php 
  include('./php/dbconn.php');
  include('./php/header.php');
?>
  <style>
    section h2{text-align:center; font-weight:600; margin-top:30px;}
    table caption{display:none;}
    textarea{height:500px;}
  </style>
  <form name="글쓰기" method="post" action="./php/dbinput.php" onsubmit="return formCheck();">
    <section>
      <h2>게시판 글 작성</h2>
      <table class="free_board table table-bordered table-hover">
        <caption>글 작성하기</caption>
        <thead>
          <tr>
            <th scope="row"><label for="">글제목</label></th><br>
            <td><input type="text" maxlength="255" name="title" id="title" class="form-control" placeholder="제목을 입력하세요"></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th><label for="">작성자</label></th>
            <td><input type="text" maxlength="50" name="name" id="name" class="form-control" placeholder="작성자명을 입력하세요"></td>
          </tr>
          <tr>
          <tr>
            <th><label for="">내용</th>
            <td><textarea cols="50" rows="30" maxlength="255" name="txtbox" id="txtbox" class="form-control" placeholder="내용작성"></textarea></td>
          </tr>
          <tr>
            <th><label for="">비밀번호</label></th>
            <td><input type="password" maxlength="255" name="pwd" id="pwd" autocomplete="off" class="form-control" placeholder="비밀번호를 입력하세요"></td>
          </tr>
        </tbody>
      </table>
      <p class="text-center">
        <input type="submit" value="등록하기" class="btn btn-primary">
        <input type="reset" value="취소하기" class="btn btn-secondary">
      </p>
    </section>
  </form>
  <script>
    function formCheck(){
      //제목체크
      if(document.getElementById('title').value.length<1){
        alert('제목을 입력하세요.');
        document.getElementById('title').focus();
        return false;
      }
      // //작성자 체크
      if(document.getElementById('name').value.length<1){
        alert('작성자 명을 입력하세요.');
        document.getElementById('name').focus();
        return false;
      }
      // //내용 체크
      if(document.getElementById('txtbox').value.trim().length===0){
        alert('내용을 입력하세요.');
        document.getElementById('txtbox').focus();
        return false;
      }
      // //패스워드 체크
      if(document.getElementById('pwd').value.length<1){
        alert('비밀번호를 입력하세요.');
        document.getElementById('pwd').focus();
        return false;
      }
    }
  </script>
<?php include('./php/footer.php'); ?>