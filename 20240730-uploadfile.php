 <?php
    // echo $_FILES['file']['name']."<BR>";
    // echo $_FILES['file']['type']."<BR>";
    // echo $_FILES['file']['size']."<BR>";
    // echo $_FILES['file']['tmp_name']."<BR>";

    // if($_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/png'){
    //     //產生檔案名稱
    //     $filename = date("YmdHis"). "_" . $_FILES['file']['name'];
    //     $location = "upload/" . $filename;

    //     if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
    //         //上傳成功
    //         $datainfo = array();
    //         $datainfo["原始檔案名稱"] = $_FILES['file']['name'];
    //         $datainfo["儲存檔案名稱"] = $filename;
    //         $datainfo["檔案格式"]     = $_FILES['file']['type'];
    //         $datainfo["檔案大小"]     = $_FILES['file']['size'];

    //         echo '{"state" : true, "datainfo": '. json_encode($datainfo) . ',"message" : "上傳成功"}';
    //     }else{
            //上傳失敗
//             echo '{"state" : false, "message" : "上傳失敗"}';
//         }
//     }else{
//         echo '{"state" : false, "message" : "檔案格式不符合規定!"}';
//     }





// 資料庫連線設定
$servername = "localhost";
$username = "admin01";
$password = "123456";
$dbname = "testdb";

// 建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/png'){
    // 產生檔案名稱
    $filename = date("YmdHis") . "_" . $_FILES['file']['name'];
    $location = "upload/" . $filename;

    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        // 上傳成功，存入資料庫
        $stmt = $conn->prepare("INSERT INTO product (Photo) VALUES (?)");
        $stmt->bind_param("s", $location);

        if ($stmt->execute()) {
            // 資料插入成功
            $datainfo = array();
            $datainfo["原始檔案名稱"] = $_FILES['file']['name'];
            $datainfo["儲存檔案名稱"] = $filename;
            $datainfo["檔案格式"]     = $_FILES['file']['type'];
            $datainfo["檔案大小"]     = $_FILES['file']['size'];

            echo json_encode(array(
                "state" => true,
                "datainfo" => $datainfo,
                "message" => "上傳成功",
                "filePath" => $location  // 返回圖片路徑
            ));
        } else {
            // 資料插入失敗
            echo json_encode(array(
                "state" => false,
                "message" => "資料庫插入失敗"
            ));
        }

        $stmt->close();
    } else {
        // 上傳失敗
        echo json_encode(array(
            "state" => false,
            "message" => "上傳失敗"
        ));
    }
} else {
    // 檔案格式不符合
    echo json_encode(array(
        "state" => false,
        "message" => "檔案格式不符合規定!"
    ));
}

$conn->close();


 ?>



