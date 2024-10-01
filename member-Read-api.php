<?php
    require_once("dbtools.php");
    $link = create_connection();
    //遞增 ASC 遞減 DESC
    $sql = "SELECT ID, Username, Email, Uid01,State, Level, Created_at FROM member ORDER BY ID DESC";
    $result = execute_sql($link, "testdb", $sql);
    $mydata = array();
    while($row = mysqli_fetch_assoc($result)){
        $mydata[] = $row;
    }
    echo '{"state" : true, "data": ' . json_encode($mydata) . ', "message" : "讀取會員資料成功!"}';
    mysqli_close($link);
?>