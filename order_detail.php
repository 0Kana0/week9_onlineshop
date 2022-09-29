<?php
    session_start();
    require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Order Detail</title>
</head>
<body>
    <div class="container mt-5">
        <h1>รายละเอียดการสั่งซื้อ</h1><br>
        <div class="d-flex justify-content-end">
            <a href="index.php" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">firstname</th>
                    <th scope="col">lastname</th>
                    <th scope="col">address</th>
                    <th scope="col">mobile</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stmt = $conn->query("SELECT * FROM order_product");
                    $stmt->execute();
                    $orders = $stmt->fetchAll();
                    foreach ($orders as $order) {
                ?>
                    <tr>
                        <th scope="row"><?= $order['id']; ?></th>
                        <td><?= $order['firstname']; ?></td>
                        <td><?= $order['lastname']; ?></td>
                        <td><?= $order['address']; ?></td>
                        <td><?= $order['mobile']; ?></td>
                        <td>
                            <a href="order_detail_person.php?id=<?= $order['id']; ?>" class="btn btn-info">ดูสินค้าที่สั่งซื้อ</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>