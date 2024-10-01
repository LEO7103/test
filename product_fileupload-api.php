<?php
// echo $_FILES['file'];
// echo'<BR>';
// echo $_FILES['file']['name'];
// echo'<BR>';
// echo $_FILES['file']['type'];
// echo'<BR>';
// echo $_FILES['file']['size'];
// echo'<BR>';
// echo $_FILES['file']['tmp_name'];
// echo'<BR>';
// echo $_FILES['file']['error'];
// echo'<BR>';
// // $myfile設定檔案命名的規則名字+uniqid 
// $myfile = date("YmdHis").uniqid().'_'.$_FILES['file']['name'];
// $filename = 'upload/'.$myfile;
// move_uploaded_file($_FILES['file']['tmp_name'],$filename);
if(isset($_FILES['file']['name']) && $_FILES['file']['name'] !=""){
    if($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png"){
        //重新命名檔案名傳遞至伺服器
        $myfile = date("YmdHis").uniqid().'_'.$_FILES['file']['name'];
        $uploadDirectory = 'upload/'. $filename; // 設置存儲目錄
        $filename = $uploadDirectory . $myfile;
        if(move_uploaded_file($_FILES['file']['tmp_name'],$filename)){
            $datainfo = array();
            $datainfo['name'] = $_FILES['file']['name'];
            $datainfo['type'] = $_FILES['file']['type'];
            $datainfo['size'] = $_FILES['file']['size'];
            $datainfo['tmp_name'] = $_FILES['file']['tmp_name'];
            $datainfo['error'] = $_FILES['file']['error'];
            $datainfo['serverfilename'] = $myfile;


            echo'{"state":true, "data":'.json_encode($datainfo).' ,"message":"上傳成功!"}';

        }else{
         $errorinfo = array();
         $erroeinfo["error"] = $_FILES['file']['error'];

         echo'{"state":false, "error_info":'.json_encode($errorinfo).' ,"message":"檔案上傳錯誤!"}';
        }

    }else{
        echo'{"state":false, "message":"檔案格式錯誤，必須為jpeg or png!"}';
    }

}else{
    echo'{"state":false, "message":"檔案不存在!"}';
}
?>
