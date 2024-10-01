<?php
// {"uid01":"xxxxxxx"}

// {"state" : true, "data": "會員資訊", "message" : 驗證成功, 已登入!"}
// {"state" : false, "message" : "驗證失敗, 未登入!"}
// {"state" : false, "message" : "欄位不得為空白"}
// {"state" : false, "message" : "欄位命名錯誤"}

    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["uid01"])){
        if($mydata["uid01"] != ""){
            $p_uid01 = $mydata["uid01"];

            require_once("dbtools.php");
            $link = create_connection();

            $sql = "SELECT Username, Email, Uid01,State,Level FROM member WHERE Uid01 = '$p_uid01'";
            $result = execute_sql($link, "testdb", $sql);
            if(mysqli_num_rows($result) == 1){
                //驗證成功, 已登入
                $row = mysqli_fetch_assoc($result);
                echo '{"state" : true, "data": ' . json_encode($row) . ', "message" : "驗證成功, 已登入!"}';
            }else{
                //驗證失敗, 未登入
                echo '{"state" : false, "message" : "驗證失敗, 未登入!"}';
            }
            mysqli_close($link);
        }else{
            echo '{"state" : false, "message" : "欄位不得為空白"}';
        }
    }else{
        echo '{"state" : false, "message" : "欄位命名錯誤"}';
    }
?>