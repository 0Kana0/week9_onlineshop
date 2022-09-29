<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Checkout</title>
</head>
<body>
    <div class="container mt-5">
        <h1>สรุปรายการสินค้า</h1>
        <h1>ตระกร้าสินค้า</h1><br>
        <div class="d-flex justify-content-end">
            <a href="cart_page.php" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
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
                    $i=1;
                    $total=0;
                    foreach ($_SESSION['cart'] as $book) {
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
        <h1>รายละเอียดผู้สั่งซื้อ</h1>
        <div class="modal-body">
            <form action="order.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อ (First name)</label>
                    <input type="text" required class="form-control" name="firstname">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="col-form-label">นามสกุล (Last name)</label>
                    <input type="text" required class="form-control" name="lastname">
                </div>
                <div class="mb-3">
                    <label for="address" class="col-form-label">ที่อยู่ (Address)</label>
                    <textarea required class="form-control" name="address"></textarea>
                </div>
                <div class="mb-3">
                    <label for="mobile" class="col-form-label">เบอร์มือถือ (Mobile Number)</label>
                    <input type="text" required class="form-control" name="mobile">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-success">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>