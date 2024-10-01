<?php
    // {"state" : true, "data": "所有消息資料", "message" : "讀取成功!"}
    // {"state" : false, "message" : "讀取失敗!"}

    $data = file_get_contents("php://input", "r");

            $servername = "localhost";
            $username = "admin01";
            $password = "123456";
            $dbname = "testdb";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if(!$conn){
                die("連線失敗".mysqli_connect_error());
            }

            $sql = "SELECT * FROM `productt` ORDER BY ID DESC";
            $result = mysqli_query($conn, $sql);
            $mydata = array();
            if(mysqli_num_rows($result)){
                while($row = mysqli_fetch_assoc($result)){
                    $mydata[] = $row;
                }
                echo '{"state" : true, "data": '.json_encode($mydata).', "message" : "讀取成功!"}';
            }else{
                echo '{"state" : false, "message" : "讀取失敗!"}';
            }
            mysqli_close($conn);
?>