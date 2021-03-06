<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cos_name = $_POST['cos_name'];
$rev_title = $_POST['rev_title'];
$rev_detail = $_POST['rev_detail'];
$rev_code = $_POST['rev_code'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "insert into review (cos_name, rev_title, rev_detail,rev_code) values('$cos_name','$rev_title','$rev_detail','$rev_code')");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // 리뷰 등록 query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 리뷰 등록 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=rev_list.php'>";
}
?>
