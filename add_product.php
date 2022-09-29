<?php
    session_start();
    require_once 'db.php';
    $id = $_GET['id'];
    $success=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <?php
        $stmt = $conn->query("SELECT * FROM products WHERE id = $id");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        foreach ($rows as $book) {
            $success=1;
            if(!isset($_SESSION['cart']))
                $_SESSION['cart'] = array();
            $item = array(
                            'id' => $book['id'],
                            'name' => $book['name'],
                            'description' => $book['description'],
                            'price' => $book['price'],
                            'img' => $book['img'],
                        );
            array_push($_SESSION['cart'],$item);
        } 
    ?>
    <?php
        if($success!=0) {
    ?>
        <script>
            window.alert("นำสินค้าใส่ตระกร้าเรียบร้อยแล้ว");
            window.location.replace("index.php?page=<?= ceil($book['id']/10)-1; ?>");
        </script>
    <?php
        } else {
    ?>
        <script>
            window.alert("เกิดข้อผิดพลาด!!!");
            window.location.replace("index.php?page=0");
        </script>
    <?php
        }
    ?>
</body>
</html>