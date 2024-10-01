<?php
// {"id":"xxx", "email": "owner@test.com"}

// {"state" : true, "message" : "更新成功"}
// {"state" : false, "message" : "註冊失敗和錯誤代碼等"}
// {"state" : false, "message" : "欄位不得為空白"}
// {"state" : false, "message" : "欄位命名錯誤"}

    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["id"]) && isset($mydata["email"])){
        if($mydata["id"] != "" && $mydata["email"] != ""){
            $p_id = $mydata["id"];
            $p_email = $mydata["email"];

            require_once("dbtools.php");
            $link = create_connection();

            $sql = "UPDATE member SET Email = '$p_email' WHERE ID = '$p_id'";
            if(execute_sql($link, "testdb", $sql)){
                echo '{"state" : true, "message" : "更新成功"}';
            }else{
                echo '{"state" : false, "message" : "註冊失敗和錯誤代碼等"}';
            }
            mysqli_close($link);
        }else{
            echo '{"state" : false, "message" : "欄位不得為空白"}';
        }
    }else{
        echo '{"state" : false, "message" : "欄位命名錯誤"}';
    }
?>