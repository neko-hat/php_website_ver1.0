<?php
 
$connect = mysqli_connect("localhost", "yoobi", "toor", "php_db") or die("fail");
 
if($connect->connect_errno){
    echo '[연결실패..] : '.$connect->connect_error.'';
}else{
    echo '[연결성공!]'.'<br>';
}
 
?>