<?php
    session_start();

    if (isset($_GET['deleteAll'])) {
        if($_SESSION['cart']){
            unset($_SESSION['cart']);
            echo "<script>
                window.alert('นำสินค้าออกจากตระกร้าเรียบร้อยแล้ว');
                window.location.replace('cart_page.php');
            </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Cart Page</title>
</head>
<body>
    <div class="container mt-5">
        <h1>ตระกร้าสินค้า</h1><br>
        <div class="d-flex justify-content-end">
            <a href="?deleteAll" class="btn btn-danger">ลบสินค้าทั้งหมด</a>
            <a href="index.php" class="ms-3 btn btn-secondary">ย้อนกลับ</a>
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
                        <td>
                            <a href="del_cart.php?id=<?= $i ?>" class="btn btn-danger">ลบ</a>
                        </td>
                    </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
        <br>
        <h1>ราคาสินค้าทั้งหมด = <?= $total ?><a href="checkout.php" class="ms-3 btn btn-info">สั่งซื้อ</a></h1>
    </div>
</body>
</html>