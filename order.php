<?php
    session_start();
    require_once 'db.php';
    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];

        $stmt = $conn->prepare("INSERT INTO order_product(firstname, lastname, address, mobile) VALUES (:firstname, :lastname, :address, :mobile)");
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":mobile", $mobile);
        $stmt->execute();

        $conn->exec($stmt);
        $last_id = $conn->lastInsertId();

        $stmt1 = $conn->prepare("INSERT INTO order_details(order_id, product_id) VALUES (:order_id, :product_id)");
        foreach ($_SESSION['cart'] as $book) {
            $stmt1->bindParam(":order_id", $last_id);
            $stmt1->bindParam(":product_id", $book['id']);
            $stmt1->execute();
        }
        unset($_SESSION['cart']);
    }
?>
<script>
    window.alert("บันทึกข้อมูลการสั่งซื้อเรียบร้อยแล้ว");
    window.location.replace("index.php?page=0");
</script>