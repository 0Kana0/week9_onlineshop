<?php
    session_start();
    require_once 'db.php';
    $limit_page = 10;
    if(isset($_GET["page"])){
        $start_page = $_GET["page"]*$limit_page;
    } else {
        $start_page=0;
    }
    $countsql = $conn->prepare("SELECT COUNT(id) FROM products");
    $countsql->execute();
    $row = $countsql->fetch();
    $num_rows = $row[0];
    $num_page = ceil($num_rows/$limit_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Show Product</title>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <a href="order_detail.php" class="me-3 btn btn-success">รายละเอียดการสั่งซื้อ (ฝั่ง Admin)</a>
            <a href="cart_page.php" class="btn btn-primary">ตระกร้าสินค้า</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">description</th>
                    <th scope="col">price</th>
                    <th scope="col">img</th>
                </tr>
            </thead>
            <tbody>
                <h3>จำนวนสินค้าทั้งหมด <?= $num_rows ?> รายการ</h3>
                <h3>จำนวนหน้าทั้งหมด <?= $num_page ?> หน้า</h3>
                <nav aria-label="...">
                    <ul class="pagination justify-content-center">
                        <?php
                            if($start_page/$limit_page<=0) {
                        ?>
                            <li class="page-item disabled">
                                <a class="page-link" tabindex="-1">Previous</a>
                            </li>
                        <?php }else{ ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?=($start_page/$limit_page)-1?>" tabindex="-1">Previous</a>
                            </li>
                        <?php } ?>

                        <?php
                            for($i=0;$i<$num_page;$i++) {
                        ?>
                            <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i+1?></a></li>
                        <?php } ?>

                        <?php
                            if($start_page/$limit_page>=$num_page-1) {
                        ?>
                            <li class="page-item disabled">
                                <a class="page-link" tabindex="-1">Next</a>
                            </li>
                        <?php }else{ ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?=($start_page/$limit_page)+1?>">Next</a>
                            </li>
                        <?php } ?>        
                    </ul>
                </nav>
                <?php
                    $stmt = $conn->query("SELECT * FROM products LIMIT $start_page,$limit_page");
                    $stmt->execute();
                    $product = $stmt->fetchAll();
                    foreach ($product as $book) {
                ?>
                    <tr>
                        <th scope="row"><?= $book['id']; ?></th>
                        <td><?= $book['name']; ?></td>
                        <td><?= $book['description']; ?></td>
                        <td><?= $book['price']; ?></td>
                        <td width="150px"><img width="100%" src="<?= $book['img']; ?>" class="rounded"></td>
                        <td>
                            <a href="add_product.php?id=<?= $book['id']; ?>" class="btn btn-warning">ใส่ตระกร้า</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>