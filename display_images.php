<?php
$servername = "localhost"; // 数据库服务器地址
$username = "admin01"; // 数据库用户名
$password = "123456"; // 数据库密码
$dbname = "my_database"; // 数据库名

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 查询图片路径
$sql = "SELECT file_path FROM images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出图片
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Image Gallery</title>
        <style>
            img {
                max-width: 200px; /* 控制图片大小 */
                margin: 10px;
            }
        </style>
    </head>
    <body>
        <h1>Image Gallery</h1>";
        
    while ($row = $result->fetch_assoc()) {
        $filePath = htmlspecialchars($row['file_path']);
        echo "<img src='$filePath' alt='Image'>";
    }

    echo "</body></html>";
} else {
    echo "No images found.";
}

// 关闭数据库连接
$conn->close();
?>
