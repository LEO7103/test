<?php
    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["username"])){
        if($mydata["username"] != ""){
            $p_username = $mydata["username"];

            require_once("dbtools.php");
            $link = create_connection();
             //先設變數$sql去資料庫找帳戶名稱'$p_username'
             //再利用$result去執行"連線 "資料庫名稱" "$sql=要找的名稱函式"
             //再用 if(mysqli_num_rows($result) == 0)去判斷是否有這筆資料
            $sql = "SELECT Username FROM member WHERE Username = '$p_username'";
            $result = execute_sql($link, "testdb", $sql);
            if(mysqli_num_rows($result) == 0){
        
                echo '{"state" : true, "message" : "帳號不存在, 可以使用"}';
            }else{
          
                echo '{"state" : false, "message" : "帳號已存在, 不可以使用"}';
            }
            mysqli_close($link);
        }else{
            echo '{"state" : false, "message" : "欄位不得為空白"}';
        }
    }else{
        echo '{"state" : false, "message" : "欄位命名錯誤"}';
    }
?>