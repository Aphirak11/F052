<?php
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>เพิ่มข้อมูลนักศึกษา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1 class="mb-4">เพิ่มข้อมูลนักศึกษา</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $std_id = $_POST['std_id'];
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $mail = $_POST['mail'];
        $tel = $_POST['tel'];
        $desc = $_POST['discription'];

        try {
            $sql = "INSERT INTO db6646_052 (std_id, f_name, l_name, mail, tel, discription) 
                    VALUES (:std_id, :f_name, :l_name, :mail, :tel, :desc)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':std_id' => $std_id,
                ':f_name' => $f_name,
                ':l_name' => $l_name,
                ':mail' => $mail,
                ':tel' => $tel,
                ':desc' => $desc
            ]);

            echo "<div class='alert alert-success'>บันทึกข้อมูลเรียบร้อย</div>";
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>ผิดพลาด: " . $e->getMessage() . "</div>";
        }
    }
    ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">รหัสนักศึกษา</label>
            <input type="text" name="std_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ชื่อ</label>
            <input type="text" name="f_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">สกุล</label>
            <input type="text" name="l_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">อีเมล</label>
            <input type="email" name="mail" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">เบอร์โทร</label>
            <input type="text" name="tel" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ข้อมูลเพิ่มเติม</label>
            <input type="text" name="discription" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">ยืนยัน</button>
    </form>
</body>

</html>


</tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

<script>
    new DataTable('#studentTable');
</script>
</body>

</html>

<?php
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Filter Product by Price</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">

    <style>
        .container {
            max-width: 800px;
        }
    </style>
</head>

<body>

    <?php

    if (isset($_POST['price']) && $_POST['price'] !== '') {
        $filterPrice = $_POST['price'];
        $filteredProduct = array_filter($products, function ($product) use ($filterPrice) {
            return $product['price'] == $filterPrice;
        });

        $filteredProduct = array_values($filteredProduct);
    } else {

    }
    ?>