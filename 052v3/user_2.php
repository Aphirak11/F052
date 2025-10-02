<?php
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">

    <style>
        .container {
            max-width: 1000px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">รายการนักศึกษา</h2>

        <form method="post" class="mb-3">
            <a href="main.php" class="btn btn-primary">+ เพิ่มนักศึกษา</a>
        </form>

        <table id="studentTable" class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM db6646_052 ORDER BY `key` ASC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
