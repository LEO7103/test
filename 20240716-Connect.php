<?php
$servername = "localhost";
$username= "owner";
$password="123456";

//建立連線
$conn = mysqli_connect($servername,$username,$password);
if(!$conn){
    die("連線失敗". mysqli_connect_errno());
}

echo "連線成功";

?>
