<?php

//input:
//{{"ID":"XXX","name":"雞腿飯","price":"100","num":"2","remark":"好吃"}}

$data = file_get_contents("php://input","r");
$mydata =array();
$mydata =json_decode( $data,true);
// echo $mydata["ID"];
// echo $mydata["name"];
// echo $mydata["price"];
// echo $mydata["remark"];

if(isset($mydata["ID"]) && isset($mydata["name"]) && isset($mydata["price"]) && isset($mydata["num"]) && isset($mydata["remark"])){
   if($mydata["ID"] != "" && $mydata["name"] != "" && $mydata["price"] != "" && $mydata["num"] != "" && $mydata["remark"] ){
$p_id =$mydata["ID"];
$p_name =$mydata["name"];
$p_price =$mydata["price"];
$p_num =$mydata["num"];
$p_remark =$mydata["remark"];
$p_photo =$mydata["photo"];

 $servername ="localhost";
 $username ="admin01";
 $password ="123456";
 $dbname ="testdb";

 $conn = mysqli_connect($servername,$username,$password,$dbname);
 if(!$conn){

   die("連線失敗".mysqli_connect_error());
}

 $sql ="UPDATE product SET Name = '$p_name', Price = '$p_price', Num = '$p_num',Remark ='$p_remark',Photo ='$p_photo' WHERE ID = '$p_id' "; 


  if(mysqli_query($conn,$sql)){
      echo '{"state" : true, "message" : "更新成功"}';
  }else{
 echo '{"state" : false, "message" : "更新失敗和錯誤代碼等' .  $sql . mysqli_error($conn) .'"}';

  }
  mysqli_close($conn);
  }else{
   echo '{"state" : false, "message" : "欄位不得為空白"}';
    }
}else{
   echo '{"state" : false, "message" : "欄位命名錯誤0826"}';

}





 
?>