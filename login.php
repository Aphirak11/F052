<?php
    session_start(); //Start the session to uese session variables
    require_once 'config.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username0rEmail = trim($_POST['username_or_email']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username0rEmail,  $username0rEmail,]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            if($use['role'] === 'admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: index.php");
            }

        }



    }













?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>




<form method="post" class="row g-3">
        <div class="col-md-6">
            <label for="username_or_email" class="form-label">ชื่อผู้ใช้หรืออีเมล</label>
            <input type="text" name="username_or_email" id="username_or_email" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
            <div class="col-12">
            <button type="submit" class="btn btn-success">เข้าสู่ระบบ</button>
            <a href="register.php" class="btn btn-link">สมัครสมาชิก</a>
        </div>
</form>
















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>