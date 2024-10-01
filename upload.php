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

// 检查文件是否被上传
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    
    // 检查文件上传是否有误
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("File upload error.");
    }

    // 设置上传目录
    $uploadDir = 'upload/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // 设置文件路径
    $filePath = $uploadDir . basename($file['name']);

    // 移动上传的文件
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        echo "File uploaded successfully.";

        // 准备 SQL 语句
        $stmt = $conn->prepare("INSERT INTO images (file_path) VALUES (?)");
        $stmt->bind_param("s", $filePath);

        // 执行 SQL 语句
        if ($stmt->execute()) {
            echo "File path saved to database.";
        } else {
            echo "Error saving file path: " . $stmt->error;
        }

        // 关闭 SQL 语句
        $stmt->close();
    } else {
        echo "Error moving uploaded file.";
    }
} else {
    echo "No file uploaded.";
}

// 关闭数据库连接
$conn->close();
?>
