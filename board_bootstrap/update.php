<?php 
  include('./php/dbconn.php');
  include('./php/header.php');
  //view.php에서 넘겨진 id값 받기
  $id = $_GET['id'];
  $id = mysqli_real_escape_string($conn,$id);
  // echo $id;

  $sql = "select * from free_board where id='$id';";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  // echo $row['id']. '<br>';
  // echo $row['name']. '<br>';
  // echo $row['subject']. '<br>';
  // echo $row['memo']. '<br>';
  // echo date("Y-m-d", strtotime($row['datetime'])). '<br>';

?>
  <style>
    section h2{text-align:center; font-weight:600; margin-top:30px;}
    table caption{display:none;}
    textarea{height:500px;}
  </style>
  <form name="글쓰기 수정" method="post" action="./php/dbinput.php" onsubmit="return formCheck();">
    <section>
      <h2>게시판 글 수정</h2>
      <table class="free_board table table-bordered table-hover">
        <caption>글 수정하기</caption>
        <thead>
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
          <tr>
            <th scope="row"><label for="">글제목</label></th><br>
            <td><input type="text" maxlength="255" name="title" id="title" value="<?php echo $row['subject'] ?>" class="form-control"></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th><label for="">작성자</label></th>
            <td><input type="text" maxlength="50" name="name" id="name" value="<?php echo $row['name'] ?>" class="form-control" readonly></td>
          </tr>
          <tr>
          <tr>
            <th><label for="">내용</th>
            <td><textarea cols="50" rows="30" maxlength="255" name="txtbox" id="txtbox" class="form-control"><?php echo $row['memo'] ?></textarea></td>
          </tr>
          <tr>
            <th><label for="">비밀번호</label></th>
            <td><input type="password" maxlength="255" name="pwd" id="pwd" autocomplete="off" class="form-control"></td>
          </tr>
        </tbody>
      </table>
      <p class="text-center">
        <input type="submit" value="수정하기" class="btn btn-primary">
        <input type="reset" value="취소하기" class="btn btn-secondary">
      </p>
    </section>
  </form>
  <script>
    function formCheck(){
      // alert(document.getElementById('name').value.length);
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