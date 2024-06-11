<?php
  include('./php/dbconn.php');
  include('./php/header.php');
?>
  <style>
    section h2{text-align:center; font-weight:600; margin-top:100px;}
    table caption{display:none;}
    table tr th:first-child{width:6%;}
    table tr th:nth-child(2){width:67%;}
    table tr th:nth-child(3){width:14%;}
    table tr th:last-child{width:13%;}
    a{text-decoration: none; color:#333;}
    .input-group{margin:auto;}
  </style>
  <main>
    <form name="게시판 목록" method="post" action="search_result.php">
      <section>
        <h2>게시판 목록</h2>
        <table class="table table-striped table-hover">
          <caption>게시판목록</caption>
          <thead class="table-dark">
            <tr class="text-center">
              <th>번호</th>
              <th>제목</th>
              <th>작성자</th>
              <th>작성날짜</th>
            </tr>
          </thead>
        <?php
          //한 페이지에 보여질 게시물 개수
          $list_num = 5;

          //한 블럭당 페이지 수
          $page_num = 3;

          //현재 페이지
          $page = isset($_GET['page'])? $_GET['page']:1; 
          // echo $page;
          //전체 페이지 수
          // $total_page = ceil($num/$list_num);
          $total_page = ceil(50/$list_num);

          //전체블럭 = 전체페이지 수 / 블럭당 페이지 수
          $total_block = ceil($total_page/$page_num);

          //현재 블럭번호
          $now_block = ceil($page/$page_num);

          //블럭당 시작페이지 번호
          $s_pageNum = ($now_block-1)*$page_num +1;

          //데이터가 0인 경우
          if($s_pageNum <=0){$s_pageNum=1;}

          //블럭당 마지막페이지 번호
          $e_pageNum = $now_block*$page_num;

          //마지막 번호가 전체 페이지번호보다 크다면 동일한 값을 준다
          if($e_pageNum > $total_page){$e_pageNum=$total_page;}


          //변수 출력하기
          $start = ($page-1)*$list_num;
          $sql = "select * from free_board order by id DESC limit $start, $list_num;";
          $result = mysqli_query($conn, $sql);
          $cnt = $start+1;

          // $query = 'select id, subject, name, datetime from free_board order by id DESC';
          // $result = mysqli_query($conn, $query);

          // mysqli_fetch_row() 배열번호를 통해 값 호출
          // mysqli_fetch_assoc() db의 테이블의 필드명을 통해 값 호출
          // mysqli_fetch_array() 배열번호와 필드명 모두를 통해 값 호출
          /*
          substr(string, start, [,length]) : 문자열의 일부분을 추출하는 함수
            start: 추출시작하는 위치, length: 추출할 문자 개수(없으면 문자열끝까지 추출)
          */

          while($row = mysqli_fetch_array($result)): ?>
          <tr>
            <td class="text-center"><?=$row['id']?></td>
            <td class="text-left"><a href="view.php?id=<?=$row['id']?>" title="<?=$row['subject']?>"><?=$row['subject']?></a></td>
            <td class="text-center"><?=$row['name']?></td>
            <td class="text-center"><?=substr($row['datetime'],0,10)?></td>
            <!-- <td><?=date("Y-m-d", strtotime($row['datetime']))?></td> -->
          </tr>
          <?php 
              
              //페이지네이션
              $cnt++;
          ?>
          
        <?php endwhile;
          mysqli_free_result($result);
          mysqli_close($conn); //데이터베이스 접속종료
        ?>
        </table>
        <!-- 페이지네이션 -->
        <nav aria-label="페이지내이션" class="">
          <ul class="pagination justify-content-center">
            <!-- 이전 페이지 -->
            <?php
              if($page <=1){?>
                <li class="page-item"><a href="list.php?page=1" title="이전페이지로" class="page-link">이전</a></li>
            <?php }else{ ?>
                <li class="page-item"><a href="list.php?page=<?php echo ($page-1);?>" title="이전페이지로" class="page-link">이전</a></li>
            <?php } ?>
            <!-- 페이지 번호 출력 -->
            <?php
            for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?>
              <li class="page-item">
                <a href="list.php?page=<?php echo $print_page; ?>" class="page-link">
                  <?php echo $print_page ?>
                </a>
              </li>
            <?php } ?>
            <!-- 다음페이지 -->
            <?php
            if($page >= $total_page){?>
              <li class="page-item"><a href="list.php?page=<?php echo $total_page; ?>" title="다음페이지로" class="page-link">다음</a></li>
            <?php }else{ ?>
              <li class="page-item"><a href="list.php?page=<?php echo ($page+1); ?>" title="다음페이지로" class="page-link">다음</a></li>
            <?php } ?>
          </ul>
        </nav>
        <!-- 버튼 -->
        <div class="input-group text-center w-75">
          <input class="form-control" type="text" id="search_txt" name="search_txt" placeholder="제목 또는 내용을 입력해주세요.">
          <input class="input-group-text btn btn-outline-primary" type="submit" value="검색" id="search_btn" onclick="return formCheck();">
          <a class="btn btn-primary" href="write.php" title="글쓰기">글쓰기</a>
        </div>
      </section>
    </form>
  </main>
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
<?php include('./php/footer.php'); ?>