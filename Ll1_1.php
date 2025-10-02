<?php


$error = []; // Array to hold errror messager

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //ตรวจสอบว่ากรอกข้อมูลมาครบหรือไม่ (empty)
    if (empty($username) || empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        $error[] = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // ครวจสอบรูปแบบอีเมล
        $errors[] = "กรุณากรองอีเมลให้ถูกต้อง";
    } elseif ($password !== $confirm_password) {
        $error[] = "รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน";
    } else {
        // ตรวจสอบว่ามีชื่อผู้ใช้หรืออีเมลถูกใช้ไปแล้วหรือไม่
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $email,]);

        if ($stmt->rowCont() > 0) {
            $error[] = "ชื่อผู้ใช้หรืออีเมลนี้ถูกใช้ไปแล้ว";
        }
    }



    if (empty($error)) { //ถ้ามไม่มีข้อผิดพลาดใดๆ
        //นำข้อมูลไปบันทึกในฐานข้อมูล
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(username, full_name, email, password, role) VALUES (?, ?, ?, ?, 'member')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $fullname, $email, $hashedPassword]);
        //ถ้าบันทึกสำเร็จ ให้เปลี่ยนเส้นทางไปหน้า login
        header("Location: login.php");
        exit(); // หยุดการทำงานของสคิปต์หลังจากเปลี่ยนเส้นทาง
    }
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <?php if (!empty($error)): // ถ ้ำมีข ้อผิดพลำด ให้แสดงข ้อควำม ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($error as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>

                    <!-- ใช ้ htmlspecialchars เพื่อป้องกัน XSS -->
                    <!-- < ? = คือ short echo tag ?> -->
                    <!-- ถ ้ำเขียนเต็ม จะได ้แบบด ้ำนล่ำง -->
                    <?php // echo "<li>" . htmlspecialchars($e) . "</li>"; ?>

                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center text-primary">
                        <h2>เพิ่มนักศึกษา</h2>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">รหัสนักศึกษา</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="เช่น 664230052">
                            </div>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">ชื่อ</label>
                                <input type="text" name="fullname" id="fullname" class="form-control"
                                    placeholder="ชื่อ">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">นามสกุล</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="นามสกุล">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">email</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="664230052@webmail.npru.ac.th">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">เบอร์โทร</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control" placeholder="099XXXXXXX">
                            </div>
                            <div class="gap-2">
                                <button type="submit" class="btn btn-secondary mt-2">ดูรายการ</button>
                                <button type="submit" class="btn btn-primary mt-2">เพิ่มข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>