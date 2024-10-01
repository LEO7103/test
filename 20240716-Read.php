<?php
$servername = "localhost";
$username = "admin01";
$password = "123456";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("連線失敗" . mysqli_connect_error());
}

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    //抓第一筆資料
    // $row =mysqli_fetch_assoc($result);
    // echo "ID:" .$row["ID"] . "Name" .$row["Name"];

    //抓第二筆資料
    // $row =mysqli_fetch_assoc($result);
    // echo "ID:" .$row["ID"] . "Name" .$row["Name"];

    $mydata = array();
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "ID:" .$row["ID"] . "Name" .$row["Name"];
        $mydata[] = $row;
        //($result)找資料給$row   再把資料給陣列的 $mydata
    }
   
    echo '{"state" : true, "data" : '.json_encode($mydata).' ,"message" :"讀取所有產品成功"}';
} else {
    echo '{"state";false,"message":"讀取失敗和錯誤代碼"}';
}
mysqli_close($conn);
