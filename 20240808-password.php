<?php
    //時間戳記
    echo time();
    echo '<br>';
    echo date("Ymdhis");
    echo '<br>';

    //md5
    echo "md5('123456'): " . md5('123456');
    echo '<br>';
    echo "md5('abcdef'): " . md5('abcdef');
    echo '<br>';

    //uniqid
    echo "uniqid(): " . uniqid();
    echo '<br>';
    echo "uniqid(): " . uniqid(time());
    echo '<br>';

    //hash雜湊
    echo "hash('md5', time()): " . hash('md5', time());
    echo '<br>';
    echo "hash('sha256', time()): " . hash('sha256', time());
    echo '<br>';
    echo "hash('sha512', time()): " . hash('sha512', time());
    echo '<br>';
   

    //password_hash("密碼", 演算法)
    echo 'password_hash("123456", PASSWORD_DEFAULT): ' . password_hash("123456", PASSWORD_DEFAULT);
    echo '<br>';
    echo '<br>';
      //$2y$10$3y1tqWwOsYgueoyy29D5Fee8jOVsaJsm6XmA0ogja8r/l6zEfL5Yy
    $hash01 ='$2y$10$3y1tqWwOsYgueoyy29D5Fee8jOVsaJsm6XmA0ogja8r/l6zEfL5Yy';
    if (password_verify('123456', $hash01)){
        echo '密碼正確';

    }else{
        echo '密碼錯誤';

    }

     //產生UID01 花時間想演算法去產生複查度高的uid
     echo '<br>';
     echo '<br>';
     echo "UID01: " . substr(hash('sha256', uniqid(time())), 0, 8); 
?>