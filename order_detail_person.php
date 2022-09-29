<?php
    session_start();
    require_once 'db.php';
    $id = $_GET['id'];
    $stmt = $conn->query("SELECT * FROM order_product WHERE id = $id");
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <div class="container mt-3">
        <div class="d-flex justify-content-end">
            <a href="order_detail.php" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
        <h5>ลำดับที่ <?= $order['id']; ?></h5><br>
        <h5>ชื่อ-นามสกุล <?= $order['firstname']; ?> <?= $order['lastname']; ?></h5><br>
        <h5>ที่อยู่ <?= $order['address']; ?></h5><br>
        <h5>เบอร์มือถือ <?= $order['mobile']; ?></h5><br>
        <h5>เวลาสั่งซื้อ <?= $order['order_date']; ?></h5><br><br>
        <h2>รายการสินค้าที่สั่ง</h2><br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">description</th>
                    <th scope="col">price</th>
                    <th scope="col">img</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stmt1 = $conn->query("SELECT * FROM `order_product`,`order_details`,`products` WHERE `order_product`.id=`order_details`.order_id AND `order_details`.product_id = `products`.id AND `order_details`.order_id=$id");
                    $stmt1->execute();
                    $product = $stmt1->fetchAll();
                    $i=1;
                    $total=0;
                    foreach ($product as $book) {
                        $total+=$book['price'];
                ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $book['id']; ?></td>
                        <td><?= $book['name']; ?></td>
                        <td><?= $book['description']; ?></td>
                        <td><?= $book['price']; ?></td>
                        <td width="150px"><img width="100%" src="<?= $book['img']; ?>" class="rounded"></td>
                    </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
        <br>
        <h1>ราคาสินค้าทั้งหมด = <?= $total ?></h1><br>
    </div>
</body>
</html>