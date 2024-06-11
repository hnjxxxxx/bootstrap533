<?php
  include('./php/dbconn.php');

  $id = $_POST['id'];
  $id = mysqli_real_escape_string($conn,$id);
  //echo $id .'<br>'; // 제목눌렀을 때 넘겨받은 id값 출력

  $pwd = $_POST['pwd'];
  $pwd = mysqli_real_escape_string($conn,$pwd);
  // $pwd = password_hash($pwd, PASSWORD_DEFAULT);
  // echo $pwd .'<br>';

  $sql = "select * from free_board where id='$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  // echo $row['pwd'];

  if(password_verify($pwd, $row['pwd'])){
    echo "<script>alert('글을 삭제합니다.');</script>";
    $sql = "delete from free_board where id='$id'";
    mysqli_query($conn,$sql);
    echo "<script>location.replace('./list.php');</script>";
    exit;
  }else{
    echo "<script>alert('비밀번호가 달라 삭제할 수 없습니다. 다시 확인하세요.');</script>";
    echo "<script>history.back(1);</script>"; //이전페이지로 이동
    exit;
  } 
?>