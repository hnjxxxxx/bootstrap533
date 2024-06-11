<?php
  include('./php/dbconn.php');
  include('./php/header.php');
  $search_txt = $_POST['search_txt'];
  $search_txt = mysqli_real_escape_string($conn,$search_txt);
  // echo $search_txt;

  $sql = "select * from free_board where subject='$search_txt' or memo='$search_txt'order by id DESC";

  $result = mysqli_query($conn, $sql);

?>
<style>
  section h2{text-align:center; font-weight:600; margin-top:100px;}
  table caption{display:none;}
  table tr th:first-child{width:6%;}
  table tr th:nth-child(2){width:50%;}
  table tr th:nth-child(3){width:14%;}
  table tr th:nth-child(4){width:17%;}
  table tr th:last-child{width:13%;}
  a{text-decoration: none; color:#333;}
  .input-group{margin:auto;}
</style>
<main>
<form name="게시판 목록" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <section>
        <h2>게시판 목록</h2>
        <table class="table table-bordered table-striped table-hover">
          <caption>게시판목록</caption>
          <thead class="table-dark">
            <tr class="text-center">
              <th>번호</th>
              <th>제목</th>
              <th>작성자</th>
              <th>내용</th>
              <th>작성날짜</th>
            </tr>
          </thead>
        <?php
          while($row = mysqli_fetch_array($result)): ?>
          <tr>
            <td class="text-center"><?=$row['id']?></td>
            <td><?=$row['subject']?></td>
            <td class="text-center"><?=$row['name']?></td>
            <td><?=$row['memo']?></td>
            <td class="text-center"><?=substr($row['datetime'],0,10)?></td>
          </tr>
        <?php endwhile;
          mysqli_free_result($result);
          mysqli_close($conn);
        ?>
        </table>
        <!-- 검색창, 버튼 -->
        <div class="input-group w-75">
          <input type="text" id="search_txt" name="search_txt" placeholder="제목 또는 내용을 입력해주세요." class="form-control">
          <input type="submit" value="검색" id="search_btn" onclick="return formCheck();" class="btn btn-outline-primary">
          <a href="write.php" title="글쓰기" class="btn btn-primary">글쓰기</a>
        </div>
      </section>
    </form>
</main>
<?php include('./php/footer.php'); ?>
<script>
  function formCheck(){
      let search_text = document.getElementById('search_txt');
      if(search_text.value.length<1){
        alert('검색어를 입력하지 않았습니다. 확인하세요.');
        return false;
      }else{
        return true;
      }
    }
  
</script>