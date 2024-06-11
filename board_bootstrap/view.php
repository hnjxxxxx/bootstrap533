<?php
  include('./php/dbconn.php');
  include('./php/header.php');
  $id = $_GET['id'];
  $id = mysqli_real_escape_string($conn,$id);
  // echo $id; // 제목눌렀을 때 넘겨받은 id값 출력

  $sql = "select * from free_board where id='$id'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
?>
<style>
  section h2{text-align:center; font-weight:600; margin-top:100px;}
  table caption{display:none;}
  table th{width:10%;}
  .input-group{margin:auto;}
</style>
<main>
  <form name="frm" method="post" action="delete.php" onsubmit="return formCheck();">
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
    <section>
      <h2>글 내용 보기</h2>
      <table class="table table-bordered table-hover">
        <caption>글 내용 보기</caption>
          <tr>
            <th>No.</th>
            <td><?php echo $row['id'] ?></td>
          </tr>
          <tr>
            <th>작성자</th>
            <td><?php echo $row['name'] ?></td>
          </tr>
          <tr>
            <th>제목</th>
            <td><?php echo $row['subject'] ?></td>
          </tr>
          <tr>
            <th>내용</th>
            <td><?php echo $row['memo'] ?></td>
          </tr>
          <tr>
            <th>작성일</th>
            <td><?php echo date("Y-m-d", strtotime($row['datetime'])) ?></td>
          </tr>
      </table>
      <p class="text-center">
        <a href="list.php" title="목록보기" class="btn btn-primary">목록보기</a>
        <a href="update.php?id=<?php echo $row['id'] ?>" title="수정하기" class="btn btn-danger">글 수정하기</a>
        
        <div class="input-group w-50">
          <span class="input-group-text">비밀번호 </span>
          <input type="password" id="pwd" name="pwd" class="form-control" aria-label="비밀번호">
          <input type="submit" value="삭제하기" class="btn btn-primary">
        </div>
        <!-- <a href="delete.php?id=<?php echo $row['id'] ?>" title="삭제하기" onclick="return formCheck();">글 삭제하기</a> -->
      </p>
    </section>
  </form>
</main>
<script>
  function formCheck(){
    // alert('a');
    if(document.getElementById('pwd').value.length<1){
      alert('비밀번호를 입력하지 않았습니다. 다시 확인하세요.');
      return false;
    }else{
      // alert('삭제페이지로 갑니다.');
      // document.frm.action = "delete.php";
      // document.frm.submit();
      return true;
    }
  }
  
</script>